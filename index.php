<?php
session_start();
if (empty($_SESSION["userid"])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['userrol'] == 'user') {
    header("Location: user.php");
    exit;
} elseif ($_SESSION['userrol'] == 'admin') {
    header("Location: admin.php");
    exit;
} else {
    header("Location: 404.html");
    exit;
}
