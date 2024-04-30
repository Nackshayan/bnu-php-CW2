<?php
include 'C:\xampp\htdocs\bnu-php-CW2\_includes\dbconnect.inc';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentid = $_POST['studentid'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $house = $_POST['house'];
    $town = $_POST['town'];
    $county = $_POST['county'];
    $country = $_POST['country'];
    $postcode = $_POST['postcode'];
    $imagePath = '';

    if (isset($_FILES['student_image']) && $_FILES['student_image']['error'] == 0) {
        $fileTmpPath = $_FILES['student_image']['tmp_name'];
        $fileName = $_FILES['student_image']['name'];
        $fileSize = $_FILES['student_image']['size'];
        $fileType = $_FILES['student_image']['type'];
        $fileNameCmps = explode('.', $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = ['jpg', 'gif', 'png', 'jpeg'];
        if (in_array($fileExtension, $allowedfileExtensions) && $fileSize < 4000000) {
            $uploadFileDir = 'C:\xampp\htdocs\bnu-php-CW2\Student Images\\';
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $imagePath = $dest_path;
            } else {
                echo '<script>alert("Error moving the uploaded file");</script>';
            }
        } else {
            echo '<script>alert("Invalid file type or size");</script>';
        }
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssssssssss", $studentid, $hashedPassword, $dob, $firstname, $lastname, $house, $town, $county, $country, $postcode, $imagePath);
        if ($stmt->execute()) {
            echo "<script>alert('New student added successfully');</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $mysqli->error;
    }
}
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Student</h2>
        <form action="addstudent.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="studentid" class="form-label">Student ID:</label>
                <input type="text" class="form-control" id="studentid" name="studentid" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth:</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="mb-3">
                <label for="house" class="form-label">House:</label>
                <input type="text" class="form-control" id="house" name="house" required>
            </div>
            <div class="mb-3">
                <label for="town" class="form-label">Town:</label>
                <input type="text" class="form-control" id="town" name="town" required>
            </div>
            <div class="mb-3">
                <label for="county" class="form-label">County:</label>
                <input type="text" class="form-control" id="county" name="county" required>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country:</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <div class="mb-3">
                <label for="postcode" class="form-label">Postcode:</label>
                <input type="text" class="form-control" id="postcode" name="postcode" required>
            </div>
            <div class="mb-3">
                <label for="student_image" class="form-label">Student Image:</label>
                <input type="file" class="form-control" id="student_image" name="student_image" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>
    </div>
</body>
</html>