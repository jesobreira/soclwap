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
background: #45484d; /* Old browsers */
background: -moz-linear-gradient(top, #45484d 0%, #000000 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#45484d), color-stop(100%,#000000)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #45484d 0%,#000000 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #45484d 0%,#000000 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #45484d 0%,#000000 100%); /* IE10+ */
background: linear-gradient(top, #45484d 0%,#000000 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#45484d', endColorstr='#000000',GradientType=0 ); /* IE6-9 */
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
  background: #aebcbf; /* Old browsers */
background: -moz-linear-gradient(top, #aebcbf 0%, #6e7774 50%, #0a0e0a 51%, #0a0809 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#aebcbf), color-stop(50%,#6e7774), color-stop(51%,#0a0e0a), color-stop(100%,#0a0809)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #aebcbf 0%,#6e7774 50%,#0a0e0a 51%,#0a0809 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #aebcbf 0%,#6e7774 50%,#0a0e0a 51%,#0a0809 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #aebcbf 0%,#6e7774 50%,#0a0e0a 51%,#0a0809 100%); /* IE10+ */
background: linear-gradient(top, #aebcbf 0%,#6e7774 50%,#0a0e0a 51%,#0a0809 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#aebcbf', endColorstr='#0a0809',GradientType=0 ); /* IE6-9 */

}

.row {
background: -moz-linear-gradient(top, rgba(0,0,0,0.65) 0%, rgba(0,0,0,0.86) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0.65)), color-stop(100%,rgba(0,0,0,0.86))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(0,0,0,0.65) 0%,rgba(0,0,0,0.86) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(0,0,0,0.65) 0%,rgba(0,0,0,0.86) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(0,0,0,0.65) 0%,rgba(0,0,0,0.86) 100%); /* IE10+ */
background: linear-gradient(top, rgba(0,0,0,0.65) 0%,rgba(0,0,0,0.86) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6000000', endColorstr='#db000000',GradientType=0 ); /* IE6-9 */
border: 1px #000 solid;
}

.titlebar {
background: rgb(181,189,200); /* Old browsers */
background: -moz-linear-gradient(top, rgba(181,189,200,1) 0%, rgba(130,140,149,1) 36%, rgba(40,52,59,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(181,189,200,1)), color-stop(36%,rgba(130,140,149,1)), color-stop(100%,rgba(40,52,59,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(181,189,200,1) 0%,rgba(130,140,149,1) 36%,rgba(40,52,59,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(181,189,200,1) 0%,rgba(130,140,149,1) 36%,rgba(40,52,59,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(181,189,200,1) 0%,rgba(130,140,149,1) 36%,rgba(40,52,59,1) 100%); /* IE10+ */
background: linear-gradient(top, rgba(181,189,200,1) 0%,rgba(130,140,149,1) 36%,rgba(40,52,59,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b5bdc8', endColorstr='#28343b',GradientType=0 ); /* IE6-9 */
  font-color:#fff;
  border-radius: 6px 6px 6px 6px;
  margin:1px;
}

.infobox {
  border: 1px solid #000;
  padding: 10px;
  font-size: 12px;
  color: #808080;
  text-align: justify;
background: rgb(76,76,76); /* Old browsers */
background: -moz-linear-gradient(top, rgba(76,76,76,1) 0%, rgba(89,89,89,1) 12%, rgba(102,102,102,1) 25%, rgba(71,71,71,1) 39%, rgba(44,44,44,1) 50%, rgba(0,0,0,1) 51%, rgba(17,17,17,1) 60%, rgba(43,43,43,1) 76%, rgba(28,28,28,1) 91%, rgba(19,19,19,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(76,76,76,1)), color-stop(12%,rgba(89,89,89,1)), color-stop(25%,rgba(102,102,102,1)), color-stop(39%,rgba(71,71,71,1)), color-stop(50%,rgba(44,44,44,1)), color-stop(51%,rgba(0,0,0,1)), color-stop(60%,rgba(17,17,17,1)), color-stop(76%,rgba(43,43,43,1)), color-stop(91%,rgba(28,28,28,1)), color-stop(100%,rgba(19,19,19,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(76,76,76,1) 0%,rgba(89,89,89,1) 12%,rgba(102,102,102,1) 25%,rgba(71,71,71,1) 39%,rgba(44,44,44,1) 50%,rgba(0,0,0,1) 51%,rgba(17,17,17,1) 60%,rgba(43,43,43,1) 76%,rgba(28,28,28,1) 91%,rgba(19,19,19,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(76,76,76,1) 0%,rgba(89,89,89,1) 12%,rgba(102,102,102,1) 25%,rgba(71,71,71,1) 39%,rgba(44,44,44,1) 50%,rgba(0,0,0,1) 51%,rgba(17,17,17,1) 60%,rgba(43,43,43,1) 76%,rgba(28,28,28,1) 91%,rgba(19,19,19,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(76,76,76,1) 0%,rgba(89,89,89,1) 12%,rgba(102,102,102,1) 25%,rgba(71,71,71,1) 39%,rgba(44,44,44,1) 50%,rgba(0,0,0,1) 51%,rgba(17,17,17,1) 60%,rgba(43,43,43,1) 76%,rgba(28,28,28,1) 91%,rgba(19,19,19,1) 100%); /* IE10+ */
background: linear-gradient(top, rgba(76,76,76,1) 0%,rgba(89,89,89,1) 12%,rgba(102,102,102,1) 25%,rgba(71,71,71,1) 39%,rgba(44,44,44,1) 50%,rgba(0,0,0,1) 51%,rgba(17,17,17,1) 60%,rgba(43,43,43,1) 76%,rgba(28,28,28,1) 91%,rgba(19,19,19,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4c4c4c', endColorstr='#131313',GradientType=0 ); /* IE6-9 */

}

.page {
  height: auto !important;
  min-height:100%;
  height:100%;
  position:relative;
background: rgb(125,126,125); /* Old browsers */
background: -moz-linear-gradient(top, rgba(125,126,125,1) 0%, rgba(73,73,73,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(125,126,125,1)), color-stop(100%,rgba(73,73,73,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(125,126,125,1) 0%,rgba(73,73,73,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(125,126,125,1) 0%,rgba(73,73,73,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(125,126,125,1) 0%,rgba(73,73,73,1) 100%); /* IE10+ */
background: linear-gradient(top, rgba(125,126,125,1) 0%,rgba(73,73,73,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7d7e7d', endColorstr='#494949',GradientType=0 ); /* IE6-9 */
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
background: rgb(66,66,66); /* Old browsers */
background: -moz-linear-gradient(top, rgba(66,66,66,1) 0%, rgba(10,10,10,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(66,66,66,1)), color-stop(100%,rgba(10,10,10,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(66,66,66,1) 0%,rgba(10,10,10,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(66,66,66,1) 0%,rgba(10,10,10,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(66,66,66,1) 0%,rgba(10,10,10,1) 100%); /* IE10+ */
background: linear-gradient(top, rgba(66,66,66,1) 0%,rgba(10,10,10,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#424242', endColorstr='#0a0a0a',GradientType=0 ); /* IE6-9 */
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