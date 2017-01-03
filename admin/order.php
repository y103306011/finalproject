<?php session_start(); ?>
<?php
    $username = $_SESSION["username"];
?>
<?php
    $NO = $_GET["NO"];
    $db = mysqli_connect("localhost","root","Yang831013") or die("無法開啟MySQL伺服器連接!");
    $dbname = "finalproject";
    if (!mysqli_select_db($db,$dbname)) {
        die("無法開啟$dbname資料庫");
    }
    $sql = "SELECT * FROM record_table WHERE NO = '$NO'";
    $result = mysqli_query($db,$sql);
    $err = mysqli_error($db);
    $num = mysqli_num_rows($result);
    echo $err;
    if($num > 0){
        $row = mysqli_fetch_array($result);
        $Artist = $row["Artist"];
        $thisAName = $row["AName"];
        $thisAid = $row["Aid"];
        $thisPrice = $row["Price"];
        mysqli_free_result($result);
    }    
    mysqli_close($db);
?>
<?php
    $db = mysqli_connect("localhost","root","Yang831013") or die("無法開啟MySQL伺服器連接!");
    $dbname = "finalproject";
    if (!mysqli_select_db($db,$dbname)) {
        die("無法開啟$dbname資料庫");
    }
    $sql = "SELECT * FROM purchase_table WHERE Aid = '$thisAid'";
    $result = mysqli_query($db,$sql);
    $err = mysqli_error($db);
    $num = mysqli_num_rows($result);
    echo $err;
    if($num > 0){
        $row = mysqli_fetch_array($result);
        $thisMid = $row["Mid"];
        mysqli_free_result($result);
    }    
    mysqli_close($db);
?>
<?php
    $db = mysqli_connect("localhost","root","Yang831013") or die("無法開啟MySQL伺服器連接!");
    $dbname = "finalproject";
    if (!mysqli_select_db($db,$dbname)) {
        die("無法開啟$dbname資料庫");
    }
    $sql = "SELECT * FROM record_table WHERE Artist = '$Artist'";
    $result = mysqli_query($db,$sql);
    $err = mysqli_error($db);
    $numAlbum = mysqli_num_rows($result);
    echo $err;
    if($numAlbum > 0){
        $i = 0;
        while ($row = mysqli_fetch_array($result)) {
            $Aid[$i] = $row["Aid"];
            $AName[$i] = $row["AName"];
            $i = $i + 1;
        }
        mysqli_free_result($result);
    }    
    mysqli_close($db);
?>
<?php
    $db = mysqli_connect("localhost","root","Yang831013") or die("無法開啟MySQL伺服器連接!");
    $dbname = "finalproject";
    if (!mysqli_select_db($db,$dbname)) {
        die("無法開啟$dbname資料庫");
    }
    for ($j=0; $j < $numAlbum; $j++) { 
        $Albumid = $Aid[$j];     
        $sql = "SELECT * FROM sales_table WHERE Aid = '$Albumid'";
        $result = mysqli_query($db,$sql);
        $err = mysqli_error($db);
        echo $err;
        $num = mysqli_num_rows($result);
        if($num > 0){
            $total = 0;
            while ($row = mysqli_fetch_array($result)) {
                $Quantity = $row["Quantity"];
                $total = $total + $Quantity;
            }
            mysqli_free_result($result);
        }
        $AlbumAmount[$j] = $total; 
    }   
    mysqli_close($db);
?>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="utf-8">

    <head>
        <title>產銷資訊系統</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style type="text/css">
        /* Add a dark background color with a little bit see-through */
        
        .navbar {
            margin-bottom: 0;
            background-color: #2d2d30;
            border: 0;
            font-size: 11px !important;
            letter-spacing: 4px;
            opacity: 0.9;
        }
        /* Add a gray color to all navbar links */
        
        .navbar li a,
        .navbar .navbar-brand {
            color: #d5d5d5 !important;
        }
        /* On hover, the links will turn white */
        
        .navbar-nav li a:hover {
            color: #fff !important;
        }
        /* The active link */
        
        .navbar-nav li.active a {
            color: #fff !important;
            background-color: #29292c !important;
        }
        /* Remove border color from the collapsible button */
        
        .navbar-default .navbar-toggle {
            border-color: transparent;
        }
        /* Dropdown */
        
        .open .dropdown-toggle {
            color: #fff;
            background-color: #555 !important;
        }
        /* Dropdown links */
        
        .dropdown-menu li a {
            color: #000 !important;
        }
        /* On hover, the dropdown links will turn red */
        
        .dropdown-menu li a:hover {
            background-color: blue !important;
        }
        
        .container {
            padding: 90px 80px;
            background: #ffffff;
        }
        
        #info {
            padding-left: 1%;
        }
        
        body {
            background: #2d2d30;
        }
        </style>
    </head>

    <body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><b>玫瑰大眾唱片</b></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($_SESSION['username'] != null) {
                        echo "<li><a href='member.php'>$username</a></li>";
                    }?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">存貨資料<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="record.php">存貨查詢</a></li>
                            <li><a href="recordinventory.php">現有存貨</a></li>
                        </ul>
                    </li>
                    <li><a href="sale.php">銷貨紀錄</a></li>
                    <li><a href="purchase.php">訂貨紀錄</a></li>
                    <li><a href="logout.php">登出系統</a></li>
                    <li><a href="https://www.facebook.com/pg/gmusicshopping/photos/?ref=page_internal"><span class="glyphicon glyphicon-info-sign"></span></a></li>
                </ul>
            </div>
        </div>
    </nav>
        <div class="bg-1">
            <div class="container">
                <div class="row test">                            
                    <h3 class="text-center"><b><?php echo "$thisAName";?></b></br></br></h3>
                    <p class="text-center"><b><?php echo "$Artist";?></b></br></br></p>
                    <div class="col-md-8" id="info">
                        <div class="row">
                            <div class="col-sm-11 form-group">                    
                            <div class="thumbnail">
                                <img src="http://127.0.0.1/project/merchandise/<?php echo "$NO";?>.jpg" class="img-responsive" style="height:200px">
                            </div>
                                <table class="table table-hover">
                                    <?php
                                        echo "<tr>";
                                        echo "<td>唱片ID</td>";
                                        echo "<td>唱片名稱</td>";
                                        echo "<td>銷售張數</td>";
                                        echo "</tr>";
                                        $totalSale = 0;                                                
                                        for ($k=0; $k < $numAlbum; $k++) { 
                                            echo "<tr>";
                                            echo "<td>$Aid[$k]</td>";
                                            echo "<td>$AName[$k]</td>";
                                            echo "<td>$AlbumAmount[$k]</td>";
                                            echo "</tr>";
                                            $totalSale = $totalSale + $AlbumAmount[$k];
                                        }
                                        $predict[0] = $AlbumAmount[0];
                                        for ($k=1; $k <= $numAlbum; $k++) { 
                                            $predict[$k] = $predict[$k-1] + 0.15*($AlbumAmount[$k-1] - $predict[$k-1]);
                                        }
                                        $current_predict = round($predict[$numAlbum]);
                                        $a = (2*$current_predict*($thisPrice*0.5))/($thisPrice*0.25);
                                        $EOQ = round(sqrt($a));
                                        echo "<tr style='color:blue; background:#E6E6F2;'>";
                                        echo "<td></td>";
                                        echo "<td>發行唱片張數</td>";
                                        echo "<td>$numAlbum</td>";
                                        echo "</tr>";
                                        echo "<tr style='color:red; background:#FFECEC;'>";
                                        echo "<td></td>";
                                        echo "<td>總銷售張數</td>";
                                        echo "<td >$totalSale</td>";
                                        echo "</tr>";
                                        echo "<td></td>";
                                        echo "<td>預測需求張數</td>";
                                        echo "<td >$current_predict</td>";
                                        echo "</tr>";
                                        echo "<td></td>";
                                        echo "<td>本期估計訂購張數</td>";
                                        echo "<td >$EOQ</td>";
                                        echo "</tr>";
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" id="order">
                        <form method="post" action="order2.php">
                            <div class="row">
                                <div class="col-sm-10 form-group">
                                <label for="Aid">專輯ID</label>
                                <input class="form-control" id="Aid" name="Aid" value="<?php echo "$thisAid";?>" type="text" required>
                                </div>
                            </div>
                            <div class="row" style="margin-top:1%;">
                                <div class="col-sm-10 form-group">
                                <label for="Aid">供應商ID</label>
                                <input class="form-control" id="Mid" name="Mid" value="<?php echo "$thisMid";?>" type="text" required>
                                </div>
                            </div>
                            <div class="row" style="margin-top:1%;">
                                <div class="col-sm-10 form-group">
                                <label for="Aid">訂購日期</label>
                                <?php
                                    $getDate= date("Y-m-d");
                                ?>
                                <input class="form-control" id="PDate" name="PDate" value="<?php echo "$getDate";?>" type="date" required>
                                </div>
                            </div>
                            <div class="row" style="margin-top:1%;">
                                <div class="col-sm-10 form-group">
                                <label for="Aid">訂購數量</label>
                                <input class="form-control" id="Quantity" name="Quantity" value="<?php echo "$EOQ";?>" type="text" required>
                                </div>
                            </div>
                            <div class="row" style="margin-top:1%;">
                                <div class="col-sm-10 form-group">
                                <label for="Aid">訂購金額</label>
                                <input class="form-control" id="Dollar" name="Dollar" value="<?php echo round($thisPrice*$EOQ*0.5);?>" type="text" required>
                                </div>
                            </div>
                            <div class="row" style="margin-top:3%;">
                                <input class="btn btn-primary btn-block" type="submit" value="確認訂購"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
