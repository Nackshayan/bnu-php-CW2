<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   if (isset($_POST['selmodule'])) {
      $sql = "INSERT INTO studentmodules VALUES ('" . mysqli_real_escape_string($mysqli, $_SESSION['id']) . "', '" . mysqli_real_escape_string($mysqli, $_SESSION['id']) ."';";
      $result = mysqli_query($conn, $sql);
      $data['content'] .= "<div class='alert alert-success'>The module " . htmlspecialchars($_POST['selmodule']) . " has been assigned to you.</div>";
   }
   else {

     $sql = "SELECT * FROM module";
     $result = mysqli_query($mysqli, $sql);

     $data['content'] .= "<div class='container'>";
     $data['content'] .= "<h2>Assign Module</h2>";
     $data['content'] .= "<form name='frmassignmodule' action='' method='post'>";
     $data['content'] .= "<div class='mb-3'>";
     $data['content'] .= "<label for='selmodule' class='form-label'>Select a module to assign</label>";
     $data['content'] .= "<select name='selmodule' class='form-select'>";

     while($row = mysqli_fetch_array($result)) {
        $data['content'] .= "<option value='" . htmlspecialchars($row['modulecode']) . "'>" . htmlspecialchars($row['name']) . "</option>";
     }
     $data['content'] .= "</select>";
     $data['content'] .= "</div>";
     $data['content'] .= "<button type='submit' name='confirm' class='btn btn-primary'>Save</button>";
     $data['content'] .= "</form>";
     $data['content'] .= "</div>"; 
   }
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>