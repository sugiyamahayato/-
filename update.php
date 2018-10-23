<?php
session_start();
var_dump($_SESSION);

$data=$_SESSION;

if (isset($data['ID']) &&
    isset($data['company_name']) &&
    isset($data['name']) &&
    isset($data['furigana']) &&
    isset($data['mail']) &&
    isset($data['tel']) &&
    isset($data['sex']) &&
    isset($data['item']) )
//データの引継ぎのタイミングでSESSION
//SESSIONのデータ確認、データがあればSESSIONのデータを＄ROWに代入
//SESSIONの削除、有効期限かコード内で削除

header("Content-type: text/html; charset=utf-8");

    $dsn = "mysql:host=localhost; dbname=otoiawase_form; charset=utf8";
    $user = "root";
    $password = "";
    //GETを取得
    $ID=$_GET['id'];
    if($_GET['id'] === ''){
        $errors[] = 'エラー';
    }
    
    //GETに値が入っていれば、DB接続、入っていなければエラーまたはselect.phpに戻す
    //更新ボタン押下でupdate2.phpに画面遷移
    //POSTでデータを送る


try{
    //データベース接続
    $pdo = new PDO($dsn, $user, $password);
    //エラー
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //プリペアドステートメント
    $stmt = $pdo->prepare("SELECT * FROM otoiawase WHERE ID=? ");

    if ($stmt) {
        //プレースホルダへGET['id']の値を設定
        //プレースホルダが「？」の場合、パラメータは数字でその位置を指定する
        $stmt->bindValue(1, $ID, PDO::PARAM_INT);
        //クエリ実行  
        $stmt->execute();
        //値の取得
        $row = $stmt->fetch(PDO::FETCH_ASSOC);   
    }
//エラーキャッチ(例外処理)
}catch(PDOException $e){
            print('error:' .$e->getMessage());
            die();      
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>変更画面</title>
</head>
<body>
<h1>変更画面</h1>
<p>変更してください</p> 
<form action="update2.php" method="POST">
<input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
<p>貴社名：<input type="text" name="company_name" value="<?php echo $row['company_name']; ?>"></p>
<p>ご担当者名：<input type="text" name="name" value="<?php echo $row['name']; ?>"></p>
<P>ふりがな：<input type="text" name="furigana" value="<?php echo $row['furigana']; ?>"></p>
<p>Mail:<input type="text" name="mail" value="<?php echo $row['mail']; ?>"></p>
<p>Tel:<input type="text" name="tel" value="<?php echo $row['tel']; ?>"></p>
<p>性別：<input type="text" name="sex" value="<?php echo $row['sex']; ?>"></p>
<p>内容：<input type="text" name="item" value="<?php echo $row['item']; ?>"></p>
<p><input type="submit" name="submit" value="変更"></p>
</form>
</body>
</html>
