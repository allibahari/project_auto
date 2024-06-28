<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST["id"];

    // کوئری برای حذف کارمند خاص
    $sql = "DELETE FROM employees WHERE id = $employee_id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header("Location: list_employees.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>
