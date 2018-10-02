<?php
session_start();

         $data=$_SESSION['submit'];
        if(isset($data['company_name']) && 
            isset($data['name']) &&    
            isset($data['furigana']) && 
            isset($data['mail']) && 
            isset($data['tel']) && 
            isset($data['sex'])){      

        $res = "";
        $USER = 'root'; //ユーザー名
        $PW = '';  //パスワード
        $dnsinfo = "mysql:dbname=toiawase_form;host=localhost;charset=utf8";

        try{ 
            $pdo = new PDO($dnsinfo, $USER, $PW);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo -> prepare("INSERT INTO otoiawase(CompanyName, Name, Furigana, Mali, Tel, Sex) 
                                    VALUE (:CompanyName, :Name, :Furigana, :Mali, :Tel, :Sex)");
            $stmt->bindValue(':CompanyName',$data['company_name'], PDO::PARAM_STR);
            $stmt->bindValue (':Name', $data['name'], PDO::PARAM_STR);
            $stmt->bindValue(':Furigana', $data['furigana'], PDO::PARAM_STR);
            $stmt->bindvalue(':Mali', $data['mail'], PDO::PARAM_STR);
            $stmt->bindvalue(':Tel', $data['tel'], PDO::PARAM_STR);
            $stmt->bindvalue(':Sex', $data['sex'], PDO::PARAM_STR);

            $stmt->execute();
                           
            }catch(PDOException $e){
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
