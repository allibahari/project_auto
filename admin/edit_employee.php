<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش اطلاعات کارمند</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .employee-form {
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-custom {
            width: 100%;
            margin-top: 10px;
        }
        .back-btn {
            margin-top: 20px;
            display: inline-block;
            color: #ffffff;
            background-color: #dc3545;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-btn:hover {
            text-decoration: none;
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-4 mb-4 text-center">ویرایش اطلاعات کارمند</h1>
        <a href="list_employees.php" class="back-btn">بازگشت به صفحه اصلی</a>
        <?php
        include "nav.php";
        if (isset($_GET['id'])) {
            $employee_id = $_GET['id'];
            include "config.php";
            // کوئری برای دریافت جزئیات کارمند خاص
            $sql = "SELECT * FROM employees WHERE id = $employee_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="employee-form">';
                    echo '<form action="update_employee.php" method="post" enctype="multipart/form-data" onsubmit="return confirm(\'آیا مطمئن هستید که می‌خواهید تغییرات را ذخیره کنید؟\');">';
                    echo '<input type="hidden" name="id" value="' . $employee_id . '">';
                    echo '<div class="form-group">';
                    echo '<label for="first_name">نام:</label>';
                    echo '<input type="text" class="form-control" id="first_name" name="first_name" value="' . $row["first_name"] . '">';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<label for="last_name">نام خانوادگی:</label>';
                    echo '<input type="text" class="form-control" id="last_name" name="last_name" value="' . $row["last_name"] . '">';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<label for="national_code">کد ملی:</label>';
                    echo '<input type="text" class="form-control" id="national_code" name="national_code" value="' . $row["national_code"] . '">';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<label for="birth_date">تاریخ تولد:</label>';
                    echo '<input type="date" class="form-control" id="birth_date" name="birth_date" value="' . $row["birth_date"] . '">';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<label for="job_title">سمت شغلی:</label>';
                    echo '<input type="text" class="form-control" id="job_title" name="job_title" value="' . $row["job_title"] . '">';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<label for="mobile">شماره موبایل:</label>';
                    echo '<input type="text" class="form-control" id="mobile" name="mobile" value="' . $row["mobile"] . '" maxlength="11">';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<label for="photo_path">عکس پرسنلی:</label>';
                    echo '<input type="file" class="form-control" id="photo_path" name="photo_path">';
                    echo '</div>';
                    echo '<button type="submit" class="btn btn-primary btn-custom">ذخیره تغییرات</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo "<p class='mt-4 mb-4'>هیچ اطلاعاتی یافت نشد.</p>";
            }
            $conn->close();
        } else {
            echo "<p class='mt-4 mb-4'>خطا در دریافت اطلاعات.</p>";
        }
        ?>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
