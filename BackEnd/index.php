<?php
require_once __DIR__ . '/config.php';

class API {
    function Select() {
        $db = new Connect;
        $users = array();
        $data = $db->prepare('SELECT * FROM customer');
        $data->execute();
        $i = 0;
        while ($OutputData = $data->fetch(PDO::FETCH_ASSOC)) {
            $users[$i] = array(
                'fname' => $OutputData['fname'],
                'lname' => $OutputData['lname'],
                'tel' => $OutputData['tel'],
                'address' => $OutputData['address'],
                'state' => $OutputData['state'],
                'city' => $OutputData['city'],
                'zip' => $OutputData['zip'],
            );
            $i++;
        }
        return json_encode($users);
    }
}

$API = new API();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
echo $API->Select();
?>
