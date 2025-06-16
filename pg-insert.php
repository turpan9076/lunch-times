<?php
    $db_set = "host = localhost user = team6 dbname = team6db password = hirano";
    $db_conn = pg_connect($db_set);
    if(!$db_conn){
        print("接続エラー\n");
    }else{
        print("接続完了\n");
    }
    
    $r_id = 1;
    $m_id = 37;
    $datetime = date("Y-m-d H:i:s");

    $query = "INSERT INTO report (report_id,menu_id,report_time) VALUES ($1,$2,$3)";
    $insert = pg_query_params($db_conn,$query,array($r_id,$m_id,$datetime)); 
    if(!$insert){
        print("Insert error\n");
    }else{
        print("Insert success\n");
    }
    
    $query = "SELECT * FROM report";
    $result = pg_query($db_conn,$query);
    if(!$result){
        print("result error\n");
    }else{
        print("result success\n");
        $rows = pg_fetch_array($result,NULL,PGSQL_ASSOC);
        for($i=0;$i<pg_num_rows($result);$i++){
            printf("report_id=".$rows["report_id"]);
            printf("|menu_id=".$rows["menu_id"]);
            printf("|report_time=".$rows["report_time"]);
        }
    }

    $db_close = pg_close($db_conn);
    if($db_close){
        print("切断完了\n");
    }else{
        print("切断失敗\n");
    }

?>