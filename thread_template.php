<?php
  require('function.php');

  debug('============================');
  debug('スレッドページ');
  debug('============================');
  debugLogStart();
  //ログイン認証
  require('auth.php');
  require('get_comment_function.php');
  require('post_comment_function.php');

  debug('画面表示処理終了 >>>>>>>>>>>>>>>>>>>>>>>>>>');
  $urlParam = `http://`.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  $dbGetComment = getComment();
  $thread_title = $dbGetComment[0]['thread_title'];
  require('head.php');
?>

  <body class="thread-body">
    <div class="thread">
      <header>
        <h1><?php echo $thread_title ?></h1>
        <p><?php  ?></p>
      </header>
      <div class="thread-table">
        <?php
        foreach($dbGetComment as $key => $val){
        ?>
        <div class="comment-wrapper" >
          <!-- print response number,name,datetime and comment ID  -->
          <?php if($val['delete_flg']){?>
            <div class="name-wrapper">
              <p><?php echo $val['id']; ?> 名前：あべし！！ <?php echo $val['comment_time'] ?> ID:???</p>
              <p style="<?php if($val['email'] === "") echo 'display:none;' ;?>">email:<?php echo $val['email'] ;?></p>
            </div>
            <div class="comment-box">
              削除されました
            </div>
          </div>
          <?php }else{?>
          <div class="name-wrapper">
            <p><?php echo $val['id']; ?> 名前：<?php echo $val['name']; ?> <?php echo $val['comment_time'] ?> ID:<?php echo $val['commenter_id'] ?></p>
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
                // echo $value;
                // var_dump($url_link);
                // echo $text;
                $replace = '<a href="'.$value.'">'.$value.'</a>';
                $text =  str_replace($value, $replace ,$text);
                // var_dump($url_link);
                // var_dump($text)
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
        ?>
        <?php
        }
         ?>
      </div>
      <section>
        <form class="post-wrapper" action="" method="post">
          <p><?php if(!empty($err_msg['chat'])) echo $err_msg['chat'] ; ?></p>
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
    <div class="">
      <form class="" action="" method="post">
        <input type="submit" name="delete" value="消去">
        <?php
          $delete = (isset($_POST['delete'])) ? true : false ;
          if($delete){
            deleteThread();
          }
         ?>
      </form>
    </div>
  </body>
</html>
