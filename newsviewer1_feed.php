<?php
   header('Content-Type: text/xml');
   echo file_get_contents('https://sourceforge.net/p/soclwap/blog/feed');
?>
