<?php
 session_start();
         $data=$_SESSION['submit'];
        if(isset($data['company_name']) && isset($data['name']) && isset($data['furigana']) && isset($data['mail']) && isset($data['tel']) && isset($data['sex'])){ 

        $res = "";
        $USER = 'root'; //ユーザー名
        $PW = '';  //パスワード
        $dnsinfo = "mysql:dbname=toiawase_form;host=localhost;charset=utf8";

        try{ 
            $pdo = new PDO($dnsinfo, $USER, $PW);
            $sql = "INSERT INTO otoiawase(CompnayName,Name,Furigana,Mali,Tel,Sex) VALUE(?,?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $array = array($data['company_name'], $data['name'], $data['furigana'], $data['mail'], $data['tel'], $data['sex']);
            $res = $stmt->execute($array);
        }catch(Exception $e){
            $res = $e->getMessage();
        }
    }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お問い合わせフォーム</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div>
        <div>
        <h1>お問い合わせ 送信完了</h1>
        <p>
        お問い合わせありがとうございました。<br>
        内容を確認のうえ、回答させて頂きます。<br>
        しばらくお待ちください。
        </p>
        <a href="test.php">
            <button type="button">お問い合わせに戻る</button>
        </a>
    </div>
</div>
</body>
<html>


