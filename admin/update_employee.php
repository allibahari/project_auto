<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST["id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $national_code = $_POST["national_code"];
    $birth_date = $_POST["birth_date"];
    $job_title = $_POST["job_title"];

    $photo_path = '';
    if (isset($_FILES["photo_path"]) && $_FILES["photo_path"]["error"] == 0) {
        $photo_path = "uploads/" . basename($_FILES["photo_path"]["name"]);
        move_uploaded_file($_FILES["photo_path"]["tmp_name"], $photo_path);
    }

    if ($photo_path) {
        $sql = "UPDATE employees SET first_name='$first_name', last_name='$last_name', national_code='$national_code', birth_date='$birth_date', job_title='$job_title', photo_path='$photo_path' WHERE id='$employee_id'";
    } else {
        $sql = "UPDATE employees SET first_name='$first_name', last_name='$last_name', national_code='$national_code', birth_date='$birth_date', job_title='$job_title' WHERE id='$employee_id'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: employee_details.php?id=" . $employee_id);
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
