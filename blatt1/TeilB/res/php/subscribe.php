<?php
$conn = mysqli_connect("localhost", "root", "", "uebung1");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$mailinglist;
$query = "SELECT Name FROM Newsletter;";
mysqli_query($conn, "SET NAMES 'utf8'");
$result = mysqli_query($conn, $query)
or die ("Query failed!");
while ($row = mysqli_fetch_row($result)) {
    for ($i = 0; $i < mysqli_num_fields($result); $i++) {
        $mailinglist[$row[$i]] = 0;
    }
}
mysqli_free_result($result);

$name;
$email;
$querySuccess = 0;
$vereinMitglied = 0;


if (isset($_POST['mailinglist'])) {
    $tmp = $_POST['mailinglist'];
    foreach ($mailinglist as $key => $value) {
        for ($j = 0; $j < sizeof($tmp); $j++) {
            if ($key == $tmp[$j]) {
                $mailinglist[$key] = true;
            }
        }
    }
}

if (isset($_POST['name'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
}

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
}
if (isset($_POST['VereinMitglied'])) {
    $vereinMitglied = true;
}

if (isset($_POST['name']) && isset($_POST['email'])) {

    mysqli_query($conn, "SET Name 'utf8'");
    $query_user = "INSERT INTO `User` (Email, Name, VereinsMitglied) VALUES ('$email', '$name', $vereinMitglied)";
    $query_current_keys = "SELECT Email, Name FROM User;";
    $result = mysqli_query($conn, $query_current_keys)
    or die ("Query failed!");
    while ($row = mysqli_fetch_row($result)) {
        for ($i = 0; $i < mysqli_num_fields($result); $i++) {
            if ($row[$i] == $email) {
                if ($row[++$i] == $name) {
                    $query_user = "UPDATE User SET VereinsMitglied = $vereinMitglied";
                } else {
                    echo "This email is already registered with a different name";
                    $querySuccess = 0;
                }

            }

        }
    }
    if (mysqli_query($conn, $query_user)) {
        $queryResult = 'Record updated successfully';
        $querySuccess = true;
    } else {
        $queryResult = 'Error updating record: ' . mysqli_error($conn);
        echo $queryResult;
    }
    mysqli_free_result($result);

    if (isset($_POST['mailinglist'])) {
        foreach ($mailinglist as $key => $value) {
            for ($j = 0; $j < sizeof($tmp); $j++) {
                if ($value) {
                    $query = "INSERT INTO Subscribed (Email, Newsletter) VALUES ('$email', '$key')";
                    echo $query;
                    if (mysqli_query($conn, $query)) {
                        $queryResult = 'Record updated successfully';
                        $querySuccess = true;
                    } else {
                        $queryResult = 'Error updating record: ' . mysqli_error($conn);
                        echo $queryResult;
                    }
                }
            }
        }
    }
    mysqli_close($conn);

    if ($querySuccess) {
        echo "Successfull subscribed";
    }
}