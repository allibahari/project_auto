<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لیست کارمندان</title>
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
        .search-container {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .search-container label {
            font-weight: bold;
        }
        .btn-search, .btn-advanced-search {
            margin-top: 10px;
            width: 100%;
        }
        .btn-advanced-search {
            background-color: #17a2b8;
            color: #fff;
        }
        .btn-advanced-search:hover {
            background-color: #138496;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-4 mb-4 text-center">لیست کارمندان</h1>
        <div class="search-container">
            <form action="search.php" method="get">
                <div class="form-group">
                    <label for="keyword">جستجو بر اساس کد ملی یا نام و نام خانوادگی:</label>
                    <input type="text" class="form-control" id="keyword" name="keyword" placeholder="کد ملی یا نام و نام خانوادگی را وارد کنید">
                </div>
                <button type="submit" class="btn btn-primary btn-search">جستجو</button>
                <button type="button" class="btn btn-advanced-search" onclick="toggleAdvancedSearch()">جستجوی پیشرفته</button>
            </form>
        </div>
        
        <div class="advanced-search-container mt-4" id="advancedSearch" style="display: none;">
            <form action="advanced_search.php" method="get">
                <div class="form-group">
                    <label for="job_title">سمت شغلی:</label>
                    <input type="text" class="form-control" id="job_title" name="job_title" placeholder="سمت شغلی را وارد کنید">
                </div>
                <div class="form-group">
                    <label for="birth_date">تاریخ تولد:</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date">
                </div>
                <div class="form-group">
                    <label for="marital_status">وضعیت ازدواج:</label>
                    <select id="marital_status" name="marital_status" class="form-control">
                        <option value="">انتخاب کنید</option>
                        <option value="single">مجرد</option>
                        <option value="married">متاهل</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-search">جستجوی پیشرفته</button>
            </form>
        </div>
        
        <?php
        include "config.php";
        include "nav.php";

        // کوئری برای دریافت اطلاعات کارمندان
        $sql = "SELECT * FROM employees ORDER BY last_name ASC";
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
                echo '<p><strong>شماره موبایل: </strong>' . $row["mobile"] . '</p>'; // اضافه کردن شماره موبایل
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

    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function toggleAdvancedSearch() {
            var advancedSearch = document.getElementById("advancedSearch");
            if (advancedSearch.style.display === "none") {
                advancedSearch.style.display = "block";
            } else {
                advancedSearch.style.display = "none";
            }
        }
    </script>
</body>
</html>
