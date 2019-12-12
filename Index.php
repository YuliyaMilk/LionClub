<?php
require_once 'config.php';
require_once 'functions.php';
$concerts= get_concerts();
$concerts = get_json($concerts);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title> LION Club</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="eventCalendar.css">
    <link rel="stylesheet" href="eventCalendar_theme_responsive1.css">
    <link rel="stylesheet" href="main9.css">
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="footer.css">
 <script src="wow.min.js"></script>
 <script>
       new WOW().init();
 </script>
 
  </head>
 <body>
 <script src="http://code.jquery.com/jquery.min.js"></script>
  <script src="moment.js"></script>
  <script src="jquery.eventCalendar.js"></script>
  <script>
  $(function(){
  var data =<?php echo $concerts ?>;
    /*var data = [
     { "date": "2019-04-25 20:00:","title": "Событие 1", "description": "The Killers", "url": "http://www.event3.com/"},
     { "date": "2019-05-06 20:00:","title": "Событие 1", "description": "Metallica", "url": "http://www.event3.com/"},
     { "date": "2019-05-01 20:00:","title": "Событие 1", "description": "Radiohead", "url": "http://www.event3.com/"},
     { "date": "2019-04-23 20:00:","title": "Событие 1", "description": "Tame Impala", "url": "http://www.event3.com/"},
    
    
    ];*/
     $('#eventCalendar').eventCalendar({
          //eventsjson:'data.json',
          jsonData: data,
          jsonDateFormat: 'human',
          openEventInNewWindow:true,
          locales: {
    locale: "ru",
	txt_noEvents: "Нет запланированных концертов",
	txt_SpecificEvents_prev: "",
	txt_SpecificEvents_after: "концерты:",
	txt_NextEvents: "Следующие концерты:",
	txt_GoToEventUrl: "Смотреть",
	moment: {
        "months" : [ "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь",
                "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь" ],
        "monthsShort" : [ "Янв", "Фев", "Мар", "Апр", "Май", "Июн",
                "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек" ],
        "weekdays" : [ "Воскресенье","Понедельник","Вторник","Среда",
                "Четверг","Пятница","Суббота" ],
        "weekdaysShort" : [ "Вс","Пн","Вт","Ср",
                "Чт","Пт","Сб" ],
        "weekdaysMin" : [ "Вс","Пн","Вт","Ср",
                "Чт","Пт","Сб" ],
        
          }
        }
     
     });
  
  });
  </script>  
  
  <script type="text/javascript">
         var lastResFind=""; 
         var copy_page=""; 
         function TrimStr(s) {
         s = s.replace( /^\s+/g, '');
         return s.replace( /\s+$/g, '');
         }
         function FindOnPage(inputId) {
         var obj = window.document.getElementById(inputId);
         var textToFind;

         if (obj) {
         textToFind = TrimStr(obj.value);
} else {
alert("Введенная фраза не найдена");
return;
}
if (textToFind == "") {
alert("Вы ничего не ввели");
return;
}

if(document.body.innerHTML.indexOf(textToFind)=="-1")
alert("Ничего не найдено, проверьте правильность ввода!");

if(copy_page.length>0)
document.body.innerHTML=copy_page;
else copy_page=document.body.innerHTML;


document.body.innerHTML = document.body.innerHTML.replace(eval("/name="+lastResFind+"/gi")," ");
document.body.innerHTML = document.body.innerHTML.replace(eval("/"+textToFind+"/gi"),"<a name="+textToFind+" style='background:red'>"+textToFind+"</a>");
lastResFind=textToFind; 
window.location = '#'+textToFind;
} 
</script>
         
 <div class="container">
     <header >  
        
         <div class="heading">
                <a href="Index.php" > <img src="LEVLOGOcolor.svg" height="180" width="290" class="logo"> </a> 
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
    <div> 
     <div class="container1">
             <div id="eventCalendar" class="supereventcalendar wow fadeInLeft"></div>
             <a href="Splin.html"> <div class="Advert wow fadeInLeft">
           <h3> СПЛИН ВЫХОДИТ НА «ВСТРЕЧНУЮ ПОЛОСУ»</h3>
           <p>5 мая 2019 группа Сплин покажет на сцене "Lion Club" большое шоу, посвященное выходу очередного студийного альбома «Встречная полоса».
            Зрителей ждут новые композиции легендарной группы, давно полюбившиеся хиты и эффектное световое шоу.
            Релиз «Встречной полосы» состоялся 25 мая 2018 года. Это 15-я номерная пластинка команды, созданная в ставшем для нее уже традиционным стиле психоделического сюрреализма.
             Запись проходила в 2017 – 2018 гг. на студии «Добролет». Кроме музыкантов группы, в ней приняли участие приглашенные исполнители - струнный квартет, духовая секция и перкуссионисты. «Тепло родного дома», которую бессменный лидер коллектива Александр Васильев называет центральной композицией альбома, стала первым синглом, презентованным публике 15 декабря 2017. Второй – «Булгаковский марш» - артисты показали поклонникам 1 апреля 2018 в формате анимационного клипа.</p>
              </div> </a>
     </div>
       
     <form class = "searchform wow rotateInDownRight">
        <input id="text-to-find" type="text" placeholder="Введите имя исполнителя" required>
        <button type="submit" onClick="javascript: FindOnPage('text-to-find') ; return false;">Искать</button>
     </form>
            
      <!--<div class="concerts">
         <ul >
              <li><img class="The_Killers" src="The_Killers.jpg" width="600px" height="400px" align="left" > <div class="c"> The Killers — американская альтернативная рок-группа, 
              образованная в 2002 году Брэндоном Флауэрсом и Дэйвом Кенингом. Название было взято из видеоклипа New Order «Crystal» (2001), 
              где под таким именем выступает фиктивная группа. В музыке The Killers наиболее четко прослеживается влияние группы New Order <p>
              </li>
              
              <li><img class="Metallica" src="Metallica.jpg" width="600px" height="400px" align="left" > Metallica - американская метал-группа, образованная в 1981 году.
              Metallica оказала большое влияние на развитие метала и входит (наряду с такими группами как Slayer, Megadeth и Anthrax) в «большую четвёрку трэш-метала»[2]. 
              Альбомы Metallica были распроданы в количестве более, чем 110 миллионов пластинок. </li>
               
              <li><img class= "Radiohead" src="Radiohead.jpg" width="600px" height="400px" align="left">Radiohead — британская рок-группа из Оксфордшира. 
              Группа была основана в 1985 году, и её состав с того времени не менялся. Стиль Radiohead традиционно определяют как альтернативный рок, 
              хотя на разных этапах звучание варьировалось от брит-попа до арт-рока и электронной музыки. </li>
           </ul>
       </div>  -->
      
      <div class="The_Killers wow fadeInRight" data-wow-offset="90" >
      <a class="NameOfBand"  href="The_Killers.html">  <p>30 марта. The Killers  — американская альтернативная рок-группа, 
              образованная в 2002 году Брэндоном Флауэрсом и Дэйвом Кенингом. Название было взято из видеоклипа New Order «Crystal» (2001), 
              где под таким именем выступает фиктивная группа. В музыке The Killers наиболее четко прослеживается влияние группы New Order.</p> </a>
              
      </div>
      <div class = "Metallica wow fadeInRight" data-wow-offset="90" >
          <a class="NameOfBand"  href="Metallica.html"> <p>14 апреля.Metallica - американская метал-группа, образованная в 1981 году.
              Metallica оказала большое влияние на развитие метала и входит (наряду с такими группами как Slayer, Megadeth и Anthrax) в «большую четвёрку трэш-метала»[2]. 
              Альбомы Metallica были распроданы в количестве более, чем 110 миллионов пластинок. </p></a>
      </div> 
        
      <div class="Radiohead wow fadeInRight" data-wow-offset="90" >
          <a class="NameOfBand"  href="Radiohead.html">  <p> 25 апреля. Radiohead — британская рок-группа из Оксфордшира. 
              Группа была основана в 1985 году, и её состав с того времени не менялся. Стиль Radiohead традиционно определяют как альтернативный рок, 
              хотя на разных этапах звучание варьировалось от брит-попа до арт-рока и электронной музыки.</p></a>
        </div> 
        
        <div class="Tame_Impala wow fadeInRight" data-wow-offset="90"  >
            <a class="NameOfBand"  href="Tame_Impala.html"><p> 12 июня. Tame Impala (произн. тэйм импа?ла; с англ. приручённая импала) — австралийский музыкальный коллектив, организованный 
            Кевином Паркером (автор и продюсер группы) в 2007 году и работающий в жанре психоделического рока. 
            В концертный состав группы входят Кевин Паркер (гитара, вокал), Джей Уотсон (синтезатор, вокал, гитара), Доминик Симпер (гитара, синтезатор) </p></a>
        </div>
        
       <div class="Splin wow fadeInRight" data-wow-offset="90"  >
            <a class="NameOfBand"  href="Splin.html"><p> 5 мая. Сплин - российская рок-группа из Санкт-Петербурга. Бессменный лидер — Александр Васильев.
             Датой рождения группы считается 27 мая 1994 года.  5 мая 2019 группа Сплин покажет на сцене "Lion Club" большое шоу, посвященное выходу очередного студийного альбома «Встречная полоса».
            Зрителей ждут новые композиции легендарной группы, давно полюбившиеся хиты и эффектное световое шоу.
            Релиз «Встречной полосы» состоялся 25 мая 2018 года. Это 15-я номерная пластинка команды, созданная в ставшем для нее уже традиционным стиле психоделического сюрреализма.
             Запись проходила в 2017 – 2018 гг. на студии «Добролет». Кроме музыкантов группы, в ней приняли участие приглашенные исполнители - струнный квартет, духовая секция и перкуссионисты.</p></a>
        </div>
        
      
 </body>
</html>
  
