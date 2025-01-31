<?php
require('dbconnect.php'); // Connect to the database

// Check if there is a search query
$search = isset($_POST['search']) ? mysqli_real_escape_string($con, $_POST['search']) : '';

$sql = "SELECT * FROM catbreeds WHERE is_visible = 1";

// Add the search condition to the SQL query
if ($search != '') {
    $sql .= " AND (id LIKE '%$search%' OR name_th LIKE '%$search%' OR name_en LIKE '%$search%')";
}

$result = mysqli_query($con, $sql); // Execute SQL query
$count = mysqli_num_rows($result); // Count rows
?>

<!doctype html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ข้อมูลสายพันธุ์แมว</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Verdana', sans-serif;
      background-color:rgb(93, 191, 158);
      color: #4a4a4a;
      padding: 20px;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #4a90e2;
      color: #fff;
      padding: 15px 20px;
      border-radius: 10px;
      margin-bottom: 20px;
    }
    .header h1 {
      margin: 0;
      font-size: 24px;
    }
    .header .search-box {
      display: flex;
      align-items: center;
    }
    .search-box input {
      padding: 8px 15px;
      border-radius: 20px 0 0 20px;
      border: 1px solid #ccc;
      outline: none;
    }
    .search-box button {
      padding: 8px 20px;
      border: none;
      background-color: #333;
      color: #fff;
      border-radius: 0 20px 20px 0;
      cursor: pointer;
    }
    .card {
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      padding: 20px;
    }
    .card img {
      width: 200px;
      height: 200px;
      object-fit: cover;
      border-radius: 10px;
      margin-right: 20px;
    }
    .card h2 {
      font-size: 20px;
      margin-bottom: 10px;
    }
    .card-section {
      margin-top: 10px;
    }
    .card-section h3 {
      font-size: 16px;
      margin-bottom: 5px;
      color: #4a90e2;
    }
    .btn {
      padding: 10px 20px;
      border-radius: 25px;
    }
  </style>
</head>
<body>

<div class="header">
<a href="index.php" class="btn btn-warning me-3" style="display: flex; align-items: center; padding: 10px 20px; border-radius: 25px;">
  <h1 style="margin: 0; font-size: 24px; color: white; font-weight: bold;">สายพันธุ์แมวยอดนิยม</h1>
</a>

  <div class="d-flex">
    <a href="login.php" class="btn btn-warning me-3">เข้าสู่ระบบแอดมิน</a>
    <form method="POST" class="search-box">
      <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="ช่องค้นหา">
      <button type="submit">ค้นหา</button>
    </form>
  </div>
</div>

<div class="container">
  <?php if ($count > 0) {
    while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="card">
        <div class="d-flex align-items-center">
          <?php if (!empty($row["image_url"])) { ?>
            <img src="<?php echo htmlspecialchars($row["image_url"]); ?>" alt="รูปแมว">
          <?php } else { ?>
            <span>ไม่มีรูป</span>
          <?php } ?>
          <div>
            <h1><?php echo htmlspecialchars($row["name_th"]); ?> (<?php echo htmlspecialchars($row["name_en"]); ?>)</h1>
            <p>รหัส : <?php echo htmlspecialchars($row["id"]); ?></p>
          </div>
        </div>

        <div class="card-section">
          <h2><span style="font-size: 24px; color: orange;">ประวัติโดยคร่าวๆ</span></h2>
          <p>⠀⠀⠀⠀<?php echo htmlspecialchars($row["description"]); ?></p>
        </div>

        <div class="card-section">
          <h2><span style="font-size: 24px; color: orange;">ลักษณะทั่วไป</span></h2>
          <p>⠀⠀⠀⠀<?php echo htmlspecialchars($row["care_instructions"]); ?></p>
        </div>

        <div class="card-section">
          <h2><span style="font-size: 24px; color: orange;">การเลี้ยงดู</span></h2>
          <p>⠀⠀⠀⠀<?php echo htmlspecialchars($row["characteristics"]); ?></p>
        </div>
      </div>
    <?php }
  } else { ?>
    <p class="text-center">ไม่มีข้อมูลสายพันธุ์แมว</p>
  <?php } ?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
