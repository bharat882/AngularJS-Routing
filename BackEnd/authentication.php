<?php
require_once __DIR__ . '/config.php';

class API{
    function authenticateUser(){

        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'];
        $password = $data['password'];

        $db = new Connect;

        $data = $db -> prepare ('SELECT * FROM credentials where UserName = :username AND Password = :password');
        $data->bindParam('username',$username,PDO::PARAM_INT);
        $data->bindParam('password',$password,PDO::PARAM_INT);
        $data->execute();
        $isValidUser = $data -> fetch(PDO::PARAM_INT);
      //  return json_encode("$isValidUser");
        if($isValidUser)
        {
            return json_encode("USER AUTHENTICATION SUCCESSFUL");
        }
        else
        {
            return json_encode("USER AUTHENTICATION FAILED");
        }
    }
}

$API = new API();
header('Content-Type:application/json');
header('Access-Control-Allow_Origin:*');
echo $API -> authenticateUser();

?>