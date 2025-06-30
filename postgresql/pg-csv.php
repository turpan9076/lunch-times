<?php
    /*データベースに接続＋csvからデータベースに要素を追加*/

    //データベースをセット
    $db_set = "host = localhost user = team6 dbname = team6db password = hirano";
    
    //データベースと接続
    $db_conn = pg_connect($db_set);
    if(!$db_conn){
        print("接続エラー\n");
    }else{
        print("接続完了\n");
    }
    
    //現在のデータをリセット
    $query = "TRUNCATE report, menu RESTART IDENTITY";
    $delete = pg_query($db_conn,$query);
    print("RESTART\n");

    $menu_csv = fopen("menu.csv","r");
    if($menu_csv==false){
        print("csvファイルが開けませんでした。");
    }
    //1行目読み飛ばし
    fgetcsv($menu_csv);

    
    while(($row = fgetcsv($menu_csv)) !== false){
        $name = $row[0];
        $type = $row[1];
        $image = $row[2];
        $price = (int)$row[3];
        $date_str = $row[4];
        $report = $row[5];
        $result = pg_query_params($db_conn,"INSERT INTO menu (menu_name,menu_type,menu_image,
        menu_price,menu_date,report) VALUES ($1,$2,$3,$4,$5,$6)",array($name,$type,$image,$price,$date_str,$report));
        if(!$result){
            print("エラー発生");
            break;
        }
    }
    
    /*
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
            print("menu_name=".$rows["menu_name"]);
            print("\n");
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