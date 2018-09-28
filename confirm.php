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

            
            mb_language("ja");
        mb_internal_encoding("UTF-8");
        
        //mb_send_mail("kanda.it.school.trial@gmail.com", "メール送信テスト", "メール本文");

            // 件名を変数subjectに格納
            $subject = "［自動送信］お問い合わせ内容の確認";

            // メール本文を変数bodyに格納
        $body = <<< EOM
{$name}　様

お問い合わせありがとうございます。
以下のお問い合わせ内容を、メールにて確認させていただきました。

===================================================

【 貴社名 】
{$company_name}

【 ご担当者様 】 
{$name}

【 ふりがな 】 
{$furigana}

【 メール 】 
{$mail}

【 電話番号 】 
{$tel}

【 性別 】 
{$sex}

【 項目 】 
{$item}

【 内容 】 
{$content}
===================================================

内容を確認のうえ、回答させて頂きます。
しばらくお待ちください。
EOM;
        
        // 送信元のメールアドレスを変数emailに格納
        $mail = "contact@dream-php-seminar.com";

        // 送信元の名前を変数nameに格納
        $name = "お問い合わせ";

        // ヘッダ情報を変数headerに格納する      
        $header = "From: " .mb_encode_mimeheader($name) ."<{$email}>";

        // メール送信を行う
        mb_send_mail($email, $subject, $body, $header);

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
            <input type="hidden" name="company_name" value="<?php echo $company_name; ?>">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="furigana" value="<?php echo $furigana; ?>">
            <input type="hidden" name="mail" value="<?php echo $mail; ?>">
            <input type="hidden" name="tel" value="<?php echo $tel; ?>">
            <input type="hidden" name="sex" value="<?php echo $sex; ?>">
            <input type="hidden" name="item" value="<?php echo $item; ?>">
            <input type="hidden" name="content" value="<?php echo $content; ?>">
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