<?php
//=====ログ=====
//ログを取るか
ini_set('log_errors','on');
//ログの出力ファイルを指定
ini_set('error_log','php.log');

//=====デバッグ=====
//debugフラグ
$debug_flg = true;
//デバグ関数
function debug($str){
  global $debug_flg;
  if(!empty($debug_flg)){
    error_log('デバッグ:'.$str);
  }
}

//=====setting sessions=====
//sessionのパスを設定（/var/tmp/に設定すると削除されるまでの日数が３０日まで延長される）
session_save_path("/var/tmp/");
//gabage_collectionが削除するセッションの有効期限を設定（３０日以上経っているものに対して100分の1の確率で削除）
ini_set('session.gc_maxlifetime', 60*60*24*30);
//cookie lifetime extend next 30th days it will not be deleted even if you close the browser.
ini_set('session.cookie_lifetime', 60*60*24*30);
//do the session
session_start();
//current sessionId replace new generate sessionId
session_regenerate_id();

//=====画面表示時のログ吐き出し関数======
function debugLogStart(){
  debug('>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 画面処理開始');
  debug('セッションID:'.session_id());
  debug('セッション変数の中身:'.print_r($_SESSION,true));
  debug('現在日時スタンプ:'.time());
  if(!empty($_SESSION['login_date']) && !empty($_SESSION['login_limit'])){
    debug('ログイン期日日時タイムスタンプ:'.($_SESSION['login_date'] + $_SESSION['login_limit'] ) );
  }
}

//====================
//定数
//====================

define('MSG01','書き込みがありません');
define('MSG02','エラーが発生しました。しばらく経ってからお試しください。');
define('MSG03','最大文字数を超過しています');
define('MSG04','必要文字数に達していません');
define('MSG05','Emailの形式ではありません');
define('MSG06','そのEmailはすでに登録されています');
define('MSG07','エラーが発生しました。しばらく経ってからやり直してください。');
define('MSG08','半角英数字のみ使用できます');
define('MSG09','Emailまたはパスワードが違います');
define('MSG10','入力欄が空です');
define('MSG11','入力された内容が一致しません');
//====================
//グロバール変数
//====================
//エラーメッセージ
$err_msg = array();

//===================
//バリデーション関数
//===================

//バリデーション関数
function validRequired($str,$key){
  if($str === ""){
    global $err_msg;
    $err_msg[$key] = MSG10;
  }
}
function validEmail($str,$key){
  if(!preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/", $str)){
    global $err_msg;
    $err_msg[$key] = MSG05;
  }
}
function validMaxLen($str, $key, $max = 20){
  if(mb_strlen($str) > $max){
    global $err_msg;
    $err_msg[$key] = MSG03;
  }
}
function validMinLen($str, $key, $min = 6){
  if(mb_strlen($str) < $min){
    global $err_msg;
    $err_msg[$key] = MSG04;
  }
}
function validDubEmail($email){
  global $err_msg;
  //例外処理
  try {
    // DB接続
    $dbh = dbConnect();
    // SQL文作成
    $sql = 'SELECT count(*) FROM users WHERE email = :email AND delete_flg = 0';
    $data = array(':email' => $email);
    // クエリ実行
    $stmt = queryPost($dbh, $sql, $data);
    // クエリ結果の値を取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!empty(array_shift($result))){
      $err_msg['email'] = MSG06;
      }
    }catch(Exception $e){
      error_log('エラー発生' . $e->getMessage());
      $err_msg['common'] = MSG07;
    }
}
function validHalf($str, $key){
  if(!preg_match("/^[a-zA-Z0-9]+$/", $str)){
    global $err_msg;
    $err_msg[$key] = MSG08;
  }
}
function validMatch($str1,$str2,$key){
  if($str1 !== $str2){
    global $err_msg;
    $err_msg[$key] = MSG11;
  }
}
//=================
//DB接続関数
//=================
function dbConnect(){
  $dsn = "mysql:dbname=resba_board;host=localhost;charset=utf8";
  $user = 'root';
  $password = 'root';
  $option = array(
    // SQL実行失敗時にはエラーコードのみ設定
    PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
    // デフォルトフェッチモードを連想配列形式に設定
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // バッファードクエリを使う(一度に結果セットをすべて取得し、サーバー負荷を軽減)
    // SELECTで得た結果に対してもrowCountメソッドを使えるようにする
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
  );
  //PODオブジェクト生成（DBへ接続）
  $dbh = new PDO($dsn, $user, $password, $option);
  return $dbh;
}

function queryPost($dbh, $sql, $data){
  //クエリ作成
  $stmt = $dbh->prepare($sql);
  //プレースホルダーに値をセットしてSQLを実行
  if(!$stmt->execute($data)){
    debug('クエリに失敗しました');
    $err_msg['common'] = MSG02;
    return 0;
  }
  debug('クエリ成功');
  return $stmt;
}
function getUser(){
  debug('ユーザーを取得します');
  //例外処理
  try{
    //DB接続
    $dbh = dbConnect();
    //SQL文の作成
    $sql = 'SELECT * FROM users WHERE id = ;u_id AND delete_flg = 0';
    $data = array(':u_id' => $u_id);
    //クエリ実行
    $stmt = qureyPost($dbh, $sql, $data);

    if($stmt){
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }else{
      return false;
    }
  }catch(Exception $e){
    error_log('エラー発生' . $e->getMessage());
  }
}

function makeRandId($length = 9){
  static $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';
  $str = '';
  for ($i = 0; $i < $length; ++$i){
    $str .= $chars[mt_rand(0,61)];
  }
  return $str;
}

function makeThreadRandId($length = 12){
  static $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';
  $str = '';
  for($i = 0; $i < $length; ++$i){
    $str .= $chars[mt_rand(0,61)];
  }
  return $str;
}
// get_thread(){
//
// }

//======================まだ動作してません==========================
// function deleteThread(){
//   debug('スレッドを消去します。');
//   try{
//       $dbh = dbConnect();
//       $sql = 'DELETE * FROM response';
//       $data = array();
//
//       $stmt = queryPost($dbh, $sql, $data);
//       if($stmt){
//         debug('消去成功');
//         header('location:thread.php');
//       }else{
//         return false;
//       }
//     }catch(exception $e){
//       error_log('エラー発生'.$e->getMessage());
//     }
// }
 ?>
