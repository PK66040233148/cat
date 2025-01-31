<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: rgb(67, 150, 154);
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
    </style>
    <title>เพิ่มสายพันธุ์แมว</title>
</head>

<body>
    <div class="container my-5">
        <div class="form-container">
            <h2 class="text-center">เพิ่มสายพันธุ์แมว</h2>
            <form action="insertdata.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">ชื่อภาษาไทย:</label>
                    <input type="text" name="name_th" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">ชื่อภาษาอังกฤษ:</label>
                    <input type="text" name="name_en" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">คำอธิบาย:</label>
                    <textarea name="description" class="form-control" rows="4"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">คุณลักษณะ:</label>
                    <textarea name="care_instructions" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">คำแนะนำการดูแล:</label>
                    <textarea name="characteristics" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">เลือกรูปภาพ:</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">สถานะการแสดงผล:</label>
                    <select name="is_visible" class="form-select" required>
                        <option value="1">แสดง</option>
                        <option value="0">ไม่แสดง</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-custom">บันทึกข้อมูล</button>
                    <input type="reset" value="ล้างข้อมูล" class="btn btn-danger">
                    <a href="index.php" class="btn btn-back">กลับหน้าแรก</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
