<?php
session_start();
require("dbconnect.php");

// ตรวจสอบว่าเป็นผู้ดูแลระบบหรือไม่
if ($_SESSION['emp_level'] != "a") {
    echo "<center>หน้าสำหรับผู้ดูแลระบบ <a href=login.php>กรุณาเข้าสู่ระบบก่อน</a></center>";
    exit();
}

if (!$_SESSION["emp_id"]) {
    header("location:login.php");
    exit();
}

// ตรวจสอบและลบข้อมูลสายพันธุ์แมว
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // SQL Query for deleting the cat breed by ID
    $sqlDelete = "DELETE FROM catbreeds WHERE id = ?";
    if ($stmt = mysqli_prepare($con, $sqlDelete)) {
        mysqli_stmt_bind_param($stmt, "i", $id);  // Bind the ID to the SQL query
        if (mysqli_stmt_execute($stmt)) {
            // If successful, redirect to the admin panel or show a success message
            header("Location: admin_page.php");
            exit();
        } else {
            echo "ไม่สามารถลบข้อมูลได้";
        }
    } else {
        echo "ไม่สามารถเตรียมคำสั่ง SQL ได้";
    }
}
?>
