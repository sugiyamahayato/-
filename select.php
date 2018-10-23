<?php
header("Content-type: text/html; charset=utf-8");

$dsn = 'mysql:host=localhost;dbname=otoiawase_form; charset=utf8';
$user = 'root';
$password = '';

try{
    //データベース接続
    $dbn = new PDO($dsn, $user, $password);
    echo "接続成功";
    //プリペアドステートメント
    $sql = 'SELECT * FROM otoiawase';
    //クエリ実行
    $stmt = $dbn ->query($sql);
    //レコードの件数を取得
    $row_count = $stmt->rowCount();
    //連想配列でDBの内容取得
    while($row = $stmt->fetch()){
        $rows[] = $row;         
    }
    $dbn = null;
//エラーキャッチ
}catch (PDOException $e){
    print('Error:' .$e->getMessage());
    die();
}

?>

<!DOCTYPE html>
<html>
<head>
<title>内容一覧</title>
<meta charset="utf-8">
</head>
<body>
<h1>内容一覧</h1>

レコード件数：<?php echo $row_count; ?>

<table border='1'>
<tr><td>ID</td><td>貴社名</td><td>ご担当者名</td><td>ふりがな</td><td>Mail</td><td>Tel</td>
<td>性別</td><td>内容</td><td>変更する</td><td>削除する</td></tr>

<?php
foreach($rows as $row){
?>
<tr>
    <td><?php echo $row['ID']; ?></td>
    <td><?php echo $row['company_name']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['furigana']; ?></td>
    <td><?php echo $row['mail']; ?></td>
    <td><?php echo $row['tel']; ?></td>
    <td><?php echo $row['sex']; ?></td>
    <td><?php echo $row['item']; ?></td>
    <td> 
        <!-- 更新画面へ遷移 -->
        <a href="./update.php?id=<?php echo $row['ID']?>">変更</a>
    </td>
    <td>
        <!-- 削除ボタン -->
        <a href="./delete.php?id=<?php echo $row['ID']?>">削除</a>
    </td>
</tr>
<?php    
}
?>

</table>
</body>
</html>