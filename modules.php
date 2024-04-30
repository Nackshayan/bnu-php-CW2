<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // Correct the variable to $mysqli as initialized in dbconnect.inc
   // Build SQL statement that selects a student's modules
   $sql = "SELECT * FROM studentmodules sm, module m WHERE m.modulecode = sm.modulecode AND sm.studentid = '" . mysqli_real_escape_string($mysqli, $_SESSION['id']) ."';";

   $result = mysqli_query($mysqli, $sql);

   // prepare page content
   $data['content'] .= "<div class='container mt-3'>";
   $data['content'] .= "<h2>My Modules</h2>";
   $data['content'] .= "<table class='table table-striped'>";
   $data['content'] .= "<thead><tr><th>Code</th><th>Name</th><th>Level</th></tr></thead>";
   $data['content'] .= "<tbody>";
   // Display the modules within the html table
   while($row = mysqli_fetch_array($result)) {
      $data['content'] .= "<tr><td>{$row['modulecode']}</td><td>{$row['name']}</td>";
      $data['content'] .= "<td>{$row['level']}</td></tr>";
   }
   $data['content'] .= "</tbody></table>";
   $data['content'] .= "</div>"; // Close container div

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
