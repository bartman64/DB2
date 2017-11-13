<?php
$conn = mysqli_connect("localhost", "root", "", "uebung1");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$emailList = '';
$newsletter = '';

if (isset($_POST['Subject']) && isset($_POST['Message'])) {
    $subject = mysqli_real_escape_string($conn, $_POST['Subject']);
    $message = htmlspecialchars($_POST['Message']);
    $newsletter =$_POST['newsletter'];
    $receivers = $_POST['receivers'];
    $comma_seperated_list = "'".implode("',' ", $newsletter)."'";
    $subsQuery = "SELECT Subscribed.Email, `User`.Name FROM Subscribed, `User` WHERE Subscribed.Email = `User`.Email AND Subscribed.Newsletter IN ( $comma_seperated_list)";

    if ($receivers =='Vereinsmitglied') {
        $subsQuery = "SELECT Subscribed.Email , `User`.Name FROM Subscribed, `User` WHERE Subscribed.Email = `User`.Email AND Subscribed.Newsletter  IN ( $comma_seperated_list) AND `User`.VereinsMitglied = 1";
    }
    if ($receivers =='nicht Vereinsmitglied') {
        $subsQuery = "SELECT Subscribed.Email , `User`.Name FROM Subscribed, `User` WHERE Subscribed.Email = `User`.Email AND Subscribed.Newsletter  IN ( $comma_seperated_list )  AND `User`.VereinsMitglied != 1";
    }
    echo $receivers;
    echo $subsQuery;
    $emailList = mysqli_query($conn, $subsQuery);

    if ($emailList) {
        echo 'Received record successfully!';
    } else {
        echo 'Error getting record: ' . mysqli_error($conn);
    }
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Send Messages</title>
    <link rel="stylesheet" type="text/css" href="../../res/css/main.css">
</head>
<body>
<?php
if ($emailList->num_rows !== 0) {
    while ($row = mysqli_fetch_row($emailList)) {
        $messagePrefix = "Dear " . $row[1] . ",<br> Here is a new Message from your Subscription to " . $comma_seperated_list . ".<br>";
        echo '<div class="email">';
        echo '<div class="email__element"> Mail to: ' . $row[0] . '</div>';
        echo '<div class="email__element">Subject: ' . $subject . '</div>';
        echo '<div class="email__element">Message: <span class="email__text">' . $messagePrefix . $message . '</span></div>';
        echo '</div>';
        $messagePrefix = " ";
    }
} else {
    echo "<p>Für den Vereien: " . $comma_seperated_list . " gibt es keine aktiven Subscriptions!</p>";
}
?>
</body>
</html>

