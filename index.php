<?php
    
    echo  $delete;
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="owl.carousel.min.css">
    <link rel="stylesheet" href="owl.theme.default.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel</title>
</head>
<body>
    <header class="header">
        <div class="ogrmage">
            <nav class="header__content">
                <nav class="header__content-info">
                    <ul class="header__content-items">
                        <li class="header__content-item"><a href="#">Главная</a></li>
                        <li class="header__content-item"><a href="#">Туры</a></li>
                        <li class="header__content-item"><a href="#">Цены</a></li>
                    </ul>
                </nav>
                <div class="header__content-text">
                    <h1 class="welcome">Все туры</h1>
                    <h2 class="welcome2">в одном приложении</h2>
                </div>
                <div class="header__content-gotobtn">
                    <span class="gotobnt"> <a href="#form">Перейти к заполнению формы</a></span>
                </div>
            </nav>
            
            <div class="main__content">
        
            </div>

        </div>
    </header>
    <div class="container" style="border-style:  inset ;  border-left: 10px solid grey;  background-color: lightgrey; display: flex; flex-direction: column; gap: 15px; width: 100%; min-height: 100px; max-height: 258px; height: 100%; overflow-y: scroll;">
        <h1 style="color: black; border-bottom: 2px solid black">Статусы ваших заявок</h1>
        <?php foreach($tours as $tour_): ?>
            <?php
                if ($tour_->status == 1)
                :?>
                <p class="request-status"style="font-size: 24px; font-weight: bold; border-bottom: 2px solid black">№<?=$tour_->id?>.<?=$tour_->tour?>  <span style="color: green;">Одобрено</span></p>
                <?php
                endif;     
                ?>
                
            <?php
                if ($tour_->status == 2)
                :?>
                <p class="request-status" style="font-size: 24px; font-weight: bold; border-bottom: 2px solid black">№<?=$tour_->id?>.<?=$tour_->tour?>   <span style="color: red;">Отклонено</span></p>
                <?php
                endif;
                ?>
            <?php
                if ($tour_->status == 3)
                :?>
                <p class="request-status" style="font-size: 24px; font-weight: bold; border-bottom: 2px solid black">№<?=$tour_->id?>.<?=$tour_->tour?>   <span style="color: orange;">Заполните заявку заново с корректным номером телефона, мы с вами свяжемся.</span> </p>
                <?php
                endif;
                ?>
            <?php
                if ($tour_->status == 4)
                :?>
                <p class="request-status" style="font-size: 24px; font-weight: bold; border-bottom: 2px solid black">№<?=$tour_->id?>.<?=$tour_->tour?>   <span style="color: orange;">К сожалению мест на выбранный тур не осталось. Можете заполнить заявку на другой тур и мы с вами свяжемся</span> </p>
                <?php
                endif;
                ?>
        <?php endforeach ?>
    </div>
    <div class="main__content ogrmage">
        <div class="owl-carousel">
            <div class="owl-carousel-item"> <img src="./img/itely.jpg" alt=""> </div>
            <div class="owl-carousel-item"> <img src="./img/more.jpg" alt=""> </div>
            <div class="owl-carousel-item"> <img src="./img/paris.jpg" alt=""> </div>
            <div class="owl-carousel-item"> <img src="./img/gori.jpg" alt=""> </div>
          </div>
        <section class="form" id="form">
            <h1 style="color:black; margin-left: 65px;">Форма</h1>
            
            <form  class="form-input" action="./tour_act.php" method="post" >
                <p style="margin-top: 20px;">Ваш номер телефона</p>
                <input class="phone-input form-input-item" id="phone-input" type="text" value="+7" autocomplete="none" name="phone" maxlength="12">
               
                <p style="margin-top: 20px; margin-left: 70px;">Ваше имя</p>
                <input class="name-input form-input-item" id="name-input" type="text" value="" autocomplete="none" name="uname">
                <p style="margin-top: 20px; margin-left: 120px;">Тур</p>
                <select type="text" class="form-input-item" id="tour-select" name="tour">
                    <option value="" style="text-align: center;">Выберите тур</option>
                    <option value="Горы">Горы</option>
                    <option value="Море">Море</option>
                    <option value="Италия">Италия</option>
                    <option value="Париж">Париж</option>
                  </select>
                
                <button  class="login__button" id="submit">Подтвердить</button>
              </form>
              <span class="warning" id="warning"></span>
        </section>

        
    </div>
    <footer class="footer">
        <div class="footer__main footer__black ogrmage">
            <ul class="footer__main-items">
                <li class="footer__main-item"><a href="#">Больше туров</a></li>
                <li class="footer__main-item"><a href="#">Написать отзыв</a></li>
                <li class="footer__main-item"><a href="#">Связаться с нами</a></li>
                <li class="footer__main-item"><a href="#">ООО Tourism 313634234</a></li>
            </ul>
        </div>
    </footer>
    <script src="./scripts/jquery.min.js"></script>
    <script src="./scripts/owl.carousel.min.js"></script>
    <script src="./scripts/kaka.js"></script>
    <script>
            let submit = document.getElementById('submit');
            submit.innerHTML = '<button class="login__button" id="submit" style="display: none; ">Подтвердить</button>';
            let phone = document.getElementById('phone-input'); 
            let uname = document.getElementById('name-input'); 
            let tour = document.getElementById('tour-select'); 
            tour.addEventListener("change", function(){
                    if (phone.value != "+7" && uname.value != ""){
                        if (tour.value != ""){
                            submit.innerHTML = '<button class="login__button" id="submit" style="display: block;">Подтвердить</button>';
                            console.log(64)
                        }
                        else{
                            console.log("п");
                        }}
                    else{
                        console.log(11);
                        }
                    })  
        </script>
</body>
</html>
