
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
    <title>Adminka</title>
</head>
<body>
    <?php
    
    if(isset($_POST['delete'])){
        $connect = new mysqli(SERVERNAME, DB_LOGIN, DB_PASSWORD, DB_NAME);  
        $id=$_GET['id'];
        $sql = "DELETE FROM `user_requests` WHERE `id` = '$id'";
  
        $connect->query($sql);
        $connect->close();
        header("Location: /");
    }
    if(isset($_POST['accept'])){
        $connect = new mysqli(SERVERNAME, DB_LOGIN, DB_PASSWORD, DB_NAME);  
        $id=$_GET['id'];
        $sql = "UPDATE `user_requests` SET `status` = 1, `current_status` = 1 WHERE `id` = '$id'" ;
        $connect->query($sql);
        $connect->close();
        header("Location: /");
    }
    if(isset($_POST['deceline'])){
        $connect = new mysqli(SERVERNAME, DB_LOGIN, DB_PASSWORD, DB_NAME);  
        $id=$_GET['id'];
        $sql = "UPDATE `user_requests` SET `status` = 2, `current_status` = 2 WHERE `id` = '$id'" ;
        $connect->query($sql);
        $connect->close();
        header("Location: /");
    }
    if(isset($_POST['script1'])){
        $connect = new mysqli(SERVERNAME, DB_LOGIN, DB_PASSWORD, DB_NAME);  
        $id=$_GET['id'];
        $sql = "UPDATE `user_requests` SET `status` = 3, `current_status` = 3 WHERE `id` = '$id'" ;
        $connect->query($sql);
        
        $connect->close();
        header("Location: /");
    }
    if(isset($_POST['script2'])){
        $connect = new mysqli(SERVERNAME, DB_LOGIN, DB_PASSWORD, DB_NAME);  
        $id=$_GET['id'];
        $sql = "UPDATE `user_requests` SET `status` = 4, `current_status` = 3 WHERE `id` = '$id'" ;
        $connect->query($sql);
        $connect->close();
        header("Location: /");

    }

    ?>
        <div class="user_requests" style="margin: 20px 40vh 0px 0px; height: 800px; width: 1200px; overflow-y: scroll; border: 10px solid black">
        <input type="checkbox" id="selectid-all" name="selectid-all" style="margin-top: 20px;margin-left: 55px;" unchecked> Выбрать все
        <?php foreach($tours as $tour_): ?>
            <?php
                if ($tour_->current_status == 1)
                :?>
            <div class="user__requests-block" style="border: 2px solid black; margin: 20px;">
                <p class="current_status" style="margin-left: 100vh; font-weight: bold; color: green;">Одобрено</p>
                <p class="user__requests-item">ID <?=$tour_->id?>
                <input type="checkbox" id="selectid" class="selectid" name="selectid" unchecked>
                </p>
                <p class="user__requests-item">Phone:    <?=$tour_->phone?></p>
                <p class="user__requests-item">Name:    <?=$tour_->uname?></p>
                <p class="user__requests-item">Tour:    <?=$tour_->tour?></p>
            </div>
            <?php
                endif;     
                ?>
                            <?php
                if ($tour_->current_status == 2)
                :?>
            <div class="user__requests-block" style="border: 2px solid black; margin: 20px;">
                <p class="current_status" style="margin-left: 100vh; font-weight: bold; color: red;">Отклонено</p>
                <p class="user__requests-item">ID <?=$tour_->id?>
                <input type="checkbox" id="selectid" class="selectid" name="selectid" unchecked>
                </p>
                <p class="user__requests-item">Phone:    <?=$tour_->phone?></p>
                <p class="user__requests-item">Name:    <?=$tour_->uname?></p>
                <p class="user__requests-item">Tour:    <?=$tour_->tour?></p>
            </div>
            <?php
                endif;     
                ?>
                            <?php
                if ($tour_->current_status == 3)
                :?>
            <div class="user__requests-block" style="border: 2px solid black; margin: 20px;">
                <p class="current_status" style="margin-left: 100vh; font-weight: bold; color: orange;">Некорректные данные/пользователь уведомлен</p>
                <p class="user__requests-item">ID <?=$tour_->id?>
                <input type="checkbox" id="selectid" class="selectid" name="selectid" unchecked>
                </p>
                <p class="user__requests-item">Phone:    <?=$tour_->phone?></p>
                <p class="user__requests-item">Name:    <?=$tour_->uname?></p>
                <p class="user__requests-item">Tour:    <?=$tour_->tour?></p>
            </div>
            <?php
                endif;     
                ?>
            <?php
                if ($tour_->current_status == 4)
                :?>
            <div class="user__requests-block" style="border: 2px solid black; margin: 20px;">
                <p class="current_status" style="margin-left: 100vh; font-weight: bold; color: grey;">На рассмотрении</p>
                <p class="user__requests-item">ID <?=$tour_->id?>
                <input type="checkbox" id="selectid" class="selectid" name="selectid" unchecked>
                    <form action="admin.php?id=<?= $tour_->id ?>" method="post" >
                        <input class="admin__action" type="submit" name="accept" value="Одобрить" style="border: none; background: none; color: lightgreen; margin-left:500px;"> 
                        <input class="admin__action" type="submit" name="deceline" value="Отклонить" style="border: none; background: none; color: orange; margin-left: 15px;">  
                        <input class="admin__action" type="submit" name="script1" value="шаблон1" style="border: none; background: none; color: grey; margin-left: 15px;">
                        <input class="admin__action" type="submit" name="script2" value="шаблон2" style="border: none; background: none; color: grey; margin-left: 15px;">    
                        <input class="admin__action" type="submit" name="delete" value="Удалить" style="border: none; background: none; color: red;margin-left: 15px;">
                    </form>
                </p>
                <p class="user__requests-item">Phone:    <?=$tour_->phone?></p>
                <p class="user__requests-item">Name:    <?=$tour_->uname?></p>
                <p class="user__requests-item">Tour:    <?=$tour_->tour?></p>
            </div>
            <?php
                endif;     
                ?>
            <?php endforeach ?>
        </div>
</body>
<script>
        document.getElementById('selectid-all')
                  .addEventListener('change', function () {
            let checkboxes = 
                document.querySelectorAll('.selectid');
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = this.checked;
            }, this);
        });
    </script>
</html>
