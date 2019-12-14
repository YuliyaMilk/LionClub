<?php
require "db.php" ;
?> 

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title> LION Club</title>
    <link rel="stylesheet" href="vybor.css">
    <link rel="stylesheet" href="main9.css">
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="Concerts6.css">
    <script src="wow.min.js"></script>
 <script>
       new WOW().init();
 </script>
    <body>  
 <div class="container">
     <header >  
        
         <div class="heading">
               <a href="Index.php">  <img src="LEVLOGOcolor.svg" height="180" width="290" class="logo"> </a> 
              <nav> 
                 <ul class="menu">
                  <li class="nav-item "> <a class="nav-link" href="AboutClub.html"><span> О Клубе </span> </a> </li>
                  <li class="active"> <a class="nav-link"  href="Index.php"> <span>Концерты</span> </a> </li>
                  <li class="nav-item"> <a class="nav-link" href="Rent.html"> <span>Аренда</span> </a> </li>
                  <li class="nav-item"> <a class="nav-link" href="Contacts.html"> <span>Контакты</span> </a> </li>
                  <li class="nav-item"> <a class="nav-link" href="Cabinet.php"> <span>Личный кабинет</span> </a> </li>
                </ul>
              </nav>
             </div>  
     </header> 
     
    <div class="title wow zoomInLeft"> <h1> Увидимся на концерте! </div> 
    
    <div class="ticket wow zoomInRight"> 
        <img class="imgg" src="Radiohead.jpg" width="355" height="233">
        <div class="textTick"> <p> <h2> Radiohead</h2><br/> Дата: 21 февраля 2019г. <br/> Время: 19:00 <br/> Тип билета: VIP(COMFORT+) <br/> Пользователь: <?php echo $_SESSION['logged_user'] ->login; ?> </p> </div>
    </div>
    </body>
    </html>
