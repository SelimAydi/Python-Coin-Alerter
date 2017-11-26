<?php
try {
    $db = new PDO('sqlite:/db/users.db');
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

    <link rel="stylesheet" type="text/css" href="/style/stylesheet.css">
</head>
<body>
<div class="topbar">
</div>
<div class="configwrap">
    <div class="title">
        <h1>Coin Alerter</h1>
    </div>
    <div class="configcontent">
        <form method="post" action="added.php">
            <p>Coin Name</p><input type="text" name="coin_name" placeholder="Viacoin">
            <p>Email</p><input type="text" name="email" placeholder="satoshi@nakamoto.com">
            <p>Low</p><input type="text" name="low" placeholder="3.0">
            <p>High</p><input type="text" name="high" placeholder="100.0">
            <input type="submit" value="Set alarm">
        </form>
    </div>
</div>
</body>
</html>


