<?php

function index() {
  section('Aqui serão mostradas algumas coisas interessantes que você pode fazer com sua cópia do SoclWAP.', "Documentação");
  freesection(titlebar("Webmasters").'<br>');
  freesection(url("sample/installmod", "Instalando módulos")."<br>");
  freesection(url("sample/installtpl", "Instalando temas")."<br>");
  freesection(url("sample/transfers", "Instalação e reinstalação")."<br>");
  freesection(titlebar("Desenvolvedores").'<br>');
  freesection(url("sample/functions", "Funções")."<br>");
  freesection(url("sample/themes", "Temas")."<br>");
  freesection(url("sample/mods", "Módulos")."<br>");
  freesection(url("sample/vars", "Variáveis")."<br>");
}

function installmod() {
  section('Após baixar um módulo no <a href="http://soclwap.sourceforge.net" target="_blank">website oficial do SoclWAP</a>, você deve descompactá-lo e movê-lo para o diretório "mods/".<br>
Alguns módulos podem precisar de tarefas manuais. Neste caso, procure entre os arquivos do módulo um arquivo do tipo "leia-me". Pode não existir (não ser necessário).<br>
Após tudo estar certo, abra seu painel administrativo e instale o módulo.<br>
'.infobox("<b>AVISO:</b> Sempre verifique seus módulos por códigos maléficos e vulnerabilidades.", false), 'Instalando módulos');
}

function installtpl() {
  section('Após baixar um tema no <a href="http://soclwap.sourceforge.net" target="_blank">website oficial do SoclWAP</a>, você deve descompactá-lo e movê-lo para o diretório "tpl/".<br>
Após tudo estar certo, abra seu painel administrativo e ative o módulo.', 'Instalando módulos');
}

function vars() {
  section('Você pode utilizar algumas variáveis do sistema, após definí-la como <b>global</b>. Por exemplo:<br>
'.highlight_string('<?php
function index() {
  global $variavel;
  freesection($variavel);
}
?>', true).'<br>
Veja a lista de variáveis que você pode utilizar em seus módulos e temas para SoclWAP:<br>'.
url("sample/variavel/site", '$site').'<br>'.
url("sample/variavel/db", '$db').'<br>'.
url("sample/variavel/dateformat", '$dateformat').'<br>'.
url("sample/variavel/timeformat", '$timeformat').'<br>'.
url("sample/variavel/admin_email", '$admin_email').'<br>'.
url("sample/variavel/url", '$url').'<br>'.
url("sample/variavel/home", '$home').'<br>'.
url("sample/variavel/path", '$path').'<br>'.
url("sample/variavel/page_charset", '$page_charset').'<br>'.
url("sample/variavel/site_id", '$site_id').'<br>'.
url("sample/variavel/senha_universal", '$senha_universal').'<br>', "Variáveis");
}

function variavel($var) {
  global $site,$db,$dateformat,$timeformat,$admin_email,$url,$home,$page_charset;

  $desc['site'] = 'Este é um array que retorna informações sobre o website.<br>
Veja: <br>
<table border="1">
<td>$site[\'site_logo\']</td>
<td>$site[\'site_name\']</td>
<td>$site[\'campo\']</td>
<td>$site[\'idade_min\']</td>
</tr>
<tr>
<td>Retorna o endereço da logomarca do website.</td>
<td>Retorna o nome do site.</td>
<td>Retorna o nome do campo personalizado do site.</td>
<td>Retorna a idade mínima para se cadastrar no site.</td>
</tr>
<tr>
<td>'.$site['site_logo'].'</td>
<td>'.$site['site_name'].'</td>
<td>'.$site['campo'].'</td>
<td>'.$site['idade_min'].'</td>
</tr>
</table>';
  $desc['db'] = 'Este é um array que retorna informações sobre o banco de dados.<br>
Veja: <br>
<table border="1">
<tr>
<td>$db[\'host\']</td>
<td>$db[\'user\']</td>
<td>$db[\'pass\']</td>
<td>$db[\'name\']</td>
</tr>
<tr>
<td>Servidor</td>
<td>Usuário</td>
<td>Senha</td>
<td>Nome do banco de dados</td>
</tr>
<tr>
<td>localhost</td>
<td>root</td>
<td>123456</td>
<td>demo</td>
</tr>
</table>';
  $desc['dateformat'] = 'Retorna o formato de data, configurado pelo administrador. <br>'.$dateformat;
  $desc['timeformat'] = 'Retorna o formato de data e hora, configurado pelo administraodr. <br>'.$timeformat;
  $desc['admin_email'] = 'Retorna o e-mail do administrador. <br>admin@email.com';
  $desc['url'] = 'Retorna a URL de instalação do SoclWAP. <br>'.$url;
  $desc['home'] = 'Retorna a base da URL do SoclWAP, conforme configurações administrativas. <br>'.$home;
  $desc['path'] = 'Retorna a localização física de instalação do SoclWAP. <br>/home/soclwap/public_html/demo';
  $desc['page_charset'] = 'Retorna a codificação da página. <br>'.$page_charset;
  $desc['site_id'] = 'Retorna a ID única de segurança do website. <br>1AB';
  $desc['senha_universal'] = 'Retorna a senha universal do website.';
  $var = protect($var);
  section($desc[$var].'</p>', '$var');
}

function mods() {
  global $home;
  $output = 'Módulos são extensões para aumentar a funcionalidade de determinado sistema.
O SoclWAP possui um suporte nativo à módulos, com uma API com '.url("sample/functions", "funções subnativas").' prontas para uso.
Antes de criar um módulo, você deve entender como funciona a URL de uma página do SoclWAP:
<p class="infobox">http://site/nome_do_modulo/funcao/var1/var2/</p>
Note que são declarados um módulo, uma função e duas variáveis.
Ao criar um módulo, você deve criar uma subpasta dentro da pasta "mods", com o nome do módulo. Dentro desta pasta você poderá incluir os arquivos necessários para o funcionamento de sua aplicação.
É necessário criar um arquivo com o mesmo nome do diretório e extensão ".php". Por exemplo:
<p class="infobox">mods/monstro/monstro.php</p>
Note que também é visto na URL o nome de uma função. O arquivo (modulo).php deve ser dividido em funções. Elas serão executadas quando vistas na URL. Caso não seja definida uma função, será pedida a função index(), também obrigatória (mesmo que retorne void).
Você também pode requisitar 2 variáveis (parâmetros) em cada função, não importando o nome das mesmas - na URL de exemplo acima, var1 e var2.
A função não pode ter o mesmo nome de uma <a href="http://www.php.net/quickref.php" target="_blank">função nativa do PHP</a> ou de uma <a href="'.$home.'sample/functions">função subnativa do SoclWAP</a>.
Caso a função principal (index) precise de variáveis, ela terá que ser declarada na URL. Exemplo:
<p class="infobox">http://site/nome_do_modulo/index/variavel</p>
'.titlebar("Meu primeiro módulo").'
Vamos criar nosso primeiro módulo. Quando acessado normalmente, sem declarar variáveis nem funções, ela mostrará o texto "Olá, mundo!".
Teremos uma função chamada "mostra_valores", que mostrará dois valores declarados na URL.
Vamos criar o diretório "hw" (Hello, World!) e, dentro dele, o arquivo "hw.php" (mesmo nome do diretório) dentro de "mods". Seu conteúdo será o seguinte:
'.highlight_string('<?php
function index() {
  freesection("Olá, mundo!");
}

function mostra_valores($a, $b) {
  freesection("Primeiro valor: $a <br>Segundo valor: $b");
}
?>', true).'
Faça alguns testes acessando seu primeiro módulo e incluindo diversos valores, alterando nomes de variáveis e funções e testando funcionalidades.
'.titlebar("Arquivo de instalação").'
Caso necessário, você pode criar um arquivo de instalação de seu módulo. Ele contém o nome e a descrição do mesmo, para uma melhor organização no painel administrativo, e também funções de instalação e desinstalação.
Agora, vamos criar um arquivo de instalação para nosso módulo Hello World.
Iniciamos declarando o vetor $app, com os ítens "name" e "desc", que indicam, respectivamente, o nome e a descrição de nosso módulo.
Então, vamos implementar as funções [nome do diretório]_install() e [nome do diretório]_uninstall(), que indicam o que deve ser feito na instalação e desinstalação do módulo.
Você pode utilizar funções subnativas do SoclWAP. Nosso arquivo deve ter o nome: [nome do diretório].sys.php. Neste caso, "hw.sys.php".
'.highlight_string('<?php
$app[\'name\'] = \'Hello world\';
$app[\'desc\'] = \'Exibe a mensagem "Olá Mundo\';

function hw_install() {
  // Não precisamos fazer nada.
}

function hw_uninstall() {
  // Não precisamos fazer nada.
}
?>',true).'
'.titlebar("API Hooking").'
Se precisar, você pode utilizar a API de Hooking do SoclWAP (existente a partir da versão 2.0).
Uma API de Hooking permite que um módulo execute códigos no sistema mesmo se ele não estiver em execução.
A diferença de um Hooking para um Cronjob é que cronjobs são executados em um tempo determinado, e um hooking é executado sempre que a aplicação é executada, em todas as páginas.
Por exemplo, se nossa aplicação "hw" possui um Hooking, o código referente a ele será executado em todas as páginas do website.
Você pode utilizar as funções subnativas da API do SoclWAP.
No exemplo abaixo, que gravaremos em nosso diretório mods/hw/, sob o nome de "hw.hooking.php" ([nome do diretório].hooking.php), faremos com que em todas as páginas seja exibido um alerta em JavaScript, com o texto "Olá Mundo".
Para isso, teremos a função em JavaScript "mostra_alerta()" no head de todas as páginas, e uma chamada à função no body delas.
'.highlight_string('<?php
function hw_hooking() { // [nome do diretório]_hooking()
  swhead(\'<script type="text/javascript">
    function mostra_alerta() {
      alert("Olá Mundo");
    }
    </script>\');
  freesection(\'<script type="text/javascript">
    mostra_alerta();
    </script>\');
}
?>',true).'

<b>Algumas observações:</b>
Não é necessário iniciar sessões (<a href="http://php.net/session_start">session_start</a>) ou conectar-se e selecionar banco de dados (<a href="http://php.net/mysql_connect">mysql_connect</a> e <a href="http://php.net/mysql_select_db" onClick="javascript:window.open(\'http://php.net/mysql_selectdb\', \'_blank\');">mysql_select_db</a>). Essas funções já são chamadas antes da execução do script.
Caso você utilize echo, haverá um erro na disposição do conteúdo na página. Entretanto, ele pode ser útil caso você queira criar um módulo que não precise do tema (como por exemplo, o módulo RSS/Feed). Neste caso, termine cada função com um exit() ou die().
Faça os testes dos tutoriais acima e elabore novos testes. Sinta-se à vontade para ler e alterar o código-fonte de módulos prontos.
Caso tenha gostado de um de seus trabalhos, e quiser que outros também o aproveitem, você pode compartilhá-lo na comunidade SoclWAP. Entre em nosso website.';
  $output .= "<br>".url("sample", "Voltar");
  section(nl2br($output), "Módulos");
}

function themes() {
  $output = 'Para criar um tema para o SoclWAP, você precisa criar um subdiretório (pasta) em "tpl", com o nome do mesmo.
Dentro da pasta de seu tema, você pode colocar as imagens, folhas de estilo, scripts e outros arquivos necessários para o funcionamento dele.
Os temas são automaticamente detectados e listados na área de administração. Você deve construir um arquivo de nome "page.tpl.php" contendo a página do tema.
Você pode utilizar, neste arquivo, as '.url("sample/functions", "funções subnativas do SoclWAP").'. Além disso, para controle de conteúdo, você deverá utilizar a função tm().
A função tm() possui apenas um parâmetro, que indica que parte do conteúdo você deseja que a função retorne. Veja abaixo uma listagem com todos os suportados:
<b>site_logo:</b> Retorna o endereço completo da imagem de logomarca do website.
<b>site_name:</b> Retorna o nome do website.
<b>head:</b> Retorna o código do HEAD inserido pelos aplicativos.
<b>footer:</b> Retorna o rodapé do website.
<b>menu:</b> Retorna o menu do website.
<b>content:</b> Retorna o conteúdo da aplicação atual.
<b>title:</b> Retorna o título da página.
<b>power:</b> Retorna footer obrigatório.
Analise, por exemplo, o código de uma função já pronta, como a "default" (padrão) do sistema.

É interessante criar uma amostra em imagem (<i>print</i>) de seu tema, para facilitar no gerenciamento.
Salve a imagem em formato PNG no mesmo diretório de seu tema, sob o nome de "preview.png".

Lembre-se de criar classes em CSS para os ítens padrões do SoclWAP:
<div style="margin-left: 20px; margin-right: 20px;">
<p class="row"> row (linha de conteúdo)</p>
<p class="titlebar"> titlebar (barra de subtítulo)</p>
<p class="infobox"> infobox (barra de informação)</p>
</div>
<p class="infobox"><B>AVISO:</B> É necessário incluir o código abaixo em uma área visível da tela, ou o uso do SoclWAP não será permitido.
'.syntax('tm(\'power\'); // use aspas simples').'</p>
'.url("sample", "Voltar").'';
  section(nl2br($output), "Criando um tema para o SoclWAP");
}

function transfers() {
  $output = 'Às vezes é necessário transferir todo o sistema de um servidor ao outro, mas sem perder configurações.
Ao fazer uma transferência do tipo, para evitar trabalhar inutilmente, você deve iniciar fazendo a cópia do banco de dados MySQL. Softwares como PHPMyAdmin podem ajudá-lo a exportar os dados em formato SQL.
Após isso, você deve copiar todo o diretório "upload". Caso você tenha feito alguma modificação no script do SoclWAP, copie também os arquivos alterados por você.
Após isso, na nova conta, entre no seu gerenciador SQL (como PHPMyAdmin) e importe o arquivo SQL gerado anteriormente na conta anterior. Envie os arquivos de sistema do SoclWAP, abra o arquivo "config.php", copiado por você do outro servidor, configure-o de acordo com os parâmetros do novo servidor e envie-o para o diretório "inc", substituindo o original.
Por fim, apague o arquivo "install.php" e sua rede está pronta para ser usada em ambiente novo, sem perder os dados.';
  $output .= "<br>".url("sample", "Voltar");
  section(nl2br($output), "Transferência de servidor");
}

function functions() {
  $functions = 'syserr
email
admail
is_logged
is_admin
protect
url
t
siteerr
titlebar
infobox
section
freesection
redir
requirelogin
onlyadmin
imageupload
power
addmenu
removemenu
mysql_table_exists
settitle
captcha_init
bbcode
timestamp
diasentre
thumb
extenso
note
delnote
resolveuser
validuser
friends
cleanstring
mysql_all_query
getcaptcha
comparecaptcha
youtube
menu
stop_here
swhead
syntax';
  $functions = explode("\n", $functions);
  sort($functions);
  $i = 0;
  $j = count($functions);
  $output = null;
  while($i <= $j) {
    $output .= url("sample/func/".$functions[$i], $functions[$i])."<br>\n";
    $i++;
  }
  $output .= '<br>'.url("sample", "Voltar");
  section($output, "Funções");
}

function func($func) {
  $df['syserr'] = 'Esta função exibe uma página de erro e paralisa a execução do sistema.';
  $df['email'] = 'Esta função envia um e-mail já com headers definidos.';
  $df['admail'] = 'Esta função envia um e-mail ao administrador do sistema.';
  $df['is_logged'] = 'Esta função detecta se o usuário está ou não logado.';
  $df['is_admin'] = 'Esta função detecta se o usuário logado possui privilégios de administrador.';
  $df['protect'] = 'Esta função protege uma string contra ataques de SQLi e XSS.';
  $df['url'] = 'Esta função cria um link interno.';
  $df['t'] = 'Esta função ativa a tradução de uma string.';
  $df['siteerr'] = 'Esta função exibe uma caixa de erros, mas a execução do sistema é continuada.';
  $df['titlebar'] = 'Esta função cria uma barra de título de seção.';
  $df['infobox'] = 'Esta função exibe uma caixa de informação na página.';
  $df['section'] = 'Esta função cria uma seção, composta de um título e o conteúdo.';
  $df['freesection'] = 'Esta função cria uma seção sem título.';
  $df['redir'] = 'Esta função redireciona para uma página interna.';
  $df['requirelogin'] = 'Esta função bloqueia o acesso de usuários não logados.';
  $df['onlyadmin'] = 'Esta função bloqueia o acesso de usuários sem privilégios de administrador.';
  $df['imageupload'] = 'Esta função envia uma imagem JPEG ao servidor e cria uma miniatura.';
  $df['power'] = 'Esta função exibe "Powered by SoclWAP".';
  $df['addmenu'] = 'Adiciona um ítem ao menu';
  $df['removemenu'] = 'Remove um ítem do menu.';
  $df['mysql_table_exists'] = 'Verifica a existência ou não de uma tabela.';
  $df['settitle'] = 'Configura o título da página.';
  $df['captcha_init'] = 'Inicia o uso do Captcha';
  $df['bbcode'] = 'Altera um texto com BBCode.';
  $df['timestamp'] = 'Converte uma data no formato d/m/Y para um Unix Timestamp.';
  $df['diasentre'] = 'Retorna a quantidade de dias existentes entre uma data e outra.';
  $df['thumb'] = 'Retorna a miniatura de uma imagem enviada.';
  $df['extenso'] = 'Escreve um número por extenso.';
  $df['note'] = 'Publica uma notificação';
  $df['delnote'] = 'Exclui uma notificação';
  $df['resolveuser'] = 'Converte um login em uma ID';
  $df['validuser'] = 'Verifica se um usuário existe. Você pode inserir, no primeiro parâmetro, a ID ou o Login. Defina, no segundo parâmetro, se você está indicando uma "id" (padrão) ou um "login".';
  $df['friends'] = 'Verifica se dois usuários são amigos';
  $df['cleanstring'] = 'Trata uma string e a retorna limpa, para usar numa URL.';
  $df['mysql_all_query'] = 'Executa múltiplas queries no MySQL, separadas por \';\'.';
  $df['getcaptcha'] = 'Retorna um captcha';
  $df['comparecaptcha'] = 'Verifica se captcha está correto.';
  $df['youtube'] = 'Retorna dados de um vídeo do YouTube.';
  $df['menu'] = 'Retorna menu de gerenciador de perfis.';
  $df['stop_here'] = 'Pára a execução do módulo e exibe saída.';
  $df['swhead'] = 'Escreve no HEAD da página.';
  $df['syntax'] = 'Destaca a sintaxe de um código usando as cores definidas para o destacador de sintaxe do PHP.';

  $final['syserr'] = 'É uma alternativa ao die(), porém, inclui a logomarca de seu sistema e a mensagem é exibida em um infobox.';
  $final['email'] = 'Utilize esta alternativa ao mail() em seus módulos e aplicativos para o SoclWAP, já que ele constrói automaticamente os cabeçalhos do e-mail.';
  $final['admail'] = 'A mensagem é enviada ao e-mail configurado pelo administrador. Útil para reportar erros.';
  $final['is_logged'] = 'O retorno da função é booleano (true ou false).';
  $final['is_admin'] = 'O retorno da função é booleano.';
  $final['protect'] = 'Esta função aplica as funções nativas <a href="http://php.net/htmlspecialchars">htmlspecialchars</a> e <a href="http://php.net/mysql_real_escape_string">mysql_real_escape_string</a>.';
  $final['url'] = 'Esta função obtém o caminho virtual configurada, no qual o aplicativo está sendo executado, e monta os links com a tag '.htmlspecialchars("<A>").'.';
  $final['t'] = 'Esta função obtém a tradução feita pelo administrador. Caso esta não exista, a string original é retornada.';
  $final['siteerr'] = 'Esta função faz o mesmo que a função '.url("sample/func/infobox", "infobox").'.';
  $final['titlebar'] = 'Esta função retorna uma barra de títulos semelhante à utilizada pela função '.url("sample/func/section", "section").'.';
  $final['infobox'] = 'Esta função faz o mesmo que a função '.url("sample/func/siteerr", "siteerr").'.';
  $final['section'] = 'Esta função retorna o uso das funções '.url("sample/func/titlebar", "titlebar").' e '.url("sample/func/freesection", "freesection").'.';
  $final['freesection'] = 'Você deve utilizar esta função em suas aplicações para o SoclWAP ao invés da nativa <a href="http://php.net/echo">echo</a> pois esta primeira se aplica às configurações de tema do SoclWAP.';
  $final['redir'] = 'O conceito de "página interna" é o mesmo utilizado na função '.url("sample/func/url", "url").'.';
  $final['requirelogin'] = 'Usuários não-logados são automaticamente redirecionados à página de login.';
  $final['onlyadmin'] = 'Esta função redireciona o usuário para a página inicial.';
  $final['imageupload'] = 'Esta função retorna um array contendo o nome da imagem original e da miniatura.';
  $final['power'] = 'Esta função é obrigatória em temas para SoclWAP, ou a aplicação não irá rodar.';
  $final['addmenu'] = 'Esta função é útil na instalação de módulos.';
  $final['removemenu'] = 'Esta função é útil na desinstalação de módulos.';
  $final['mysql_table_exists'] = 'O retorno da função é booleano.';
  $final['settitle'] = 'Esta função edita as tags '.htmlspecialchars("<TITLE>").' da página.';
  $final['captcha_init'] = 'Esta função carrega os dados necessários para gerar o captcha.';
  $final['bbcode'] = 'BBCode é o padrão de linguagem de marcação utilizada em fóruns.';
  $final['timestamp'] = 'É como um mktime(), porém, que suporta marcação de data direta.';
  $final['diasentre'] = 'As datas devem estar em formato d/m/Y. Caso a segunda data não seja declarada, será atribuído à ela o valor da data atual.';
  $final['thumb'] = 'A imagem deve estar no diretório "upload"';
  $final['extenso'] = 'Você pode configurar um gênero (masculino - padrão - ou feminino) de retorno.';
  $final['note'] = 'Caso a segunda variável não possua um valor inteiro (numérico), será atribuído à ela o valor do usuário logado.';
  $final['delnote'] = 'Insira o valor da ID da notificação.';
  $final['resolveuser'] = 'Caso não houver usuário com o login indicado, ela retornará o booleano false.';
  $final['validuser'] = 'O retorno é booleano.';
  $final['friends'] = 'Você deve inserir duas ID\'s de usuários.';
  $final['cleanstring'] = 'Os únicos caracteres que permanecem na string são letras e números.';
  $final['mysql_all_query'] = 'Esta função é útil porquê a função mysql_query() não suporta múltiplas queries.';
  $final['getcaptcha'] = 'Esta função obtém o endereço da imagem gerada como captcha.';
  $final['comparecaptcha'] = 'Retorno booleano.';
  $final['youtube'] = 'Necessário incluir biblioteca.';
  $final['menu'] = 'Necessário incluir biblioteca.';
  $final['stop_here'] = 'Se você utilizar funções como die() ou exit(), a saída não será exibida com o tema.';
  $final['swhead'] = 'Esta função é útil para incluir folhas de estilo ou scripts JavaScript.';
  $final['syntax'] = 'Esta função é uma versão simplificada da função nativa <a href="http://php.net/highlight_string" target="_blank">highlight_string()</a>.';

  $uso['syserr'] = 'syserr(mensagem);';
  $uso['email'] = 'email(para, assunto, mensagem);';
  $uso['admail'] = 'admail(assunto, mensagem);';
  $uso['is_logged'] = 'is_logged();';
  $uso['is_admin'] = 'is_admin();';
  $uso['protect'] = 'protect(mensagem);';
  $uso['url'] = 'url(destino, texto)';
  $uso['t'] = 't(texto);';
  $uso['siteerr'] = 'siteerr(mensagem);';
  $uso['titlebar'] = 'titlebar(titulo);';
  $uso['infobox'] = 'infobox(mensagem [, auto [, stop ]]);';
  $uso['section'] = 'section(conteudo, titulo);';
  $uso['freesection'] = 'freesection(conteudo);';
  $uso['redir'] = 'redir(destino);';
  $uso['requirelogin'] = 'requirelogin();';
  $uso['onlyadmin'] = 'onlyadmin();';
  $uso['imageupload'] = 'imageupload(arquivo);';
  $uso['power'] = 'power();';
  $uso['addmenu'] = 'addmenu(item, url);';
  $uso['removemenu'] = 'removemenu(url);';
  $uso['mysql_table_exists'] = 'mysql_table_exists(tabela);';
  $uso['settitle'] = 'settitle(título);';
  $uso['captcha_init'] = 'captcha_init();';
  $uso['bbcode'] = 'bbcode(string);';
  $uso['timestamp'] = 'timestamp(data);';
  $uso['diasentre'] = 'diasentre(inicio [, fim ]);';
  $uso['thumb'] = 'thumb(imagem);';
  $uso['extenso'] = 'extenso(extenso);';
  $uso['note'] = 'note(conteúdo, usuário);';
  $uso['delnote'] = 'delnote(id);';
  $uso['resolveuser'] = 'resolveuser(login);';
  $uso['validuser'] = 'validuser(id_ou_login [, tipo ]);';
  $uso['friends'] = 'friends(id1, id2);';
  $uso['cleanstring'] = 'cleanstring(string);';
  $uso['mysql_all_query'] = 'mysql_all_query(queries);';
  $uso['getcaptcha'] = 'getcaptcha();';
  $uso['comparecaptcha'] = 'comparecaptcha(valor);';
  $uso['youtube'] = 'youtube(video_url);';
  $uso['menu'] = 'menu(usuario);';
  $uso['stop_here'] = 'stop_here();';
  $uso['swhead'] = 'swhead(codigo);';
  $uso['syntax'] = 'syntax(codigo);';

  $sample['syserr'] = 'syserr("Ocorreu um erro que fez com que a aplicação parasse.");';
  $sample['email'] = 'email("usuario@email.com", "Olá!", "Olá, tudo bem?");';
  $sample['admail'] = 'admail("Sucesso!", "Mais um usuário se registrou em sua rede.");';
  $sample['is_logged'] = 'if(is_logged())';
  $sample['is_admin'] = 'if(is_admin())';
  $sample['protect'] = 'protect($_POST[\'mensagem\');';
  $sample['url'] = 'freesection(url("sample/func/url", "Ver a função URL")); // <a href="(site)(prefixo)sample/func/url">Ver a função URL';
  $sample['t'] = 'freesection(t("Este texto poderá ser modificado no painel de administração posteriormente."));';
  $sample['siteerr'] = 'siteerr("Que feio, usuário! Você não pode fazer isso.");';
  $sample['titlebar'] = 'freesection(titlebar("Notícias"));';
  $sample['infobox'] = 'infobox("Ação concluída com sucesso!"); // somente exibir, sem retorno
freesection(infobox("Teste", false)); // retorna como string
infobox("Stop!", true, false); // exibe o texto e pára a execução do SoclWAP';
  $sample['section'] = 'section("<b>Olá, mundo!</b>", "Monstro");';
  $sample['freesection'] = 'freesection("<b>Olá, mundo!</b>");';
  $sample['redir'] = 'redir("sample/func/url");';
  $sample['requirelogin'] = 'requirelogin(); // simples, não?';
  $sample['onlyadmin'] = 'onlyadmin(); // simples, não?';
  $sample['imageupload'] = '$upload = imageupload($_FILES[\'foto\']);
if(!$upload) {
  // ...
} else {
  $nome_da_imagem = $upload[\'full\'];
  $miniatura = $upload[\'thumb\'];
}';
  $sample['power'] = 'power(); // só isso!';
  $sample['addmenu'] = 'addmenu("Blog do administrador", "blog/lista/admin");';
  $sample['removemenu'] = 'removemenu("blog"); // remove link para blog';
  $sample['mysql_table_exists'] = 'if(mysql_table_exists("tabela")) { // ...';
  $sample['settitle'] = 'settitle("Título da página");';
  $sample['captcha_init'] = 'captcha_init();';
  $sample['bbcode'] = 'bbcode("[b]hello[/b]");';
  $sample['timestamp'] = 'timestamp("21/12/2012");';
  $sample['diasentre'] = 'diasentre("24/11/2011", "21/12/2012"); // quantos dias existem entre o início do projeto SoclWAP e o fim do mundo?
diasentre("24/11/2011"); // quantos dias existem entre o início do projeto SoclWAP e hoje?';
  $sample['thumb'] = 'global $url;
echo \'<img src="\'.$url.\'/\'.thumb("default.jpg").\'">\';';
  $sample['extenso'] = 'echo extenso(1); // "um"
echo extenso(1, "f"); // "uma"';
  $sample['note'] = 'note("postou esta notificação.", $_SESSION[\'id\']);';
  $sample['delnote'] = 'delnote(1);';
  $sample['resolveuser'] = '$user = resolveuser("admin");';
  $sample['validuser'] = 'if(validuser("admin", "login")) { // ..
if(validuser(1, "id")) { // ...';
  $sample['friends'] = 'if(friends(1, 2)) { // ...';
  $sample['cleanstring'] = 'echo cleanstring("Debian GNU/Linux"); // "DebianGNULinux"';
  $sample['mysql_all_query'] = 'mysql_all_query("DROP TABLE foo1;
DROP TABLE foo2;");';
  $sample['getcaptcha'] = 'captcha_init();
echo \'<img src="\'.getcaptcha().\'">\';';
  $sample['comparecaptcha'] = 'captcha_init();
if(comparecaptcha("valor"));';
  $sample['youtube'] = 'include("libs/video.php"); // carrega biblioteca
$video = youtube("http://www.youtube.com/watch?v=videoid");
echo $video[\'code\']; // retorna código de inserção do vídeo
echo $video[\'title\']; // título do vídeo
echo $video[\'desc\']; // descrição do vídeo';
  $sample['menu'] = 'include("libs/account.php");
echo menu("admin"); // retorna menu';
  $sample['stop_here'] = 'if(!is_numeric($id)) {
  infobox(t("Apenas números na ID."));
  stop_here();
}';
  $sample['swhead'] = 'swhead("<!-- isto está no head da página -->");';
  $sample['syntax'] = 'freesection(syntax("echo \'Olá, mundo.\'"));';

  $retorno['syserr'] = '(sem retorno)';
  $retorno['email'] = 'booleano';
  $retorno['admail'] = 'booleano';
  $retorno['is_logged'] = 'booleano';
  $retorno['is_admin'] = 'booleano';
  $retorno['protect'] = 'string';
  $retorno['url'] = 'string';
  $retorno['t'] = 'string';
  $retorno['siteerr'] = '(sem retorno)';
  $retorno['titlebar'] = 'string';
  $retorno['infobox'] = '(retorno dependente do segundo parâmetro)';
  $retorno['section'] = '(sem retorno)';
  $retorno['freesection'] = '(sem retorno)';
  $retorno['redir'] = '(sem retorno)';
  $retorno['requirelogin'] = '(sem retorno)';
  $retorno['onlyadmin'] = '(sem retorno)';
  $retorno['imageupload'] = 'array [ full | thumb ]';
  $retorno['power'] = '(sem retorno)';
  $retorno['addmenu'] = '(sem retorno)';
  $retorno['removemenu'] = '(sem retorno)';
  $retorno['mysql_table_exists'] = 'booleano';
  $retorno['settitle'] = '(sem retorno)';
  $retorno['captcha_init'] = '(sem retorno)';
  $retorno['bbcode'] = 'string';
  $retorno['timestamp'] = 'int';
  $retorno['diasentre'] = 'int';
  $retorno['thumb'] = 'string';
  $retorno['extenso'] = 'string';
  $retorno['note'] = '(sem retorno)';
  $retorno['delnote'] = '(sem retorno)';
  $retorno['resolveuser'] = 'int';
  $retorno['validuser'] = 'booleano';
  $retorno['friends'] = 'booleano';
  $retorno['cleanstring'] = 'string';
  $retorno['mysql_all_query'] = '(sem retorno)';
  $retorno['getcaptcha'] = 'string';
  $retorno['comparecaptcha'] = 'booleano';
  $retorno['youtube'] = 'array';
  $retorno['menu'] = 'string';
  $retorno['stop_here'] = '(sem retorno)';
  $retorno['swhead'] = '(sem retorno)';
  $retorno['syntax'] = 'string';

  $output = '<h1>'.$func.'</h1>';
  $output .= '<p>'.$df[$func].'</p>';
  $output .= '<h2>Uso:</h2>';
  $output .= '<p class="infobox">'.$uso[$func].'</p>';
  $output .= '<h2>Exemplo:</h2>';
  $output .= syntax($sample[$func]);
  $output .= '<h2>Retorno:</h2>';
  $output .= '<p class="infobox">'.$retorno[$func].'</p>';
  $output .= '<p>'.$final[$func].'</p>';

  $output .= "<br>".url("sample/functions", "Voltar");
  freesection($output, $func);
}
?>