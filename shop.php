<?php
    $db = mysqli_connect("localhost","root","Yang831013") or die("無法開啟MySQL伺服器連接!");
    $dbname = "finalproject";
    if (!mysqli_select_db($db,$dbname)) {
        die("無法開啟$dbname資料庫");
    }
    $sql = "SELECT * FROM record_table";
    $result = mysqli_query($db,$sql);
    $err = mysqli_error($db);
    $num = mysqli_num_rows($result);
    echo $err;
    mysqli_close($db);
?>
<?php session_start(); ?>
<?php
    $username = $_SESSION["username"];
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
    
    .carousel-inner img {
        -webkit-filter: grayscale(90%);
        filter: grayscale(90%);
        /* make all photos black and white */
        width: 50%;
        /* Set width to 100% */
        margin: auto;
    }
    
    .carousel-caption h3 {
        color: #fff !important;
    }
    
    @media (max-width: 600px) {
        .carousel-caption {
            display: none;
            /* Hide the carousel text when the screen is less than 600 pixels wide */
        }
    }
    
    .thumbnail {
        padding: 0 0 15px 0;
        border: none;
        border-radius: 0;
    }
    
    .thumbnail p {
        margin-top: 15px;
        color: #555;
    }
    .thumbnail img {
        padding-top: 5%;
        width:  60%;
        height: 40%;
    }
    /* Black buttons with extra padding and without rounded borders */
    
    .btn {
        padding: 10px 20px;
        background-color: #303;
        color: #f1f1f1;
        border-radius: 0;
        transition: .2s;
    }
    /* On hover, the color of .btn will transition to white with black text */
    
    .btn:hover,
    .btn:focus {
        border: 1px solid #333;
        background-color: #fff;
        color: #000;
    }   
    .container {
        padding: 60px 80px;
        background: #2d2d30;
        color: #bdbdbd;
    }
    #list{
        margin-top: 5%;
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
                    <?php if (isset($_SESSION['username'])) {
                        echo "<li><a href='member.php'>$username</a></li>";
                    }else{
                        echo "<li><a href='login.php'>會員登入</a></li>";
                        echo "<li><a href='joinus.php'>加入我們</a></li>";
                    }
                    ?>
                    <li><a href='index.php'>Home</a></li>
                    <li><a href="shop.php">商品清單</a></li>
                    <?php if (isset($_SESSION['username'])) {
                        echo "<li><a href='logout.php'>會員登出</a></li>";
                    }
                    ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">MORE
            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="adminlogin.php">管理員登入</a></li>                           
                        </ul>
                    </li>
                    <li><a href="https://www.facebook.com/pg/gmusicshopping/photos/?ref=page_internal"><span class="glyphicon glyphicon-info-sign"></span></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="bg-1">
        <div class="container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000" style="width:100%;">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="ny.jpg" alt="New York">
                <div class="carousel-caption">
                    <h3>既然青春留不住</h3>
                    <p>李宗盛</p>
                </div>
            </div>
            <div class="item">
                <img src="chicago.jpg" alt="Chicago">
                <div class="carousel-caption">
                    <h3>20 動力火車 新歌DUET精選(2CD)</h3>
                    <p>動力火車</p>
                </div>
            </div>
            <div class="item">
                <img src="la.jpg" alt="Los Angeles">
                <div class="carousel-caption">
                    <h3>林宥嘉演唱會自選LIVE CD</h3>
                    <p>林宥嘉</p>
                </div>
            </div>
        </div>
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div id="list">
                <?php 
                    if ($num > 0) {
                        $i = 3;
                        while($row = mysqli_fetch_array($result)){
                            $NO = $row["NO"];
                            $AName = $row["AName"];
                            $Artist = $row["Artist"];
                            $Released = $row["Released"];
                            $Price = $row["Price"];
                            if ($i%3 == 0 ) {
                                echo "<div class='row text-center'>";
                            }
                            echo "<div class='col-sm-4'>";
                            echo "<div class='thumbnail'>";
                            echo "<img src='merchandise/". $NO .".jpg' alt='$AName'>";
                            echo "<p><strong>$AName</strong></p>";
                            echo "<p>$Artist</p>";
                            echo "<p>$Released</p>";
                            echo "<p style='color:red;'>"."$"."$Price</p>";
                            echo "<input type='button' value='Buy' class='btn' onclick="."'window.location.href=".'"'."buy.php?NO=$NO".'"'."'>";
                            echo "</div>";
                            echo "</div>";
                            if ($i%3 == 2 ) {
                                echo "</div>";
                            }
                            $i = $i + 1;
                        } 
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
