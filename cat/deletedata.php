<?php
require('dbconnect.php');

$emp_id = $_GET["emp_id"];

$sql = "DELETE FROM employee WHERE emp_id=$emp_id";
$result = mysqli_query($con, $sql);

if ($result) {
  header("location:index.php");
  exit(0);
} else {
  echo "ไม่สามารถลบได้ หรือ มีข้อผิดพลาดเกิดขึ้น";
}
