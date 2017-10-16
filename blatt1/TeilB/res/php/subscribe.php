<?php
$conn = mysqli_connect("localhost", "root", "", "uebung1");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$mailinglist = array(
    "1Liga" => false,
    "2Liga" => false,
    "3Liga" => false,
    "Regionalliga" => false,
    "WM" => false,
    "Nationalmannschaft" => false,
);
$name;
$email;
$vereinMitglied;


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
    $vereinMitglied = mysqli_real_escape_string($conn, $_POST['VereinMitglied']);
}

$query = "INSERT INTO `MailingList`(`Email`, `Name`, `VereinMitglied`, `1Liga`, `2Liga`, `3Liga`, `RegionalligaBayern`, `WM2018`, `Nationalmannschaft`)
VALUES (
'$email',
'$name',
'$vereinMitglied',
" . $mailinglist['1Liga'] .",
" . $mailinglist['2Liga'] .",
" . $mailinglist['3Liga'] .",
" . $mailinglist['Regionalliga'] .",
" . $mailinglist['WM'] .",
" . $mailinglist['Nationalmannschaft'] .")";
foreach ($mailinglist as $key => $value) {
    if($value)
    echo $key . " ";
}