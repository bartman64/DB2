<?php
$conn = mysqli_connect("localhost", "root", "", "uebung1");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$emailList = '';
$club = '';

if(isset($_POST['Subject']) && isset($_POST['Message'])){
    $subject = mysqli_real_escape_string($conn, $_POST['Subject']);
    $message = htmlspecialchars($_POST['Message']);
    $club = mysqli_real_escape_string($conn,$_POST['Mailingliste']);
    $subsQuery = "SELECT Email FROM subscribed WHERE Newsletter = '" . $club . "'";

    if(isset($_POST['subs'])){
        $subsQuery = "SELECT Email FROM subcribed, `user` WHERE subscribed.Newsletter = '" . $club . "' AND `user`.VereinsMitglied = 1";
    }

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
    if($emailList->num_rows !== 0){
        while ($row = mysqli_fetch_row($emailList)){
            for($i = 0; $i < mysqli_num_fields($emailList); $i++){
                echo '<div class="email">';
                echo '<div class="email__element"> Mail to: ' . $row[$i] . '</div>';
                echo '<div class="email__element">Subject: ' . $subject . '</div>';
                echo '<div class="email__element">Message: <span class="email__text">' . $message . '</span></div>';
                echo '</div>';
            }
        }
    } else {
        echo "<p>Für den Vereien: " .$club . " gibt es keine aktiven Subscriptions!</p>";
    }
?>
</body>
</html>

