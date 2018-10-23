
<?php 
header("Content-type:text/html; charset=utf-8");
$dsn="mysql:host=localhost;dbname=otoiawase_form;charset=utf8";
$user='root';
$pw='';

// getで取得したで値を$IDに代入
$ID=$_GET['id'];
// getの中身をチェック
if (isset($_GET['id'])){
        echo 'エラー';
}

try{
    $dbh= new PDO($dsn, $user, $pw);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // DELETEのSQL文
    $sql=$dbh->prepare('DELETE FROM otoiawase WHERE ID=?');
    
    $sql->bindValue(1,$ID,PDO::PARAM_INT);

    $sql->execute();

    // 一覧画面に画面遷移
    header('location:select.php');
}catch(PDOException $e){
    echo 'エラー:',$e->getMessage();
}

?>