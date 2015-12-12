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
  background-color:#3b5998;
  color:#fff;
  padding:20px 0;
  margin:0;
  text-transform: lowercase;
  font-weight: bold;
  font-size: 20px;
  color: white;
  font-style: bold;
}

a img {
  border:0;
}

a:link {
  color:#005;
  text-decoration:none;
}

a:visited {
  color:#115;
  text-decoration:none;
}

a:hover {
  color:#005;
  background-color:#57779f;
  text-decoration:none;
}

a:active {
  color:#005;
  background-color:#57779f;
  text-decoration:none;
}

.menubar {
  color:#fff;
  text-align:center;
  background: #1f4189; /* Old browsers */
}

.menubar a:link {
  color:#fff;
}

.row {
background: #d8dfea
color: #3b5998;
border: 1px #bcbec3 solid;
}

.titlebar {
border-top: #627aad 1px solid;
color: #333333;
background: #eceff5;
text-align: center;
margin-top: 1px;
}

.infobox {
  border: 1px solid #000;
  padding: 10px;
  font-size: 12px;
  color: #f5f6fa;
  text-align: justify;
  background: #627aad;
}

.page {
  height: auto !important;
  min-height:100%;
  height:100%;
  position:relative;
  background-color: #fff;
}

.content {
  overflow: auto;
  padding-bottom: 40px;
  width: 100%;
  
}

.footer {
  margin-top: -40px;
  height: 40px;
  border-top: 1px solid #cccccc;
  color:#000;
  clear: both;
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

input {
  border: 1px solid;
}

textarea {
  border: 1px solid;
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
  <img src="<?php tm('site_logo'); ?>" align="right" height="40">
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