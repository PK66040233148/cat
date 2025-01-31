<?php
require('dbconnect.php');

$emp_id = $_GET["emp_id"];

$sql = "SELECT * FROM employee WHERE emp_id=$emp_id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

  <style>
    .form-signin {
        width: 100%;
        max-width: 500px;
        padding: 20px;
        margin: auto;
        max-height: 80vh;
        overflow-y: auto;
        overflow-x: hidden;
        border: 2px solid #ddd;
        border-radius: 10px;
        background: rgb(140, 227, 198);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        background: #ffffff;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    body {
        background: linear-gradient(135deg, #a3aaff, #f9f7fc);
        font-family: 'Arial', sans-serif;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    h2 {
        font-family: 'Arial', sans-serif;
        font-weight: bold;
        color: rgb(51, 16, 96);
    }
  </style>

  <title>แก้ไขข้อมูลพนักงาน</title>
</head>

<body>
  <div class="container my-3">
    <h2 class="text-center">แก้ไขข้อมูลพนักงาน</h2>
    <hr>
    <form action="updatedata.php" method="POST" class="form-signin">
      <input type="hidden" value="<?php echo $row["emp_id"]; ?>" name="emp_id">
      
      <div class="form-group">
        <label for="emp_title">คำนำหน้า :</label>
        <select name="emp_title" class="form-control" required>
          <option value="นาย" <?php if ($row["emp_title"] == "นาย") { echo "SELECTED"; } ?>>นาย</option>
          <option value="นาง" <?php if ($row["emp_title"] == "นาง") { echo "SELECTED"; } ?>>นาง</option>
          <option value="นางสาว" <?php if ($row["emp_title"] == "นางสาว") { echo "SELECTED"; } ?>>นางสาว</option>
        </select>
      </div>

      <div class="form-group">
        <label for="emp_name">ชื่อ :</label>
        <input type="text" name="emp_name" class="form-control" value="<?php echo $row["emp_name"]; ?>" required>
      </div>

      <div class="form-group">
        <label for="emp_surname">นามสกุล :</label>
        <input type="text" name="emp_surname" class="form-control" value="<?php echo $row["emp_surname"]; ?>" required>
      </div>

      <div class="form-group">
        <label for="emp_birthday">วันเดือนปีเกิด :</label>
        <input type="date" name="emp_birthday" class="form-control" value="<?php echo $row["emp_birthday"]; ?>" required>
      </div>

      <div class="form-group">
        <label for="emp_adr">ที่อยู่ปัจจุบัน :</label>
        <textarea name="emp_adr" class="form-control" required><?php echo $row["emp_adr"]; ?></textarea>
      </div>

      <div class="form-group">
        <label for="emp_skill">ทักษะความสามารถ :</label>
        <textarea name="emp_skill" class="form-control" required><?php echo $row["emp_skill"]; ?></textarea>
      </div>

      <div class="form-group">
        <label for="emp_tel">เบอร์โทรศัพท์ :</label>
        <input type="tel" name="emp_tel" class="form-control" value="<?php echo $row["emp_tel"]; ?>" required>
      </div>

      <div class="form-group">
        <label for="emp_user">ชื่อเข้าระบบ :</label>
        <input type="text" name="emp_user" class="form-control" value="<?php echo $row["emp_user"]; ?>" required>
      </div>

      <div class="form-group">
        <label for="emp_pass">รหัสผ่าน :</label>
        <input type="password" name="emp_pass" class="form-control" value="<?php echo $row["emp_pass"]; ?>" required>
      </div>

      <div class="form-group">
        <label for="emp_level">ระดับผู้ใช้งาน <i class='bx bxs-user-pin'></i></label>
        <select name="emp_level" class="form-control" readonly>
          <option value="a" <?php if ($row["emp_level"] == "a") { echo "SELECTED"; } ?>>ผู้ดูแลระบบ</option>
          <option value="u" <?php if ($row["emp_level"] == "u") { echo "SELECTED"; } ?>>ผู้ใช้งาน</option>
        </select>
      </div>

      <div class="form-group">
        <label for="emp_department">แผนก :</label>
        <select name="emp_department" class="form-control" required>
        <option value="">--เลือกแผนก--</option>
        <option value="1">ฝ่ายบุคคล</option>
        <option value="2">ฝ่ายสินเชื่อ</option>
        <option value="3">ฝ่ายขาย</option>
        <option value="4">ฝ่ายจัดซื้อ</option>
        <option value="5">ฝ่ายการเงิน</option>
        <option value="6">ฝ่ายส่งของ</option>
        </select>
      </div>

      <div class="my-3">
        <input type="submit" value="แก้ไขข้อมูล" class="btn btn-success">
        <input type="reset" value="ล้างข้อมูล" class="btn btn-danger">
        <a href="index.php" class="btn btn-primary">กลับหน้าแรก</a>
      </div>
    </form>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>
