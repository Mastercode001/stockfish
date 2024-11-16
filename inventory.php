<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="inv_design.css" rel="stylesheet" type="text/css" />
    <link href="table_inv.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-...<your-integrity-hash>..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <style>
        .icon-large {
            font-size: 40px; /* ปรับขนาดตามที่ต้องการ */
        }

        .icon-large1 {
            padding: 2px;
            font-size: 20px; /* ปรับขนาดตามที่ต้องการ */
        }
        
        .navbar {
            background-color: #89a0fa;
        }

      
        .btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 140px;
        height: 1.5cm;
        border: none;
        border-radius: 50px;
        background-color: rgba(255, 255, 255, 0.955);
        color: #333;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        transition: background-color 0.3s ease;
        margin-left: 60px;
        }
        @media only screen and (max-width: 520px){
            
    .btn{
        margin: auto;
        background-color: #89a0fa;
        }
        .navbar {
            width: 810px;
        }
        }
         /* สไตล์สำหรับ Popup */
    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .popup-content {
        background: white;
        padding: 20px;
        border-radius: 8px;
        width: 300px;
        text-align: center;
    }

    .popup-content h2 {
        margin-bottom: 15px;
    }

    .popup-content input, .popup-content select {
        width: 100%;
        padding: 8px;
        margin: 5px 0;
    }

    .popup-content button {
        padding: 8px 16px;
        margin-top: 10px;
        cursor: pointer;
    }

    .popup-content button:hover {
        background-color: #4CAF50;
        color: white;
    }
    </style>

    <title>คลัง</title>
</head>

<body>
    <div class="main-container">
        <div class="button-container">
            <div>
                <button class="btn glass"><a href="index.php">
                        <i class="material-symbols-outlined icon-large mr-2">home</i>
                    </a></button>
                <div class="la"><b>หน้าหลัก</b></div>
            </div>
            <div>
                <button class="btn glass"><a href="add_inventory.php">
                        <i class="material-symbols-outlined icon-large mr-2">assignment_add</i>
                    </a></button>
                <div class="la"><b>เพิ่มคลัง</b></div>
            </div>
            <div>
                <button class="btn glass"><a href="inventory.php">
                        <i class="material-symbols-outlined icon-large mr-2">inventory_2</i>
                    </a></button>
                <div class="la"><b>คลัง</b></div>
            </div>
            <div>
                <button class="btn glass"><a href="minus.php">
                        <i class="material-symbols-outlined icon-large mr-2">monitor_weight_loss</i>
                    </a></button>
                <div class="la"><b>เบิกสินค้า</b></div>
            </div>
            <div>
                <button class="btn glass"><a href="history.php">
                        <i class="material-symbols-outlined icon-large mr-2">history</i>
                    </a></button>
                <div class="la2"><b>ประวัติการเข้า-ออก</b></div>
            </div>
        </div>
        
    </div>
<div class="main-container1">
    <div class="navbar bg-base-100">
  <div class="navbar-start">
    <div class="dropdown">
      <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-10 w-10"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h16M4 18h7" />
        </svg>
      </div>
      <div class="container" onclick="myFunction(this)">
      <ul
    tabindex="0"
    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
    <li><a href="index.php"><i class="fas fa-home"></i> หน้าหลัก</a></li><hr>
    <li><a href="add_inventory.php"><i class="fas fa-plus"></i> เพิ่มคลัง</a></li><hr>
    <li><a href="inventory.php"><i class="fas fa-box"></i> คลังสินค้า</a></li><hr>
    <li><a href="minus.php"><i class="fas fa-minus"></i> เบิกสินค้า</a></li><hr>
    <li><a href="history.php"><i class="fas fa-history"></i> ประวัติการเข้า-ออก</a></li>
</ul></div>

    </div>
  </div>
  <div class="navbar-center">
    <a class="btn btn-ghost text-4xl">คลัง</a>
  </div>
  <div class="navbar-end">
    
  </div>
</div>
</div>  
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

    // รับค่า type และ search จาก dropdown และ input
    $type_filter = isset($_GET['type']) ? $_GET['type'] : '';
    $search_query = isset($_GET['search']) ? $_GET['search'] : '';

    // สร้าง SQL Query ตามค่า filter และ search
$sql = "SELECT * FROM inventory WHERE 1=1";
if ($type_filter) {
    $type_filter = $conn->real_escape_string($type_filter);
    $sql .= " AND type = '$type_filter'";
}
if ($search_query) {
    $search_query = $conn->real_escape_string($search_query);
    $sql .= " AND product_name LIKE '%$search_query%'";
}

// เพิ่มการจัดเรียงน้ำหนักจากมากไปน้อย
$sql .= " ORDER BY weight DESC"; // เพิ่มบรรทัดนี้
$result = $conn->query($sql);

    ?>

    <div class="wrapper">
        <!-- ช่องค้นหาและ Dropdown -->
        <div class="search-box">
            <form action="" method="GET">
                <input type="text" name="search" class="input input-bordered w-24 md:w-auto" placeholder="ค้นหา" value="<?php echo htmlspecialchars($search_query); ?>">
                <select name="type" class="search-select">
                    <option value="">เลือกประเภท</option>
                    <option value="ใหญ่" <?php if ($type_filter == 'ใหญ่') echo 'selected'; ?>>ใหญ่</option>
                    <option value="ตกไซด์" <?php if ($type_filter == 'ตกไซด์') echo 'selected'; ?>>ตกไซด์</option>
                    <option value="เล็ก" <?php if ($type_filter == 'เล็ก') echo 'selected'; ?>>เล็ก</option>
                </select>
                <button type="submit" class="search-button">
                    <i class="material-symbols-outlined icon-large1">search</i>
                </button>
            </form>
        </div>

        <button onclick="deleteSelected()" class="delete-button">ลบที่เลือก</button>
        <!-- <button onclick="EditSelected()" class="edit-button">แก้ไขที่เลือก</button> -->
    </div>
    
    <script>
        // Function to handle the delete button click
        function deleteSelected() {
            var selectedIds = [];
            var checkboxes = document.querySelectorAll("input[type='checkbox']:checked");
            checkboxes.forEach(function (checkbox) {
                selectedIds.push(checkbox.value);
            });
            if (selectedIds.length > 0) {
                if (confirm("คุณแน่ใจหรือไม่ว่าต้องการลบรายการที่เลือก?")) {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'delete_inventory.php';

                    selectedIds.forEach(function (id) {
                        var input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'delete_ids[]';
                        input.value = id;
                        form.appendChild(input);
                    });

                    document.body.appendChild(form);
                    form.submit();
                }
            } else {
                alert("กรุณาเลือกสินค้าเพื่อทำการลบก่อน.");
            }
        }
    </script>

<script>
    function editItem(id, productName, currentWeight, currentType, currentUnit, currentPrice) {
        // แสดง popup ที่มีช่องกรอกข้อมูลใหม่
        const popup = document.createElement('div');
        popup.className = 'popup-overlay';
        popup.innerHTML = `
            <div class="popup-content">
                <h2>แก้ไขข้อมูลสินค้า: ${productName}</h2>
                <label for="newWeight">น้ำหนัก:</label>
                <input type="number" id="newWeight" value="${currentWeight}" required>

                <label for="newType">ประเภท:</label>
                <select id="newType" required>
                    <option value="ใหญ่" ${currentType === 'ใหญ่' ? 'selected' : ''}>ใหญ่</option>
                    <option value="ตกไซด์" ${currentType === 'ตกไซด์' ? 'selected' : ''}>ตกไซด์</option>
                    <option value="เล็ก" ${currentType === 'เล็ก' ? 'selected' : ''}>เล็ก</option>
                </select>

                <label for="newUnit">หน่วย:</label>    
                <select id="newUnit" required>
                    <option value="ขีด" ${currentType === 'ขีด' ? 'selected' : ''}>ขีด</option>
                    <option value="กก." ${currentType === 'กก.' ? 'selected' : ''}>กก.</option>
                    
                </select>

                <label for="newPrice">ราคา:</label>
                <input type="number" id="newPrice" value="${currentPrice}" required>

                <button onclick="saveEdit(${id})">บันทึกการแก้ไข</button>
                <button onclick="closePopup()">ยกเลิก</button>
            </div>
        `;
        document.body.appendChild(popup);
    }

    function saveEdit(id) {
    const newWeight = document.getElementById('newWeight').value;
    const newType = document.getElementById('newType').value;
    const newUnit = document.getElementById('newUnit').value;
    const newPrice = document.getElementById('newPrice').value;

    if (!newWeight || !newType || !newUnit || !newPrice) {
        alert('กรุณากรอกข้อมูลให้ครบถ้วน!');
        return;
    }

    // ส่งข้อมูลไปยังเซิร์ฟเวอร์สำหรับการอัพเดต
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'edit_inventory.php';

    form.appendChild(createInput('id', id));
    form.appendChild(createInput('newWeight', newWeight));
    form.appendChild(createInput('newType', newType));
    form.appendChild(createInput('newUnit', newUnit));
    form.appendChild(createInput('newPrice', newPrice));

    // ส่งน้ำหนักใหม่ไปด้วยสำหรับบันทึกในประวัติ
    form.appendChild(createInput('oldWeight', document.getElementById('newWeight').getAttribute('value'))); // ค่าหน้ำหนักเก่า

    document.body.appendChild(form);
    form.submit();
}


    function createInput(name, value) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = value;
        return input;
    }

    function closePopup() {
        document.querySelector('.popup-overlay').remove();
    }
</script>




<script>
    function highlightSearchTerm() {
        const searchQuery = new URLSearchParams(window.location.search).get('search');
        if (searchQuery) {
            const regex = new RegExp(searchQuery, 'gi');
            const elements = document.querySelectorAll('td:nth-child(3)'); // เลือกเฉพาะคอลัมน์ชื่อสินค้า

            elements.forEach(el => {
                if (el.textContent.match(regex)) {
                    el.innerHTML = el.textContent.replace(regex, match => `<span class="highlight">${match}</span>`);
                }
            });
        }
    }

    // Call the function when the page loads
    document.addEventListener('DOMContentLoaded', highlightSearchTerm);
</script>

<!-- การแสดงหน้าจอแบบมือถือ -->
    <div class="te">
        <table class="table">
            <!-- head -->
            <thead>
                <tr style="font-size:20px;">
                    <th><center>เลือก</center></th> <!-- เพิ่มคอลัมน์สำหรับ Checkbox -->
                    <th><center>ลำดับ</center></th>
                    <th>ชื่อสินค้า</th>
                    <th>ประเภท</th>
                    <th>น้ำหนัก</th>
                    <th>หน่วย</th>
                    <th>ราคา</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($result->num_rows > 0) {
    // แสดงข้อมูล
    $row_number = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr style='font-size:16px;'>";
        echo "<td><center><input type='checkbox' name='delete_ids[]' value='" . $row['id'] . "'></center></td>"; // เพิ่ม Checkbox
        echo "<th style='text-align: center;'>" . $row_number . "</th>";
        echo "<td>" . $row['product_name'] . "</td>";
        echo "<td>" . $row['type'] . "</td>";
        echo "<td>" . $row['weight'] . "</td>";
        echo "<td>" . $row['unit'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        // เพิ่มคอลัมน์สำหรับปุ่มแก้ไข
        echo "<td><center><button class='edit-button' onclick='editItem(" . $row['id'] . ", \"" . $row['product_name'] . "\", " . $row['weight'] . ", \"" . $row['type'] . "\", \"" . $row['unit'] . "\", " . $row['price'] . ")'>แก้ไข</button></center></td>";
        echo "</tr>";
        $row_number++;
    }
} else {
    echo "<tr><td colspan='8' style='text-align: center;'>ไม่มีข้อมูล</td></tr>";
}
?>

</tbody>

        </table>
    </div>
</body>

</html>
