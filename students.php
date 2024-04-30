<?php
include 'C:\xampp\htdocs\bnu-php-CW2\_includes\dbconnect.inc';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $studentIdsToDelete = $_POST['student_ids'] ?? [];

    if (!empty($studentIdsToDelete)) {
        $placeholders = implode(',', array_fill(0, count($studentIdsToDelete), '?'));
        $sql = "DELETE FROM student WHERE studentid IN ($placeholders)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param(str_repeat('s', count($studentIdsToDelete)), ...$studentIdsToDelete);
        $stmt->execute();
        $stmt->close();
    }
}

$sql = "SELECT * FROM student";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function confirmDeletion() {
            const selected = document.querySelectorAll('input[name="student_ids[]"]:checked').length;
            if (selected === 0) {
                alert('Please select at least one student to delete.');
                return false;
            }
            return confirm('Are you sure you want to delete the selected student(s)?');
        }
    </script>
</head>
<body>
    <div class="container mt-4">
        <h2>Student Records</h2>
        <form method="post" onsubmit="return confirmDeletion();">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Student ID</th>
                        <th>DOB</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>House</th>
                        <th>Town</th>
                        <th>County</th>
                        <th>Country</th>
                        <th>Postcode</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><input type="checkbox" name="student_ids[]" value="<?= $row['studentid']; ?>"></td>
                        <td><?= $row['studentid']; ?></td>
                        <td><?= $row['dob']; ?></td>
                        <td><?= $row['firstname']; ?></td>
                        <td><?= $row['lastname']; ?></td>
                        <td><?= $row['house']; ?></td>
                        <td><?= $row['town']; ?></td>
                        <td><?= $row['county']; ?></td>
                        <td><?= $row['country']; ?></td>
                        <td><?= $row['postcode']; ?></td>
                        <td>
                            <?php if ($row['image_path']): ?>
                                <img src="Student Images/<?= basename($row['image_path']); ?>" alt="Student Image" class="img-fluid" style="max-width: 100px; height: auto;">
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <button type="submit" name="delete" class="btn btn-danger">Delete Selected</button>
        </form>
    </div>
    <?php $result->free(); ?>
</body>
</html>

<?php $mysqli->close(); ?>