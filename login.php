<?php
require "db.php" ; ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
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

            <div class="forma wow fadeInRight">
                <?php $data = $_POST;
 if( isset($data['do_login']) )
  {
    $errors = array();
    $user = R::findOne('users','login = ?',array($data['login']));

    if($user)
    {
       // логин существует
    if( password_verify($data['password'],$user->password) )
     { 
     $_SESSION['logged_user']= $user;
     echo '<div style ="color:green;">Вы авторизованы!<br>Можете перейти в <a href="Cabinet.php"> Личный Кабинет</a></div><hr>';
     } else 
     {  
       $errors[]='Неверно введен пароль!';
     }
  } else
  {
     $errors[] = 'Пользователь с таким логином не найден!';
  }
     if (! empty($errors) )
  {
   echo '<div style ="color:red;">'.array_shift($errors).'</div><hr>';
  } }  ?>

                    <form action="login.php" method="POST">

                        <p>
                            <p><strong>Логин </strong>: </p>
                            <input type="text" name="login" value="<?php echo @$data['login']; ?>">
                        </p>

                        <p>
                            <p><strong>Пароль </strong>: </p>
                            <input type="password" name="password" value="<?php echo @$data['password']; ?>">
                        </p>

                        <p>
                            <button class="button" style="vertical-align:middle" href="login1.php" type="submit" name="do_login"><span>Войти</span></button>
                        </p>

                    </form>
            </div>
        </div>
    </body>

    </html>