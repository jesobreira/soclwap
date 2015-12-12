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
background: rgb(73,155,234); /* Old browsers */
background: -moz-linear-gradient(top, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(73,155,234,1)), color-stop(100%,rgba(32,124,229,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(73,155,234,1) 0%,rgba(32,124,229,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(73,155,234,1) 0%,rgba(32,124,229,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(73,155,234,1) 0%,rgba(32,124,229,1) 100%); /* IE10+ */
background: linear-gradient(top, rgba(73,155,234,1) 0%,rgba(32,124,229,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#499bea', endColorstr='#207ce5',GradientType=0 ); /* IE6-9 */
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
background: rgb(191,210,85); /* Old browsers */
background: -moz-linear-gradient(top, rgba(191,210,85,1) 0%, rgba(142,185,42,1) 50%, rgba(114,170,0,1) 51%, rgba(158,203,45,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(191,210,85,1)), color-stop(50%,rgba(142,185,42,1)), color-stop(51%,rgba(114,170,0,1)), color-stop(100%,rgba(158,203,45,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(191,210,85,1) 0%,rgba(142,185,42,1) 50%,rgba(114,170,0,1) 51%,rgba(158,203,45,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(191,210,85,1) 0%,rgba(142,185,42,1) 50%,rgba(114,170,0,1) 51%,rgba(158,203,45,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(191,210,85,1) 0%,rgba(142,185,42,1) 50%,rgba(114,170,0,1) 51%,rgba(158,203,45,1) 100%); /* IE10+ */
background: linear-gradient(top, rgba(191,210,85,1) 0%,rgba(142,185,42,1) 50%,rgba(114,170,0,1) 51%,rgba(158,203,45,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#bfd255', endColorstr='#9ecb2d',GradientType=0 ); /* IE6-9 */

}

.row {
background: rgb(212,228,239); /* Old browsers */
background: -moz-linear-gradient(top, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(212,228,239,1)), color-stop(100%,rgba(134,174,204,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(212,228,239,1) 0%,rgba(134,174,204,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(212,228,239,1) 0%,rgba(134,174,204,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(212,228,239,1) 0%,rgba(134,174,204,1) 100%); /* IE10+ */
background: linear-gradient(top, rgba(212,228,239,1) 0%,rgba(134,174,204,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d4e4ef', endColorstr='#86aecc',GradientType=0 ); /* IE6-9 */
border: 1px navy solid;
}

.titlebar {
background: rgb(207,231,250); /* Old browsers */
background: -moz-linear-gradient(top, rgba(207,231,250,1) 0%, rgba(99,147,193,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(207,231,250,1)), color-stop(100%,rgba(99,147,193,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(207,231,250,1) 0%,rgba(99,147,193,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(207,231,250,1) 0%,rgba(99,147,193,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(207,231,250,1) 0%,rgba(99,147,193,1) 100%); /* IE10+ */
background: linear-gradient(top, rgba(207,231,250,1) 0%,rgba(99,147,193,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cfe7fa', endColorstr='#6393c1',GradientType=0 ); /* IE6-9 */
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
background: rgb(242,246,248); /* Old browsers */
background: -moz-linear-gradient(top, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 50%, rgba(181,198,208,1) 51%, rgba(224,239,249,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(242,246,248,1)), color-stop(50%,rgba(216,225,231,1)), color-stop(51%,rgba(181,198,208,1)), color-stop(100%,rgba(224,239,249,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(242,246,248,1) 0%,rgba(216,225,231,1) 50%,rgba(181,198,208,1) 51%,rgba(224,239,249,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(242,246,248,1) 0%,rgba(216,225,231,1) 50%,rgba(181,198,208,1) 51%,rgba(224,239,249,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(242,246,248,1) 0%,rgba(216,225,231,1) 50%,rgba(181,198,208,1) 51%,rgba(224,239,249,1) 100%); /* IE10+ */
background: linear-gradient(top, rgba(242,246,248,1) 0%,rgba(216,225,231,1) 50%,rgba(181,198,208,1) 51%,rgba(224,239,249,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f6f8', endColorstr='#e0eff9',GradientType=0 ); /* IE6-9 */

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
  background-color:#57577f;
  color:#fff;
  clear: both;
  border-radius: 6px 6px 0px 0px;
  text-align:center;
  position: relative;
  bottom:0px;
background: rgb(206,219,233); /* Old browsers */
background: -moz-linear-gradient(top, rgba(206,219,233,1) 0%, rgba(170,197,222,1) 17%, rgba(97,153,199,1) 50%, rgba(58,132,195,1) 51%, rgba(65,154,214,1) 59%, rgba(75,184,240,1) 71%, rgba(58,139,194,1) 84%, rgba(38,85,139,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(206,219,233,1)), color-stop(17%,rgba(170,197,222,1)), color-stop(50%,rgba(97,153,199,1)), color-stop(51%,rgba(58,132,195,1)), color-stop(59%,rgba(65,154,214,1)), color-stop(71%,rgba(75,184,240,1)), color-stop(84%,rgba(58,139,194,1)), color-stop(100%,rgba(38,85,139,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(206,219,233,1) 0%,rgba(170,197,222,1) 17%,rgba(97,153,199,1) 50%,rgba(58,132,195,1) 51%,rgba(65,154,214,1) 59%,rgba(75,184,240,1) 71%,rgba(58,139,194,1) 84%,rgba(38,85,139,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(206,219,233,1) 0%,rgba(170,197,222,1) 17%,rgba(97,153,199,1) 50%,rgba(58,132,195,1) 51%,rgba(65,154,214,1) 59%,rgba(75,184,240,1) 71%,rgba(58,139,194,1) 84%,rgba(38,85,139,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(206,219,233,1) 0%,rgba(170,197,222,1) 17%,rgba(97,153,199,1) 50%,rgba(58,132,195,1) 51%,rgba(65,154,214,1) 59%,rgba(75,184,240,1) 71%,rgba(58,139,194,1) 84%,rgba(38,85,139,1) 100%); /* IE10+ */
background: linear-gradient(top, rgba(206,219,233,1) 0%,rgba(170,197,222,1) 17%,rgba(97,153,199,1) 50%,rgba(58,132,195,1) 51%,rgba(65,154,214,1) 59%,rgba(75,184,240,1) 71%,rgba(58,139,194,1) 84%,rgba(38,85,139,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cedbe9', endColorstr='#26558b',GradientType=0 ); /* IE6-9 */
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