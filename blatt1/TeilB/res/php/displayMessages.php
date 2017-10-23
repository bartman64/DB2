<?php
$conn = mysqli_connect("localhost", "root", "", "uebung1");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$emailList = '';

if(isset($_POST['Subject']) && isset($_POST['Message'])){
    $subject = mysqli_real_escape_string($_POST['Subject']);
    $message = htmlspecialchars($_POST['Message']);
    $club = $_POST['Mailingliste'];
    $subsQuery = "SELECT Email FROM mailinglist WHERE" . $club . "=1";

    if(isset($_POST['subs'])){
        $subsQuery = "SELECT Email FROM mailinglist WHERE " . $club . " = 1 AND VereinMitglied = 1";
    }

    $emailList = mysqli_query($conn, $query);

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
    <link rel="stylesheet" type="text/css" href="../res/css/main.css">
</head>
<body>
<?php
    if($emailList !== ''){
        while ($row = mysqli_fetch_row($emailList)){
            for($i = 0; $i < mysqli_num_fields($row); $i++){
                echo '<div>';
                echo '<span class="receiver"> Mail to: ' . $row[$i] . '</span>';
                echo '<span class="subject">Subject: ' . $subject . '</span>';
                echo '<span class="message">Message: ' . $message . '</span>';
            }
        }
    } else {
        echo "<p>Error while processing request!</p>";
    }
?>
</body>
</html>

