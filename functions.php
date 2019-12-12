<?php
   function get_concerts() {
             global $db;
             $query = "SELECT * FROM concerts";
             $res = mysqli_query($db,$query);
             return mysqli_fetch_all($res,MYSQLI_ASSOC);
             }
   function get_json($arr){
   $data= '[';
   foreach($arr as $item) {
         $data .= '{"date": "' .$item['date']. '","title": "' .$item['title']. '", "description": "' .$item['description']. '", "url": "' .$item['url']. '"},';
   }
   $data .= ']';
   return $data;
   }
   
   function print_arr($arr) {
        echo '<pre>' . print_r($arr,true).'</pre>';
        }