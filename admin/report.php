<?php
include "config.php";
include "nav.php";
// کوئری برای دریافت تعداد کل کارمندان
$sql = "SELECT COUNT(*) as total_employees FROM employees";
$result = $conn->query($sql);

$total_employees = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_employees = $row['total_employees'];
}

$conn->close();
?>

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
        <!-- دیگر عناصر داشبورد را اضافه کنید -->
    </div>
</div>