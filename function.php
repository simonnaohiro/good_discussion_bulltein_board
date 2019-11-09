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
    $err_msg[$key] = MSG01;
  }
}
function validMaxLength($str,$key,$max = 40){
  if($str > $max){
    global $err_msg;
    $err_msg[$key] = MSG03;
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

function getComment(){
  debug('書き込みを取得します');
  try{
    //connect to DB
    $dbh = dbConnect();
    //set the SQL
    $sql = 'SELECT * FROM response';
    $data = array();
    //do the query
    $stmt = queryPost($dbh, $sql, $data);

    if($stmt){
      //クエリ結果の全データを返却
      return $stmt->fetchAll();
    }else{
      return false;
    }

  } catch(exception $e) {
    error_log('エラー発生' . $e->getMessege());
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
