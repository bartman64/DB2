<?php

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Send Messages</title>
    <link rel="stylesheet" type="text/css" href="../res/css/main.css">
</head>
<body>
<form action="../res/php/displayMessages.php">
    <select name="Mailingliste">
        <option value="1Liga">1.Liga</option>
        <option value="2Liga">2.Liga</option>
        <option value="3Liga">3.Liga</option>
        <option value="RegionalligaBayern">Regionalliga Bayern</option>
        <option value="WM2018">WM 2018</option>
        <option value="DeutscheNationalmanschaft">Deutsche Nationalmanschaft</option>
    </select>
    <br>
    <br>
    <input type="checkbox" name="subs" value="subsOnly">
    Mitteilung nur an Mitglieder des Vereins senden!
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
