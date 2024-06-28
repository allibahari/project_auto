<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نتایج جستجوی پیشرفته</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .employee-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            display: flexbox;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .employee-details {
            margin-top: 10px;
        }
        .employee-image {
            max-width: 100px;
            max-height: 100px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-4 mb-4 text-center">نتایج جستجوی پیشرفته</h1>
        <a style="text-decoration: none; color:red;" href="list_employees.php"><h4>بازگشت به صفحه اصلی</h4></a>
        
        <?php
        include "config.php";
        include "nav.php";

        // دریافت مقادیر جستجوی پیشرفته از فرم
        $job_title = isset($_GET['job_title']) ? $_GET['job_title'] : '';
        $birth_date = isset($_GET['birth_date']) ? $_GET['birth_date'] : '';
        $marital_status = isset($_GET['marital_status']) ? $_GET['marital_status'] : '';

        // ساخت کوئری برای جستجوی پیشرفته
        $sql = "SELECT * FROM employees WHERE 1=1";

        if ($job_title != '') {
            $sql .= " AND job_title LIKE '%$job_title%'";
        }
        if ($birth_date != '') {
            $sql .= " AND birth_date = '$birth_date'";
        }
        if ($marital_status != '') {
            $sql .= " AND marital_status = '$marital_status'";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="employee-box">';
                echo '<div class="row">';
                echo '<div class="col-md-3">';
                echo '<img src="' . $row["photo_path"] . '" alt="عکس پرسنلی" class="employee-image">';
                echo '</div>';
                echo '<div class="col-md-9">';
                echo '<h3>' . $row["first_name"] . ' ' . $row["last_name"] . '</h3>';
                echo '<p><strong>کد ملی: </strong>' . $row["national_code"] . '</p>';
                echo '<p><strong>تاریخ تولد: </strong>' . $row["birth_date"] . '</p>';
                echo '<p><strong>سمت شغلی: </strong>' . $row["job_title"] . '</p>';
                echo '<p><strong>شماره موبایل: </strong>' . $row["mobile"] . '</p>';
                echo '<p><strong>وضعیت ازدواج: </strong>' . $row["marital_status"] . '</p>';
                echo '<a href="employee_details.php?id=' . $row["id"] . '" class="btn btn-primary mt-2">نمایش جزئیات</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p class='mt-4 mb-4'>هیچ کارمندی یافت نشد.</p>";
        }
        $conn->close();
        ?>
    
    </div>

    <!-- Link Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
