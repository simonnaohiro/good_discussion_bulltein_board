<?php
  require('function.php');

  debug('「「「「「「「「「「「「「「「「「「「「「「');
  debug('「「マイページ「「');
  debug('「「「「「「「「「「「「「「「「「「「「「「');
  debugLogStart();
  //ログイン認証
  require('auth.php');

 ?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/mypage.css">
    <title>マイページ</title>
  </head>
  <body>
    <div class="header-img" >
      ここにヘッダーをイメージします
    </div>
    <div class="mypage-wrapper">
      <div class="container">
        <div class="mypage-container">
          <div class="left-list menu">
            bookmarkしたスレかなんかを保存しとく？
          </div>
          <div class="mymenu menu">
            <div class="user-img">
              <img src="" alt="">
            </div>
            <div class="user-profile">
              <h1>ユーザーネーム</h1>
              <p>ここに自己紹介や自分のプロフィールをかく</p>
            </div>
            <div class="menu-wrapper">
              ここにユーザーの情報、ページのスタイルの変更などの編集機能を入れる
              <a href="logout.php">ログアウトする</a>
              <a href="thread.php">スレッドへ</a>
            </div>
          </div>
          <div class="right-list menu">
            ユーザーメニュー
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
