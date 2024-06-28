<?php
include "config.php";
session_start();

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
            $stmt = $conn->prepare("INSERT INTO employees (first_name, last_name, birth_date, national_code, marital_status, email, job_title, photo_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $first_name, $last_name, $birth_date, $national_code, $marital_status, $email, $job_title, $target_file);

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