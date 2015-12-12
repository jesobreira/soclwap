<?php
header("Content-type: text/html; charset=UTF-8");
if(!isset($_GET['step'])) {
  die('<script> location.href="?step=1"; </script>');
}
$step = $_GET['step'];
if(!is_numeric($step)) {
  die('<script> location.href="?step=1"; </script>');
}

function mysql_all_query($qry) {
  $qry = explode(";", $qry);
  $i = 0;
  $j = count($qry);
  while($i<=$j) {
    mysql_query($qry[$i]);
    $i++;
  }
}

?>
<html>
<title>Instalação SoclWAP</title>
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js'></script>
<script>
$(document).ready(function(){
                $('input').focus(function() {
                        $(this)
                                .parent().addClass('highlight')
                });
                
                $('input').blur(function(){
                        $(this)
                                .parent().removeClass('highlight')
                });
        
        });


</script>
<style type="text/css">
  body {
    background: #1e5799; /* Old browsers */
    background: -moz-linear-gradient(top, #1e5799 0%, #2989d8 88%, #bdbdbd 89%, #21395b 89%, #173c6d 91%, #003475 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1e5799), color-stop(88%,#2989d8), color-stop(89%,#bdbdbd), color-stop(89%,#21395b), color-stop(91%,#173c6d), color-stop(100%,#003475)); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, #1e5799 0%,#2989d8 88%,#bdbdbd 89%,#21395b 89%,#173c6d 91%,#003475 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, #1e5799 0%,#2989d8 88%,#bdbdbd 89%,#21395b 89%,#173c6d 91%,#003475 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top, #1e5799 0%,#2989d8 88%,#bdbdbd 89%,#21395b 89%,#173c6d 91%,#003475 100%); /* IE10+ */
    background: linear-gradient(top, #1e5799 0%,#2989d8 88%,#bdbdbd 89%,#21395b 89%,#173c6d 91%,#003475 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#003475',GradientType=0 ); /* IE6-9 */
    font-family: Segoe UI,Tahoma,Arial,Helvetica,sans-serif;
    font-size: 12px;
  }
  #page {
    width: 790px;
    min-height: 600px;
    margin-left: auto;
    margin-right: auto;
    border-radius: 5px 5px 5px 5px;
    /*background-color: #fff;*/
    border: 1px solid;
    left: 50%;
    top: 50%;
    background: #adccff; /* Old browsers */
    background: -moz-linear-gradient(top, #adccff 0%, #f2f7ff 19%, #eeeeee 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#adccff), color-stop(19%,#f2f7ff), color-stop(100%,#eeeeee)); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, #adccff 0%,#f2f7ff 19%,#eeeeee 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, #adccff 0%,#f2f7ff 19%,#eeeeee 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top, #adccff 0%,#f2f7ff 19%,#eeeeee 100%); /* IE10+ */
    background: linear-gradient(top, #adccff 0%,#f2f7ff 19%,#eeeeee 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#adccff', endColorstr='#eeeeee',GradientType=0 ); /* IE6-9 */
  }
  .infobox {
    border: 1px solid #0D1880;
    background-color: #B3CFF5;
    padding: 10px;
    font-size: 12px;
    color: #808080;
    text-align: justify;
  }
  fieldset {
    border: 1px solid;
  }
  .input {
    padding:6px;
    width:315px;
    border: 1px solid #fff;
  }
  input {
    border:4px solid #666;
    padding:4px;
    width:300px;
  }
  .highlight {
    background-color:#FF6;
    border: 1px solid #FC6;
  }
</style>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<script type="text/javascript">
function next() {
  location.href='?step=<?php echo $step+1; ?>';
}
</script>
</head>
<body>
<div id="page" class="page">
<table width="100%" height="100%">
<tr>
<td height="20%" align="center">
<img src="img/logo.png" width="20%"></div>
</td>
</tr>
<td>
<table width="100%" height="100%">
<tr>
<td width="20%" valign="top">
<!-- steps -->
<?php
$steps = '<p id="s1">Bem-vindo</p><!-- s1 -->
<p id="s2">Licença</p><!-- s2 -->
<p id="s3">Requisitos</p><!-- s3 -->
<p id="s4">Configurar</p><!-- s4 -->
<p id="s5">Finalizar</p><!-- s5 -->';
$steps = str_replace('<p id="s'.$step.'">', '<p id="s'.$step.'"><b>', $steps);
$steps = str_replace('</p><!-- s'.$step.' -->', '</b></p><!-- s'.$step.' -->', $steps);

$i = 1;
while($i < $step) {
  $steps = str_replace('<p id="s'.$i.'">', '<p id="s'.$i.'"><font color="green">', $steps);
  $steps = str_replace('</p><!-- s'.$i.' -->', '</font></p><!-- s'.$i.' -->', $steps);
  $i++;
}

echo $steps;
?>
</td>
<td width="80%" valign="top">
<!-- main -->
<?php
/*-----------------------*/
if($step==1) {
  echo '<p>Olá. Bem-vindo ao programa de instalação do SoclWAP.</p>
<p>Você verá que instalar o SoclWAP em seu servidor é tão fácil como contar até 5.</p>
<p>Caso precise de ajuda, visite o <a href="http://soclwap.sourceforge.net/" target="_blank">website do SoclWAP</a>.</p>
<p>Este assistente lhe ajudará a configurar sua cópia do SoclWAP.</p>
<p>Vamos começar?</p>
<p align="center"><input type="button" value="Próximo" onClick="next()"></p>';
}
if($step==2) {
  echo '<textarea style="outline: 0 none;resize:none;overflow:auto;" readonly="readonly" rows="25" cols="70">A INSTITUIÇÃO CREATIVE COMMONS NÃO É UM ESCRITÓRIO DE ADVOCACIA E NÃO PRESTA SERVIÇOS JURÍDICOS. A DISTRIBUIÇÃO DESTA LICENÇA NÃO ESTABELECE QUALQUER RELAÇÃO ADVOCATÍCIA. O CREATIVE COMMONS DISPONIBILIZA ESTAS INFORMAÇÕES "NO ESTADO EM QUE SE ENCONTRAM". O CREATIVE COMMONS NÃO FAZ QUALQUER GARANTIA QUANTO ÀS INFORMAÇÕES DISPONIBILIZADAS E SE EXONERA DE QUALQUER RESPONSABILIDADE POR DANOS RESULTANTES DO SEU USO.
Licença

A OBRA (CONFORME DEFINIDA ABAIXO) É DISPONIBILIZADA DE ACORDO COM OS TERMOS DESTA LICENÇA PÚBLICA CREATIVE COMMONS ("CCPL" OU "LICENÇA"). A OBRA É PROTEGIDA POR DIREITO AUTORAL E/OU OUTRAS LEIS APLICÁVEIS. QUALQUER USO DA OBRA QUE NÃO O AUTORIZADO SOB ESTA LICENÇA OU PELA LEGISLAÇÃO AUTORAL É PROIBIDO.

AO EXERCER QUAISQUER DOS DIREITOS À OBRA AQUI CONCEDIDOS, VOCÊ ACEITA E CONCORDA FICAR OBRIGADO NOS TERMOS DESTA LICENÇA. O LICENCIANTE CONCEDE A VOCÊ OS DIREITOS AQUI CONTIDOS EM CONTRAPARTIDA A SUA ACEITAÇÃO DESTES TERMOS E CONDIÇÕES.

1. Definições

"Obra Derivada" significa uma Obra baseada na Obra ou na Obra e outras Obras pré-existentes, tal qual uma tradução, adaptação, arranjo musical ou outras alterações de uma Obra literária, artística ou científica, ou fonograma ou performance, incluindo adaptações cinematográficas ou qualquer outra forma na qual a Obra possa ser refeita, transformada ou adaptada, abrangendo qualquer forma reconhecível como derivada da original, com exceção da Obra que constitua uma Obra Coletiva, a qual não será considerada uma Obra Derivada para os propósitos desta Licença. Para evitar dúvidas, quando a Obra for uma Obra musical, performance ou fonograma, a sincronização da Obra em relação cronometrada com uma imagem em movimento (“synching”) será considerada uma Obra Derivada para os propósitos desta Licença.
"Obra Coletiva" significa uma coleção de Obras literárias, artísticas ou científicas, tais quais enciclopédias e antologias, ou performances, fonogramas ou transmissões, ou outras Obras ou materiais não indicados na Seção 1(g) abaixo, que em razão da seleção e arranjo do seu conteúdo, constituam criações intelectuais nas quais a Obra é incluída na sua integridade em forma não-modificada, juntamente com uma ou mais contribuições, cada qual constituindo separada e independentemente uma Obra em si própria, que juntas são reunidas em um todo coletivo. A Obra que constituir uma Obra Coletiva não será considerada uma Obra Derivada (como definido acima) para os propósitos desta Licença.
"Distribuir" significa colocar à disposição do público o original e cópias da Obra ou Obra Derivada, o que for apropriado, por meio de venda ou qualquer outra forma de transferência de propriedade ou posse.
"Licenciante" significa a pessoa física ou jurídica que oferece a Obra sob os termos desta Licença.
"Autor Original" significa, no caso de uma Obra literária, artística ou científica, o indivíduo ou indivíduos que criaram a Obra ou, se nenhum indivíduo puder ser identificado, a editora.
"Titular de Direitos Conexos" significa (i) no caso de uma performance os atores, cantores, músicos, dançarinos, e outras pessoas que atuem, cantem, recitem, declamem, participem em, interpretem ou façam performances de Obras literárias ou artísticas ou expressões de folclore (ii) no caso de um fonograma, o produtor, sendo este a pessoa ou entidade legal que primeiramente fixar os sons de uma performance ou outros sons; e (iii) no caso de radiodifusão, a empresa de radiodifusão.
"Obra" significa a Obra literária, artística e/ou científica oferecida sob os termos desta Licença, incluindo, sem limitação, qualquer produção nos domínios literário, artístico e científico, qualquer que seja o modo ou a forma de sua expressão, incluindo a forma digital, tal qual um livro, brochuras e outros escritos; uma conferência, alocução, sermão e outras Obras da mesma natureza; uma Obra dramática ou dramático-musical; uma Obra coreográfica ou pantomima; uma composição musical com ou sem palavras; uma Obra cinematográfica e as expressas por um processo análogo ao da cinematografia; uma Obra de desenho, pintura, arquitetura, escultura, gravura ou litografia; uma Obra fotográfica e as Obras expressas por um processo análogo ao da fotografia; uma Obra de arte aplicada; uma ilustração, mapa, plano, esboço ou Obra tridimensional relativa a geografia, topografia, arquitetura ou ciência; uma performance, transmissão ou fonograma, na medida em que tais Obras/direitos sejam reconhecidos e protegidos pela legislação aplicável; uma compilação de dados, na extensão em que ela seja protegida como uma Obra sujeita ao regime dos direitos autorais; ou uma Obra executada por artistas circenses ou de shows de variedade, conforme ela não for considerada uma Obra literária, artística ou científica.
"Você" significa a pessoa física ou jurídica exercendo direitos sob esta Licença, que não tenha previamente violado os termos desta Licença com relação à Obra, ou que tenha recebido permissão expressa do Licenciante para exercer direitos sob esta Licença apesar de uma violação prévia.
"Executar Publicamente" significa fazer a utilização pública da Obra e comunicar ao público a Obra, por qualquer meio ou processo, inclusive por meios com ou sem fio ou performances públicas digitais; disponibilizar ao público Obras de tal forma que membros do público possam acessar essas Obras de um local e em um local escolhido individualmente por eles; Executar a Obra para o público por qualquer meio ou processo e comunicar ao público performances da Obra, inclusive por performance pública digital; transmitir e retransmitir a Obra por quaisquer meios, inclusive sinais, sons ou imagens.
"Reproduzir" significa fazer cópias da Obra por qualquer meio, inclusive, sem qualquer limitação, por gravação sonora ou visual, e o direito de fixar e Reproduzir fixações da Obra, inclusive o armazenamento de uma performance protegida ou fonograma, em forma digital ou qualquer outro meio eletrônico.
2. Limitações e exceções ao direito autoral e outros usos livres. Nada nesta licença deve ser interpretado de modo a reduzir, limitar ou restringir qualquer uso permitido de direitos autorais ou direitos decorrentes de limitações e exceções estabelecidas em conexão com a proteção autoral, sob a legislação autoral ou outras leis aplicáveis.

3. Concessão da licença. O Licenciante concede a Você uma licença de abrangência mundial, sem royalties, não-exclusiva, perpétua (pela duração do direito autoral aplicável), sujeita aos termos e condições desta Licença, para exercer os direitos sobre a Obra definidos abaixo:

Reproduzir a Obra, incorporar a Obra em uma ou mais Obras Coletivas e Reproduzir a Obra quando incorporada em Obras Coletivas;
Criar e Reproduzir Obras Derivadas, desde que qualquer Obra Derivada, inclusive qualquer tradução, em qualquer meio, adote razoáveis medidas para claramente indicar, demarcar ou de qualquer maneira identificar que mudanças foram feitas à Obra original. Uma tradução, por exemplo, poderia assinalar que “A Obra original foi traduzida do Inglês para o Português,” ou uma modificação poderia indicar que “A Obra original foi modificada”;
Distribuir e Executar Publicamente a Obra, incluindo as Obras incorporadas em Obras Coletivas; e,
Distribuir e Executar Publicamente Obras Derivadas.
O Licenciante renuncia ao direito de recolher royalties, seja individualmente ou, na hipótese de o Licenciante ser membro de uma sociedade de gestão coletiva de direitos (por exemplo, ECAD, ASCAP, BMI, SESAC), via essa sociedade, por qualquer exercício Seu sobre os direitos concedidos sob esta Licença.
Os direitos acima podem ser exercidos em todas as mídias e formatos, independente de serem conhecidos agora ou concebidos posteriormente. Os direitos acima incluem o direito de fazer as modificações que forem tecnicamente necessárias para exercer os direitos em outras mídias, meios e formatos. Todos os direitos não concedidos expressamente pelo Licenciante ficam ora reservados.

4. Restrições. A licença concedida na Seção 3 acima está expressamente sujeita e limitada pelas seguintes restrições:

Você pode Distribuir ou Executar Publicamente a Obra apenas sob os termos desta Licença, e Você deve incluir uma cópia desta Licença ou o Identificador Uniformizado de Recursos (Uniform Resource Identifier) para esta Licença em cada cópia da Obra que você Distribuir ou Executar Publicamente. Você não poderá oferecer ou impor quaisquer termos sobre a Obra que restrinjam os termos desta Licença ou a habilidade do destinatário exercer os direitos a ele aqui concedidos sob os termos desta Licença. Você não pode sublicenciar a Obra. Você deverá manter intactas todas as informações que se referem a esta Licença e à exclusão de garantias em toda cópia da Obra que Você Distribuir ou Executar Publicamente. Quando Você Distribuir ou Executar Publicamente a Obra, Você não poderá impor qualquer medida tecnológica eficaz à Obra que restrinja a possibilidade do destinatário exercer os direitos concedidos a ele sob os termos desta Licença. Esta Seção 4(a) se aplica à Obra enquanto quando incorporada em uma Obra Coletiva, mas isto não requer que a Obra Coletiva, à parte da Obra em si, esteja sujeita aos termos desta Licença. Se Você criar uma Obra Coletiva, em havendo notificação de qualquer Licenciante, Você deve, na medida do razoável, remover da Obra Coletiva qualquer crédito, conforme estipulado na Seção 4(b), quando solicitado. Se Você criar uma Obra Derivada, em havendo aviso de qualquer Licenciante, Você deve, na medida do possível, retirar da Obra Derivada qualquer crédito conforme estipulado na Seção 4(b), de acordo com o solicitado.
Se Você Distribuir ou Executar Publicamente a Obra ou qualquer Obra Derivada ou Obra Coletiva, Você deve, a menos que um pedido relacionado à Seção 4(a) tenha sido feito, manter intactas todas as informações relativas a direitos autorais sobre a Obra e exibir, de forma razoável em relação ao meio ou mídia por Você utilizado: (i) o nome do Autor Original (ou seu pseudônimo, se for o caso), se fornecido, do Titular de Direitos Conexos, se fornecido e quando aplicável, e/ou, ainda, se o Autor Original/Titular de Direitos Conexos e/ou o Licenciante designar outra parte ou partes (p. ex.: um instituto patrocinador, editora, periódico) para atribuição (“Partes de Atribuição”) nas informações relativas aos direitos autorais do Licenciante, termos de serviço ou por outros meios razoáveis, o nome dessa parte ou partes; (ii) o título da Obra, se fornecido; (iii) na medida do razoável, o Identificador Uniformizado de Recursos (URI) que o Licenciante especificar para estar associado à Obra, se houver, exceto se o URI não se referir ao aviso de direitos autorais ou à informação sobre o regime de licenciamento da Obra; e, (iv) em conformidade com a Seção 3(b), no caso de Obra Derivada, crédito identificando o uso da Obra na Obra Derivada (p. ex.: "Tradução Francesa da Obra do Autor Original/Titular de Direitos Conexos", ou "Roteiro baseado na Obra original do Autor Original/Titular de Direitos Conexos"). O crédito exigido por esta Seção 4(b), pode ser implementado de qualquer forma razoável; desde que, entretanto, no caso de uma Obra Derivada ou Obra Coletiva, na indicação de crédito feita aos autores participantes da Obra Derivada ou Obra Coletiva, o crédito apareça como parte dessa indicação, e de modo ao menos tão proeminente quanto os créditos para os outros autores participantes. De modo a evitar dúvidas, Você apenas poderá fazer uso do crédito exigido por esta Seção para o propósito de atribuição na forma estabelecida acima e, ao exercer Seus direitos sob esta Licença, Você não poderá implícita ou explicitamente afirmar ou sugerir qualquer vínculo, patrocínio ou apoio do Autor Original, Titular de Direitos Conexos, Licenciante e/ou Partes de Atribuição, o que for cabível, por Você ou Seu uso da Obra, sem a prévia e expressa autorização do Autor Original, Titular de Direitos Conexos, Licenciante e/ou Partes de Atribuição.
Na extensão em que reconhecidos e considerados indisponíveis pela legislação aplicável, direitos morais não são afetados por esta Licença.
5. Declarações, garantias e exoneração

EXCETO QUANDO FOR DE OUTRA FORMA MUTUAMENTE ACORDADO PELAS PARTES POR ESCRITO, O LICENCIANTE OFERECE A OBRA “NO ESTADO EM QUE SE ENCONTRA” (AS IS) E NÃO PRESTA QUAISQUER GARANTIAS OU DECLARAÇÕES DE QUALQUER ESPÉCIE RELATIVAS À OBRA, SEJAM ELAS EXPRESSAS OU IMPLÍCITAS, DECORRENTES DA LEI OU QUAISQUER OUTRAS, INCLUINDO, SEM LIMITAÇÃO, QUAISQUER GARANTIAS SOBRE A TITULARIDADE DA OBRA, ADEQUAÇÃO PARA QUAISQUER PROPÓSITOS, NÃO-VIOLAÇÃO DE DIREITOS, OU INEXISTÊNCIA DE QUAISQUER DEFEITOS LATENTES, ACURACIDADE, PRESENÇA OU AUSÊNCIA DE ERROS, SEJAM ELES APARENTES OU OCULTOS. EM JURISDIÇÕES QUE NÃO ACEITEM A EXCLUSÃO DE GARANTIAS IMPLÍCITAS, ESTAS EXCLUSÕES PODEM NÃO SE APLICAR A VOCÊ.

6. Limitação de responsabilidade. EXCETO NA EXTENSÃO EXIGIDA PELA LEI APLICÁVEL, EM NENHUMA CIRCUNSTÂNCIA O LICENCIANTE SERÁ RESPONSÁVEL PARA COM VOCÊ POR QUAISQUER DANOS, ESPECIAIS, INCIDENTAIS, CONSEQÜENCIAIS, PUNITIVOS OU EXEMPLARES, ORIUNDOS DESTA LICENÇA OU DO USO DA OBRA, MESMO QUE O LICENCIANTE TENHA SIDO AVISADO SOBRE A POSSIBILIDADE DE TAIS DANOS.

7. Terminação

Esta Licença e os direitos aqui concedidos terminarão automaticamente no caso de qualquer violação dos termos desta Licença por Você. Pessoas físicas ou jurídicas que tenham recebido Obras Derivadas ou Obras Coletivas de Você sob esta Licença, entretanto, não terão suas licenças terminadas desde que tais pessoas físicas ou jurídicas permaneçam em total cumprimento com essas licenças. As Seções 1, 2, 5, 6, 7 e 8 subsistirão a qualquer terminação desta Licença.
Sujeito aos termos e condições dispostos acima, a licença aqui concedida é perpétua (pela duração do direito autoral aplicável à Obra). Não obstante o disposto acima, o Licenciante reserva-se o direito de difundir a Obra sob termos diferentes de licença ou de cessar a distribuição da Obra a qualquer momento; desde que, no entanto, quaisquer destas ações não sirvam como meio de retratação desta Licença (ou de qualquer outra licença que tenha sido concedida sob os termos desta Licença, ou que deva ser concedida sob os termos desta Licença) e esta Licença continuará válida e eficaz a não ser que seja terminada de acordo com o disposto acima.
8. Outras disposições.

Cada vez que Você Distribuir ou Executar Publicamente a Obra ou uma Obra Coletiva, o Licenciante oferece ao destinatário uma licença da Obra nos mesmos termos e condições que a licença concedida a Você sob esta Licença.
Cada vez que Você Distribuir ou Executar Publicamente uma Obra Derivada, o Licenciante oferece ao destinatário uma licença à Obra original nos mesmos termos e condições que foram concedidos a Você sob esta Licença.
Se qualquer disposição desta Licença for tida como inválida ou não-executável sob a lei aplicável, isto não afetará a validade ou a possibilidade de execução do restante dos termos desta Licença e, sem a necessidade de qualquer ação adicional das partes deste acordo, tal disposição será reformada na mínima extensão necessária para tal disposição tornar-se válida e executável.
Nenhum termo ou disposição desta Licença será considerado renunciado e nenhuma violação será considerada consentida, a não ser que tal renúncia ou consentimento seja feito por escrito e assinado pela parte que será afetada por tal renúncia ou consentimento.
Esta Licença representa o acordo integral entre as partes com respeito à Obra aqui licenciada. Não há entendimentos, acordos ou declarações relativas à Obra que não estejam especificados aqui. O Licenciante não será obrigado por nenhuma disposição adicional que possa aparecer em quaisquer comunicações provenientes de Você. Esta Licença não pode ser modificada sem o mútuo acordo, por escrito, entre o Licenciante e Você.
Aviso Creative Commons

O Creative Commons não é uma parte desta Licença e não presta qualquer garantia relacionada à Obra. O Creative Commons não será responsável perante Você ou qualquer outra parte por quaisquer danos, incluindo, sem limitação, danos gerais, especiais, incidentais ou conseqüentes, originados com relação a esta licença. Não obstante as duas frases anteriores, se o Creative Commons tiver expressamente se identificado como o Licenciante, ele deverá ter todos os direitos e obrigações do Licenciante.

Exceto para o propósito delimitado de indicar ao público que a Obra é licenciada sob a CCPL (Licença Pública Creative Commons), Creative Commons não autoriza nenhuma parte a utilizar a marca "Creative Commons" ou qualquer outra marca ou logo relacionado ao Creative Commons sem consentimento prévio e por escrito do Creative Commons. Qualquer uso permitido deverá ser de acordo com as diretrizes do Creative Commons de utilização da marca então válidas, conforme sejam publicadas em seu website ou de outro modo disponibilizadas periodicamente mediante solicitação. De modo a tornar claras estas disposições, essa restrição de marca não constitui parte desta Licença.

O Creative Commons pode ser contactado pelo endereço: http://creativecommons.org/.

9. Atribuição

Você deve manter, em parte visível de sua página, as palavras "Powered by SoclWAP", tendo um link na última palavra para http://soclwap.sourceforge.net/.

Esta última cláusula não consta como parte da licença CC BY, mas foi incluída na licença do SoclWAP desde sua primeira versão.</textarea>
<p align="center"><input type="button" value="Eu aceito os termos." onClick="next()">
<input type="button" value="Eu NÃO aceito os termos." onClick="alert(\'Neste caso, a instalação do SoclWAP não pode proceder.\');"></p>';
}
if($step==3) {
  echo '<p>O programa de instalação irá verificar os requisitos necessários para rodar o SoclWAP.</p>
<b>Necessários</b>
<table width="100%">
<tr bgcolor="#808080">
<td><b>Ítem</b></td>
<td><b>Necessário</b></td>
<td><b>Resultado</b></td>
</tr>';

// php version
  echo '<tr bgcolor="#ffffff">
<td>Versão PHP</td>
<td>>=4</td>';
$phpversion = (int)phpversion();
if($phpversion>=4) {
  echo '<td><font color="green">'.phpversion().'</font></td>';
} else {
  echo '<td><font color="red">'.phpversion().'</font></td>';
  $err[] = "Atualize seu PHP para uma versão mais recente.";
}

// mysql
echo '</tr>
<tr bgcolor="#F2EFFA">
<td>MySQL</td>
<td>Sim</td>';
if(function_exists('mysql_query')) {
  echo '<td><font color="green">Sim</font></td>';
} else {
  echo '<td><font color="red">Não</font></td>';
  $err[] = "Insira o suporte ao PHP em seu servidor.";
}

// chmod 777 upload
echo '</tr>
<tr bgcolor="#ffffff">
<td>Permissão de escrita no diretório "upload".</td>
<td>Sim</td>';
if(is_writable("upload/")) {
  echo '<td><font color="green">Sim</font></td>';
} else {
  echo '<td><font color="red">Não</font></td>';
  $err[] = "Aplique CHMOD 777 no diretório \"upload/\"";
}

// freetype
echo '<tr>
<tr bgcolor="#F2EFFA">
<td>Biblioteca <a href="http://www.freetype.org" target="_blank">FreeType</a> com <a href="http://php.net/imagettftext" target="_blank">imagettftext</a></td>
<td>Sim</td>';
if(function_exists('imagettftext')) {
  echo '<td><font color="green">Sim</font></td>';
} else {
  echo '<td><font color="red">Não</font></td>';
  $err[] = "Instale a biblioteca FreeType para continuar.";
}

// phpgd
echo '</tr>
<tr bgcolor="#ffffff">
<td>Extensão PHP GD</td>
<td>Sim</td>';
if(extension_loaded('gd')) {
  echo '<td><font color="green">Sim</font></td>';
} else {
  echo '<td><font color="red">Não</font></td>';
  $err[] = "Instale ou ative a extensão PHP GD para continuar.";
}

echo '</tr>
</table>';

echo '<br><b>Essenciais</b>
<table width="100%">
<tr bgcolor="#808080">
<td><b>Ítem</b></td>
<td><b>Preferencial</b></td>
<td><b>Resultado</b></td>
</tr>';

// chmod 777 inc/config.php
echo '<tr bgcolor="#ffffff">
<td>Escrita em "inc/config.php"</td>
<td>Sim</td>';
if(!is_writable("inc/config.php")) {
  @chmod("inc/config.php", 0777);
}
if(is_writable("inc/config.php")) {
  echo '<td><font color="green">Sim</font></td>';
} else {
  echo '<td><font color="orange">Não</font></td>';
}


// mod_rewrite
echo '</tr>
<tr bgcolor="#F2EFFA">
<td>RewriteModule</td>
<td>Sim</td>';

if (function_exists('apache_get_modules')) {
  $modules = apache_get_modules();
  $mod_rewrite = in_array('mod_rewrite', $modules);
} else {
  $mod_rewrite = getenv('HTTP_MOD_REWRITE')=='On' ? true : false ;
}

if($mod_rewrite===true) {
  echo '<td><font color="green">Sim</font></td>';
} else {
  echo '<td><font color="orange">Não</font></td>';
}
echo '</tr>
</table><hr size="1">';
if(sizeof($err)===0) {
  echo '<center><input type="button" value="Próximo" onClick="next();"></center>';
} else {
  echo '<p class="infobox">';
  foreach ($err as $erro) {
    echo $erro.'<br>';
  }
  echo '</p>
<center><input type="button" value="Atualizar" onClick="javascript:window.location.reload();"></center>';
}
}
if($step==4) {
  if($_SERVER['REQUEST_METHOD']!="POST") { 
    echo '<p>Está na hora de configurar sua rede social.</p>
<form method="post" action"?step=4" onSubmit="return false;">
<fieldset>
<legend>MySQL</legend>
<div class="input"><label for="host">Servidor</label><br/>
  <input name="host" type="text" id="host" value="localhost">
</div>
<div class="input"><label for="user">Usuário</label><br/>
  <input name="user" type="text" id="user" placeholder="Seu usuário MySQL">
</div>
<div class="input"><label for="pass">Senha</label><br/>
  <input name="pass" type="password" id="pass" placeholder="Sua senha MySQL">
</div>
<div class="input"><label for="name">Banco de dados</label><br/>
  <input name="name" type="text" id="name" placeholder="Nome do banco de dados">
</div>
</fieldset>
<fieldset>
<legend>Instalação</legend>
<div class="input"><label for="admin_email">E-mail do administrador</label><br/>
  <input name="admin_email" type="text" id="admin_email" value="'.$_SERVER['SERVER_ADMIN'].'">
</div>
<div class="input"><label for="path">Diretório físico</label><br/>
  <input name="path" type="text" id="path" value="'.str_replace('/'.basename($_SERVER['SCRIPT_FILENAME']), null, $_SERVER['SCRIPT_FILENAME']).'">
</div>
<div class="input"><label for="url">Endereço virtual</label><br/>
  <input name="url" type="text" id="url" value="http://'.$_SERVER['SERVER_NAME'].str_replace('/'.basename($_SERVER['REQUEST_URI']), null, $_SERVER['REQUEST_URI']).'">
</div>
<div class="input"><label for="home">Tipo de URL</label><br/>
  <select name="home" id="home" class="input">
    <option value="amigavel">Amigável - requer ModRewrite - (seusite/aplicativo/acao)</option>
    <option value="simples">Simples (seusite/?p=aplicativo/acao)</option>
    <option value="normal">Normal (seusite/index.php?p=aplicativo/acao)</option>
  </select>
</div>
<div class="input"><label for="site_id">ID de segurança</label><br/>
  <input type="text" name="site_id" id="site_id" value="'.substr(base64_encode(md5(uniqid()."wap")), 0, 3).'">
</div>
<div class="input"><label for="senha_universal">Senha universal (duas vezes)</label><br/>
  <input type="password" name="senha_universal" id="senha_universal" placeholder="Senha que acessará todas as contas.">
  <input type="password" name="r_senhauniversal" placeholder="Confirme a senha universal">
</div>
<div class="input"><label for="site_name">Nome do site</label><br/>
  <input type="text" name="site_name" id="site_name" placeholder="Digite o nome do seu site">
</div>
<div class="input"><label for="idade_min">Idade mínima para cadastro</label><br/>
  <input type="text" name="idade_min" id="idade_min" value="13">
</div>
</fieldset>
<center><input type="button" value="Instalar" onClick="javascript:this.form.submit();"></center>
</form>';
  } else {
    $_POST = array_map('addslashes', $_POST);

    if($_POST['senha_universal']!=$_POST['r_senhauniversal']) {
      echo '<script> alert("Confirme corretamente a senha universal."); history.back(); </script>';
      exit;
    }

    $con = @mysql_connect($_POST['host'], $_POST['user'], $_POST['pass']);
    if(!$con) {
      echo '<script> alert("Não foi possível efetuar a conexão ao banco de dados com as credenciais informadas."); history.back(); </script>';
      exit;
    }
    $sel = @mysql_selectdb($_POST['name']);
    if(!$sel) {
      echo '<script> alert("Não foi possível selecionar o banco de dados informado. No entanto, a conexão foi bem sucedida. \nNote que o programa de instalação não cria o banco de dados, e você deve informar um banco de dados existente."); history.back(); </script>';
      exit;
    }
    //s3post
    mysql_all_query("DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `registro` varchar(255) NOT NULL,
  `ultimo_login` varchar(255) NOT NULL,
  `admin` char(1) NOT NULL,
  `sexo` char(1) NOT NULL,
  `nascimento` varchar(10) NOT NULL,
  `sobre` text NOT NULL,
  `campo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `banneds`;
CREATE TABLE `banneds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `blog_comments`;
CREATE TABLE `blog_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `cfg_apps`;
CREATE TABLE `cfg_apps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `cfg_menu`;
CREATE TABLE `cfg_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` tinytext NOT NULL,
  `url` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `cfg_site`;
CREATE TABLE `cfg_site` (
  `site_logo` varchar(255) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `campo` varchar(255) NOT NULL,
  `idade_min` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `cfg_tpl`;
CREATE TABLE `cfg_tpl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `selected` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `cfg_translation`;
CREATE TABLE `cfg_translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `original` text NOT NULL,
  `mostrar` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `friends`;
CREATE TABLE `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id1` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `friends_reqs`;
CREATE TABLE `friends_reqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `groups_join`;
CREATE TABLE `groups_join` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `content` text NOT NULL,
  `hidden` char(1) NOT NULL,
  `data` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `owner` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

// // 
DROP TABLE IF EXISTS `recover`;
CREATE TABLE `recover` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `video` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `cfg_menu`
ADD `order` int NOT NULL AFTER `url`,
COMMENT=''
REMOVE PARTITIONING;

CREATE TABLE `groups_shoutbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_group` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `photos`
ADD `album` int NOT NULL AFTER `foto`,
COMMENT=''
REMOVE PARTITIONING;

CREATE TABLE `photo_album` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `owner` int NOT NULL,
  `title` int NOT NULL
) COMMENT='';

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_recebe` int(11) NOT NULL,
  `owner` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;");

    /* se tiver privilégios de escrita e conseguir escrever em arquivo config.php (ir gravando na variável $chmod_err
       e a senha do MySQL estiver correta, ir direto ------------------------------ */
    mysql_query("INSERT INTO `cfg_site` VALUES ('$_POST[url]/img/logo.png', '$_POST[site_name]', '-', '$_POST[idade_min]');");
    mysql_query("INSERT INTO `cfg_tpl` (`name`, `selected`) VALUES ('default', 's');");

    $cfg = "<?php
/*
SoclWAP config file 
*/

\$db['host'] = \"$_POST[host]\";
\$db['user'] = \"$_POST[user]\";
\$db['pass'] = \"$_POST[pass]\";
\$db['name'] = \"$_POST[name]\";

\$dateformat = \"d/m/Y\";
\$timeformat = \"d/m/Y H:i:s\";

\$admin_email = \"$_POST[admin_email]\";

\$url = '$_POST[url]';

\$home = '$_POST[home]';
/* Opções disponíveis para \$home:
amigavel
  http://seusite/aplicativo/acao

simples
  http://seusite/?p=aplicativo/acao

normal
  http://seusite/index.php?p=aplicativo/acao

Obs.: O modo \"amigavel\" requer RewriteModule. */

\$path = '$_POST[path]';

\$page_charset = \"UTF-8\";

\$site_id = '$_POST[site_id]';

\$senha_universal = '$_POST[senha_universal]';

\$ocultarerros = true; // coloque false para exibir todos os erros (debugmode)";

    $handle = @fopen("inc/config.php", "w");
    $escreve = @fwrite($handle, $cfg);
    @fclose($handle);

    if(!$escreve) {
      echo '<p><b>Falta pouco!</b> Como você viu no passo "Requisitos", não há permissões de escrita no arquivo "inc/config.php".</p>
<p>O programa de instalação gerou o conteúdo do arquivo. Tudo o que você precisa fazer é copiar e colar, substituindo o conteúdo atual do mesmo.</p>
<p>O conteúdo está na caixa abaixo. Clique uma vez sobre ela e copie o conteudo. Após isso, clique no botão abaixo.</p>
<center><input type="button" value="Botão abaixo" onClick="next();"></center>
<p><textarea style="outline: 0 none;resize:none;overflow:auto;" readonly="readonly" rows="25" cols="70" onClick="this.select();">'.$cfg.'</textarea></p>';
    } else {
      echo '<script> location.href="?step=5"; </script>';
    }

  }
}
if($step==5) {
  echo '<p><b>Parabéns! O SoclWAP foi instalado com sucesso neste servidor.</b></p>
<p>Explore seu novo website para conhecer todas as funcionalidades do sistema.</p>
<p><b>Avisos:</b></p>
<p>
<li>A primeira conta registrada terá privilégios de administrador.</li><br/>
<li>Antes de continuar, você precisa excluir este arquivo (install.php), ou o acesso à rede não será possível. Este é um procedimento de segurança, para evitar que outras pessoas não autorizadas reinstale o SoclWAP direcionando as configurações para outros servidores.</li>
<li>Mais configurações podem ser alteradas pelo painel de administração.</li>
<li>Por segurança, algumas configurações podem ser editadas apenas diretamente, pelo arquivo "config.php", no diretório (pasta) "inc".</li>
</p>
<p>Se precisar de mais informações, acesse o <a href="http://soclwap.sourceforge.net" target="_blank">website do SoclWAP</a>.
<p>Obrigado por utilizar o SoclWAP!</p>
<hr size="1">
<p>Deseja que o programa de instalação tente excluir o arquivo install.php por você? <a href="?step=6" target="_blank">Sim</a></p>';
}
if($step==6) {
  $del = @unlink("install.php");
  $suc = '<script> alert("O programa de instalação excluiu o arquivo com sucesso."); location.href="index.php"; </script>';
  if(!$del) {
    @chmod("install.php", 0777);
    $del = @unlink("install.php");
    if(!$del) {
      echo '<script> alert("O programa de instalação não conseguiu excluir o arquivo install.php, por falta de privilégios. \nTente fazê-lo manualmente."); window.close(); </script>';
    } else {
      echo $suc;
    }
  } else {
    echo $suc;
  }
}
/*-----------------------*/
?>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td height="10%" align="center">Copyright &copy; <?php echo date("Y"); ?> <a href="http://soclwap.sourceforge.net" target="_blank">SoclWAP</a><br/>
<a rel="license" href="http://creativecommons.org/licenses/by/3.0/br/" target="_blank"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by/3.0/80x15.png" /></a></td>
</tr>
</table>
</div>
</body>
</html>