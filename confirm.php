<?php 
 session_start();
    
        //submitで送られて来たデータを$dataに格納
        $data=$_SESSION['submit'];
        $company_name = $data["company_name"];
        $name = $data["name"];
        $furigana = $data["furigana"];
        $mail = $data["mail"];
        $tel = $data["tel"];
        $sex = $data["sex"];
        $item = $data["item"];
        $content  = $data["content"];

    // 送信ボタンが押されたら
    if (isset($_POST["submit"])) {

        // サンクスページに画面遷移させる
        header("Location: thanks.php");
        exit;
    } 
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お問い合わせフォーム</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <form action="thanks.php" method="post">
           
            <h1 class="contact-title">お問い合わせ 内容確認</h1>
            <p>お問い合わせ内容はこちらで宜しいでしょうか？<br>よろしければ「送信する」ボタンを押して下さい。</p>
            <div>
                <div>
                    <label>貴社名</label>
                    <p><?php echo $company_name; ?></p>
                <div>
                    <label>ご担当者名</label>
                    <p><?php echo $name; ?></p>
                </div>
                <div>
                    <label>ふりがな</label>
                    <p><?php echo $furigana; ?></p>
                </div>
                <div>
                    <label>メールアドレス</label>
                    <p><?php echo $mail; ?></p>
                </div>
                <div>
                    <label>電話番号</label>
                    <p><?php echo $tel; ?></p>
                </div>
                <div>
                    <label>性別</label>
                    <p><?php echo $sex; ?></p>
                </div>
                <div>
                    <label>お問い合わせ項目</label>
                    <p><?php echo $item; ?></p>
                </div>
                <div>
                    <label>お問い合わせ内容</label>
                    <p><?php echo nl2br($content); ?></p>
                </div>
            </div>
        <input type="button" value="内容を修正する" onclick="history.back(-1)">
        <button type="submit" name="submit">送信する</button>
    </form>
</div>
</body>
<html>