<html>
<body>
<?php

$USER = 'root';
$PW = '';
$DB = "mysql:dbname=toiawase_form;host=localhost;charset=utf8";
// データベースに接続
try{
    if(!$pdo = new PDO($DB, $USER, $PW));
    echo "接続完了";
}catch(PDOException $e){
    $e->getMessage();
}

// データベースを選択
/*if(!mysql_select_db("toiawase_form",$pdo)){
echo"データベース選択エラー";
exit;
}*/

// SELECT文を実行
/*if(!$res=mysql_query("SELECT * FROM otoiawase")){
echo "SQLエラー<BR>";
exit;
}*/

// 検索した結果を全部表示
echo "<table border=1>";
echo "<tr><td>id</td><td>name</td></tr>";
while($row=mysql_fetch_array($res)){
echo "<tr>";
echo "<td>". $row["name"] . "</td>";
echo "<td>". $row["age"] . "</td>";

echo "<form action=koushin_input.php method=post>";
echo "<input type=hidden name=id value=" . $row["id"] . ">";
echo "<td><input type=submit value=更新></td>";
echo "</form>";

echo "<form action=sakujo.php method=post>";
echo "<input type=hidden name=id value=" . $row["id"] . ">";
echo "<td><input type=submit value=削除></td>";
echo "</form>";

echo "</tr>";
}
echo "</table>";

// 結果セットの解放
mysql_free_result($res);

// データベースから切断
mysql_close($con);
?>
</body>
</html>

