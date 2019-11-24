<?php
  require('function.php');

  debug('「「「「「「「「「「「「「「「「「「「「「');
  debug('ニコレイアウト');
  debug('「「「「「「「「「「「「「「「「「「「「「');
  debugLogStart();
  //ログイン認証
  require('auth.php');
  require('get_comment_function.php');
  require('post_comment_function.php');

  debug('画面表示処理終了 >>>>>>>>>>>>>>>>>>>>>>>>>>');
  $dbGetComment = getComment($dbName);
  $thread_title = $dbGetComment[0]['thread_title'];
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
            <h1 class="video-heading"><?php echo $thread_title ?></h1>
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
                <iframe src="https://www.youtube.com/embed/pbPy9NT9W6Q" width="" height=""></iframe>
              </div>
              <div class="controller-wrapper">
              </div>
              <form class="form-wrapper" method="post">
                <input type="text" class="command-box" name="" placeholder="コマンド" colspan="2"><input type="text" class="comment-form" name="chat" placeholder="コメント"><input class="submit-btn" type="submit" value="コメントする">
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
                <div class="comment-header">
                  <ul>
                    <li id="js-comment">書き込み</li>
                    <li id="js-comment-time">動画時間</li>
                    <li id="js-comment-date">書き込み日時</li>
                    <li id="js-comment-num">書き込み番号</li>
                  </ul>
                </div>
                <div class="comment-body">
                  <?php
                  foreach($dbGetComment as $key => $val){
                   ?>
                  <div id="js-comm-target" class="comment comment-contents">
                    <?php
                     echo $val['comment_val'];
                    ?>
                  </div>
                  <?php
                    }
                   ?>
                  <div id="js-commT-target" class="comment-time comment-contents">
                    動画時間
                  </div>
                  <div id="js-commD-target" class="comment-date comment-contents">
                    書き込み日時
                  </div>
                  <div id="js-commN-target" class="comment-num comment-contents">
                    書き込み番号
                  </div>
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
