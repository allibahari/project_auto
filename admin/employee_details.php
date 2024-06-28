<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جزئیات کارمند</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .employee-details {
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .employee-details img {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
            border-radius: 5px;
        }
        .btn-custom {
            width: 100%;
            margin-top: 10px;
        }
        .details-group {
            margin-top: 10px;
        }
        .details-group p {
            margin-bottom: 5px;
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
        <h1 class="mt-4 mb-4 text-center">جزئیات کارمند</h1>
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
                    echo '<div class="card employee-details">';
                    echo '<div class="card-body">';
                    echo '<div class="row">';
                    echo '<div class="col-md-4 text-center">';
                    echo '<img src="' . $row["photo_path"] . '" alt="عکس پرسنلی">';
                    echo '</div>';
                    echo '<div class="col-md-8">';
                    echo '<h3 class="card-title">' . $row["first_name"] . ' ' . $row["last_name"] . '</h3>';
                    echo '<div class="details-group">';
                    echo '<p><strong>کد ملی: </strong>' . $row["national_code"] . '</p>';
                    echo '<p><strong>تاریخ تولد: </strong>' . $row["birth_date"] . '</p>';
                    echo '<p><strong>سمت شغلی: </strong>' . $row["job_title"] . '</p>';
                    echo '<p><strong>شماره موبایل: </strong>' . $row["mobile"] . '</p>'; // اضافه کردن شماره موبایل
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="row">';
                    echo '<div class="col-md-6">';
                    echo '<a href="edit_employee.php?id=' . $employee_id . '" class="btn btn-warning btn-custom">ویرایش اطلاعات</a>';
                    echo '</div>';
                    echo '<div class="col-md-6">';
                    echo '<form action="delete_employee.php" method="post" onsubmit="return confirm(\'آیا مطمئن هستید که می‌خواهید این کارمند را حذف کنید؟\');">';
                    echo '<input type="hidden" name="id" value="' . $employee_id . '">';
                    echo '<button type="submit" class="btn btn-danger btn-custom">حذف کارمند</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
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
        <div class="row">
    <div class="col-md-12">
        <form action="change_role.php" method="post">
            <input type="hidden" name="id" value="<?php echo $employee_id; ?>">
            <div class="form-group">
                <label for="username">نام کاربری جدید:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">رمز عبور جدید:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
</div>

    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php

