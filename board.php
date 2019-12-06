<?php
  require('function.php');

  debug("===========================");
  debug('掲示板〜スレッド一覧ページ〜');
  debug("===========================");
  debugLogStart();
  //スレッド作成関数
  require('create_thread_function.php');
  // スレッド取得関数
  require('get_tableName_function.php');
  //書き込み取得関数
  require('get_comment_function.php');
  $getAllThread = getThread();
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
              <?php
              $allThreadCount = count($getAllThread);
              // var_dump($getAllThread);
              for ($i=0; $i < $allThreadCount; $i++) {
                $tableName = $getAllThread[$i]['Tables_in_resba_board'];
                $getThreadComment = getComment($tableName);
                $threadPath = 'http://localhost:8888/resba_board/thread_template.php?tID='.$tableName;
                ?>
                <a class="thread-heading" href="<?php echo $threadPath ?>"><?php echo $getThreadComment[0]['thread_title']; ?></a>
                <?php
                }
                 ?>
            </div>
          </section>
          <section>
            <div class="thread-content">
              <div class="thread-wrapper">
                <?php
                for ($i=0; $i < 5; $i++) {
                  $tableName = $getAllThread[$i]['Tables_in_resba_board'];
                  var_dump($tableName);
                  $getThreadComment = getComment($tableName);
                  foreach($getThreadComment as $key => $val){
                  ?>
                  <div class="comment-wrapper" >
                    <!-- print response number,name,datetime and comment ID  -->
                    <?php if($val['delete_flg']){?>
                      <div class="name-wrapper">
                        <p><?php echo $val['id']; ?> 名前：あべし！！ <?php echo $val['comment_date'] ?> ID:???</p>
                        <p style="<?php if($val['email'] === "") echo 'display:none;' ;?>">email:<?php echo $val['email'] ;?></p>
                      </div>
                      <div class="comment-box">
                        削除されました
                      </div>
                    </div>
                    <?php }else{?>
                    <div class="name-wrapper">
                      <p><?php echo $val['id']; ?> 名前：<?php echo $val['name']; ?> <?php echo $val['comment_date'] ?> ID:<?php echo $val['commenter_id'] ?></p>
                      <p style="<?php if($val['email'] === "") echo 'display:none;' ;?>">email:<?php echo $val['email'] ;?></p>
                    </div>
                    <!-- print a content of response-->
                    <div class="comment-box">
                     <p><?php
                     $text = $val['comment_val'];

                     //if $text has URL
                     if(preg_match_all('(https?://[-_.!~*\'()a-zA-Z0-9;/?:@&=+$,%#]+)', $text, $result) !== 0){
                       foreach($result[0] as $value){ ?>
                         <?php
                          $replace = '<a href="'.$value.'">'.$value.'</a>';
                          $text =  str_replace($value, $replace ,$text);
                          ?>
                         <?php
                       }
                       echo nl2br($text);

                     }else{
                       echo nl2br($text);
                     }
                     ?>
                     </p>
                    </div>
                  </div>
                  <?php
                  }
                  }
                   ?><?php
                }
                ?>
                  </div>
              </div>
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
