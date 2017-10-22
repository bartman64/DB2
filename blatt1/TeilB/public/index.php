<?php

?>

<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<form action="../res/php/subscribe.php" method="post">
    Name:<br>
    <input type="text" name="name" value="" required placeholder="Enter your name"/>
    <br>
    Email:<br>
    <input type="email" name="email" placeholder="Enter your email">
    <br><br>
    <input type="checkbox" name="VereinMitglied" value="Mitglied">
    Bin Mitglied in einem Fußballverein
    <br>
    <br>
    <input type="checkbox" name="mailinglist[]" value="1Liga">
    1. Liga
    <br>
    <input type="checkbox" name="mailinglist[]" value="2Liga">
    2. Liga
    <br>
    <input type="checkbox" name="mailinglist[]" value="3Liga">
    3. Liga
    <br>
    <input type="checkbox" name="mailinglist[]" value="Regionalliga">
    Regionalliga Bayern
    <br>
    <input type="checkbox" name="mailinglist[]" value="WM">
    WM 2018
    <br>
    <input type="checkbox" name="mailinglist[]" value="Nationalmannschaft">
    Deutsche Nationalmannschaft
    <br>
    <br>
    <input type="submit" value="Subscribe">
</form>
</body>
</html>
