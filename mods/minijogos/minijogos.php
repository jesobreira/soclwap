<?php
function index() {
  section(url("minijogos/velha", t("Jogo da velha")).'<br>'.
          url("minijogos/roletarussa", t("Roleta russa")).'<br>'.
          url("minijogos/reflexo", t("Teste de reflexo")).'<br>'.
          url("minijogos/crystal", t("Bola de cristal")).'<br>'.
          url("minijogos/restaum", t("Resta um")).'<br>'.
          url("minijogos/zodiaco", t("Zodíaco chinês"))."<br>".
          url("minijogos/hangman", t("Jogo da velha")).'<br>'.
          url("minijogos/leitor", t("Leitor de mentes")), t("Jogos"));
}

function zodiaco() {
  swhead('<script LANGUAGE="JavaScript">
<!--

/*
Submitted by David Gardner (davidgardner7@yahoo.com)
Featured on JavaScript Kit (http://javascriptkit.com)
For this and over 400+ free scripts, visit http://javascriptkit.com
*/

function getpet () {

        var toyear = 1997;
        var birthyear = document.frm.inyear.value;
        var birthpet="Ox"

        x = (toyear - birthyear) % 12
        if ((x == 1) || (x == -11)) {
            birthpet="Mouse"      }
            else  {
             if (x == 0)             {
             birthpet="Ox"           }
             else  {
              if ((x == 11) || (x == -1)) {
              birthpet="Tiger"          }
              else  {
               if ((x == 10) || (x == -2)) {
               birthpet="Rabbit"         }
               else  {
                if ((x == 9) || (x == -3))  {
                birthpet="Dragon"         }
                else  {
                 if ((x == 8) || (x == -4))  { 
                 birthpet="Snake"          }
                 else  {
                  if ((x == 7) || (x == -5))  { 
                  birthpet="Horse"          }
                  else  {
                   if ((x == 6) || (x == -6))  { 
                   birthpet="Sheep"          }
                   else  {
                    if ((x == 5) || (x == -7))  {  
                    birthpet="Monkey"         }
                    else  {
                     if ((x == 4) || (x == -8))  {
                     birthpet="Chicken"        }
                     else  {
                      if ((x == 3) || (x == -9))  {
                      birthpet="Dog"            }
                      else  {
                       if ((x == 2) || (x == -10))  {
                       birthpet="Pig"             }  
                      }
                     }
                    }
                   }
                  }
                 }
                }
               }
              }
             }
            }
        document.frm.birth.value = birthpet;

}
// -->
</script>
');
  freesection('<p>Enter your birth year. For example: "1975" </p>
    <form NAME="frm">
      <p><input TYPE="text" SIZE="4" NAME="inyear" value="1975"> <input TYPE="button" VALUE="My pet, please"
      onClick="getpet()"> <br>
      </p>
      <p><input TYPE="text" SIZE="9" NAME="birth"> </font></p>
    </form>');
}

function restaum() {
  global $home;
  swhead('<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin
var pos=new Array(49);
var jumps=new Array();
var boardType="Solitaire";
var numMoves=0;
var finished=false;
var selectnum=false;
var autosolve=false;
var running=false;
var basenum=0;
var destnum=0;
var destnum1=0;
var destnum2=0;
var destnum3=0;
var destnum4=0;
var delaynum=500;
if (document.images) {
blank = new Image(19,19);
blank.src = "'.$home.'/mods/minijogos/blank.gif";
empty = new Image(19,19);
empty.src = "'.$home.'/mods/minijogos/empty.gif";
emptysel = new Image(19,19);
emptysel.src = "'.$home.'/mods/minijogos/emptysel.gif";
peg = new Image(19,19);
peg.src = "'.$home.'/mods/minijogos/peg.gif";
pegact = new Image(19,19);
pegact.src = "'.$home.'/mods/minijogos/pegact.gif";
}
function display(pos,basenum,destnum) {
selectnum=false;
if (!basenum && !destnum) {
for (var i=0; i<pos.length; i++) {
if (pos[i]==-1) document.images["img"+i].src=blank.src;
else if (pos[i]==1) document.images["img"+i].src=peg.src;
else document.images["img"+i].src=empty.src;
 }
}
else {
document.images["img"+basenum].src=empty.src;
document.images["img"+(basenum+destnum/2)].src=empty.src;
document.images["img"+(basenum+destnum)].src=peg.src;
for (var i=0; i<pos.length; i++) {
if (document.images["img"+i].src==emptysel.src)
document.images["img"+i].src=empty.src;
 }
}
if (numMoves>1) win();
}
function move(num) {
var curNumMoves=numMoves; 
if (!document.images)
alert("Your browser does not support the \'document.images\' property.You\n" +
"should upgrade to at least Netscape 3.0 or Internet explorer 4.0.");
else if (autosolve && running) {}
else if (autosolve && !finished) {
if (confirm(\'VocÃª interrompeu a SoluÃ§Ã£o. Quer tentar jogar sozinho agora?\'))
newGame();
}
else if (selectnum) {
if (num!=basenum && num!=basenum+destnum1 && num!=basenum+destnum2 &&
num!=basenum+destnum3 && num!=basenum+destnum4)
alert("Escolha onde quer colocar a bolinha ou clique nela novamente para desselecionÃ¡-la!");
else if (num==basenum) {
document.images["img"+basenum].src=peg.src;
if (destnum1!=0)
document.images["img"+(basenum+destnum1)].src=empty.src;
if (destnum2!=0)
document.images["img"+(basenum+destnum2)].src=empty.src;
if (destnum3!=0)
document.images["img"+(basenum+destnum3)].src=empty.src;
if (destnum4!=0)
document.images["img"+(basenum+destnum4)].src=empty.src;
selectnum=false;
}
else if (num==basenum+destnum1) movePeg(basenum,destnum1)
else if (num==basenum+destnum2) movePeg(basenum,destnum2)
else if (num==basenum+destnum3) movePeg(basenum,destnum3)
else if (num==basenum+destnum4) movePeg(basenum,destnum4)
}
else if (pos[num]==0) {
}
else if ((num==3 || num==10) && pos[num+7]==1 && pos[num+14]==0) movePeg(num,14);
else if ((num==45 || num==38) && pos[num-7]==1 && pos[num-14]==0) movePeg(num,-14);
else if ((num==21 || num==22) && pos[num+1]==1 && pos[num+2]==0) movePeg(num,2);
else if ((num==26 || num==27) && pos[num-1]==1 && pos[num-2]==0) movePeg(num,-2);
else if (num==4 || num==11 || num==19 || num==20) {
if (pos[num-1]==1 && pos[num-2]==0 && pos[num+7]==1 && pos[num+14]==0)
selPeg(num,-2,14);
else if (pos[num-1]==1 && pos[num-2]==0) movePeg(num,-2);
else if (pos[num+7]==1 && pos[num+14]==0) movePeg(num,14);
}
else if (num==2 || num==9 || num==14 || num==15) {
if (pos[num+1]==1 && pos[num+2]==0 && pos[num+7]==1 && pos[num+14]==0)
selPeg(num,2,14);
else if (pos[num+1]==1 && pos[num+2]==0) movePeg(num,2);
else if (pos[num+7]==1 && pos[num+14]==0) movePeg(num,14);
} 
else if (num==28 || num==29 || num==37 || num==44) {
if (pos[num+1]==1 && pos[num+2]==0 && pos[num-7]==1 && pos[num-14]==0)
selPeg(num,2,-14);
else if (pos[num+1]==1 && pos[num+2]==0) movePeg(num,2);
else if (pos[num-7]==1 && pos[num-14]==0) movePeg(num,-14);
}
else if (num==33 || num==34 || num==39 || num==46) {
if (pos[num-1]==1 && pos[num-2]==0 && pos[num-7]==1 && pos[num-14]==0)
selPeg(num,-2,-14);
else if (pos[num-1]==1 && pos[num-2]==0) movePeg(num,-2);
else if (pos[num-7]==1 && pos[num-14]==0) movePeg(num,-14);
}
else if (num==16 || num==17 || num==18 || num==23 || num==24 || num==25 || num==30 || num==31 || num==32) {
var cond1=(pos[num-1]==1 && pos[num-2]==0);
var cond2=(pos[num-7]==1 && pos[num-14]==0);
var cond3=(pos[num+1]==1 && pos[num+2]==0);
var cond4=(pos[num+7]==1 && pos[num+14]==0);
if ((cond1 && (cond2 || cond3 || cond4)) ||
(cond2 && (cond1 || cond3 || cond4)) ||
(cond3 && (cond1 || cond2 || cond4)))
{
basenum=num;
destnum1=destnum2=destnum3=destnum4=0;
document.images["img"+basenum].src=pegact.src;
if (cond1) {
destnum1=-2;
document.images["img"+(basenum+destnum1)].src=emptysel.src;
}
if (cond2) {
destnum2=-14;
document.images["img"+(basenum+destnum2)].src=emptysel.src;
}
if (cond3) {
destnum3=2;
document.images["img"+(basenum+destnum3)].src=emptysel.src;
}
if (cond4) {
destnum4=14;
document.images["img"+(basenum+destnum4)].src=emptysel.src;
}
selectnum=true;
}
else if (cond1) movePeg(num,-2);
else if (cond2) movePeg(num,-14);
else if (cond3) movePeg(num,2);
else if (cond4) movePeg(num,14);
}
if (curNumMoves!=numMoves) display(pos,basenum,destnum);
else if (finished) win();
}
function selPeg(num,ofset1,ofset2) {
basenum=num;
destnum1=ofset1;
destnum2=ofset2;
destnum3=destnum4=0;
document.images["img"+basenum].src=pegact.src;
document.images["img"+(basenum+destnum1)].src=emptysel.src;
document.images["img"+(basenum+destnum2)].src=emptysel.src;
selectnum=true;
}
function movePeg(num,ofset) {
pos[num+ofset]=1;
pos[num+ofset/2]=pos[num]=0
basenum=num;
destnum=ofset;
numMoves++;
}
function win() {
var cnt=0;
for(var i=0; i<pos.length; i++) {
if (pos[i]!=-1) cnt+=pos[i];
}
if (cnt==1 && autosolve) {
if (confirm(\'Agora que vocÃª jÃ¡ viu, quer tentar de novo?\'))
newGame();
}
else if (cnt==1 && pos[24]==1) {
finished=true;
if (confirm(\'PARABÃ‰NS! MUITO BEM! Quer jogar de novo?\')) newGame();
}
else if (cnt==1) {
finished=true;
if (confirm(\'PARABÃ‰NS! MUITO BEM! Quer jogar de novo?\')) newGame();
}
else {
var legalMoves=false;
var num=0;
while (num<pos.length && !legalMoves) {
if (pos[num]==1 &&
(((num==2 || num==9 || num==14 || num==15 || num==16 || num==17 ||
num==18 || num==23 || num==24 || num==25 || num==30 || num==31 ||
num==32 || num==21 || num==22 || num==28 || num==29 || num==37 ||
num==44) && pos[num+1]==1 && pos[num+2]==0) ||
((num==4 || num==11 || num==19 || num==20 || num==16 || num==17 ||
num==18 || num==23 || num==24 || num==25 || num==30 || num==31 ||
num==32 || num==26 || num==27 || num==33 || num==34 || num==39 ||
num==46) && pos[num-1]==1 && pos[num-2]==0) ||
((num==2 || num==9 || num==14 || num==15 || num==16 || num==17 ||
num==18 || num==23 || num==24 || num==25 || num==30 || num==31 ||
num==32 || num==4 || num==11 || num==19 || num==20 || num==3 ||
num==10) && pos[num+7]==1 && pos[num+14]==0) ||
((num==33 || num==34 || num==39 || num==46 || num==16 || num==17 ||
num==18 || num==23 || num==24 || num==25 || num==30 || num==31 ||
num==32 || num==45 || num==38 || num==28 || num==29 || num==37 ||
num==44) && pos[num-7]==1 && pos[num-14]==0)))
legalMoves=true;
num++;
}
if (!legalMoves) {
finished=true;
if (confirm(\'Acabou! NÃ£o hÃ¡ mais peÃ§as para pular. Quer tentar de novo?\')) newGame();
      }
   }
}
function newGame() {
if (autosolve && running) {}
else if (document.images) {
autosolve=false;
finished=false;
if (boardType=="Cross") {
for (var i=0; i<pos.length; i++) pos[i]=0;
pos[0]=pos[1]=pos[5]=pos[6]=-1;
pos[7]=pos[8]=pos[12]=pos[13]=-1;
pos[10]=pos[16]=pos[17]=pos[18]=pos[24]=pos[31]=1;
pos[35]=pos[36]=pos[40]=pos[41]=-1;
pos[42]=pos[43]=pos[47]=pos[48]=-1;
}
else if (boardType=="Plus") {
for (var i=0; i<pos.length; i++) pos[i]=0;
pos[0]=pos[1]=pos[5]=pos[6]=-1;
pos[7]=pos[8]=pos[12]=pos[13]=-1;
pos[10]=pos[17]=pos[22]=pos[23]=pos[24]=1;
pos[25]=pos[26]=pos[31]=pos[38]=1;
pos[35]=pos[36]=pos[40]=pos[41]=-1;
pos[42]=pos[43]=pos[47]=pos[48]=-1;
}
else if (boardType=="Fireplace") {
for (var i=0; i<pos.length; i++) pos[i]=0;
pos[0]=pos[1]=pos[5]=pos[6]=-1;
pos[7]=pos[8]=pos[12]=pos[13]=-1;
pos[2]=pos[3]=pos[4]=pos[9]=pos[10]=1;
pos[11]=pos[16]=pos[17]=pos[18]=1;
pos[23]=pos[25]=1;
pos[35]=pos[36]=pos[40]=pos[41]=-1;
pos[42]=pos[43]=pos[47]=pos[48]=-1;
}
else if (boardType=="Up Arrow") {
for (var i=0; i<pos.length; i++) pos[i]=0;
pos[0]=pos[1]=pos[5]=pos[6]=-1;
pos[7]=pos[8]=pos[12]=pos[13]=-1;
pos[3]=pos[9]=pos[10]=pos[11]=pos[15]=1;
pos[16]=pos[17]=pos[18]=pos[19]=1;
pos[24]=pos[31]=pos[37]=pos[38]=1;
pos[39]=pos[44]=pos[45]=pos[46]=1;
pos[35]=pos[36]=pos[40]=pos[41]=-1;
pos[42]=pos[43]=pos[47]=pos[48]=-1;
}
else if (boardType=="Pyramid") {
for (var i=0; i<pos.length; i++) pos[i]=0;
pos[0]=pos[1]=pos[5]=pos[6]=-1;
pos[7]=pos[8]=pos[12]=pos[13]=-1;
pos[10]=pos[16]=pos[17]=pos[18]=pos[22]=1;
pos[23]=pos[24]=pos[25]=pos[26]=1;
pos[28]=pos[29]=pos[30]=pos[31]=1;
pos[32]=pos[33]=pos[34]=1;
pos[35]=pos[36]=pos[40]=pos[41]=-1;
pos[42]=pos[43]=pos[47]=pos[48]=-1;
}
else if (boardType=="Diamond") {
for (var i=0; i<pos.length; i++) pos[i]=1;
pos[0]=pos[1]=pos[5]=pos[6]=-1;
pos[7]=pos[8]=pos[12]=pos[13]=-1;
pos[2]=pos[4]=pos[14]=pos[20]=pos[24]=0;
pos[28]=pos[34]=pos[44]=pos[46]=0;
pos[35]=pos[36]=pos[40]=pos[41]=-1;
pos[42]=pos[43]=pos[47]=pos[48]=-1;
}
else if (boardType=="Solitaire") {
for (var i=0; i<pos.length; i++) pos[i]=1;
pos[0]=pos[1]=pos[5]=pos[6]=-1;
pos[7]=pos[8]=pos[12]=pos[13]=-1;
pos[24]=0;
pos[35]=pos[36]=pos[40]=pos[41]=-1;
pos[42]=pos[43]=pos[47]=pos[48]=-1;
}
numMoves=0;
running=true;
changeBoard();
running=false;
solveArray();
display(pos);
}
else
alert("Your browser does not support the \'document.images\' property.You\n" +
"should upgrade to at least Netscape 3.0 or Internet explorer 4.0.");
}
function initArray() {
this.length=initArray.arguments.length;
for (var i=0; i<this.length; i++) {
this[i] = initArray.arguments[i];
   }
}
function drawPreview(start,end) {
i=start;
j=end;
baseref=jumps[start];
offset=jumps[start+1];
pos[baseref]=pos[baseref+offset/2]=0;
pos[baseref+offset]=1;
document.images["img"+baseref].src=pegact.src;
document.images["img"+(baseref+offset)].src=emptysel.src;
solveRunning=setTimeout(\'drawJump(i,j)\',delaynum);
}
function drawJump(start,end) {
i=start; j=end;
baseref=jumps[start];
offset=jumps[start+1];
document.images["img"+baseref].src=empty.src;
document.images["img"+(baseref+offset/2)].src=empty.src;
document.images["img"+(baseref+offset)].src=peg.src;
if (start+2==end) {
document.buttonsform.solve.value="SoluÃ§Ã£o";
running=false;
finished=true;
setTimeout(\'win()\',delaynum);
}
else solveRunning=setTimeout(\'drawPreview(i+2,j)\',delaynum);
}
function solve() {
if (!document.images)
alert("Your browser does not support the \'document.images\' property.You\n" +
"should upgrade to at least Netscape 3.0 or Internet explorer 4.0.");
else if (autosolve && running) {
clearTimeout(solveRunning);
document.buttonsform.solve.value="SoluÃ§Ã£o";
running=false;
}
else {
document.buttonsform.solve.value=" Parar ";
newGame();
autosolve=true;
running=true;
solveRunning=setTimeout(\'drawPreview(0,jumps.length)\',delaynum);
   }
}
function changeBoard() {
formName=document.buttonsform;
if (!running) {
boardType=formName.options[formName.options.selectedIndex].value;
newGame();
}
else {
optlength=formName.options.length;
for (var m=0; m<optlength; m++) {
if (formName.options[m].value==boardType) {
formName.options.selectedIndex=m;
break;
         }
      }
   }
}
function solveArray() {
if (boardType=="Cross") {
jumps = new initArray(17,-2,31,-14,18,-2,15,2,10,14);
}
else if (boardType=="Plus") {
jumps = new initArray(23,-2,25,-2,10,14,24,-2,21,2,
38,-14,23,2,26,-2); 
}
else if (boardType=="Fireplace") {
jumps = new initArray(17,2,4,14,25,-14,2,2,4,14,
19,-2,10,14,24,-2,9,14,22,2);
}
else if (boardType=="Up Arrow") {
jumps = new initArray(46,-14,31,2,45,-14,44,-14,30,2,33,-2,
18,-14,4,-2,16,2,2,14,15,2,18,-2,31,
-14,16,2,19,-2,10,14);
}
else if (boardType=="Pyramid") {
jumps = new initArray(23,14,25,14,28,2,34,-2,37,-14,39,-14,
16,14,18,-2,31,-2,29,-14,15,2,17,14,
26,-2,31,-14,10,14);
}
else if (boardType=="Diamond") {
jumps = new initArray(30,14,44,2,32,2,34,-14,18,-14,4,-2,
16,-2,14,14,46,-14,20,-2,2,14,28,2,
38,-14,17,-2,15,14,29,2,31,2,33,-14,
19,-2,24,-2,10,14,25,-2,22,2);
}
else if (boardType=="Solitaire") {
jumps = new initArray(38,-14,33,-2,46,-14,25,14,44,2,46,-14,
11,14,20,-2,17,2,34,-14,20,-2,
15,2,2,14,23,-14,4,-2,2,14,
37,-14,28,2,31,-2,14,14,28,2,
17,-2,15,14,29,2,31,2,33,-14,19,-2,
24,-2,10,14,25,-2,22,2);
   }
}
// End -->
</SCRIPT> 
 ');
  freesection('
<table width="500"> </table> 
 
<!--  Demonstration  --> 
 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin
document.write(
"<center>\n"+
"<table width=\"100%\" height=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\n"+
"<tr><td valign=\"middle\" align=\"center\">\n"+
"<table width=\"400px\" bgcolor=\"#d7d7ff\" border=\"0\">\n"+
"<tr><td align=\"center\">\n"+
"<br>\n"+
"<p>\n"+
"<table border=\"1\" bgcolor=\"#ffffff\" cellpadding=\"15\" cellspacing=\"0\">\n"+
"<tr><td align=\"center\">");
if (navigator.appName != "Microsoft Internet Explorer") {
document.write(
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img0\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img1\">\n"+
"<a href=\"#\" onClick=\"window.move(2);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img2\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(3);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img3\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(4);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img4\"></A>\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img5\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img6\"><BR>\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img7\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img8\">\n"+
"<a href=\"#\" onClick=\"window.move(9);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img9\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(10);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img10\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(11);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img11\"></A>\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img12\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img13\"><BR>\n"+
"<a href=\"#\" onClick=\"window.move(14);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img14\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(15);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img15\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(16);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img16\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(17);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img17\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(18);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img18\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(19);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img19\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(20);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img20\"></A><BR>\n"+
"<a href=\"#\" onClick=\"window.move(21);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img21\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(22);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img22\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(23);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img23\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(24);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/empty.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img24\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(25);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img25\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(26);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img26\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(27);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img27\"></A><BR>\n"+
"<a href=\"#\" onClick=\"window.move(28);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img28\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(29);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img29\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(30);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img30\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(31);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img31\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(32);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img32\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(33);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img33\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(34);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img34\"></A><BR>\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img35\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img36\">\n"+
"<a href=\"#\" onClick=\"window.move(37);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img37\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(38);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img38\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(39);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img39\"></A>\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img40\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img41\"><BR>\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img42\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img43\">\n"+
"<a href=\"#\" onClick=\"window.move(44);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img44\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(45);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img45\"></A>\n"+
"<a href=\"#\" onClick=\"window.move(46);return false\" onMouseOver=\"window.status=\'\';\n"+
"return true\"><img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img46\"></A>\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img47\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img48\"><BR>")
}
else {
document.write(
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img0\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img1\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img2\" \n"+
"onClick=\"window.move(2);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img3\" \n"+
"onClick=\"window.move(3);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img4\" \n"+
"onClick=\"window.move(4);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img5\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img6\"><BR>\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img7\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img8\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img9\" \n"+
"onClick=\"window.move(9);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img10\" \n"+
"onClick=\"window.move(10);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img11\" \n"+
"onClick=\"window.move(11);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img12\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img13\"><BR>\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img14\" \n"+
"onClick=\"window.move(14);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img15\" \n"+
"onClick=\"window.move(15);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img16\" \n"+
"onClick=\"window.move(16);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img17\" \n"+
"onClick=\"window.move(17);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img18\" \n"+
"onClick=\"window.move(18);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img19\" \n"+
"onClick=\"window.move(19);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img20\" \n"+
"onClick=\"window.move(20);return false\"><BR>\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img21\" \n"+
"onClick=\"window.move(21);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img22\" \n"+
"onClick=\"window.move(22);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img23\" \n"+
"onClick=\"window.move(23);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/empty.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img24\" \n"+
"onClick=\"window.move(24);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img25\" \n"+
"onClick=\"window.move(25);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img26\" \n"+
"onClick=\"window.move(26);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img27\" \n"+
"onClick=\"window.move(27);return false\"><BR>\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img28\" \n"+
"onClick=\"window.move(28);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img29\" \n"+
"onClick=\"window.move(29);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img30\" \n"+
"onClick=\"window.move(30);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img31\" \n"+
"onClick=\"window.move(31);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img32\" \n"+
"onClick=\"window.move(32);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img33\" \n"+
"onClick=\"window.move(33);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img34\" \n"+
"onClick=\"window.move(34);return false\"><BR>\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img35\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img36\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img37\" \n"+
"onClick=\"window.move(37);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img38\" \n"+
"onClick=\"window.move(38);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img39\" \n"+
"onClick=\"window.move(39);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img40\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img41\"><BR>\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img42\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img43\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img44\" \n"+
"onClick=\"window.move(44);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img45\" \n"+
"onClick=\"window.move(45);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/peg.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img46\" \n"+
"onClick=\"window.move(46);return false\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img47\">\n"+
"<img src=\"'.$home.'/mods/minijogos/blank.gif\" border=\"0\" width=\"19\" height=\"19\" name=\"img48\"><BR>\n");
}
document.write(
"</td></tr>\n"+
"</table>\n"+
"<p>\n"+
"<form name=\"buttonsform\">\n"+
"<input type=\"button\" name=\"new\" value=\"Novo Jogo\" onClick=\"window.newGame()\">\n"+
"<input type=\"button\" name=\"solve\" value=\"SoluÃ§Ã£o\" onClick=\"window.solve()\">\n"+
"<select name=\"options\" onChange=\"(window.changeBoard())\">\n"+
"<option value=\"Cross\">Cruz\n"+
"<option value=\"Plus\">Mais\n"+
"<option value=\"Fireplace\">Banquinho\n"+
"<option value=\"Up Arrow\">Flecha\n"+
"<option value=\"Pyramid\">PirÃ¢mide\n"+
"<option value=\"Diamond\">Losango\n"+
"<option selected value=\"Solitaire\">Tradicional\n"+
"</select>\n"+
"</form>\n"+
"</td></tr>\n"+
"</table>\n"+
"<p>\n"+
"</center>");
newGame();
// End -->
</SCRIPT> 
 
<NOSCRIPT> 
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td valign="middle" align="center">
<table border="1" bgcolor="#FFFFBB" cellpadding="15" cellspacing="0">
<tr><td align=center>
<font face="Verdana, Arial, Helvetica" color="#000080" SIZE=-1><B>
<font SIZE=+2>Resta Um</font>
<p><BR>
VocÃª provavelmente desabilitou o JavaScript do seu navegador ou estÃ¡<br>usando um navegador incompatÃ­vel.<p>
Este jogo precisa de um navegador que rode JavaScript 1.1.
</td></tr></table></td></tr></table>
</NOSCRIPT> 
 
</center> 
<table width=100, height=15><tr><td></td></tr></table> 
 
<center> 
 
<
</table></center> ');
}

function hangman() {
  swhead('<SCRIPT language=JavaScript type=text/javascript>
<!--
gallows = new Array("--------\n|      |\n|\n|\n|\n|\n=====",
"--------\n|      O\n|\n|\n|\n|\n=====",
"--------\n|      O\n|      |\n|\n|\n|\n=====",
"--------\n|      O\n|     \\|\n|\n|\n|\n=====",
"--------\n|      O\n|     \\|/\n|\n|\n|\n=====",
"--------\n|      O\n|     \\|/\n|      |\n|\n|\n=====",
"--------\n|      O\n|     \\|/\n|      |\n|     /\n|\n=====",
"--------\n|      O\n|     \\|/\n|      |\n|     / \\\n|\n=====")
guessChoices = new
Array("JavaScript","Navigator","LiveConnect","LiveWire","Windows","Explorer","Microsoft","Idiot","Platform","Server","Browser","Function","Object","Array","Onmouse")
function startAgain() {
 guesses = 0
 max = gallows.length-1
 guessed = " "
 len = guessChoices.length - 1
 toGuess =
guessChoices[Math.round(len*Math.random())].toUpperCase()
 displayHangman()
 displayToGuess()
 displayGuessed()
}
function stayAway() {
 document.game.elements[3].focus()
 alert("Don\'t mess with this field element!")
}
function displayHangman() {
 document.game.status.value=gallows[guesses]
}
function displayToGuess() {
 pattern=""
 for(i=0;i<toGuess.length;++i) {
  if(guessed.indexOf(toGuess.charAt(i)) != -1) pattern +=
(toGuess.charAt(i)+" ")
  else pattern += "_ "
 }
 document.game.toGuess.value=pattern
}
function displayGuessed() {
 document.game.guessed.value=guessed
}
function badGuess(s) {
 if(toGuess.indexOf(s) == -1) return true
 return false
}
function winner() {
 for(i=0;i<toGuess.length;++i) {
  if(guessed.indexOf(toGuess.charAt(i)) == -1) return false
 }
 return true
}
function guess(s){
 if(guessed.indexOf(s) == -1) guessed = s + guessed
 if(badGuess(s)) ++guesses
 displayHangman()
 displayToGuess()
 displayGuessed()
 if(guesses >= max){
  alert("You\'re dead. The word you missed was "+ toGuess +".")
  startAgain()
 }
 if(winner()) {
  alert("You won!, Clever!!!")
  startAgain()
 }
}
// -->
</SCRIPT>');
  freesection('<CENTER>
<H1>The Game Of Hangman</H1>
  <P><B>Can You Get Any Of</B></P>
<P><B>The Fifteen Words</B></P></CENTER>
<HR>

<CENTER>
<FORM name=game><PRE><TEXTAREA cols=18 name=status onfocus=stayAway() rows=7></TEXTAREA>
</PRE>
<P><INPUT name=toGuess onfocus=stayAWAY()><B>Word to guess</B><BR></P>
<P>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT 
name=guessed onfocus=stayAway()><B> Letters guessed so far</B><BR></P>
<P><B>Enter your next guess.</B></P><INPUT onclick="guess(\'A\')" type=button value=" A "><INPUT onclick="guess(\'B\')" type=button value=" B "><INPUT onclick="guess(\'C\')" type=button value=" C "><INPUT onclick="guess(\'D\')" type=button value=" D "><INPUT onclick="guess(\'E\')" type=button value=" E "><INPUT onclick="guess(\'F\')" type=button value=" F "><INPUT onclick="guess(\'G\')" type=button value=" G "><INPUT onclick="guess(\'H\')" type=button value=" H "><INPUT onclick="guess(\'I\')" type=button value=" I "><INPUT onclick="guess(\'J\')" type=button value=" J "><INPUT onclick="guess(\'K\')" type=button value=" K "><INPUT onclick="guess(\'L\')" type=button value=" L "><INPUT onclick="guess(\'M\')" type=button value=" M "><INPUT onclick="guess(\'N\')" type=button value=" N "><INPUT onclick="guess(\'O\')" type=button value=" O "><INPUT onclick="guess(\'P\')" type=button value=" P "><INPUT onclick="guess(\'Q\')" type=button value=" Q "><INPUT onclick="guess(\'R\')" type=button value=" R "><INPUT onclick="guess(\'S\')" type=button value=" S "><INPUT onclick="guess(\'T\')" type=button value=" T "><INPUT onclick="guess(\'U\')" type=button value=" U "><INPUT onclick="guess(\'V\')" type=button value=" V "><INPUT onclick="guess(\'W\')" type=button value=" W "><INPUT onclick="guess(\'X\')" type=button value=" X "><INPUT onclick="guess(\'Y\')" type=button value=" Y "><INPUT onclick="guess(\'Z\')" type=button value=" Z "> 

<P><INPUT name=restart onclick=startAgain() type=button value="-- Start Again --"></P>
<SCRIPT type=text/javascript>
<!--
startAgain()
// -->
</SCRIPT>
</FORM>
<HR>
');
}

function leitor() {
  swhead('<SCRIPT LANGUAGE="JavaScript">
<!--
// "Copyright 1996-97 (C) Tatsuya Takemura. All rights reserved." 

function es() {
    alert("Please mind a number.")     
    x=0
    var today=new Date()
    sec=0
    for (i=1;i<=5;i++) {     
        sec=today.getSeconds()
        rand1 = 31
        while ( rand1 > 30 ) {
            rand1 = Math.random()*sec*100
            rand1 = Math.ceil(rand1)
        }
        rand2 = Math.random()
        if (rand2>0.5) { mes="add "; mes1=" to "; y=rand1 }
                  else{ mes="substract " ; mes1=" from "; y=-rand1}
    x1=x
    x=x+y
    if (x<0) { mes="add "; mes1=" to "; x=x1+rand1 }
    alert("Please "+mes+rand1+mes1+"it. ")     
       
    }
    alert("Please substruct a number that you mind first from it.")
    alert("Now you mind a number of "+x+" , don`t you ?")
}



 
//-->
</SCRIPT>');
  freesection('<H1 ALIGN="CENTER">ESP</H1>
<CENTER>
<P><P>Extrasensory Perception
<BR><BR><BR><BR>
My page have ESP.
<br>
My page is a mind reader.

<FORM NAME="f">
<INPUT TYPE="button" VALUE="CLICK HERE" onClick="es()">
</FORM>
</center>');
}

function velha() {
section('<script language="LiveScript">

        <!-- 

                step = 0;

                diff=3;

                // change board when button is clicked

        function clear_all(form) {

                        step = 0;

                        for (i=0;i<9; ++i) {

                                position="a"+i;

                                form[position].value="";

                        }

                }

                // change board when button is clicked

        function clickit(field) {

                if (step == -1) {alert("Reset e jogue novamente"); return;}

        position=field.name.substring(1,2,1);

        position = \'a\'+position;

                if (field.form[position].value !="") {alert("Não pode mover pra cá"); return;}

        field.form[position].value="X";

        if (eval_pos(field.form)) {

                        field.form.output.value="Você venceu!!"; 

                        step = -1;

                        return;

                }

        position=get_move(field.form);

        field.form.output.value=\'I moved to \' + position.substring(1,2,1);

                if (position=="") {

                        field.form.output.value="Não houve vencedor."; 

                        step = -1;

                        return;

                }

        field.form[position].value="O";

        if (eval_pos(field.form)) {

                        field.form.output.value="Você perdeu!";

                        step = -1;

                }

        }



                // see if there is a winner

        function eval_pos(form) {

                if ((form.a0.value!="" && 

                        form.a0.value==form.a3.value && form.a0.value==form.a6.value)||

                   (form.a0.value!="" 

                        && form.a0.value==form.a1.value && form.a0.value==form.a2.value) ||

                   (form.a0.value!="" 

                        && form.a0.value==form.a4.value && form.a0.value==form.a8.value) ||

                   (form.a1.value!="" 

                        && form.a1.value==form.a4.value && form.a1.value==form.a7.value) ||

                   (form.a2.value!="" 

                        && form.a2.value==form.a5.value && form.a2.value==form.a8.value) ||

                   (form.a2.value!="" 

                        && form.a2.value==form.a4.value && form.a2.value==form.a6.value) ||

                   (form.a3.value!="" 

                        && form.a3.value==form.a4.value && form.a3.value==form.a5.value) ||

                   (form.a6.value!="" 

                        && form.a6.value==form.a7.value && form.a6.value==form.a8.value))

                        return true;

                else    

           return false;

        }



                function f(a) {

                if (a == "") return "."; else return a;

                }



                // get position for move.

        function comp_move(form,player,weight,depth) {

            var cost;

                        var bestcost=-2;

                        var position;

                        var newplayer;

                        if (player=="X") newplayer="O"; else newplayer="X";

                        if (depth==diff) return 0;

                        if (eval_pos(form)) return 1;

                        for (var i=0; i<9; ++i) {

                                position=\'a\'+i;

                                if (form[position].value != "")

                                        continue;

                                form[position].value=player;

                                cost = comp_move(form,newplayer, -weight, depth+1);

                                if (cost > bestcost) {

                                        bestcost=cost;

                                        if (cost==1) i=9;

                                }

                                form[position].value="";

                        }

                        if (bestcost==-2) bestcost=0;

                        return(-bestcost);

                }



                // get position for move.

        function get_move(form) {

                        var cost;

                        var bestcost=-2;

                        bestmove="";

                        // don\'t think about first move.

                        if (step++ == 0)

                                if (form.a4.value=="") 

                                        return "a4";

                                else 

                                if (form.a0.value=="") 

                                        return "a0";



                        for (var i=0; i<9; ++i) {

                                localposition=\'a\'+i;

                                if (form[localposition].value != "")

                                        continue;

                                form[localposition].value="O";

                                cost=comp_move(form,"X", -1, 0);

                                if (cost > bestcost) {

                                        if (cost==1) i=9;

                                        bestmove=localposition;

                                        bestcost=cost;

                                }

                                form[localposition].value="";

                        }

                        return bestmove;

        }



                // complain if user attempts to change board

        function complain(field) {

                        field.form.output.focus(); // put focus eleswhere

                        alert("Clique no botão");

        }

        //a href="http://www.ucsd.edu/

        // the end -->

      </script>


<form>
  <div align="center"><center><p><input type="text" size="1" name="a0" onfocus="complain(this)"> <input type="button" name="b0" onclick="clickit(this)"> <input type="text" size="1" name="a1" onfocus="complain(this)"> <input type="button" name="b1" onclick="clickit(this)"> <input type="text" size="1" name="a2" onfocus="complain(this)"> <input type="button" name="b2" onclick="clickit(this)"> <br>
  <input type="text" size="1" name="a3" onfocus="complain(this)"> <input type="button" name="b3" onclick="clickit(this)"> <input type="text" size="1" name="a4" onfocus="complain(this)"> <input type="button" name="b4" onclick="clickit(this)"> <input type="text" size="1" name="a5" onfocus="complain(this)"> <input type="button" name="b5" onclick="clickit(this)"> <br>
  <input type="text" size="1" name="a6" onfocus="complain(this)"> <input type="button" name="b6" onclick="clickit(this)"> <input type="text" size="1" name="a7" onfocus="complain(this)"> <input type="button" name="b7" onclick="clickit(this)"> <input type="text" size="1" name="a8" onfocus="complain(this)"> <input type="button" name="b8" onclick="clickit(this)"> <br>
  <br>
  <br>
  <font size="3" face="Comic Sans MS, arial">Mensagem: <input type="text" size="20" name="output"><br>
  <br>
  Nível de Dificuldade: <select name="difficulty" size="1" onchange="diff=form.difficulty[form.difficulty.selectedIndex].value;">
    <option value="1"> Muito Fácil </option>
    <option value="2"> Fácil </option>
    <option selected value="3"> Médio </option>
    <option value="4"> Difícil </option>
  </select> </font></p>
  </center></div><div align="center"><center><p><font size="3" face="Comic Sans MS, arial"><input type="button" value="Computador Movendo Primeiro" onclick="

                if (!step++) this.form.a4.value=\'O\';"> </font></p>
  </center></div><div align="center"><center><p><font size="3" face="Comic Sans MS, arial"><input type="reset" value="Reiniciar" onclick="clear_all(this.form)"> </font></p>
  </center></div>
</form>

<p align="center">&nbsp;</p>', t("Jogo da velha"));
}

function roletarussa() {
  section('<div align="center"><table border="0" width="350" cellspacing="0" cellpadding="0">
<form name="fire">
Load number of bullets (1-6):<br><input name="bullets" type="text" size=3 value=1><br>

<p>
<input name="message" type="button" value="Play Roulette!" onClick="fireit()">
</p>

</form>

<script>

//Russian Roulette Game- by javascriptkit.com
//Visit JavaScript Kit (http://javascriptkit.com) for script
//Credit must stay intact for use

function fireit(){
var theone=Math.floor(Math.random()*6)

if (theone<=document.fire.bullets.value-1)
alert("Bang. You\'re dead!")
else{
document.fire.message.value="Whew. Got lucky!"
setTimeout("document.fire.message.value=\'Play Roulette\'",500)
}
}

</script></table></div>', t("Roleta russa"));
}

function reflexo() {
  section('<script language="JavaScript">
<!-- hiding for old browsers
        // response time test, created by Jasper van Zandbeek
        // e-mail: jasperz@net-v.com

var startTime=new Date();
var endTime=new Date();
var startPressed=false;
var bgChangeStarted=false;
var maxWait=20;
var timerID;

function startTest()
{
        document.bgColor=document.response.bgColorChange.options[document.response.bgColorChange.selectedIndex].text;
        bgChangeStarted=true;
        startTime=new Date();
}

function remark(responseTime)
{
        var responseString="";
        if (responseTime < 0.10)
                responseString="Well done!";
        if (responseTime >= 0.10 && responseTime < 0.20)
                responseString="Nice!";
        if (responseTime >=0.20 && responseTime < 0.30)
                responseString="Could be better...";
        if (responseTime >=0.30 && responseTime < 0.60)
                responseString="Keep practising!";
        if (responseTime >=0.60 && responseTime < 1)
                responseString="Have you been drinking?";
        if (responseTime >=1)
                responseString="Did you fall asleep?";

        return responseString;
}

function stopTest()
{
        if(bgChangeStarted)
        {
                endTime=new Date();
                var responseTime=(endTime.getTime()-startTime.getTime())/1000;

                document.bgColor="white";       
                alert("Your response time is: " + responseTime + " seconds " + "\n" + remark(responseTime));
                startPressed=false;
                bgChangeStarted=false;
        }
        else
        {
                if (!startPressed)
                {
                        alert("press start first to start test");
                }
                else
                {       
                        clearTimeout(timerID);
                        startPressed=false;             
                        alert("cheater! you pressed too early!");
                }               
        }
}

var randMULTIPLIER=0x015a4e35;
var randINCREMENT=1;
var today=new Date();
var randSeed=today.getSeconds();
function randNumber()
{
        randSeed = (randMULTIPLIER * randSeed + randINCREMENT) % (1 << 31);
        return((randSeed >> 15) & 0x7fff) / 32767;
}

function startit()
{
        if(startPressed)
        {
                alert("Already started. Press stop to stop");
                return;
        }
        else
        {
                startPressed=true; 
                timerID=setTimeout(\'startTest()\', 6000*randNumber());
        }
}
// --> 
</script>
<p>Test your Response time!</p>
Click on "Start" first, and wait until the background color changes. As soon as it changes, hit "stop!"


<form name="response">
Change background color in: 
<select name="bgColorChange">
<option selected>deeppink
<option>aliceblue
<option>crimson
<option>darkkhaki
<option>cadetblue
<option>darkorchid
<option>coral
<option>chocolate
<option>mediumslateblue
<option>tomato
<option>darkslategray
<option>limegreen
<option>cornflowerblue
<option>darkolivegreen
</select>
<input type="button" value="start" onClick="startit()">
<input type="button" value="stop" onClick="stopTest()">
</form>
', t("Reflexto"));
}

function crystal() {
  section('<table border="0" bgcolor="#000000" cellspacing="0" cellpadding="3">
  <tr>
    <td width="100%">
<p><font size="4" color="#FFFF00">Crystal Ball</font></p>
<font color="#CCCCFF">
<p>Please enter a yes/no question and it will respond</p>
<p>Warning: the crystal ball has a tendency to be sarcastic!</p>
<table width="40%" border="0">
<tr>
<td>
<form name="input1">
<input name="textfield" size=63>
</form>
</td>
</tr>
</table>
<table width="8%" border="0">
<tr>
<td>
<form>
<input type="button" name="button1" value="Ask Me!"
onClick="getAnswers()">
</form>
</td>
</tr>
</table>

<script language="JavaScript">

//Crystal Ball Script - By Michael McDermott (mcdemf1@wfu.edu)
//http://www.wfu.edu/~mcdemf1
//Visit JavaScript Kit (http://javascriptkit.com) for script


function getAnswers() {

time = new Date()
randominteger = time.getSeconds()

if (document.input1.textfield.value == "") { 
alert("You dummy! You didn\'t enter anything into the Crystal Ball!!!")
return
}

if (randominteger <= 3) answer="Did you really think so? Hahaha, I\'m laughing now at your pitiful chances."
if ((randominteger >= 4) && (randominteger <= 6)) answer ="Yeah, it it\'s got a 65% chance of happening."
if ((randominteger >= 7) && (randominteger <= 9)) answer ="Oh come on! No way!"
if ((randominteger >= 10) && (randominteger <= 12)) answer ="As sure as I\'m made of glass, this is likely to happen."
if ((randominteger >= 13) && (randominteger <= 15)) answer ="Why are you asking A CRYSTAL BALL? Do you really believe the answers?"
if ((randominteger >= 16) && (randominteger <= 18)) answer ="Give me a break, give me a break, break me off a piece of that NO!"
if ((randominteger >= 19) && (randominteger <= 21)) answer ="Good chances lie on the horizon."
if ((randominteger >= 22) && (randominteger <= 24)) answer ="Ask me again, I am restless and overworked."
if ((randominteger >= 25) && (randominteger <= 27)) answer ="Do you know how the Crystal Ball works? There\'s your answer."
if ((randominteger >= 28) && (randominteger <= 30)) answer ="As the sun is hot, your answer is YES."
if ((randominteger >= 31) && (randominteger <= 33)) answer ="Did you get drunk last weekend? There\'s your answer."
if ((randominteger >= 34) && (randominteger <= 36)) answer ="Forget about it"
if ((randominteger >= 37) && (randominteger <= 39)) answer ="Yeah, it could happen. 80% chance."
if ((randominteger >= 40) && (randominteger <= 42)) answer ="Hitler has a better chance of raising from the dead."
if ((randominteger >= 43) && (randominteger <= 45)) answer ="If you really think so, then it shall be."
if ((randominteger >= 46) && (randominteger <= 48)) answer ="Who said ambiguous answers were bad? Not me, so YES!"
if ((randominteger >= 49) && (randominteger <= 51)) answer ="You think I\'m going to answer that after a day of hard work? Ask again later."
if ((randominteger >= 52) && (randominteger <= 54)) answer ="If you own a pet, yes. Otherwise, no."
if ((randominteger >= 55) && (randominteger <= 57)) answer ="The sun will rise in the east and set in the west. Thank you Captain Obvious. YES!"
if ((randominteger >= 58) && (randominteger <= 60)) answer ="I\'m laughing hard, very hard. You\'d better ask again."

var newWindow = window.open("","Results","width=300,height=300")
newWindow.document.write("<html><body bgcolor=\'#000000\' text=\'#FFFFCC\' link=\'#00FFFF\' alink=\'#000066\' vlink=\'#6666FF\'>")
newWindow.document.write("<P align=\'center\'><font size=\'4\' color=\'#FFFF00\'>Your Question:</P><P></P><font size=\'3\' color=\'#FFFFCC\'>")
newWindow.document.write("<P align=\'center\'>" + document.input1.textfield.value + "</P>")
newWindow.document.write("<P></P><P></P><P></P><P align=\'center\'><font size=\'4\' color=\'#FFFF00\'>The Great Crystal Ball Has Answered:</P><P></P>")
newWindow.document.write("<font size=\'3\' color=\'#FFFFCC\'>")
newWindow.document.write("<P align=\'center\'>" + answer + "</P>")
newWindow.document.write("<P></P><P></P><P align=\'center\'><A HREF=\'javascript:window.close()\'>Close Me</A></P>")
}
</script>
</font>
</td>
  </tr>
</table>', t("Crystal"));
}