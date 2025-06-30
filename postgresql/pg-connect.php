<?php
    /*データベースに接続＋データベースから読み取り*/

    //データベースをセット
    $db_set = "host = localhost user = team6 dbname = team6db password = hirano";
    //データベースと接続
    $db_conn = pg_connect($db_set);
    if(!$db_conn){
        print("接続エラー\n");
    }else{
        print("接続完了\n");
    }

    //データベースのmenuテーブルからデータを読み取る
    $query = "SELECT * FROM menu";
    $result = pg_query($db_conn,$query); 
    if(!$result){
        print("クエリ実行エラー\n");
    }else{
        print("クエリ実行成功\n");
        //読み取ったデータの内、menu_idとmenu_nameを表示
        for($i=0;$i<pg_num_rows($result);$i++){
            $rows = pg_fetch_array($result,NULL,PGSQL_ASSOC);
            print("menu_id=".$rows["menu_id"]);
            print("\n");
            print("menu_name=".$rows["menu_name"]);
            print("\n");
        }
    }

    //データベースとの通信を切断
    $db_close = pg_close($db_conn);
    if($db_close){
        print("切断完了\n");
    }else{
        print("切断失敗\n");
    }

?>