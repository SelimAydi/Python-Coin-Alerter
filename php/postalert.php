<?php
try {
    $alarm = $_GET['id'];
    $db = new PDO('sqlite:/db/users.db');
    $db->exec("UPDATE alarms SET alerted = 'True' WHERE rowid = '$alarm';");
    $result = $db->prepare("SELECT * FROM alarms;");
    $result->execute();

    $result = $result->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
} catch(PDOException $e){
    logerror($e->getMessage(), "opendatabase");
    print "Error in openhrsedb ".$e->getMessage();
    echo "connection failed";
}
?>
