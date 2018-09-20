<?php
  session_start();
  

  if (!empty($_POST)){  
      
   $company_name = $_POST['company_name'];
   $name = $_POST['name'];
   $furigana = $_POST['furigana'];
   $mail = $_POST['mail'];
   $tel = $_POST['tel'];


      if ($company_name == ''){
          $error_message['company_name'] = '貴社名を入力してください。';
      }
      if ($name == ''){
          $error_message['name'] = 'ご担当者様名を入力してください。';
      }
      if ($furigana == ''){
          $error_message['furigana'] = 'ふりがなを入力してください。';
      }
      if ($mail == ''){
          $error_message['mail'] = 'メールアドレスを入力してください。';
      }
      if ($tel == ''){
          $error_message['tel'] = '電話番号を入力してください。';
      }
      if (empty($error_message)){
          $_SESSION['submit'] = $_POST;
          header('location: confirm.php');
      }
    
      var_dump($error);
    }    
  
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お問い合わせフォーム</title>
<link rel="stylesheet" href="style.css">
</head>
<body>   
<div><h1>Contact</h1></div>
<div><h2>お問い合わせ</h2></div>
<div>
    <form action="test.php" method="post" name="form">
        <h1 class="contact-title">お問い合わせ 内容入力</h1>
        <p>ご希望のお問い合わせ内容を入力の上、下記のフォームから、お気軽にお問い合わせください。</p>
        <div>
            <div>
                <label>貴社名<span>(必須)</span></label>
                <input type="text" name="company_name" placeholder="例）株式会社○○" value=""> 
                <?php if(isset($error_message['company_name'])){ ?>
                <div class = 'company_name'>
                   <?php echo $error_message['company_name']?>
                </div>
                <?php } ?>   
             <div> 
                <label>ご担当者名<span>(必須)</span></label>
                <input type="text" name="name" placeholder="例）鈴木一郎" value="">
               <?php if (isset($error_message['name'])){ ?>
               <div class = 'name'>
                  <?php echo $error_message['name']?>
               </div>
               <?php } ?>   
            </div>
            <div>
                <label>ふりがな<span>(必須)</span></label>
                <input type="text" name="furigana" placeholder="例）すずきいちろう" value="">
                <?php if (isset($error_message['furigana'])){?>
                <div class = 'furigana'>
                   <?php echo $error_message['furigana']?>
                </div>
                <?php } ?>   
            </div>
            <div>
                <label>メールアドレス<span>(必須)</span></label>
                <input type="text" name="mail" placeholder="例）guest@example.com" value="">
                <?php if (isset($error_message['mail'])){?>
                <div class = 'mail'>
                  <?php echo $error_message['mail']?>
                </div>
                <?php } ?>  
            </div>
            <div>
                <label>電話番号<span>(必須)</span></label>
                <input type="text" name="tel" placeholder="例）0000000000" value="">
                <?php if (isset($error_message['tel'])) {?>
                <div class = 'tel'>
                  <?php echo $error_message['tel']?>
                </div>
                <?php } ?>  
            </div>
            <div>
                <label>性別</label>
                <input type="radio" name="sex" value="男性" checked> 男性
                <input type="radio" name="sex" value="女性"> 女性
            </div>
            <div>
                <label>お問い合わせ項目</label>
                <select name="item">
                    <option value="">お問い合わせ項目を選択してください</option>
                    <option value="ご質問・お問い合わせ">ご質問・お問い合わせ</option>
                    <option value="ご意見・ご感想">ご意見・ご感想</option>
                </select>
            </div>
            <div>
                <label>お問い合わせ内容<span>(必須)</span></label>
                <textarea name="content" rows="5" placeholder="お問合せ内容を入力"></textarea>
            </div>
        </div>
        <button type="submit">確認画面へ</button>
    </form>
</div>
</body>
<html>