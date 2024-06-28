<?php
include "nav.php";
include "config.php";

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$statusMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $birth_date = $conn->real_escape_string($_POST['birth_date']);
    $national_code = $conn->real_escape_string($_POST['national_code']);
    $marital_status = $conn->real_escape_string($_POST['marital_status']);
    $email = $conn->real_escape_string($_POST['email']);
    $job_title = $conn->real_escape_string($_POST['job_title']);
    $mobile = $conn->real_escape_string($_POST['mobile']); // اضافه کردن دریافت شماره موبایل

    $photo = $_FILES['photo'];
    $photo_name = time() . '_' . $photo['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($photo_name);

    // بررسی تکراری بودن national_code
    $check_query = "SELECT * FROM employees WHERE national_code = '$national_code'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        $statusMessage = "کد ملی تکراری است. لطفاً یک کد ملی دیگر وارد کنید.";
    } else {
        if (move_uploaded_file($photo['tmp_name'], $target_file)) {
            $stmt = $conn->prepare("INSERT INTO employees (first_name, last_name, birth_date, national_code, marital_status, email, job_title, mobile, photo_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $first_name, $last_name, $birth_date, $national_code, $marital_status, $email, $job_title, $mobile, $target_file);

            if ($stmt->execute()) {
                $statusMessage = "اطلاعات کارمند با موفقیت ذخیره شد.";
            } else {
                $statusMessage = "خطا در ذخیره اطلاعات: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $statusMessage = "خطا در آپلود فایل.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم اطلاعات کارمندان</title>
    <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="css/employees.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Persian Datepicker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">
</head>
<body>
    <div class="form-container">
        <h2>فرم اطلاعات کارمندان</h2>
        <form method="POST" enctype="multipart/form-data" id="employeeForm">
            <div class="form-group">
                <label for="first_name">نام:</label>
                <input type="text" id="first_name" name="first_name" required class="form-control">
            </div>
            <div class="form-group">
                <label for="last_name">نام خانوادگی:</label>
                <input type="text" id="last_name" name="last_name" required class="form-control">
            </div>
            <div class="form-group">
                <label for="birth_date">تاریخ تولد:</label>
                <input type="text" id="birth_date" name="birth_date" required class="form-control" data-provide="datepicker" data-date-language="fa" data-date-format="yyyy/mm/dd">
            </div>
            <div class="form-group">
                <label for="national_code">کد ملی:</label>
                <input type="text" id="national_code" name="national_code" required class="form-control">
            </div>
            <div class="form-group">
                <label for="mobile">شماره موبایل:</label>
                <input type="text" id="mobile" name="mobile" required class="form-control" maxlength="11">
            </div>
            <div class="form-group">
                <label for="marital_status">وضعیت ازدواج:</label>
                <select id="marital_status" name="marital_status" required class="form-select">
                    <option value="single">مجرد</option>
                    <option value="married">متاهل</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">ایمیل:</label>
                <input type="email" id="email" name="email" required class="form-control">
            </div>
            <div class="form-group">
                <label for="job_title">سمت شغلی:</label>
                <input type="text" id="job_title" name="job_title" required class="form-control">
            </div>
            <div class="form-group">
                <label for="photo">عکس پرسنلی:</label>
                <input type="file" id="photo" name="photo" required class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">ارسال</button>
            </div>
        </form>
        <div class="message" id="statusMessage"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var statusMessage = "<?php echo $statusMessage; ?>";
            if (statusMessage !== "") {
                var messageDiv = document.getElementById('statusMessage');
                messageDiv.innerText = statusMessage;
                messageDiv.style.display = 'block';
                if (statusMessage.includes("موفقیت")) {
                    messageDiv.classList.add('success');
                } else {
                    messageDiv.classList.add('error');
                }
            }
        });

        $(document).ready(function () {
            $('#birth_date').persianDatepicker({
                format: 'YYYY/MM/DD'
            });
        });
    </script>

    <!-- Bootstrap Bundle JS (including Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Persian Datepicker JS -->
    <script src="https://cdn.jsdelivr.net/npm/persian-date/dist/persian-date.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
</body>
</html>
