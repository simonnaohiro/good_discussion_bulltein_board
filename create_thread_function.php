<?php
  $thread_title = (isset($_POST['thread_title'])) ? $_POST['thread_title'] : '';
  $name = ($_POST['name'] === "") ? '禁断のミノリス774': $_POST['name'];
  $email = (isset($_POST['email'])) ? $_POST['email']: '';
  $chat = (isset($_POST['chat'])) ? $_POST['chat'] : '';

  if(!empty($_POST)){
    //バリーデーションチェック
    // validRequired($thread_title, 'thread_title');
    validRequired($chat, 'chat');
    validMaxLen($email, 'email');
    validMaxLen($name, 'name');

    if(empty($err_msg)){
      //例外処理
      $threadDBName = 'response'.makeThreadRandId();
      try {
        $dbh = dbConnect();
        $sql = 'CREATE TABLE `resba_board`.`'.$threadDBName.'`
        ( `id` INT(11) NOT NULL AUTO_INCREMENT UNIQUE, `thread_title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
         `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
         `comment_val` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `delete_flg` BOOLEAN NOT NULL DEFAULT FALSE , `comment_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
         `commenter_id` VARCHAR(255) NULL DEFAULT NULL ) ENGINE = InnoDB';
        $data = array();
        debug('SQL:'.$sql);
        debug('流し込みデータ:'.print_r($data, true));
        //クエリ実行
        $stmt = queryPost($dbh, $sql, $data);
        if($stmt){
          debug('スレッドを作成しました');
          try{
            $sql2 = 'INSERT INTO '.$threadDBName.' (thread_title, name, email, comment_val, comment_time, commenter_id) VALUES (:thread_title, :name, :email, :chat, :comment_time, :commenter_id)';
            $data2 = array(':thread_title' => $thread_title ,':name' => $name,':email' => $email, ':chat' => $chat, ':comment_time' => date('Y-m-d H:i:s'), ':commenter_id' => makeRandId());
            debug('SQL:'.$sql2);
            debug('流し込みデータ:'.print_r($data2, true));
            //クエリ実行
            $stmt2 = queryPost($dbh, $sql2, $data2);
            if($stmt2){
              debug('>>1に書き込みました');
              debug('作ったスレッドに遷移します');
              $url = "http://localhost:8888/resba_board/thread_template.php?tID=".$threadDBName;
              header('Location:'.$url);
            }
          }catch (Exception $e){
            error_log('エラー発生:' . $e->getMessage());
            $err_msg['common'] = MSG02;
          }
        }
      } catch(Exception $e) {
        error_log('エラー発生:' . $e->getMessage());
        $err_msg['common'] = MSG02;
      }
    }
  }
