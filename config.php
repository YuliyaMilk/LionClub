<?php

@$db = mysqli_connect('localhost','mysql','mysql','lion_club') or die ('No connect to DB');
mysqli_set_charset($db,'utf8') or die('Cannot set charset');
?>