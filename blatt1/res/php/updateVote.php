<?php

$conn = mysqli_connect("localhost", "root", "", "uebung1");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$existingClubs_default = 'default';
$newClub_default = 'Neuer Verein';

$existingClubs = mysqli_real_escape_string($conn, $_POST['existingClubs']);
$newClub = mysqli_real_escape_string($conn, $_POST['newClub']);

$queryResult;
$querySuccess = false;
$sumVotes;


if ($existingClubs !== $existingClubs_default && $newClub === $newClub_default) {
    $query = "UPDATE vereine SET Stimmen=Stimmen+1 WHERE `Name`= '" . $existingClubs . "'";

    if (mysqli_query($conn, $query)) {
        $queryResult = 'Abstimmung erfolgreich!';
        $querySuccess = true;
    } else {
        $queryResult = 'Error updating record: ' . mysqli_error($conn);
        mysqli_close($conn);
    }

} else if ($existingClubs === $existingClubs_default && $newClub !== $newClub_default) {
    $noDuplicate = true;

    //Get existing Vereine Namen
    $query = "SELECT Name FROM vereine;";
    mysqli_query($conn, "SET NAMES 'utf8'");
    $result = mysqli_query($conn, $query);

    if (!$result) {
        $queryResult = 'Error getting records: ' . mysqli_error($conn);
    };

    while ($row = mysqli_fetch_row($result)) {
        if (!$noDuplicate) {
            break;
        }
        if (strcasecmp($row[0], $newClub) === 0) {
            $noDuplicate = false;
            $queryResult = 'Bitte keine Vereine doppelt eintragen!';
            mysqli_close($conn);
        }
    }

    if ($noDuplicate) {
        mysqli_free_result($result);

        $insertQuery = "INSERT INTO vereine (`Name`, Stimmen)
        VALUES ('" . $newClub . "', 1)";

        if (mysqli_query($conn, $insertQuery)) {
            $queryResult = 'Record updated successfully';
            $querySuccess = true;
        } else {
            $queryResult = 'Error updating record: ' . mysqli_error($conn);
            mysqli_close($conn);
        }
    }
} else {
    $queryResult = 'Bitte wählen sie einen bereits bestehenden Verein aus oder tragen sie einen neuen ein!';
    mysqli_close($conn);
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
<div>
    <h2>
        <?php
        echo $queryResult;
        ?>
    </h2>
    <?php
    if ($querySuccess) {
        $voteQuery = "SELECT SUM(Stimmen) as Participants FROM vereine";

        $voteResult = mysqli_query($conn, $voteQuery);

        if (!$voteResult) {
            echo 'Error updating record: ' . mysqli_error($conn);
        } else {
            $row = mysqli_fetch_row($voteResult);
            $sumVotes = $row[0];
            echo '<p>Anzahl der Teilnehmer: ' . $sumVotes . '</p>';
        }
        mysqli_free_result($voteResult);
    }
    ?>
    <a href="../../public/index.php">Zurück zur Vereins Auswahl!</a>
    <?php
    if ($querySuccess) {
        $tableQuery = "SELECT Name, Stimmen FROM vereine";

        mysqli_query($conn, "SET NAMES 'utf8'");
        $tableResult = mysqli_query($conn, $tableQuery);

        if (!$tableResult) {
            echo 'Error receiving record: ' . mysqli_errno($conn);
        } else {
            echo '<table border="1">';
            echo '<tr>';
            echo '<th>Verein</th>';
            echo '<th>Abstimmungsteilnehmer</th>';
            echo '<th>Prozentualer Anteil der entfallenen Stimmen</th>';
            while($row = mysqli_fetch_row($tableResult)){
                echo '<tr>';
                for($i = 0; $i <  mysqli_num_fields($tableResult); $i++){
                    echo "<td>$row[$i]</td>";
                }
                $percentage = number_format(($row[1] / $sumVotes) * 100, 2, '.', ' ');
                echo "<td>$percentage%</td>";
                echo '</tr>';
            }
            echo '</table>';

            mysqli_close($conn);
        }
    }
    ?>
</div>
</body>
</html>