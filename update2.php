<?php

header("Content-type: text/html; charset=utf-8");

    $dsn="mysql:local=localhost; dbname=otoiawase_form; charset=utf8";
    $USER='root';
    $pw='';

    //POSTで送られてきた値を$dataに代入
    $data = $_POST;

    // $errorに関数を代入
    $error = validation($data);

    //$POSTの中身をチェック
   if(!empty($_POST === '')){
        echo 'エラー';
   }


   function validation($data){

    $error=array();

    if (empty($data['company_name'])){
        $error[] = "貴社名が入力されていません。";
    }
    if (empty($data['name'])){
        $error[] = "ご担当者名が入力されていません。";
    }
    if (empty($data['furigana'])){
        $error[] = "ふりがなが入力されていません。";
    }
    if (empty($data['mail'])){
        $error[] = "メールアドレスが入力されていません。";
    }elseif (mb_stristr($data['mail'],"@")){
        $error[] = "メールアドレスに＠が含まれていません。";
    }
    if (empty($data['tel'])){
        $error[] = "電話番号が入力されていません。";
    }elseif (is_int($data['tel'])){
        $error[] = "電話番号を正しく入力してください。";
    }
    if (empty($data['sex'])){
        $error[] = "性別が入力されていません。";
    }
    return $error;

}

try {
    //DB接続
    $pdo = new PDO($dsn, $USER, $pw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //UPDETAのSQL　（データベース更新）
    $stmt=$pdo->prepare("UPDATE otoiawase SET company_name=?, name=?, furigana=?, mail=?, tel=?, sex=?, item=? WHERE ID=?");

        //各カラムのプレスホルダに値をバインド
        $stmt->bindParam(1, $data['company_name'], PDO::PARAM_STR);
        $stmt->bindParam(2, $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(3, $data['furigana'], PDO::PARAM_STR);
        $stmt->bindParam(4, $data['mail'], PDO::PARAM_STR);
        $stmt->bindParam(5, $data['tel'], PDO::PARAM_INT);
        $stmt->bindParam(6, $data['sex'], PDO::PARAM_STR);
        $stmt->bindParam(7, $data['item'], PDO::PARAM_STR);
        $stmt->bindParam(8, $data['ID'], PDO::PARAM_INT);
        //実行
        $stmt->execute();
    
    //SELECTのSQL（更新確認のため）
    $sql=$pdo->prepare("SELECT * FROM otoiawase WHERE ID=? ");

        //IDのプレスホルダにバインド  
        $sql->bindValue(1, $data['ID'], PDO::PARAM_INT);
        //実行
        $sql->execute();
        //$rowに$sqlの配列を代入
        $row = $sql->fetch(PDO::FETCH_ASSOC);
//例外処理
}catch(PDOException $e){
    $errors[] = $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
<title>変更確認画面</title>
</head>
<body>
<h1>変更確認画面</h1>
<!-- 例外を受け取った時、エラーを表示 -->
<?php if (!empty($errors)) echo $errors; ?>

<!-- 入力チェックのエラー文表示 -->
<?php if(!empty($error)) :?> 
    <ul class = "error_list">
    <?php foreach($error as $value) : ?>
        <?php echo $value; ?>
    <?php endforeach; ?>
<?php endif; ?>
<table border='1'>
<tr><td>ID</td><td>貴社名</td><td>ご担当者名</td><td>ふりがな</td><td>Mail</td><td>Tel</td>
<td>性別</td><td>内容</td></tr>


<tr>
    <td><?php echo $row['ID']; ?></td>
    <td><?php echo $row['company_name']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['furigana']; ?></td>
    <td><?php echo $row['mail']; ?></td>
    <td><?php echo $row['tel']; ?></td>
    <td><?php echo $row['sex']; ?></td>
    <td><?php echo $row['item']; ?></td> 
<?php if(!empty($error)) :?>
<!-- エラーがある場合、入力画面にもう一度遷移 -->
 <p><a href="./update3.php?id=<?php echo $row['ID']; ?>">入力画面に戻る</a></p>
<?php endif; ?> 
</tr>
</table>
<!-- 一覧画面に遷移 -->
<a href='select.php'>一覧ページに戻る</a>
</body>
</html>





