<?php
require('dbconnect.php');

$cat_id = $_GET["id"];
$sql = "SELECT * FROM catbreeds WHERE id=$cat_id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
        background-color:rgb(67, 154, 131);
        font-family: 'Arial', sans-serif;
    }
    .form-container {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        border-top: 4px solid #28a745;
    }
    .form-container h2 {
        margin-bottom: 30px;
        color: #333;
    }
    .form-label {
        font-weight: bold;
    }
    .form-control, .form-select {
        border-radius: 10px;
    }
    .btn-custom {
        background-color: #28a745;
        color: white;
        border-radius: 20px;
        font-size: 16px;
    }
    .btn-custom:hover {
        background-color: #218838;
    }
    .btn-back {
        background-color: #007bff;
        color: white;
        border-radius: 20px;
        font-size: 16px;
    }
    .btn-back:hover {
        background-color: #0056b3;
    }
    .img-preview {
        margin-top: 15px;
        border-radius: 8px;
        max-width: 100%;
        max-height: 200px;
    }
  </style>
  <title>แก้ไขข้อมูลสายพันธุ์แมว</title>
</head>
<body>
  <div class="container my-5">
    <div class="form-container">
      <h2 class="text-center">แก้ไขข้อมูลสายพันธุ์แมว</h2>
      <form action="update_catbreeds.php" method="POST" class="form-container" enctype="multipart/form-data">
        
        <!-- Make the id field visible and editable -->
        <div class="mb-3">
          <label class="form-label">รหัสสายพันธุ์:</label>
          <input type="text" name="id" class="form-control" value="<?php echo $row['id']; ?>" readonly>
        </div>
        
        <div class="mb-3">
          <label class="form-label">ชื่อสายพันธุ์ (TH):</label>
          <input type="text" name="name_th" class="form-control" value="<?php echo $row['name_th']; ?>" required>
        </div>
        
        <div class="mb-3">
          <label class="form-label">ชื่อสายพันธุ์ (EN):</label>
          <input type="text" name="name_en" class="form-control" value="<?php echo $row['name_en']; ?>" required>
        </div>
        
        <div class="mb-3">
          <label class="form-label">คำอธิบาย:</label>
          <textarea name="description" class="form-control" rows="4" required><?php echo $row['description']; ?></textarea>
        </div>
        
        <div class="mb-3">
          <label class="form-label">ลักษณะทั่วไป:</label>
          <textarea name="care_instructions" class="form-control" rows="4" required><?php echo $row['care_instructions']; ?></textarea>
        </div>
        
        <div class="mb-3">
          <label class="form-label">คำแนะนำในการดูแล:</label>
          <textarea name="characteristics" class="form-control" rows="4" required><?php echo $row['characteristics']; ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">สถานะ:</label>
          <select name="is_visible" class="form-select">
            <option value="1" <?php if ($row['is_visible'] == 1) echo "selected"; ?>>แสดง</option>
            <option value="0" <?php if ($row['is_visible'] == 0) echo "selected"; ?>>ซ่อน</option>
          </select>
        </div>
        
        <div class="mb-3">
          <label class="form-label">เลือกรูปภาพ:</label>
          <input type="file" name="image" class="form-control">
          <?php if ($row['image_url']) { ?>
            <p>รูปภาพปัจจุบัน:</p>
            <img src="<?php echo $row['image_url']; ?>" alt="Current Image" class="img-preview">
          <?php } ?>
        </div>
        
        <div class="text-center">
          <button type="submit" class="btn btn-custom">บันทึกการแก้ไข</button>
          <a href="admin_page.php" class="btn btn-back">กลับหน้าแรก</a>
        </div>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
