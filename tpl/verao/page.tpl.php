<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php tm('title'); ?></title>
<style type="text/css">

body, html {
  font-family:Arial, Helvetica, sans-serif;
  width:100%;
  margin:0;
  padding:0;
  text-align:left;
  height:100%;
  min-height:100%;
}

.header {
  /*background-color:#476799;*/
  color:blue;
  padding:20px 0;
  margin:0;
  text-shadow: 1px -1px 10px white;
  font-size: 50px;
  font-color: white;
  font-style: bold;
  background: url('<?php global $url; echo $url; ?>/tpl/verao/header-bg.png');
}

a img {
  border:0;
}

a:link {
  font-color:#005;
  text-decoration:none;
}

a:visited {
  font-color:#115;
  text-decoration:none;
}

a:hover {
  font-color:#005;
  background-color:#57779f;
  text-decoration:none;
}

a:active {
  font-color:#005;
  background-color:#57779f;
  text-decoration:none;
}

.menubar {
  font-color:#fff;
  border-radius: 0px 0px 6px 6px;
  text-align:center;
background: rgb(197,222,234); /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover, rgba(197,222,234,1) 0%, rgba(138,187,215,1) 31%, rgba(6,109,171,1) 100%); /* FF3.6+ */
background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,rgba(197,222,234,1)), color-stop(31%,rgba(138,187,215,1)), color-stop(100%,rgba(6,109,171,1))); /* Chrome,Safari4+ */
background: -webkit-radial-gradient(center, ellipse cover, rgba(197,222,234,1) 0%,rgba(138,187,215,1) 31%,rgba(6,109,171,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-radial-gradient(center, ellipse cover, rgba(197,222,234,1) 0%,rgba(138,187,215,1) 31%,rgba(6,109,171,1) 100%); /* Opera 12+ */
background: -ms-radial-gradient(center, ellipse cover, rgba(197,222,234,1) 0%,rgba(138,187,215,1) 31%,rgba(6,109,171,1) 100%); /* IE10+ */
background: radial-gradient(center, ellipse cover, rgba(197,222,234,1) 0%,rgba(138,187,215,1) 31%,rgba(6,109,171,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c5deea', endColorstr='#066dab',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
}

.row {
background: #f6e6b4; /* Old browsers */
background: -moz-linear-gradient(top, #f6e6b4 0%, #ed9017 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f6e6b4), color-stop(100%,#ed9017)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #f6e6b4 0%,#ed9017 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #f6e6b4 0%,#ed9017 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #f6e6b4 0%,#ed9017 100%); /* IE10+ */
background: linear-gradient(top, #f6e6b4 0%,#ed9017 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6e6b4', endColorstr='#ed9017',GradientType=0 ); /* IE6-9 */
border: 1px #000 solid;
}

.titlebar {
background: #c5deea; /* Old browsers */
background: -moz-linear-gradient(top, #c5deea 0%, #8abbd7 31%, #066dab 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#c5deea), color-stop(31%,#8abbd7), color-stop(100%,#066dab)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #c5deea 0%,#8abbd7 31%,#066dab 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #c5deea 0%,#8abbd7 31%,#066dab 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #c5deea 0%,#8abbd7 31%,#066dab 100%); /* IE10+ */
background: linear-gradient(top, #c5deea 0%,#8abbd7 31%,#066dab 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c5deea', endColorstr='#066dab',GradientType=0 ); /* IE6-9 */  font-color:#fff;
  border-radius: 2px 2px 6px 6px;
  margin:1px;
}

.infobox {
  border: 1px solid #000;
  padding: 10px;
  font-size: 12px;
  color: #808080;
  text-align: justify;
background: #499bea; /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover, #499bea 0%, #207ce5 100%); /* FF3.6+ */
background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,#499bea), color-stop(100%,#207ce5)); /* Chrome,Safari4+ */
background: -webkit-radial-gradient(center, ellipse cover, #499bea 0%,#207ce5 100%); /* Chrome10+,Safari5.1+ */
background: -o-radial-gradient(center, ellipse cover, #499bea 0%,#207ce5 100%); /* Opera 12+ */
background: -ms-radial-gradient(center, ellipse cover, #499bea 0%,#207ce5 100%); /* IE10+ */
background: radial-gradient(center, ellipse cover, #499bea 0%,#207ce5 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#499bea', endColorstr='#207ce5',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
}

.page {
  height: auto !important;
  min-height:100%;
  height:100%;
  position:relative;
background: #f2f9fe; /* Old browsers */
background: -moz-linear-gradient(top, #f2f9fe 0%, #d6f0fd 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f2f9fe), color-stop(100%,#d6f0fd)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #f2f9fe 0%,#d6f0fd 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #f2f9fe 0%,#d6f0fd 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #f2f9fe 0%,#d6f0fd 100%); /* IE10+ */
background: linear-gradient(top, #f2f9fe 0%,#d6f0fd 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f9fe', endColorstr='#d6f0fd',GradientType=0 ); /* IE6-9 */
}

.content {
  overflow: auto;
  padding-bottom: 40px;
  width: 100%;
  
}

.footer {
  margin-top: -40px;
  height: 40px;
  background-color:#57577f;
  color:#fff;
  clear: both;
  border-radius: 6px 6px 0px 0px;
  text-align:center;
  position: relative;
  bottom:0px;
background: #c5deea; /* Old browsers */
background: -moz-linear-gradient(top, #c5deea 0%, #8abbd7 31%, #066dab 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#c5deea), color-stop(31%,#8abbd7), color-stop(100%,#066dab)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #c5deea 0%,#8abbd7 31%,#066dab 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #c5deea 0%,#8abbd7 31%,#066dab 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #c5deea 0%,#8abbd7 31%,#066dab 100%); /* IE10+ */
background: linear-gradient(top, #c5deea 0%,#8abbd7 31%,#066dab 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c5deea', endColorstr='#066dab',GradientType=0 ); /* IE6-9 */
}

/*Opera Fix*/
body:before {
        content:"";
        height:100%;
        float:left;
        width:0;
        margin-top:-32767px;/
}


</style>
<!--[if  IE 8]>
        <style type="text/css">
                #wrap {display:table;}
        </style>
<![endif]-->

<?php tm('head'); ?>

</head>

<body>
<div id="page" class="page">

<div class="header">
  <img src="<?php tm('site_logo'); ?>" align="right" width="130">
  <?php tm('site_name'); ?>
  <br/>
</div>
<div class="menubar"><?php tm('menu'); ?></div>
<div id="content" class="content">
<?php tm('content'); ?>
</div> <!-- content -->
</div> <!-- page -->
<div id="footer" class="footer">
<?php tm('footer'); ?><br/>
<!-- Não remova a atribuição! -->
<font size="1"><?php tm('power'); ?></font>
</div> <!-- footer -->
</body>
</html>