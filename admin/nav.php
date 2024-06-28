<?php
session_start();

?>
<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="assets/logo.svg" type="image/x-icon">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <title> داشبورد مدیریت </title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Mulish&display=swap');
    @font-face {
      font-family: iran;
      src: url(../fonts/IRANSans/IRANSansWebFaNum.woff);
    }
    :root {
      --primary-color: #625BFE;
      --primary-color-dark: #7771F6;    
      --button-color: #5433FF;
      --button-color-shadow: #5433FF30;
      --text-color: white;
    }
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      direction: rtl;
      font-family: iran; 
    }
    .background {
      position: absolute;
      height: 100vh;
      width: 100vw;
      display: grid;
      place-items: center;
      opacity: 0.5;
      background-size: 100%;
      background-repeat: no-repeat;
      background-size: auto;
    }
    span {
      font-size: 18px;
    }
    nav {
      position: fixed;
      top: 0;
      right: 0; /* تغییر اینجا به right برای قرار دادن نوار کناری در سمت راست */
      height: 100vh;
      background-color: var(--primary-color);
      width: 18rem;
      padding: 1.8rem 0.85rem;
      color: var(--text-color);
      display: flex;
      flex-direction: column;
      transition: width 0.5s ease-in-out;
    }
    main {
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .sidebar-top {
      position: relative;
      display: flex;
      align-items: center;
      margin-bottom: 35px;
    }
    .sidebar-top .logo {
      position: relative;
      width: 54px;
      margin-right: 1.30rem;
      right: -18px;
    }
    .sidebar-top h2 {
      padding-left: 0.5rem;
      font-weight: 600;
      font-size: 1.4rem;
    }
    .expand-btn {
      position: absolute;
      top: 50%;
      width: 45px;
      height: 45px;
      display: grid;
      place-items: center;
      background-color: var(--button-color);
      border-radius: 6px;
      cursor: pointer;
      box-shadow: 0 3px 10px -3px var(--button-color-shadow);
      left: -3rem;
      opacity: 0;
      pointer-events: none;
      transition: 0.3s;
    }
    nav:hover .expand-btn,
    .expand-btn.hovered {
      transform: translateY(-50%) translateX(0px);
      opacity: 1;
      pointer-events: all;
    }
    .sidebar-links ul {
      list-style-type: none;
      position: relative;
    }
    .sidebar-links li {
      position: relative;
    }
    .sidebar-links li a {
      padding: 12px;
      color: var(--text-color);
      font-size: 1.25rem;
      display: flex;
      align-items: center;
      height: 56px;
      text-decoration: none;
      color: #fff;
    }
    .icon {
      display: flex;
      align-items: center;
    }
    .icon img {
      width: 26px;
      height: 26px;
      margin: auto;
    }
    .sidebar-links .link {
      margin-left: 40px;
    }
    .sidebar-links .active {
      width: 100%;
      text-decoration: none;
      background-color: var(--primary-color-dark);
      transition: all 100ms ease-in;
      border-radius: 10px;
    }
    body.collapsed nav {
      width: 80px;
    }
    body.collapsed .hide {
      opacity: 0;
      pointer-events: none;
      transition-delay: 0s;
    }
    body.collapsed .expand-btn img {
      transform: rotate(-180deg);
    }
    .sidebar-footer {
      margin-top: auto;
      padding: 1.5rem 0;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .user-name-btn, .logout-btn {
      background-color: var(--button-color);
      color: var(--text-color);
      border: none;
      padding: 0.75rem 1.5rem;
      margin: 0.5rem 0;
      border-radius: 6px;
      cursor: pointer;
      width: 80%;
      text-align: center;
      font-size: 1rem;
      transition: background-color 0.3s ease;
      text-decoration: none;
    }
    .user-name-btn:hover, .logout-btn:hover {
      background-color: var(--primary-color-dark);
    }
  </style>
</head>
<body>
  <nav>
    <div class="sidebar-top">
      <span class="expand-btn"></span>
      <h3 style="font-size: 18px;">سیستم مدیریت کارمندان</h3>
    </div>
    <div class="sidebar-links">
      <ul>
        <li>
          <a href="dashboard.php" class="active" title="Portfolio link">
            <div class="icon">
              <img src="assets/portfolio.svg" title="Portfolio Icon">
            </div>
            <span class="link hide">داشبورد</span>
          </a>
        </li>
        <li>
          <a href="employees.php" title="Analytics link">
            <div class="icon">
              <img src="assets/analytics.svg" title="Analytics Icon">
            </div>
            <span class="link hide">افزودن کارمند</span>
          </a>
        </li>
        <li>
          <a href="list_employees.php" title="Performance link">
            <div class="icon">
              <img src="assets/dashboard.svg" title="Performance Icon">
            </div>
            <span class="link hide">لیست کارمندان</span>
          </a>
        </li>
        <li>
          <a href="report.php" title="Reports Link">
            <div class="icon">
              <img src="assets/reports.svg" title="Reports Icon">
            </div>
            <span class="link hide">گزارش گیری</span>
          </a>
        </li>
        <li>
          <a href="add_admin.php" title="Reports Link">
            <div class="icon">
              <img src="assets/reports.svg" title="Reports Icon">
            </div>
            <span class="link hide">افزودن مدیر  </span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidebar-footer">
      <button class="user-name-btn">نام کاربر: <?php echo $_SESSION['username']; ?></button>
      <a href="../logout.php" class="logout-btn">خروج از حساب کاربری</a>
    </div>
  </nav>
  <script src="js/script.js"></script>
  <script src="js/scripttime.js"></script>
  <script src="js/all.js"></script>
  <script src="js/bootstrap.js"></script>
</body>
</html>
