<?php?
$res = "";
$USER = 'root';
$PW = '';
$dnsinfo = "mysql:dbname=salesmanagement;host=localhost;charset=uft8";
$pdo = new PDO($dnsinfo.$USER,$PW);

$sql = "SELECT * FROM otoiawase";
$stmt = $pdo->prepare($sql);
$stmt->execute(null);
$selectTag = "<select name='会社名'><br>"
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $selectTag .= "<option value=" .$row['company_name'] .">"
                .$row['name'] ."</option><br>";                
}
$selectTag .= "</select>";

if(isset($_POST['select'])){
    try{
        $sql = "SELECT * FROM otoiawase WHERE company_name=?";
        $stmt = $pdo->prepare($sql);
        $array = array($_POST[''])
    }
}
>