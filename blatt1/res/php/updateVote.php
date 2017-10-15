<?php
if($_POST['existingClubs'] != 'default' || $_POST['newClub'] != 'Neuer Verein') {

    $selectedClub = $_POST['existingClubs'];

    $conn = mysqli_connect("localhost", "root", "", "uebung1");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
} else {
    echo "Please select or add a club!";
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
<div class="vote-field">
    <h3 class="vote-field__header">Ergebnisse!</h3>
    <h2>Gesamt Anzahl der Teilnehmer</h2>
    <table>
        <tr>
            <th>Verein</th>
            <th>Stimmen</th>
            <th>Entfallene Stimmen pro Verein</th>
        </tr>
        <tr>

        </tr>
        <tr>

        </tr>
    </table>
</div>
</body>
</html>