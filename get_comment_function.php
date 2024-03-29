<?php
function getComment($tableName){
  debug('書き込みを取得します');
  try{
    //connect to DB
    $dbh = dbConnect('resba_board');
    //set the SQL
    $sql = 'SELECT * FROM '.$tableName;
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
