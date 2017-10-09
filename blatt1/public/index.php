<?php
$conn = mysqli_connect("localhost", "root", "", "uebung1");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../res/css/main.css">
</head>
<body>
<div class="vote-field">
    <h3 class="vote-field--header">Vereinvoting!</h3>
    <form action="../res/php/updateVote.php" method="post">
        <select>
        </select>
        <input type="text" name="newClub" value="">
        <br><br>
        <input type="submit">
    </form>
</div>
</body>
</html>
