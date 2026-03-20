<?php
$conn = mysqli_connect("localhost", "root", "", "my_project");

if (!$conn) {
    die("فشل الاتصال: " . mysqli_connect_error());
}
?>
