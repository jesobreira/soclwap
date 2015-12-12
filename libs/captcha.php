<?php
function getcaptcha() {
  global $url;
  return $url."/captcha/";
}

function comparecaptcha($value) {
  $value = strtoupper($value);
  if(md5($value)===$_SESSION['random_txt']) {
    return true;
  } else {
    return false;
  }
}
?>