<?php
require('dbconnect.php');

// รับค่าที่ส่งมาจากฟอร์ม
$name_th = $_POST["name_th"];
$name_en = $_POST["name_en"];
$description = $_POST["description"];
$characteristics = $_POST["characteristics"];
$care_instructions = $_POST["care_instructions"];
$is_visible = $_POST["is_visible"];
$cat_id = $_POST["id"];  // รับค่า id จากฟอร์ม

// ตรวจสอบการอัพโหลดไฟล์
$image_url = null;
if (isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
    // กำหนดโฟลเดอร์ที่ต้องการให้เก็บไฟล์
    $upload_dir = 'uploads/';
    
    // ดึงข้อมูลของไฟล์ที่อัพโหลด
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    
    // กำหนด path ที่จะเก็บไฟล์
    $image_url = $upload_dir . basename($image_name);
    
    // ย้ายไฟล์ไปยังโฟลเดอร์ที่กำหนด
    if (!move_uploaded_file($image_tmp, $image_url)) {
        echo "<br><br>Fail to upload image <br><br>There is a problem ";
        exit;
    }
}

// ถ้าไม่มีการอัพโหลดรูปใหม่ จะใช้ภาพเดิม
if (!$image_url) {
    $sql = "SELECT image_url FROM catbreeds WHERE id = '$cat_id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $image_url = $row['image_url'];
}

// อัพเดตข้อมูลในฐานข้อมูล
$sql = "UPDATE catbreeds 
        SET name_th = '$name_th', name_en = '$name_en', description = '$description', 
            characteristics = '$characteristics', care_instructions = '$care_instructions', 
            image_url = '$image_url', is_visible = '$is_visible' 
        WHERE id = '$cat_id'";

$result = mysqli_query($con, $sql);

// ตรวจสอบผลการทำงาน
if ($result) {
    header("Location: admin_page.php");
    exit();
} else {
    echo "เกิดข้อผิดพลาด: " . mysqli_error($con);
}
?>
