<?php

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
    </div>
    </p>
    <div>
        <input type="submit" value="Subscribe">
    </div>
</form>
</body>
</html>
