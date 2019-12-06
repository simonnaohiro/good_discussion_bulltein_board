<?php
function getThread(){
  debug('全データを取得');
  try{
    $dbh = dbConnect('resba_board');
    // $sql = 'SELECT * FROM DBA_TABLES ORDER BY OWNER,TABLE_NAME';
    $sql = 'SHOW TABLES';
    $data = array();
    $stmt = queryPost($dbh, $sql, $data);

    if($stmt){
      return $stmt->fetchAll();
    }else{
      return false;
    }
  } catch (Exception $e){
    error_log('エラー発生' . $e->getMessege());
  }
}
