<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

$data = [];
if (isset($_SESSION['message'])) { 
    $data['message'] = "<div class='alert alert-danger' role='alert'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);  
}

echo template("templates/partials/header.php");

if (isset($_SESSION['id'])) {
    $data['content'] = "<div class='container mt-4'><p>Welcome to your dashboard.</p></div>";
    echo template("templates/partials/nav.php");
    echo template("templates/default.php", $data);
} else {
    echo template("templates/login.php", $data);
}

echo template("templates/partials/footer.php");
?>