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
  background-color:#476799;
  color:#fff;
  padding:20px 0;
  margin:0;
  text-shadow: 1px -1px 10px white;
  font-size: 50px;
  font-color: white;
  font-style: bold;
background-image: linear-gradient(bottom, rgb(53,63,99) 23%, rgb(48,68,99) 62%, rgb(57,67,100) 81%);
background-image: -o-linear-gradient(bottom, rgb(53,63,99) 23%, rgb(48,68,99) 62%, rgb(57,67,100) 81%);
background-image: -moz-linear-gradient(bottom, rgb(53,63,99) 23%, rgb(48,68,99) 62%, rgb(57,67,100) 81%);
background-image: -webkit-linear-gradient(bottom, rgb(53,63,99) 23%, rgb(48,68,99) 62%, rgb(57,67,100) 81%);
background-image: -ms-linear-gradient(bottom, rgb(53,63,99) 23%, rgb(48,68,99) 62%, rgb(57,67,100) 81%);

background-image: -webkit-gradient(
        linear,
        left bottom,
        left top,
        color-stop(0.23, rgb(53,63,99)),
        color-stop(0.62, rgb(48,68,99)),
        color-stop(0.81, rgb(57,67,100))
);
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
  background-color:#57577f;
  font-color:#fff;
  border-radius: 0px 0px 6px 6px;
  text-align:center;
}

.row {
background: #f2f5f6; /* Old browsers */
background: -moz-linear-gradient(top, #f2f5f6 0%, #e3eaed 37%, #c8d7dc 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f2f5f6), color-stop(37%,#e3eaed), color-stop(100%,#c8d7dc)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #f2f5f6 0%,#e3eaed 37%,#c8d7dc 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #f2f5f6 0%,#e3eaed 37%,#c8d7dc 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #f2f5f6 0%,#e3eaed 37%,#c8d7dc 100%); /* IE10+ */
background: linear-gradient(top, #f2f5f6 0%,#e3eaed 37%,#c8d7dc 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f5f6', endColorstr='#c8d7dc',GradientType=0 ); /* IE6-9 */
border: 1px navy solid;
}

.titlebar {
  background-color:#47577f;
  font-color:#fff;
  border-radius: 6px 6px 6px 6px;
  margin:1px;
}

.infobox {
  border: 1px solid #0D1880;
  background-color: #B3CFF5;
  padding: 10px;
  font-size: 12px;
  color: #808080;
  text-align: justify;
}

.page {
  height: auto !important;
  min-height:100%;
  height:100%;
  position:relative;
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