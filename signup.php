<?php
require "db.php" ;?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf8">
        <title> LION Club</title>
        <link rel="stylesheet" href="Cabinet3.css">
        <link rel="stylesheet" href="animate.css">
        <link rel="stylesheet" href="Login3.css">
        <script src="wow.min.js"></script>
        <script>
            new WOW().init();
        </script>
    </head>

    <body>
        <div class="container">
            <header>
                <div class="heading">
                    <a href="Index.php"> <img src="LEVLOGOcolor.svg" height="180" width="290" class="logo"> </a>
                    <nav>
                        <ul class="menu">
                            <li class="nav-item "> <a class="nav-link" href="AboutClub.html"><span> О Клубе </span> </a> </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Index.php"> <span>Концерты</span> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Rent.html"> <span>Аренда</span> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Contacts.html"> <span>Контакты</span> </a>
                            </li>
                            <li class="active">
                                <a class="nav-link" href="Cabinet.php"> <span>Личный кабинет</span> </a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </header>

            <?php if( isset($_SESSION['logged_user']) ):?>
                <div class="text2">
                    Здравствуйте,
                    <?php echo $_SESSION['logged_user'] ->login; ?>!
                        <br> Вы авторизованы на сайте Lion Club. Теперь вы можете быстро совершать покупку билетов на концерты любимых групп! Стоимость билета будет автоматически списана с вашей карты, а билет мы пришлем вам на почту!
                        <br> Увидимся на концертах!
                </div>
                <div class="logout">
                    <a href="logout.php">Выйти</a>
                </div>

                <?php else : ?>
                    <?php endif; ?>

                        <div class="forma2 wow fadeInRight">
                            <?php $data = $_POST;
 if( isset($data['do_signup']) )
 {
  $errors = array();
  if ( trim($data['login']) == '') 
  { $errors[] = 'Введите логин!';} 

  if ( trim($data['email']) == '') 
  { $errors[] = 'Введите Email!';}

   if ($data['password'] == '') 
  { $errors[] = 'Введите пароль!';} 

  if ( $data['password2'] != $data['password']) 
  { $errors[] = 'Повторный пароль введен неверно!';}

  if ( R::count('users',"login= ?", array($data['login']))>0 ) 
  { $errors[] = 'Пользователь с таким логином уже существует';}

  if ( R::count('users',"email = ?",
  array($data['email']))>0 ) 
  { $errors[] = 'Пользователь с таким email уже существует';}

  if (empty($errors) )
  { 
  //ошибок нет, осуществляется регистрация
   $user = R::dispense ('users');
   $user ->login = $data['login'];
   $user ->email = $data['email'];
   $user ->password = password_hash($data['password'],PASSWORD_DEFAULT);//шифрование пароля
   R::store($user);
   echo '<div style ="color:green;">Вы успешно зарегестрированы!<br>Можете вернуться на страницу<a href="Cabinet.php"> Личный Кабинет </a></div><hr>'; 
  } else
  {
   echo '<div style ="color:red;">'.array_shift($errors).'</div><hr>';
  }

 }
?>
                                <form action="signup.php" method="POST">

                                    <p>
                                        <p><strong> Ваш логин </strong>: </p>
                                        <input type="text" name="login" value="<?php echo @$data['login']; ?>">
                                    </p>

                                    <p>
                                        <p><strong> Ваш Email </strong>: </p>
                                        <input type="email" name="email" value="<?php echo @$data['email']; ?>">
                                    </p>

                                    <p>
                                        <p><strong> Ваш пароль </strong>: </p>
                                        <input type="password" name="password" value="<?php echo @$data['password']; ?>">
                                    </p>

                                    <p>
                                        <p><strong>Введите ваш пароль еще раз </strong>: </p>
                                        <input type="password" name="password2" value="<?php echo @$data['password2']; ?>">
                                    </p>

                                    <p>
                                        <button class="button2" style="vertical-align:middle" type="submit" name="do_signup"><span> Зарегистрироваться </span> </button>
                                    </p>

                                </form>
                        </div>
        </div>
    </body>

    </html>