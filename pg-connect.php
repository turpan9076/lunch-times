<?php
    $db_set = "host = localhost user = team6 dbname = team6db password = hirano";
    $db_conn = pg_connect($db_set);
    if(!$db_conn){
        print("接続エラー\n");
    }else{
        print("接続完了\n");
    }

    sleep(1);
    $query = "SELECT A FROM B";
    $result = pg_query($db_conn,$query); 
    if(!$result){
        print("クエリ実行エラー");
    }else{
        print("クエリ実行成功");
    }
    sleep(1);

    $db_close = pg_close($db_conn);
    if($db_close){
        print("切断完了\n");
    }else{
        print("切断失敗\n");
    }

?>