<?php
header("Contebt-type: text/html; charset=utf-8");
$errors=array();

if(empty($_POST)){
    header("location: search_form.html");
    exit();
}else{
    if(!isset($_POST['search']) or $_POST['search'] === ""){
        $errors['name'] = "検索内容を入力してください。";
    } 
}

if(count($errors)===0){
    $dsn = 'mysql:host=localhost;dbname=otoiawase_form;charset=utf8';
    $user = 'root';
    $password = '';

    try{
        $dbh = new PDO($dsn, $user, $password);
        $stmt = $dbh->prepare("SELECT * FROM otoiawase WHERE company_Name LIKE (:CompanyName)");
        if($stmt){
            $search = $_POST['search'];
            $like_cn = "%".$search."%";
            $stmt->bindValue(':CompanyName', $like_cn, PDO::PARAM_STR);
            if($stmt->execute()){
                $row_count = $stmt->rowCount(); 

                while($row = $stmt->fetch()){
                    $rows[] = $row;
                 }
            }else{
                    $errors['error']="接続に失敗しました。";
            }
            $dsn = null;
        }
    }catch(Exception $e){
        print('error:' .$e->getMessage());
        $errors['error'] = "データベース接続失敗しました。";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>検索結果</title>
<meta charset="utf-8">
</head>
<body>
    
<?php if(count($errors) === 0){ ?>

<p><?=$search,"で検索しました。"?></p>
<p><?=$row_count?>件です。</P>

<table boder='1'>
<tr><td>ID</td><td>Company_Name</td><td>Name</td><td>Furigana</td><td>Mail</td><td>Tel</td><td>Sex</td><td>item</td></tr>

<?php
    foreach($rows as $row){
?>
<tr>
    <td><?php echo $rows['ID']?></td>
    <td><?php echo $row['company_Name']?></td>
    <td><?php echo $row['name']?></td>
    <td><?php echo $row['furigana']?></td>
    <td><?php echo $row['mail']?></td>
    <td><?php echo $row['tel']?></td>
    <td><?php echo $row['sex']?></td>
    <td><?php echo $row['item']?></td>
    
</tr>
<?php
    }
?>

<?php }elseif(count($errors) > 0){ ?>
<?php
    foreach($errors as $value){
        echo "<P>" .$value."</P>";
    }
}
?>


</body>
</html>

