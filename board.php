<?php
  require('function.php');

  debug("===========================");
  debug('掲示板〜スレッド一覧ページ〜');
  debug("===========================");
  debugLogStart();
  //ログイン認証
  require('create_thread_function.php');


 ?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>テスト掲示板</title>
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/board.css">
  <link href="https://fonts.googleapis.com/css?family=Bree+Serif&display=swap" rel="stylesheet">
</head>
  <body>
    <header class="board-header">
      <input type="text" name="search-thread" value="タイトルで検索">
    </header>
      <div class="container">
        <main>
          <section>
            <div class="sponsors-area">
              広告、またはお知らせを表示する。
            </div>
          </section>
          <section>
            <div class="thread-list-area">
              ここにスレッド一覧を表示する
            </div>
          </section>
          <section>
            <div class="thread-wrapper">
              ここに現在存在するスレッドを表示し<br>
              表示されたスレッド各々の>>1と最新のレスポンスを６つを表示する
              <?php  ?>
            </div>
          </section>
        </main>
        <section>
          <form class="post-wrapper" action="" method="post">
            <p><?php
             ?></p>
            <label>
              <input class="thread_title" type="text" name="thread_title" placeholder="スレッドタイトル">
            </label>
            <label class="name-post-wrapper">
              <input type="text" name="name" placeholder="名前">
              <input type="text" name="email" placeholder="Eメール">
            </label>
            <label>
              <textarea name="chat" rows="8" cols="80"></textarea>
              <input type="submit" value="送信">
            </label>
          </form>
        </section>
      </div>
  </body>
</html>
