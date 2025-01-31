<?php
session_start();
require("dbconnect.php");

// ตรวจสอบว่าเป็นผู้ดูแลระบบหรือไม่
if ($_SESSION['emp_level'] != "a") {
    echo "<center>Page for administrators <a href=login.php>Please log in first.</a></center>";
    exit();
}

if (!$_SESSION["emp_id"]) {
    header("location:login.php");
} else {
    // ดึงข้อมูลพนักงาน
    $sqllogin = "SELECT * FROM employee WHERE emp_id='" . $_SESSION["emp_id"] . "'";
    $result = mysqli_query($con, $sqllogin);
    $row = mysqli_fetch_assoc($result);

    // ดึงข้อมูลสายพันธุ์แมวจากฐานข้อมูล
    $sqlCatBreeds = "SELECT * FROM catbreeds";
    $resultCatBreeds = mysqli_query($con, $sqlCatBreeds);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <style>
        body {
            background-color:rgb(173, 56, 122);
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 30px;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            max-width: 80%;
        }
        h2, h3 {
            color: #4CAF50;
            text-align: center;
            margin-bottom: 20px;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table td, .table th {
            vertical-align: middle;
            text-align: center;
        }
        .btn-danger, .btn-success {
            font-size: 1rem;
            padding: 8px 15px;
            border-radius: 50px;
        }
        .btn-danger:hover { background-color: #c82333; }
        .btn-success:hover { background-color: #218838; }
        .logout-icon {
            font-size: 1.4rem;
            margin-left: 10px;
        }
        .table-container {
            margin-top: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .alert {
            margin-top: 20px;
            padding: 10px;
            font-size: 1.1rem;
            border-radius: 8px;
        }
        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border-color: #bee5eb;
        }
    </style>
</head>

<body>
    <div class="container">
      <div style="text-align: center;" >
        <h2>ยินดีต้อนรับผู้ดูแลระบบ</h2>
        <p>
            <i class='bx bx-user-voice'></i> สวัสดีคุณ 
            <?php echo $row["emp_title"] . " " . $row["emp_name"] . " " . $row["emp_surname"]; ?> 
            <a href="logout.php" class="btn btn-danger btn-sm">
                <i class='bx bx-lock-open bx-flashing logout-icon'></i> Log Out
            </a>
        </p>
        </div>

        <!-- ตารางข้อมูลพนักงาน -->
        <div class="table-container">
            <h3>ข้อมูลพนักงาน</h3>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>คำนำหน้า</th>
                        <th>ชื่อ</th>
                        <th>สกุล</th>
                        <th>วันเกิด</th>
                        <th>ที่อยู่ปัจจุบัน</th>
                        <th>ทักษะความสามารถ</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $row["emp_title"]; ?></td>
                        <td><?php echo $row["emp_name"]; ?></td>
                        <td><?php echo $row["emp_surname"]; ?></td>
                        <td><?php echo $row["emp_birthday"]; ?></td>
                        <td><?php echo $row["emp_adr"]; ?></td>
                        <td><?php echo $row["emp_skill"]; ?></td>
                        <td><?php echo $row["emp_tel"]; ?></td>
                        <td><a href="editformdata.php?emp_id=<?php echo $row["emp_id"]; ?>" class="btn btn-success">แก้ไข</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-container">
    <h3>รายการสายพันธุ์แมว</h3>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>รูปภาพ</th>
                <th>ชื่อสายพันธุ์ (TH)</th>
                <th>ชื่อสายพันธุ์ (EN)</th>
                <th>คำอธิบาย</th>
                <th>ลักษณะเด่น</th>
                <th>คำแนะนำในการดูแล</th>
                <th>สถานะ</th>
                <th>แก้ไข</th>
                <th>ลบ</th> <!-- New delete column -->
            </tr>
        </thead>
        <tbody>
            <?php while ($cat = mysqli_fetch_assoc($resultCatBreeds)) { ?>
                <tr>
                    <td><?php echo $cat["id"]; ?></td>
                    <td>
                        <!-- Display the image if it exists -->
                        <?php if (!empty($cat["image_url"])) { ?>
                            <img src="<?php echo $cat["image_url"]; ?>" alt="Image" style="width: 100px; height: auto;">
                        <?php } else { ?>
                            <span>No image</span>
                        <?php } ?>
                    </td>
                    <td><?php echo $cat["name_th"]; ?></td>
                    <td><?php echo $cat["name_en"]; ?></td>
                    <td>✔</td>
                    <td>✔</td>
                    <td>✔</td>
                    <td><?php echo ($cat["is_visible"] == 1) ? "แสดง" : "ซ่อน"; ?></td>
                    <td>
                        <a href="edit_catbreed.php?id=<?php echo $cat["id"]; ?>" class="btn btn-success">แก้ไข</a>
                    </td>


                    
                    <td>
                        <!-- Delete link -->
                        <a href="delete_catbreed.php?id=<?php echo $cat['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณแน่ใจว่าต้องการลบข้อมูลนี้?')">ลบ</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="text-center mt-4">
    <a href="insertform.php" class="btn btn-success">เพิ่มข้อมูลสายพันธุ์แมว</a>
  </div>
</div>

        </div>


        
        <div class="alert alert-info">
            <p>โปรดตรวจสอบข้อมูลก่อนทำการแก้ไข</p>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php } ?>
