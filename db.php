<?php
function db_connect(){
    $dsn = "mysql:host=localhost; dbname=otoiawase_form; charset=utf8";
    $user = "root";
    $password = "";

    try{
        $mysql = new PDO($dsn,$user,$password);
        echo "接続完了";
    }catch(PDOException $e){
        print('error:' .$e->getMessage());
        die();
        }
}
?>