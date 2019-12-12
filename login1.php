<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf8">
    <title> LION Club</title>
    <link rel="stylesheet" href="Cabinet1.css">
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
                <img src="leo.svg" height="100" width="80" class="logo">
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
                            <a class="nav-link" href="Cabinet.html"> <span>Личный кабинет</span> </a>
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
    </div>
</body>
</html>
