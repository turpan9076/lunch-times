<?php
    /*データベースに接続＋データベースに要素を追加*/

    //データベースをセット
    $db_set = "host = localhost user = team6 dbname = team6db password = hirano";
    //データベースと接続
    $db_conn = pg_connect($db_set);
    if(!$db_conn){
        print("接続エラー\n");
    }else{
        print("接続完了\n");
    }
    
    //追加するデータを設定
    $m_id = 37;
    $datetime = date("Y-m-d H:i:s");;

    //データを追加
    $query = "INSERT INTO report (menu_id,report_time) VALUES ($1,$2)";
    $insert = pg_query_params($db_conn,$query,array($m_id,$datetime)); 
    if(!$insert){
        print("Insert error\n");
    }else{
        print("Insert success\n");
    }
    
    /*
    //データベースのreportテーブルからデータを読み取る
    $query = "SELECT * FROM report";
    $result = pg_query($db_conn,$query);
    if(!$result){
        print("result error\n");
    }else{
        print("result success\n");
        for($i=0;$i<pg_num_rows($result);$i++){
            $rows = pg_fetch_array($result,NULL,PGSQL_ASSOC);
            printf("report_id=".$rows["report_id"]);
            printf("|menu_id=".$rows["menu_id"]);
            printf("|report_time=".$rows["report_time"]);
        }
    }
    */

    //データベースとの通信を切断
    $db_close = pg_close($db_conn);
    if($db_close){
        print("切断完了\n");
    }else{
        print("切断失敗\n");
    }

?>