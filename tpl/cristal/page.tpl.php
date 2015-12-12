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
background: #b7deed; /* Old browsers */
background: -moz-linear-gradient(top, #b7deed 0%, #71ceef 50%, #21b4e2 51%, #b7deed 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#b7deed), color-stop(50%,#71ceef), color-stop(51%,#21b4e2), color-stop(100%,#b7deed)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #b7deed 0%,#71ceef 50%,#21b4e2 51%,#b7deed 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #b7deed 0%,#71ceef 50%,#21b4e2 51%,#b7deed 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #b7deed 0%,#71ceef 50%,#21b4e2 51%,#b7deed 100%); /* IE10+ */
background: linear-gradient(top, #b7deed 0%,#71ceef 50%,#21b4e2 51%,#b7deed 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b7deed', endColorstr='#b7deed',GradientType=0 ); /* IE6-9 */
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
background: #b8e1fc; /* Old browsers */
background: -moz-linear-gradient(top, #b8e1fc 0%, #a9d2f3 10%, #90bae4 25%, #90bcea 37%, #90bff0 50%, #6ba8e5 51%, #a2daf5 83%, #bdf3fd 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#b8e1fc), color-stop(10%,#a9d2f3), color-stop(25%,#90bae4), color-stop(37%,#90bcea), color-stop(50%,#90bff0), color-stop(51%,#6ba8e5), color-stop(83%,#a2daf5), color-stop(100%,#bdf3fd)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #b8e1fc 0%,#a9d2f3 10%,#90bae4 25%,#90bcea 37%,#90bff0 50%,#6ba8e5 51%,#a2daf5 83%,#bdf3fd 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #b8e1fc 0%,#a9d2f3 10%,#90bae4 25%,#90bcea 37%,#90bff0 50%,#6ba8e5 51%,#a2daf5 83%,#bdf3fd 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #b8e1fc 0%,#a9d2f3 10%,#90bae4 25%,#90bcea 37%,#90bff0 50%,#6ba8e5 51%,#a2daf5 83%,#bdf3fd 100%); /* IE10+ */
background: linear-gradient(top, #b8e1fc 0%,#a9d2f3 10%,#90bae4 25%,#90bcea 37%,#90bff0 50%,#6ba8e5 51%,#a2daf5 83%,#bdf3fd 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b8e1fc', endColorstr='#bdf3fd',GradientType=0 ); /* IE6-9 */
  border-radius: 2px;
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
background: #6db3f2; /* Old browsers */
background: -moz-linear-gradient(top, #6db3f2 0%, #54a3ee 50%, #3690f0 51%, #1e69de 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#6db3f2), color-stop(50%,#54a3ee), color-stop(51%,#3690f0), color-stop(100%,#1e69de)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #6db3f2 0%,#54a3ee 50%,#3690f0 51%,#1e69de 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #6db3f2 0%,#54a3ee 50%,#3690f0 51%,#1e69de 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #6db3f2 0%,#54a3ee 50%,#3690f0 51%,#1e69de 100%); /* IE10+ */
background: linear-gradient(top, #6db3f2 0%,#54a3ee 50%,#3690f0 51%,#1e69de 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#6db3f2', endColorstr='#1e69de',GradientType=0 ); /* IE6-9 */
}

.row {
background: #ebf1f6; /* Old browsers */
background: -moz-linear-gradient(top, #ebf1f6 0%, #abd3ee 50%, #89c3eb 51%, #d5ebfb 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ebf1f6), color-stop(50%,#abd3ee), color-stop(51%,#89c3eb), color-stop(100%,#d5ebfb)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #ebf1f6 0%,#abd3ee 50%,#89c3eb 51%,#d5ebfb 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #ebf1f6 0%,#abd3ee 50%,#89c3eb 51%,#d5ebfb 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #ebf1f6 0%,#abd3ee 50%,#89c3eb 51%,#d5ebfb 100%); /* IE10+ */
background: linear-gradient(top, #ebf1f6 0%,#abd3ee 50%,#89c3eb 51%,#d5ebfb 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ebf1f6', endColorstr='#d5ebfb',GradientType=0 ); /* IE6-9 */
border: 1px navy solid;
}

input {
  background: #3b679e; /* Old browsers */
background: -moz-linear-gradient(top, #3b679e 0%, #2b88d9 50%, #207cca 51%, #7db9e8 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#3b679e), color-stop(50%,#2b88d9), color-stop(51%,#207cca), color-stop(100%,#7db9e8)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #3b679e 0%,#2b88d9 50%,#207cca 51%,#7db9e8 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #3b679e 0%,#2b88d9 50%,#207cca 51%,#7db9e8 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #3b679e 0%,#2b88d9 50%,#207cca 51%,#7db9e8 100%); /* IE10+ */
background: linear-gradient(top, #3b679e 0%,#2b88d9 50%,#207cca 51%,#7db9e8 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3b679e', endColorstr='#7db9e8',GradientType=0 ); /* IE6-9 */
  border-radius: 3px;
  border: none;
  padding: 3px;
}

textarea {
  background: #3b679e; /* Old browsers */
background: -moz-linear-gradient(top, #3b679e 0%, #2b88d9 50%, #207cca 51%, #7db9e8 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#3b679e), color-stop(50%,#2b88d9), color-stop(51%,#207cca), color-stop(100%,#7db9e8)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #3b679e 0%,#2b88d9 50%,#207cca 51%,#7db9e8 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #3b679e 0%,#2b88d9 50%,#207cca 51%,#7db9e8 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #3b679e 0%,#2b88d9 50%,#207cca 51%,#7db9e8 100%); /* IE10+ */
background: linear-gradient(top, #3b679e 0%,#2b88d9 50%,#207cca 51%,#7db9e8 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3b679e', endColorstr='#7db9e8',GradientType=0 ); /* IE6-9 */
  border-radius: 3px;
  border: none;
  padding: 3px;
}

.titlebar {
  background-color:#47577f;
  font-color:#fff;
  border-radius: 6px 6px 6px 6px;
  margin:1px;
background: #e4f5fc; /* Old browsers */
background: -moz-linear-gradient(top, #e4f5fc 0%, #bfe8f9 50%, #9fd8ef 51%, #2ab0ed 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#e4f5fc), color-stop(50%,#bfe8f9), color-stop(51%,#9fd8ef), color-stop(100%,#2ab0ed)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #e4f5fc 0%,#bfe8f9 50%,#9fd8ef 51%,#2ab0ed 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #e4f5fc 0%,#bfe8f9 50%,#9fd8ef 51%,#2ab0ed 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #e4f5fc 0%,#bfe8f9 50%,#9fd8ef 51%,#2ab0ed 100%); /* IE10+ */
background: linear-gradient(top, #e4f5fc 0%,#bfe8f9 50%,#9fd8ef 51%,#2ab0ed 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e4f5fc', endColorstr='#2ab0ed',GradientType=0 ); /* IE6-9 */
}

.infobox {
  border: 1px solid #0D1880;
  padding: 10px;
  font-size: 12px;
  color: #808080;
  text-align: justify;
background: #e0f3fa; /* Old browsers */
background: -moz-linear-gradient(top, #e0f3fa 0%, #d8f0fc 50%, #b8e2f6 51%, #b6dffd 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#e0f3fa), color-stop(50%,#d8f0fc), color-stop(51%,#b8e2f6), color-stop(100%,#b6dffd)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #e0f3fa 0%,#d8f0fc 50%,#b8e2f6 51%,#b6dffd 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #e0f3fa 0%,#d8f0fc 50%,#b8e2f6 51%,#b6dffd 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #e0f3fa 0%,#d8f0fc 50%,#b8e2f6 51%,#b6dffd 100%); /* IE10+ */
background: linear-gradient(top, #e0f3fa 0%,#d8f0fc 50%,#b8e2f6 51%,#b6dffd 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e0f3fa', endColorstr='#b6dffd',GradientType=0 ); /* IE6-9 */
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
background: #cedbe9; /* Old browsers */
background: -moz-linear-gradient(top, #cedbe9 0%, #aac5de 17%, #6199c7 50%, #3a84c3 51%, #419ad6 59%, #4bb8f0 71%, #3a8bc2 84%, #26558b 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#cedbe9), color-stop(17%,#aac5de), color-stop(50%,#6199c7), color-stop(51%,#3a84c3), color-stop(59%,#419ad6), color-stop(71%,#4bb8f0), color-stop(84%,#3a8bc2), color-stop(100%,#26558b)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #cedbe9 0%,#aac5de 17%,#6199c7 50%,#3a84c3 51%,#419ad6 59%,#4bb8f0 71%,#3a8bc2 84%,#26558b 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #cedbe9 0%,#aac5de 17%,#6199c7 50%,#3a84c3 51%,#419ad6 59%,#4bb8f0 71%,#3a8bc2 84%,#26558b 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #cedbe9 0%,#aac5de 17%,#6199c7 50%,#3a84c3 51%,#419ad6 59%,#4bb8f0 71%,#3a8bc2 84%,#26558b 100%); /* IE10+ */
background: linear-gradient(top, #cedbe9 0%,#aac5de 17%,#6199c7 50%,#3a84c3 51%,#419ad6 59%,#4bb8f0 71%,#3a8bc2 84%,#26558b 100%); /* W3C */
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