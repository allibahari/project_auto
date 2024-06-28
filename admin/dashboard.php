<?php
date_default_timezone_set('Asia/Tehran'); // Set timezone to Iran

$current_time = date('H:i'); // Current time
$current_date = date('Y-m-d'); // Current date

include "nav.php";
include "config.php";
// Query to get total number of employees
$sql = "SELECT COUNT(*) as total_employees FROM employees";
$result = $conn->query($sql);

$total_employees = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_employees = $row['total_employees'];
}

$conn->close();
?>
<style>
    .card {
        margin-bottom: 20px;
    }
    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
    }
    .card-text {
        font-size: 1.2rem;
    }
</style>

<div class="container">
    <h1>داشبورد</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">آمار کارمندان</h5>
                    <p class="card-text">تعداد کل کارمندان: <?php echo $total_employees; ?></p>
                    <a href="list_employees.php" class="btn btn-primary">مشاهده لیست کارمندان</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">زمان و تاریخ</h5>
                    <p class="card-text">ساعت فعلی: <?php echo $current_time; ?></p>
                    <p class="card-text">تاریخ فعلی: <?php echo $current_date; ?></p>
                </div>
            </div>
        </div>
        <!-- Add other dashboard elements here -->
    </div>
</div>
