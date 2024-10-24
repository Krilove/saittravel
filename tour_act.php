
<?php
    error_reporting(E_ERROR | E_PARSE);
    $user = "root";//логин phpmyadmin
    $password = "root";//пароль phpmyadmin
    $host = "localhost";
    $db = "requests";
    $dbh = 'mysql:host='.$host.';dbname='.$db.';charset=utf8';// 
    $pdo=new PDO($dbh, $user, $password);
?>
<?php 
    define("SERVERNAME","localhost");
    define("DB_LOGIN","root");
    define("DB_PASSWORD","root");
    define("DB_NAME","requests");
    $connect = new mysqli(SERVERNAME, DB_LOGIN, DB_PASSWORD, DB_NAME);
    $sql = "SELECT * FROM user_requests ORDER BY id DESC";
    $result = $connect->query($sql);
    for($user = array();$row=$result->fetch_assoc();$user[]=$row);
    $row = $pdo->prepare("SELECT * FROM user_requests");
    $row->execute();
    $tours=$row->fetchAll(PDO::FETCH_OBJ);
    ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Заявка отправлена на рассмотрение</title>
</head>
<body>
    <?php foreach($tours as $tour_): ?>
    <?php endforeach ?>
        <div class="succes"><span style="color: red">Не перезагружайте странцу! В случае "спама" заявками модерация их удалит и заблокирует вас.</span></br>Ваша заявка №<?=$tour_->id+1?> зарегестрированна. Ответ отобразиться на главной странице сайта, так же придет на ваш номер телефона который вы указали. Возвращение на сайт через <p id="countdown">15</p>
                                                                                                                                                                                                                                                                                                                                            <script>
                                                                                                                                                                                                                                                                                                                                            let time = 15; //
                                                                                                                                                                                                                                                                                                                                            const timer = setInterval(() => {
                                                                                                                                                                                                                                                                                                                                            document.getElementById('countdown').textContent = time <= 0 
                                                                                                                                                                                                                                                                                                                                                ? clearInterval(timer) 
                                                                                                                                                                                                                                                                                                                                                : time--; 
                                                                                                                                                                                                                                                                                                                                            }, 1000);</script>секунд.... </div> 
                                                                                                                                                                                                                                                                                                                                            
</body>
</html>

<?php
    $sql = "SELECT * FROM user_requests";
    $result = $connect->query($sql);
    for($user = array();$row=$result->fetch_assoc();$user[]=$row);
    
    echo "<script>setTimeout(function() { window.location.href='index.php'; }, 15000 )</script>";
    $name = $_POST['uname']??'0';
    $phone = $_POST['phone']??'0';
    $tour = $_POST['tour']??'0';
    $url=$_SERVER["REQUEST_URI"];
    $url=explode('/', $url);
    $str=$url[4];
    echo $str;
    $connect = new mysqli(SERVERNAME, DB_LOGIN, DB_PASSWORD, DB_NAME);
    if ($phone != " " && $name != " " && $tour != " "){
    $sql="INSERT INTO user_requests (`phone`, `uname`, `tour` ) VALUES ('$phone','$name','$tour')";
    $connect->query($sql);
    $connect->close();
    } 
    
?>