<?php
  require('function.php');

  debug('「「「「「「「「「「「「「「「「「「「「「');
  debug('ニコレイアウト');
  debug('「「「「「「「「「「「「「「「「「「「「「');
  //ログイン認証
  require('auth.php')
 ?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>nico LAYOUT</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/nico.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/124587158e.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <header>
      <div class="container">
        <div class="header-item">
          <ul class="header-left">
            <li>Top</li>
            <li>動画</li>
            <li>静画</li>
            <li>チャンネル</li>
            <li>アプリ</li>
          </ul>
          <ul class="header-right">
            <li>マイページ</li>
            <li>おすすめ</li>
            <li>ランキング</li>
            <li>メニュー<i></i></li>
          </ul>
        </div>
      </div>
    </header>
    <main>
      <div class="container">
        <div class="descrip-wrapper">
          <div class="heading-wrapper">
            <h1 class="video-heading">キャンピングカー大横転で死にかけた男たちの北海道キャンプの旅 Part4「バーベキュー編」</h1>
            <p class="description">男６人大旅行です。<br>
              オーディオコメンタリー付き</p>
          </div>
          <div class="info-wrapper">
            <div class="user-info">

            </div>
            <div class="video-info">

            </div>
          </div>
        </div>
        <div class="video-wrapper">
          <div class="primary">
            <div class="primary-inner">
              <div class="sponsor">
                ここに広告
              </div>
              <div class="video">
                <iframe src="https://www.youtube.com/watch?v=pbPy9NT9W6Q" width="" height=""></iframe>
              </div>
              <div class="controller-wrapper">
              </div>
              <form class="form-wrapper" method="post">
                <input type="text" class="command-window"name="" placeholder="コマンド" colspan="2"><input type="text" class="comment-form" name="" placeholder="コメント"><input class="submit-btn" type="submit" name="" value="コメントする">
              </form>
            </div>
          </div>
          <div class="secondary">
            <div class="sns-wrapper">
              <div class="menu">
                <div class="menu-bar">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
              </div>
              <div class="sns">
                <i class="fab fa-twitter"></i>
                <i class="fab fa-facebook"></i>
                <i class="fab fa-line"></i>
              </div>
            </div>
            <div class="comment-wrapper">
              <div class="list-switch">
                <ul>
                  <li>コメントリスト</li>
                  <li>他スレリスト</li>
                </ul>
              </div>
              <div class="selector">
                <p>チャンネルセレクト</p>
              </div>
              <div class="comment-box">
                <div class="">
                  <p>書き込み</p><p>再生時間</p><p>書き込み</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer>

    </footer>
  </body>
</html>
