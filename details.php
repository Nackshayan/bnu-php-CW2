<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   if (isset($_POST['submit'])) {

      $stmt = $conn->prepare("UPDATE student SET firstname = ?, lastname = ?, house = ?, town = ?, county = ?, country = ?, postcode = ? WHERE studentid = ?");
      $stmt->bind_param("ssssssss", $_POST['txtfirstname'], $_POST['txtlastname'], $_POST['txthouse'], $_POST['txttown'], $_POST['txtcounty'], $_POST['txtcountry'], $_POST['txtpostcode'], $_SESSION['id']);
      $stmt->execute();
      $stmt->close();

      $data['content'] = "<div class='alert alert-success'>Your details have been updated.</div>";

   } else {
      $stmt = $mysqli->prepare("SELECT * FROM student WHERE studentid = ?");
      $stmt->bind_param("s", $_SESSION['id']);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $stmt->close();

      $data['content'] = <<<EOD

   <div class="container">
     <h2>My Details</h2>
     <form name="frmdetails" action="" method="post">
       <div class="mb-3">
         <label for="txtfirstname" class="form-label">First Name:</label>
         <input name="txtfirstname" type="text" class="form-control" id="txtfirstname" value="{$row['firstname']}" />
       </div>
       <div class="mb-3">
         <label for="txtlastname" class="form-label">Surname:</label>
         <input name="txtlastname" type="text" class="form-control" id="txtlastname" value="{$row['lastname']}" />
       </div>
       <div class="mb-3">
         <label for="txthouse" class="form-label">Number and Street:</label>
         <input name="txthouse" type="text" class="form-control" id="txthouse" value="{$row['house']}" />
       </div>
       <div class="mb-3">
         <label for="txttown" class="form-label">Town:</label>
         <input name="txttown" type="text" class="form-control" id="txttown" value="{$row['town']}" />
       </div>
       <div class="mb-3">
         <label for="txtcounty" class="form-label">County:</label>
         <input name="txtcounty" type="text" class="form-control" id="txtcounty" value="{$row['county']}" />
       </div>
       <div class="mb-3">
         <label for="txtcountry" class="form-label">Country:</label>
         <input name="txtcountry" type="text" class="form-control" id="txtcountry" value="{$row['country']}" />
       </div>
       <div class="mb-3">
         <label for="txtpostcode" class="form-label">Postcode:</label>
         <input name="txtpostcode" type="text" class="form-control" id="txtpostcode" value="{$row['postcode']}" />
       </div>
       <button type="submit" name="submit" class="btn btn-primary">Save</button>
     </form>
   </div>

EOD;

   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>