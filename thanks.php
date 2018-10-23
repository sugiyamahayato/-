<?php
session_start();

$data=$_SESSION['submit'];
if (isset($data['company_name']) && 
    isset($data['name']) &&    
    isset($data['furigana']) && 
    isset($data['mail']) && 
    isset($data['tel']) && 
    isset($data['sex']) &&
    isset($data['item']) 
) {      

        $res = "";
        $USER = 'root'; //ユーザー名
        $PW = '';  //パスワード
        $dnsinfo = "mysql:dbname=otoiawase_form;host=localhost;charset=utf8";

    try{ 
        $pdo = new PDO($dnsinfo, $USER, $PW);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo ->prepare ("INSERT INTO otoiawase(company_name, name, furigana, mail, tel, sex, item) 
                                VALUE (:company_name, :name, :furigana, :mail, :tel, :sex, :item)" );  
        $stmt->bindValue(':company_name', $data['company_name'], PDO::PARAM_STR);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':furigana', $data['furigana'], PDO::PARAM_STR);
        $stmt->bindvalue(':mail', $data['mail'], PDO::PARAM_STR);
        $stmt->bindvalue(':tel', $data['tel'], PDO::PARAM_STR);
        $stmt->bindvalue(':sex', $data['sex'], PDO::PARAM_STR);
        $stmt->bindvalue(':item', $data['item'], PDO::PARAM_STR);   

        $stmt->execute();                   
    } catch(PDOException $e){
            echo $e->getMessage();
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
