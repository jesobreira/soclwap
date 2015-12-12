<?php
function youtube($videourl) {
  $ret = array();
  $video = explode("=", $videourl);
  $video = $video[1];
  $video = explode("&", $video);
  $video = $video[0];
  $video = str_replace("?v=", null, $video);
  $ret['code'] = '<object width="320" height="180"><param name="movie" value="http://www.youtube.com/v/'.$video.'&amp;hl=pt_BR&amp;fs=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$video.'&amp;hl=pt_BR&amp;fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="320" height="180"></embed></object>';
  $meta = get_meta_tags($videourl);
  $ret['title'] = protect($meta['title']);
  $ret['desc'] = protect($meta['description']);

  return $ret;
}