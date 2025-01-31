<?php
require('dbconnect.php'); // Connect to database
$sql = "SELECT * FROM employee"; // Query to select all employee data
$result = mysqli_query($con, $sql); // Execute the query

$count = mysqli_num_rows($result); // Count the number of rows returned by the query
$order = 1; // Initialize row numbering
?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

  <title>รายชื่อพนักงานทั้งหมด</title>
  <style>
    body {
      font-family: 'Verdana', sans-serif;
      background-color: #f4f7f6; /* Soft grey background */
      color: #4a4a4a;
      margin: 0;
      padding: 20px;
    }
    
    h1 {
      color: #333;
      font-size: 3rem;
      font-weight: bold;
      text-align: center;
      margin-top: 30px;
      text-transform: uppercase;
      letter-spacing: 2px;
    }
    
    .btn {
      padding: 10px 30px;
      font-size: 1rem;
      border-radius: 25px;
    }
    
    .btn-info {
      background-color: #4ab1a8; /* Fresh teal color */
      border: none;
      color: white;
    }
    
    .btn-info:hover {
      background-color: #40a495; /* Darker teal */
    }
    
    .btn-success {
      background-color: #ff5c8d; /* Soft pink */
      border: none;
      color: white;
    }
    
    .btn-success:hover {
      background-color: #ff4756; /* Darker pink */
    }

    /* Custom blue button */
    .btn-primary {
      background-color: #007bff; /* Blue color */
      border: none;
      color: white;
    }

    .btn-primary:hover {
      background-color: #0056b3; /* Darker blue */
    }

    .table {
      background-color: #ffffff; /* White background for table */
      border-radius: 15px;
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
      margin-top: 40px;
    }
    
    .table th, .table td {
      padding: 15px;
      text-align: center;
      vertical-align: middle;
    }
    
    .table thead {
      background-color: #333;
      color: white;
    }
    
    .table tbody tr:hover {
      background-color: #f0f8ff;
    }
    
    .form-control {
      border-radius: 20px;
      padding: 12px 20px;
      font-size: 1rem;
      background-color: #eaeaea; /* Light grey background for input */
      border: 1px solid #ddd;
    }
    
    .form-control:focus {
      border-color: #ff5c8d; /* Pink border on focus */
      box-shadow: 0 0 10px rgba(255, 92, 141, 0.5); /* Light pink glow */
    }
    
    .container {
      max-width: 900px;
      margin: auto;
    }
    
    .search-bar {
      margin-top: 30px;
      display: flex;
      gap: 10px;
    }
    
    .search-bar input[type="submit"] {
      width: 100%;
      border-radius: 25px;
    }
    
    .btn-container {
      margin-top: 30px;
      text-align: center;
    }
  </style>
</head>
<body>

<div class="container">
  <h1>รายชื่อพนักงานทั้งหมด</h1>

  <!-- Search Form -->
  <form action="searchdata.php" method="POST" class="search-bar">
    <input type="text" name="namesearch" placeholder="กรอกชื่อพนักงานที่ต้องการค้นหา" class="form-control">
    <input type="submit" value="ค้นหาข้อมูลพนักงาน" class="btn btn-info">
  </form>

  <!-- Employee Table -->
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>คำนำหน้า</th>
        <th>ชื่อ</th>
        <th>นามสกุล</th>
        <th>วันเกิด</th>
        <th>ที่อยู่ปัจจุบัน</th>
        <th>ทักษะความสามารถ</th>
        <th>เบอร์โทรศัพท์</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($count > 0) {
        while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo htmlspecialchars($order++); ?></td>
            <td><?php echo htmlspecialchars($row["emp_title"]); ?></td>
            <td><?php echo htmlspecialchars($row["emp_name"]); ?></td>
            <td><?php echo htmlspecialchars($row["emp_surname"]); ?></td>
            <td><?php echo htmlspecialchars($row["emp_birthday"]); ?></td>
            <td><?php echo htmlspecialchars($row["emp_adr"]); ?></td>
            <td><?php echo htmlspecialchars($row["emp_skill"]); ?></td>
            <td><?php echo htmlspecialchars($row["emp_tel"]); ?></td>
          </tr>
        <?php }
      } else { ?>
        <tr>
          <td colspan="8" class="text-center">ไม่มีข้อมูลพนักงาน</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <div class="btn-container">
    <a href="insertform.php" class="btn btn-success mt-4">กรอกข้อมูลพนักงาน</a>
  </div>
  <div class="btn-container">
    <a href="login.php" class="btn btn-primary mt-4">เข้าสู่ระบบ</a>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>
</html>
