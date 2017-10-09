<?php
$conn = mysqli_connect("localhost", "root", "", "uebung1");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<form action="" method="post">
    <select>
    <option value="">Fc Bayern</option>
    </select>
    <br><br>
    <input type="submit">
</form>
