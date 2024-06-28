<?php
include "config.php";
include "nav.php";

$statusMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form
    $username = $_POST['username'];
    $password =  md5($_POST['password']); 

    // Validate and sanitize input (basic example)
    $username = htmlspecialchars(strip_tags(trim($username)));
    // Password should be hashed for storage
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare a statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        $statusMessage = "افزودن مدیر با موفقیت انجام شد";
    } else {
        $statusMessage = "خطا: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم افزودن مدیر</title>
    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            color: #625BFE;
            margin-bottom: 20px;
        }

        label {
            color: #625BFE;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #5433FF;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #5433FF30;
        }

        .error-message {
            color: #FF6347;
            font-size: 14px;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>افزودن مدیر</h2>
        <?php if ($statusMessage): ?>
            <div class="status-message <?php echo strpos($statusMessage, 'موفقیت') !== false ? 'success-message' : 'error-message'; ?>">
                <?php echo $statusMessage; ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <label for="username">نام کاربری:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="password">رمز عبور:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            
            <input type="submit" value="افزودن مدیر">
        </form>
    </div>
</body>
</html>
