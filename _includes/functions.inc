<?php

include "passwordLib.php";

function validatelogin($id, $password) {
   global $mysqli;

   $id = mysqli_real_escape_string($mysqli, $id);

   $stmt = $mysqli->prepare("SELECT * FROM student WHERE studentid = ?;");
   $stmt->bind_param("s", $id);
   $stmt->execute();
   $loginresult = $stmt->get_result();
   $studentdetails = $loginresult->fetch_assoc();

   if ($studentdetails && password_verify($password, $studentdetails['password'])) {
      $_SESSION['id'] = $id;
      return true;
   } else {
      $_SESSION['id'] = '';
      return false;
   }
}

function template($file, $args = array()) {
    if (!file_exists($file)) {
        return '';
    }
    if (is_array($args)) {
        extract($args);
    }
    ob_start();
    include $file;
    return ob_get_clean();
}

?>