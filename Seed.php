<?php
include 'C:\xampp\htdocs\bnu-php-CW2\_includes\dbconnect.inc';

$students = [
    ['studentid' => '20000005', 'password' => 'pass1234', 'dob' => '1998-06-01', 'firstname' => 'Bob', 'lastname' => 'Marley', 'house' => '45 Priory road', 'town' => 'Highwycombe', 'county' => 'Buckinghamshire', 'country' => 'UK', 'postcode' => 'HP12 6SN'],
    ['studentid' => '20000007', 'password' => 'pass1235', 'dob' => '1999-07-02', 'firstname' => 'Bob', 'lastname' => 'Brown', 'house' => '34 Oak Avenue', 'town' => 'Slough', 'county' => 'Berkshire', 'country' => 'UK', 'postcode' => 'SL3 7US'],
    ['studentid' => '20000008', 'password' => 'pass1236', 'dob' => '2000-08-03', 'firstname' => 'Charlie', 'lastname' => 'Davis', 'house' => '56 Pine Road', 'town' => 'Oxford', 'county' => 'Oxfordshire', 'country' => 'UK', 'postcode' => 'OX4 3PH'],
    ['studentid' => '20000009', 'password' => 'pass1237', 'dob' => '1997-09-04', 'firstname' => 'Daisy', 'lastname' => 'Evans', 'house' => '78 Elm Lane', 'town' => 'Swindon', 'county' => 'Wiltshire', 'country' => 'UK', 'postcode' => 'SN1 4DQ'],
    ['studentid' => '20000010', 'password' => 'pass1238', 'dob' => '1996-10-05', 'firstname' => 'Ethan', 'lastname' => 'Foster', 'house' => '90 Birch Place', 'town' => 'Bristol', 'county' => 'Avon', 'country' => 'UK', 'postcode' => 'BS1 1RP']
];
$sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    die('MySQL prepare error: ' . $mysqli->error);
}

foreach ($students as $student) {
    $hashedPassword = password_hash($student['password'], PASSWORD_DEFAULT);
    $stmt->bind_param(
        "ssssssssss",
        $student['studentid'],
        $hashedPassword,
        $student['dob'],
        $student['firstname'],
        $student['lastname'],
        $student['house'],
        $student['town'],
        $student['county'],
        $student['country'],
        $student['postcode']
    );

    $stmt->execute();
}

echo "5 students have been inserted successfully.";

$stmt->close();
$mysqli->close();
?>