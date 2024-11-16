<?php
// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_db";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่าได้รับข้อมูลจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $newWeight = $_POST['newWeight'];
    $newType = $_POST['newType'];
    $newUnit = $_POST['newUnit'];
    $newPrice = $_POST['newPrice'];

    // ตรวจสอบว่ามีการกรอกข้อมูลหรือไม่
    if (empty($id) || empty($newWeight) || empty($newType) || empty($newUnit) || empty($newPrice)) {
        echo "ข้อมูลไม่ครบถ้วน!";
        exit;
    }

    // เริ่มต้นการทำงานในฐานข้อมูล (ใช้ transaction เพื่อให้การอัพเดตและการบันทึกประวัติเป็นอะตอมิก)
    $conn->begin_transaction();

    try {
        // อัพเดตข้อมูลในตาราง inventory
        $sql = "UPDATE inventory SET weight = ?, type = ?, unit = ?, price = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("dsssi", $newWeight, $newType, $newUnit, $newPrice, $id);

        if (!$stmt->execute()) {
            throw new Exception("เกิดข้อผิดพลาดในการอัพเดตข้อมูลใน inventory: " . $stmt->error);
        }

        // ดึงข้อมูลสินค้าที่อัพเดตจากฐานข้อมูล
        $sqlProduct = "SELECT product_name, weight FROM inventory WHERE id = ?";
        $stmtProduct = $conn->prepare($sqlProduct);
        $stmtProduct->bind_param("i", $id);
        $stmtProduct->execute();
        $stmtProduct->bind_result($productname, $oldWeight);
        $stmtProduct->fetch();
        $stmtProduct->close();

        // คำนวณการเปลี่ยนแปลงของน้ำหนัก (Change Amount)
        $changeamount = $newWeight - $oldWeight;

       // ตั้งค่าสถานะการเปลี่ยนแปลงเป็น "เข้า"
       $change_type = 'addition';  // สถานะ "เข้า"
       $status_class = 'status-in'; // ชนิดสถานะที่เกี่ยวข้องกับ "เข้า"

        // กำหนดวันที่เปลี่ยนแปลง
        $formatted_date = date('Y-m-d H:i:s');

        // บันทึกข้อมูลที่แก้ไขลงในตาราง inventory_history
        $sqlHistory = "INSERT INTO inventory_history (product_name, change_amount, change_type, type, change_date) 
               VALUES (?, ?, ?, ?, ?)";
        $stmtHistory = $conn->prepare($sqlHistory);
        $stmtHistory->bind_param("sdsss", $productname, $newWeight, $change_type, $newType, $formatted_date);

        if (!$stmtHistory->execute()) {
            throw new Exception("เกิดข้อผิดพลาดในการบันทึกข้อมูลลงใน inventory_history: " . $stmtHistory->error);
        }

        // ยืนยันการทำงานทั้งหมดใน transaction
        $conn->commit();

        echo "ข้อมูลถูกอัพเดตเรียบร้อย!";
        header("Location: inventory.php"); // ไปที่หน้า inventory หลังจากบันทึกข้อมูล
        exit;
    } catch (Exception $e) {
        // หากเกิดข้อผิดพลาด, ย้อนกลับการทำงานทั้งหมด
        $conn->rollback();
        echo "เกิดข้อผิดพลาด: " . $e->getMessage();
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
