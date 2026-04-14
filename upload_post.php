<?php

$conn = mysqli_connect("localhost","root","","travellingaja");

$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

$caption = $_POST['caption'];

$path = "uploads/".$image;

move_uploaded_file($tmp,$path);

mysqli_query($conn,"INSERT INTO posts (image,caption) VALUES ('$image','$caption')");

header("location:komunitas.php");

?>