<?php
$conn = mysqli_connect("localhost", "root", "", "uebung1");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Mailinglist Subscription</title>
    <link rel="stylesheet" type="text/css" href="../res/css/main.css">
</head>
<body>
<h1>Subscribe to football a newsletters</h1>
<form action="../res/php/subscribe.php" method="post">
    <p class="p">
        Name:
        <input type="text" name="name" value="" required placeholder="Enter your name"/>
        <br>
        Email:
        <input type="email" name="email" placeholder="Enter your email">
        <br><br>
        <input type="checkbox" name="VereinMitglied" value="Mitglied">
        Bin Mitglied in einem Fußballverein
        <br>
        <br>
    <div class="list-email">
        <?php
        $query = "SELECT Name FROM Newsletter;";
        mysqli_query($conn, "SET NAMES 'utf8'");
        $result = mysqli_query($conn, $query)
        or die ("Query failed!");
        while ($row = mysqli_fetch_row($result)) {
            for ($i = 0; $i < mysqli_num_fields($result); $i++) {
                echo ' <input type="checkbox" name="mailinglist[]" value="' . $row[$i] . '"> ';
                echo "$row[$i]";
                echo "<BR>";
            }
        }
        mysqli_free_result($result);
        ?>
    </div>
    </p>
    <div>
        <input type="submit" value="Subscribe">
    </div>
</form>
</body>
</html>
