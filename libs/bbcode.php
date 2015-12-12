<?php
function bbdecode($texto) {
   $a = array( 
      "/\[i\](.*?)\[\/i\]/is", 
      "/\[b\](.*?)\[\/b\]/is", 
      "/\[u\](.*?)\[\/u\]/is", 
      "/\[img\](.*?)\[\/img\]/is", 
      "/\[url=(.*?)\](.*?)\[\/url\]/is"
   ); 
   $b = array( 
      "<i>$1</i>", 
      "<b>$1</b>", 
      "<u>$1</u>", 
      "<img src=\"$1\" />", 
      "<a href=\"$1\" target=\"_blank\" rel=\"nofollow\">$2</a>"
   ); 
   $texto = preg_replace($a, $b, $texto); 
  $texto = str_replace("&amp;", "&", $texto);
  preg_match_all("/\[code\](.*?)\[\/code\]/is", $texto, $codes);
  foreach($codes as $code) {
    $syntax = syntax(str_replace(array('[code]', '[/code]'), null, $code[0]));
    $texto = str_replace($code[0], '<p style="border: #000 1px dotted; background:white;>'.$syntax.'</p>', $texto);
  }
  // desfazedor de merd*:
  $texto = str_replace('&amp;</span><span style="color: #0000BB">quot</span><span style="color: #007700">;</span>', '&quot;', $texto);
  $texto = str_replace('&amp;</span><span style="color: #0000BB">quot</span><span style="color: #007700">;', '&quot;', $texto);
  // fim desfazedor de merd*

  $texto = nl2br($texto); 
  return $texto; 
}
?>