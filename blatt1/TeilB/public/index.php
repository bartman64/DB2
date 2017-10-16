<?php

?>

<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<form action="" method="post">
    Name:<br>
    <input type="text" name="name" value="Max" onfocus=" if (this.value === 'Max') this.value = '';"/>
    <br>
    Email:<br>
    <input type="text" name="email" value="muster@email.com" onfocus=" if (this.value === 'muster@email.com') this.value = '';"/>
    <br><br>
    <input type="checkbox" name="VereinMitglied" value="Mitglied">
    Bin Mitglied in einem Fußballverein
    <br>
    <br>
    <input type="submit" value="Submit">
</form>
</body>
</html>
