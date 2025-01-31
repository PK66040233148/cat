<?php
// เชื่อมต่อฐานข้อมูล
require('dbconnect.php');

// รับค่าที่ส่งมาจากฟอร์ม
$name_th = mysqli_real_escape_string($con, $_POST["name_th"]);
$name_en = mysqli_real_escape_string($con, $_POST["name_en"]);
$description = mysqli_real_escape_string($con, $_POST["description"]);
$characteristics = mysqli_real_escape_string($con, $_POST["characteristics"]);
$care_instructions = mysqli_real_escape_string($con, $_POST["care_instructions"]);
$is_visible = $_POST["is_visible"];

// ตรวจสอบโฟลเดอร์ uploads และสร้างหากไม่มี
$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// ตรวจสอบการอัพโหลดไฟล์
if (isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
    // ตรวจสอบประเภทไฟล์ที่อนุญาต
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $file_type = mime_content_type($_FILES['image']['tmp_name']);
    
    if (!in_array($file_type, $allowed_types)) {
        die("อัพโหลดได้เฉพาะไฟล์ .jpg, .png, .gif เท่านั้น");
    }

    // สร้างชื่อไฟล์ใหม่เพื่อป้องกันการซ้ำซ้อน
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $new_filename = uniqid('cat_', true) . '.' . $ext;
    $image_path = $upload_dir . $new_filename;

    // ย้ายไฟล์ไปยังโฟลเดอร์ที่กำหนด
    if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
        // บันทึกข้อมูลลงฐานข้อมูล
        $sql = "INSERT INTO catbreeds (name_th, name_en, description, characteristics, care_instructions, image_url, is_visible) 
                VALUES ('$name_th', '$name_en', '$description', '$characteristics', '$care_instructions', '$image_path', '$is_visible')";
        
        if (mysqli_query($con, $sql)) {
            header("location:index.php");
            exit;
        } else {
            die("เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($con));
        }
    } else {
        die("อัปโหลดรูปภาพล้มเหลว โปรดตรวจสอบการตั้งค่าของเซิร์ฟเวอร์");
    }
} else {
    die("กรุณาอัปโหลดรูปภาพ");
}
?>
