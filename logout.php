<?php
  //共通変数・関数ファイルを良みこむ
  require('function.php');

  debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
  debug('「ログアウトページ「');
  debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
  debugLogStart();

  debug('ログアウトします');
  //セッションを削除
  session_destroy();
  // ログインページへ
  debug('ログインページへ遷移します');
  header('Location:login.php');
