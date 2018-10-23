<?php
header("Content-type: text/html; charset=utf-8");

$ID = $_GET['id'];
if (empty($_GET['id'])){
    echo 'エラー';
}

$dsn = 'mysql:host=localhost;dbname=otoiawase_form;charset=utf8;';
$USER='root';
$pw='';


try{
    $pdo = new PDO($dsn, $USER, $pw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt=$pdo->prepare("SELECT * FROM otoiawase WHERE ID=?");

    //各カラムのプレスホルダに値をバインド
    $stmt->bindParam(1, $ID, PDO::PARAM_INT);
    //実行
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

     //UPDETAのSQL　（データベース更新）
     $stmt=$pdo->prepare("UPDATE otoiawase SET company_name=?, name=?, furigana=?, mail=?, tel=?, sex=?, item=? WHERE ID=?");

     //各カラムのプレスホルダに値をバインド
     $stmt->bindParam(1, $row['company_name'], PDO::PARAM_STR);
     $stmt->bindParam(2, $row['name'], PDO::PARAM_STR);
     $stmt->bindParam(3, $row['furigana'], PDO::PARAM_STR);
     $stmt->bindParam(4, $row['mail'], PDO::PARAM_STR);
     $stmt->bindParam(5, $row['tel'], PDO::PARAM_INT);
     $stmt->bindParam(6, $row['sex'], PDO::PARAM_STR);
     $stmt->bindParam(7, $row['item'], PDO::PARAM_STR);
     $stmt->bindParam(8, $row['ID'], PDO::PARAM_INT);
     //実行
     $stmt->execute();

}catch(PDOException $e){
    print('error:' .$e->getMessage());
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
<input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
<p>貴社名：<input type="text" name="company_name" value="<?php echo $row['company_name']; ?>"></p>
<p>ご担当者名：<input type="text" name="name" value="<?php echo $row['name']; ?>"></p>
<P>ふりがな：<input type="text" name="furigana" value="<?php echo $row['furigana']; ?>"></p>
<p>Mail:<input type="text" name="mail" value="<?php echo $row['mail']; ?>"></p>
<p>Tel:<input type="text" name="tel" value="<?php echo $row['tel']; ?>"></p>
<p>性別：<input type="text" name="sex" value="<?php echo $row['sex']; ?>"></p>
<p>内容：<input type="text" name="item" value="<?php echo $row['item']; ?>"></p>
<p><a href = 'select.php'>変更</a></p>
</form>
</body>
</html>
