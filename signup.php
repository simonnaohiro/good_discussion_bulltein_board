<?php
ini_set('display_errors',1);
// 共通変数、共通関数の読みこみ
require('function.php');

debug("「「「「「「「「「「「「「「「「「「「「「「「「「");
debug("ユーザー登録ページ");
debug("「「「「「「「「「「「「「「「「「「「「「「「「「");
debugLogStart();

//post送信されていた場合
if(!empty($_POST)){
  $email = isset($_POST['email']) && is_string($_POST['email']) ? $_POST['email'] : "";
  $pass = isset($_POST['pass']) && is_string($_POST['pass']) ? $_POST['pass'] : "";
  $pass_re = isset($_POST['pass_re']) && is_string($_POST['pass_re']) ? $_POST['pass_re'] : "";

  //=================バリデーションチェック==================
  // 未入力チェック
  validRequired($email,'email');
  validRequired($pass,'pass');
  validRequired($pass_re,'pass_re');

  if(empty($err_msg)){
    //emailの形式チェック
    validEmail($email,'email');
    validMaxLen($email,'email');
    validDubEmail($email);

    //パスワードの半角英数字チェック
    validHalf($pass,'pass');
    //パスワードの最大、最小文字数チェック
    validMaxLen($pass,'pass');
    validMinLen($pass,'pass');

    //再入力したパスワードの最大、最小文字数チェック
    validMaxLen($pass_re, 'pass_re');
    validMinLen($pass_re, 'pass_re');


    if(empty($err_msg)){
      validMatch($pass, $pass_re, 'pass');

      if(empty($err_msg)){
     //例外処理
       try {
         // DBへ接続
         $dbh = dbConnect();
         // SQL文作成
         $sql = 'INSERT INTO users (email,password,login_time,create_date) VALUES(:email,:pass,:login_time,:create_date)';
         $data = array(':email' => $email, ':pass' => password_hash($pass, PASSWORD_DEFAULT),
                       ':login_time' => date('Y-m-d H:i:s'),
                       ':create_date' => date('Y-m-d H:i:s'));
         // クエリ実行
         $stmt = queryPost($dbh, $sql, $data);

         //  クエリ成功の場合
         if($stmt){
           //ログイン有効期限（デフォルトを１時間とする）
           $sesLimit = 60*60;
           // 最終ログイン日時を現在日時に
           $_SESSION['login_date'] = time();
           $_SESSION['login_limit'] = $sesLimit;
           // ユーザーIDを格納
           $_SESSION['user_id'] = $dbh->lastInsertId();

           debug('セッション変数の中身：'.print_r($_SESSION,true));

           header("Location:mypage.php"); //マイページへ
         }
       }catch(Exception $e){
         error_log('エラー発生:'.$e->getMessage());
         $err_msg = MSG07;
       }
     }
    }
  }
}
 ?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ユーザー登録</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/signup.css">
    <script src="bundle.js"></script>
  </head>
  <body>
    <div class="container">
      <section id="main">
        <div class="form-container">
          <form class="form-wrapper" action="" method="post">
            <label class="form mail-form">
              <h2>メールアドレス</h2>
              <div class="area-msg <?php if(!empty($err_msg['email'])) echo 'err'; ?>">
                <!-- ここにエラーメッセージ -->
                <?php if(!empty($err_msg['email'])){
                  echo $err_msg['email'];
                } ?>
              </div>
              <input type="text" name="email" placeholder="Eメールアドレス">
            </label>
            <label class="form pass-form">
              <h2>パスワード<button id="show-btn" class="" type="button" name="button" >パスワードを見る</button></h2>
              <div class="area-msg <?php if(!empty($err_msg['email'])) echo 'err'; ?>">
                <!-- ここにエラーメッセージ -->
                <?php if(!empty($err_msg['pass'])) echo $err_msg['pass'];?>
              </div>
              <input id="js-pass-target" class="js-pass-target" type="password" name="pass" placeholder="パスワード ">
            </label>
            <label class="form pass-reform">
              <h2>パスワード(再入力)</h2>
              <div class="area-msg <?php if(!empty($err_msg['email'])) echo 'err'; ?>">
                <!-- ここにエラーメッセージ -->
                <?php if(!empty($err_msg['pass_re'])) echo $err_msg['pass_re'] ?>
              </div>
              <input class="js-pass-target" type="password" name="pass_re" placeholder="パスワード（再入力）">
            </label>
            <label class="submit-button">
              <div class="area-msg">
                <!-- ここにエラーメッセージ -->
              </div>
              <div class="btn-container">
                <input type="submit" name="" value="送信する">
              </div>
            </label>
          </form>
        </div>
      </section>
    </div>
    <script type="text/javascript" >
      let toggle_btn = document.getElementById('show-btn');
      toggle_btn.addEventListener('click',function(){

        let input = document.getElementById('js-pass-target');
        let style = input.getAttribute('type');

        if(style == 'password'){
          input.setAttribute('type','text');
          document.getElementById('show-btn').textContent = 'パスワードを隠す';
        }else if(style = 'text'){
          input.setAttribute('type','password');
          document.getElementById('show-btn').textContent = 'パスワードを見る';
        }
      },false);
    </script>
  </body>
</html>
