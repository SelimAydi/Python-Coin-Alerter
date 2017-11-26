<?php
try {
    $db = new PDO('sqlite:users.db');
    $email = (string) $_POST['email'];
    $low = (float) $_POST['low'];
    $high = (float) $_POST['high'];
    $coin_name = (string) $_POST['coin_name'];
    $time_interval = (float) $_POST['time_interval'];
    $db->exec("REPLACE INTO users(email, alerted) VALUES ('$email', 'False');");
    $db->exec("REPLACE INTO alarms(low, high, coin_name, user_email) VALUES ('$low', '$high', '$coin_name', '$email');");

} catch(PDOException $e){
    logerror($e->getMessage(), "opendatabase");
    print "Error in openhrsedb ".$e->getMessage();
    echo "connection failed";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Coin Alerter</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<div class="configwrap">
    <div class="title">
        <h1>Coin Alerter</h1>
    </div>
    <div class="configcontent">
        <form method="post">
            <p>Your alarm has been set. <?php echo "$coin_name"; ?></p>
        </form>
    </div>
</div>
</body>
</html>


