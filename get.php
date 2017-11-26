<?php
try {
    $db = new PDO('sqlite:users.db');

    $result = $db->prepare("SELECT email, alarms.rowid, coin_name, low, high, alarms.alerted FROM users, alarms WHERE users.email = alarms.user_email;"); //replace exec with query
    $result->execute();

    $result = $result->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
} catch(PDOException $e){
    logerror($e->getMessage(), "opendatabase");
    print "Error in openhrsedb ".$e->getMessage();
    echo "connection failed";
}
?>
