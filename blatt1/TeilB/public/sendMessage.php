<?php
$conn = mysqli_connect("localhost", "root", "", "uebung1");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Send Messages</title>
    <link rel="stylesheet" type="text/css" href="../res/css/main.css">
</head>
<body>
<form action="../res/php/displayMessages.php" method="post">

        <?php
        $query = "SELECT Name FROM Newsletter;";
        mysqli_query($conn, "SET NAMES 'utf8'");
        $result = mysqli_query($conn, $query)
        or die ("Query failed!");
        while ($row = mysqli_fetch_row($result)) {
            for ($i = 0; $i < mysqli_num_fields($result); $i++) {
                echo ' <input type="checkbox" name="newsletter[]" value="' . $row[$i] . '"> ';
                echo "$row[$i]";
                echo "<BR>";
            }
        }
        mysqli_free_result($result);
        ?>

    <br>
    <br>
    Mitteilung senden an:
    <select name="receivers">
        <option value="alle">Alle</option>
        <option value="Vereinsmitglied">Vereinsmitglieder</option>
        <option value="nicht Vereinsmitglied">nicht Vereinsmitlgieder</option>
    </select>

    <br>
    <br>
    <input type="text" name="Subject" placeholder="Subject" value="">
    <br>
    <br>
    <textarea rows="5" cols="60" name="Message" placeholder="Enter Message..."></textarea>
    <br>
    <br>
    <button type="submit">Absenden</button>
</form>
</body>
</html>
