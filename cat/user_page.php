<?php
session_start();
require("dbconnect.php");
if ($_SESSION['emp_level'] != "u") {
  echo "<center>หน้าสำหรับผู้ใช้งานระบบ <a href=login.php>กรุณาเข้าสู่ระบบก่อน</a></center>";
  exit();
}
if (!$_SESSION["emp_id"]) {
  header("location:login.php");
} else {

  $sqllogin = "SELECT * FROM employee WHERE emp_id='" . $_SESSION["emp_id"] . "'";
  $result = mysqli_query($con, $sqllogin);
  $row = mysqli_fetch_assoc($result);

?>
  <!doctype html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Member Dashboard</title>
    <style>

      body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(135deg, #ff9a9e, #fad0c4, #fbc2eb, #a1c4fd);
    padding-top: 40px;
  }
      .container {
        margin-top: 30px;
      }

      h2 {
        color: #212529;
        font-weight: bold;
        font-size: 2.5rem;
        margin-bottom: 20px;
      }

      .welcome-message {
        font-size: 1.2rem;
        color: #007bff;
        margin-bottom: 20px;
      }

      .table {
        margin-top: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
      }

      .table th {
        background-color: #343a40;
        color: #fff;
        text-align: center;
      }

      .table td {
        text-align: center;
        vertical-align: middle;
      }

      .btn-custom {
        background-color: #28a745;
        color: white;
        border-radius: 5px;
        padding: 5px 10px;
      }

      .btn-custom:hover {
        background-color: #218838;
      }

      .btn-logout {
        background-color: #dc3545;
        color: white;
        border-radius: 5px;
        padding: 5px 10px;
      }

      .btn-logout:hover {
        background-color: #c82333;
      }

      .table tbody tr:hover {
        background-color: #f1f1f1;
      }

      .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        padding: 20px;
      }

      .card-header {
        background-color: #343a40;
        color: #fff;
        font-size: 1.5rem;
      }

      .card-body {
        padding: 20px;
      }

    </style>
  </head>

  <body>
    <div class="container">
      <div class="card">
        <div class="card-header">
          <i class='bx bx-user-voice'></i> ยินดีต้อนรับสมาชิก
        </div>
        <div class="card-body">
          <p class="welcome-message">สวัสดีคุณ <?php echo $row["emp_title"]; echo $row["emp_name"]; echo "&nbsp"; echo $row["emp_surname"]; ?> 
            <a href="logout.php" class="btn-logout btn-sm"><i class='bx bx-lock-open bx-flashing'></i> Log Out</a>
          </p>
          
          <table class="table table-bordered">
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
                <!--แก้ไขข้อมูล-->
                <td><a href="editformdata.php?emp_id=<?php echo $row["emp_id"] ?>" class="btn btn-success btn-custom">แก้ไข</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
  </html>

<?php } ?>
