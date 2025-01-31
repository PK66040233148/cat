<?php
require('dbconnect.php'); // Connect to database

// Check if 'emp_data' exists in the POST array
$emp_data = isset($_POST["emp_data"]) ? $_POST["emp_data"] : ''; // If not set, use an empty string

$sql = "SELECT * FROM employee WHERE emp_name LIKE '%$emp_data%' OR emp_surname LIKE '%$emp_data%' ORDER BY emp_name ASC"; 
$result = mysqli_query($con, $sql); // Execute the query

$count = mysqli_num_rows($result); // Count the number of rows returned by the query
$order = 1; // Initialize row numbering

$stmt = $con->prepare("SELECT * FROM employee WHERE emp_name LIKE ? OR emp_surname LIKE ? ORDER BY emp_name ASC");
$emp_data = '%' . $emp_data . '%';  // Add '%' around the value
$stmt->bind_param("ss", $emp_data, $emp_data);
$stmt->execute();
$result = $stmt->get_result();
?>

<!-- The rest of your HTML code follows below -->

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>รายชื่อพนักงานทั้งหมด</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f4f8fb;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color:rgb(189, 117, 117);
            margin-bottom: 20px;
            font-size: 32px;
            font-weight: 700;
            text-align: center;
        }
        .btn-info {
            background-color: #40a495;
            border: none;
        }
        .btn-info:hover {
            background-color:rgb(255, 255, 255);
        }
        .btn-success {
            background-color: #ff5c8d;
            border: none;
        }
        .btn-success:hover {
            background-color: #ff5c8d;
        }
        .btn-danger {
            background-color: #ff6b6b;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .table {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(222, 37, 37, 0.1);
            width: 100%;
            margin-top: 20px;
            table-layout: auto;
        }
        .table th, .table td {
            border: 1px solid #dcdcdc;
            padding: 15px;
            text-align: center;
            font-size: 14px;
        }
        .table th {
            background-color: #f8f9fa;
            color: #343a40;
        }
        .table-dark {
            background-color: #f1f4f9;
            color: #5f6b77;
        }
        .form-control {
            background-color: #f9fafb;
            border: 1px solid #e2e6ea;
            border-radius: 8px;
        }
        .form-control:focus {
            background-color: #ffffff;
            border-color: #007bff;
            outline: none;
        }
        .container {
            width: 100%;
            max-width: 1100px;
            margin: auto;
            background: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(207, 6, 6, 0.1);
        }
        .table th:nth-child(8), .table td:nth-child(8) {
            white-space: normal;
            min-width: 130px;
            word-wrap: break-word;
        }
        .table th:nth-child(5), .table td:nth-child(5) {
            white-space: normal;
            min-width: 110px;
            word-wrap: break-word;
        }

        .table th:nth-child(3), .table td:nth-child(3) {
            white-space: normal;
            min-width: 90px;
            word-wrap: break-word;
            text-align: left;
        }

        .table th:nth-child(4), .table td:nth-child(4) {
            white-space: normal;
            min-width: 110px;
            word-wrap: break-word;
            text-align: left;
        }
        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            font-size: 16px;
        }
        .alert b {
            font-size: 18px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>ค้นหาข้อมูลพนักงาน</h1>
    <form action="searchdata.php" class="form-group my-4" method="POST">
    <div class="row">
        <div class="col-md-8">
            <input type="text" placeholder="กรอกชื่อหรือนามสกุลที่ต้องการค้นหา" class="form-control" name="emp_data" required>
        </div>
        <div class="col-md-4">
            <input type="submit" value="ค้นหาข้อมูลพนักงาน" class="btn btn-info w-100">
        </div>
    </div>
    </form>
    <?php if ($count > 0) { ?>
    <div class="table-responsive mt-4">
        <table class="table table-striped">
            <thead class="table-dark">
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
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
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
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } else { ?>
        <div class="alert alert-danger mt-4">
            <b>ไม่พบข้อมูลพนักงาน!!</b>
        </div>
    <?php } ?>
    <a href="index.php" class="btn btn-success mt-4">กลับหน้าแรก</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
