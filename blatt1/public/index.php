<?php
$conn = mysqli_connect("localhost", "root", "", "uebung1");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-store" />
    <link rel="stylesheet" type="text/css" href="../res/css/main.css">
</head>
<body>
<div class="vote-field">
    <h3 class="vote-field__header">Vereinvoting!</h3>
    <form action="../res/php/updateVote.php" method="post">
        <div class="vote-field__col">
            <p class="vote-field__col--desc">Bestehenden Verein Wählen!</p>
            <select name="existingClubs">
                <option value="default"></option>
                <?php
                $query = "SELECT Name FROM vereine;";
                mysqli_query($conn, "SET NAMES 'utf8'");
                $result = mysqli_query($conn, $query)
                or die ("Query failed!");
                while ($row = mysqli_fetch_row($result)) {
                    for ($i = 0; $i < mysqli_num_fields($result); $i++) {
                        echo "<option value='$row[$i]'>$row[$i]</option>";
                        echo "<BR>";
                    }
                }
                mysqli_free_result($result);
                ?>
            </select>
        </div>
        <div class="vote-field__col">
            <p class="vote-field__cold--desc">Neuen Verein hinzufügen!</p>
            <input type="text" name="newClub" value="Neuer Verein">
        </div>
        <br><br>
        <input type="submit" name="Vote">
    </form>
</div>
</body>
</html>
