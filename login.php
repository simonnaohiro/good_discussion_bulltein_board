<?php
  require('function.php');

  debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「');
  debug('「ログインページ「');
  debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「');
  debugLogStart();

  require('auth.php');

  // ==============================
  // ログイン処理
  // ==============================
  if(!empty($_POST)){
    debug('ポスト送信があります');

    $email = isset($_POST['email']) && is_string($_POST['email']) ? $_POST['email'] : "";
    $pass = isset($_POST['pass']) && is_string($_POST['pass']) ? $_POST['pass'] : "";
    $pass_save = (!empty($_POST['pass_save'])) ? true : false ;

    //emailの形式チェック
    validEmail($email, 'email');
    //最大文字数チェック
    validMaxLen($email, 'email');

    //パスワード半角英数字チェック
    validHalf($pass, 'pass');
    //パスワード最大文字数チェック
    validMaxLen($pass, 'pass');
    //パスワード最小文字数チェック
    validMinLen($pass, 'pass');
    //未入力チェック
    validRequired($email, 'email');
    validRequired($pass, 'pass');
    if(empty($err_msg)){
      debug('バリデーションチェック完了');

      //例外処理
      try{

        //DBに接続
        $dbh = dbConnect();
        //SQL文作成
        $sql = 'SELECT password, id FROM users WHERE email = :email AND delete_flg = 0';
        $data = array( 'email' => $email );
        //クエリ実行
        $stmt =  queryPost($dbh, $sql, $data);
        //クエリ結果の値を取得
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        debug('クエリ結果の中身:'.print_r($result,true));

        if(!empty($result) && password_verify($pass, array_shift($result))){
          debug('パスワードがマッチしました');

          //ログイン有効期限（デフォルトで１時間）
          $sesLimit = 60*60;
          //最終ログインタイムを更新
          $_SESSION['login_date'] = time();

          //ログイン保持にチェックがある場合
          if($pass_save){
            debug('ログイン保持がチェックされています');
            //ログイン有効期限を３０日にセット
            $_SESSION['login_limit'] = $sesLimit * 24 * 30;
          }else{
            debug('ログイン保持がチェックされていません');
            //次回からログイン保持しないので、ログイン有効期限を１時間後にセット
            $_SESSION['login_limit'] = $sesLimit;
          }
          //ユーザーIDを格納
          $_SESSION['user_id'] = $result['id'];

          debug('セッション変数の中身:'.print_r($_SESSION,true));
          debug('マイページへ遷移します');
          header('Location:mypage.php');
        }else{
          debug('パスワードがアンマッチです');
          $err_msg['common'] = MSG09;
        }

      }catch(Exception $e){
        error_log('エラー発生:'.$e->getMessage());
        $err_msg['common'] = MSG07;
      }

    }

  }
  debug('画面表示終了<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<')
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
                <?php if(!empty($err_msg['email'])) echo $err_msg['email']; ?>
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
              <p>ログイン状態を保持する <input type="checkbox" name="pass_save" ></p>
            </label>
            <label class="submit-button">
              <div class="area-msg">
                <!-- ここにエラーメッセージ -->
              </div>
              <div class="btn-container">
                <input type="submit" name="" value="ログイン">
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
