<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="ここにページの説明を入れます">
  <meta name="keywords" content="キーワード1, キーワード2, キーワード3">
  <meta name="author" content="Your Name">
  <link rel="icon" href="favicon.ico">
  <title>ページのタイトル</title>
  <!-- 外部スタイルシート読み込み -->
  <link rel="stylesheet" href="styles.css">
</head>

<?php
    /*データベースに接続＋データベースから読み取り*/
    /*
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
    */

    $menu = [
      ["menu_id" => 37, "menu_name" => "ハンバーグデミグラスソース（ごはん・味噌汁付き）", "menu_type" => "Aセット","menu_image" => null,"menu_price" => 430,"menu-date" => "2025-06-17","report" => 0],
      ["menu_id" => 38, "menu_name" => "チキン南蛮丼（味噌汁付き）", "menu_type" => "Bセット","menu_image" => null,"menu_price" => 380,"menu-date" => "2025-06-17","report" => 1],
      ["menu_id" => 50, "menu_name" => "かつ丼", "menu_type" => "丼","menu_image" => null,"menu_price" => 350,"menu-date" => "2025-06-17","report" => 0],
      ["menu_id" => 51, "menu_name" => "とんこつラーメン", "menu_type" => "中華麺","menu_image" => null,"menu_price" => 350,"menu-date" => "2025-06-17","report" => 1],
      ["menu_id" => 52, "menu_name" => "かけうどん", "menu_type" => "和麺","menu_image" => null,"menu_price" => 350,"menu-date" => "2025-06-17","report" => 2],
      ["menu_id" => 53, "menu_name" => "かけそば", "menu_type" => "和麺","menu_image" => null,"menu_price" => 350,"menu-date" => "2025-06-17","report" => 3]
    ];
    
?>
<script>
  window.MENU = <?= json_encode($menu, JSON_UNESCAPED_UNICODE) ?>;
</script>

<body>

  <header class="site-header">
    <!-- <img src="img/titleImg.jpg" alt="タイトル名"> -->
    <h1 class="site-title">LUNCH TIMES</h1>
  </header>

  <nav class="site-nav">
    <ul class="nav-list">
      <li><a href="#" class="nav-link" data-index="1">今日のメニュー</a></li>
      <li><a href="#" class="nav-link" data-index="2">メニュー 一覧</a></li>
      <li><a href="#" class="nav-link" data-index="3">使い方</a></li>
      <li><a href="#" class="nav-link" data-index="4">管理者ページ</a></li>
    </ul>
  </nav>

  <main class="site-main">
    <?php 
        $AsetName = "Aset";
        $BsetName = "Bset";
        $AsetPrice = 0;
        $BsetPrice = 0;

        foreach ($menu as $row): ?>
            <?php 
            if($row["menu_type"] == "Aセット")
            {
              $AsetName = $row["menu_name"];
              $AsetPrice = $row["menu_price"];
            }  
            if($row["menu_type"] == "Bセット")  
            {
              $BsetName = $row["menu_name"];
              $BsetPrice = $row["menu_price"];
            }
           ?>
    <?php endforeach; ?>

    <section id="target1"class="content-section">
      <h2 class="section-title">🔶本日のメニュー</h2>
      <button class="setmenu-info">
        <h2>
          Aセット
          <?php echo "<h4>",$AsetName,"</h4>"?>
          <?php echo "<h4><strong>￥",$AsetPrice,"</strong></h4>"?>
        </h2>
      </button>
      <button class="setmenu-info">
        <h2>
          Bセット
          <?php echo "<h4>",$BsetName,"</h4>"?>
          <?php echo "<h4><strong>￥",$BsetPrice,"</strong></h4>"?>
        </h2>
      </button>
    </section>

    <section id="target2" class="content-section">
      <h2 class="section-title">🔶メニュー 一覧 ※<span id="today"></span></h2>
      <p class="section-text">
        <div class="button-container">
        <?php 
        $index = 0;
        foreach ($menu as $row): ?>
            <?php 
            echo 
            '
            <button id="openMealInfo" class="open-meal-info" data-index="',$index++,'">
              <div class="meal-info-header">
                <strong>',$row["menu_name"],'</strong><br>
                <h6>',$row["menu_type"],'</h6><br>
                <h5>売り切れ報告 ',$row["report"],'</h5>
              </div>
              <div class="meal-info-footer">
                <strong class="price">￥',$row["menu_price"],'</strong>
                <span class="open-meal-info-small">詳細</span>
              </div>
            </button>
            ';?>
        <?php endforeach; ?>
        </div>
        <!-- オーバーレイ＋モーダル本体（初期状態は非表示） -->
        <div id="mealInfoOverlay" class="meal-info-overlay" aria-hidden="true">
         <div class="meal-info-content" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
            <button id="closeMealInfo" class="close-button">✕</button>
            <h2 style="text-align:center" id="mealInfoTitle">ごはんのなまえ</h2><br>
            <h3 style="text-align:center"><strong id="mealInfoPrice">￥0</strong><h3>
            <h3 style="text-align:center">売り切れ報告<span id="mealInfoSold">1</span></h3>
            <button id="reportButton" class="report-button">売り切れを<br>報告する</button>
         </div>
        </div>
      </p>
    </section>
    
     <section id="target3" class="content-section">
      <h2 class="section-title">🔶使い方</h2>
      <p class="section-text">
        <h4 class="explain-content">今日のAセット,Bセットの確認
          <h5 class="indent">ホーム画面の「<strong>🔶今日のメニュー</strong>」から今日のAセット,Bセットを確認できます。</h5>
        </h4>
        <h4 class="explain-content">メニューについて
          <h5 class="indent">メニューの名前や価格,売り切れ報告数は「<strong>🔶メニュー 一覧</strong>」から確認できます</h5><br>
          <h5 class="indent">「<strong>詳細</strong>」をクリックすることで各メニューの詳細情報を見れたり売り切れ報告を行うことができます</h5>
        </h4>
      </p>
    </section>

    <section id="target4" class="content-section">
      <p class="section-text">管理者画面はこちら</p><br>
      <p class="section-text">（パスワードが必要です）</p>
      <a href="admin.html" class="nav-link">＞管理者ページへ</a>
    </section>

  </main>

  <footer class="site-footer">
    <p>&copy; 2025 Your Company. All Rights Reserved.</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>
