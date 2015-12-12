<?php
function index() {
  global $dateformat,$home;
  requirelogin();
  $owner = $_SESSION['id'];
  $output = url("blog/create", t("[postar]"));
  $qry = mysql_query("SELECT * FROM blog WHERE `owner`='$owner' ORDER BY `id` DESC LIMIT 30");
  if(mysql_num_rows($qry)==0) {
    $output .= infobox(t("Você ainda não postou em seu blog."), false);
  } else {
    while($post = mysql_fetch_array($qry)) {
      $post_author = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE `id`='$post[owner]'"));
      // begin post
      $output .= '<div class="row">
                    <h3><a name="post_'.$post['id'].'">'.$post['title'].'</a></h3>
                    <p>'.url("blog/edita/$post[id]", t("[editar]")).' '.url("blog/remove/$post[id]", t("[excluir]")).'<br>
                      <i>'.date($dateformat, $post['date']).'</i><br/>
                      '.bbcode($post['text']).'
                    </p>';
      // end post
      $commnt = mysql_query("SELECT * FROM blog_comments WHERE `post`='$post[id]' ORDER BY `id` DESC LIMIT 20");
      if(mysql_num_rows($commnt)!=0) {
        while($comment = mysql_fetch_array($commnt)) {
          $comment_author = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE `id`='$comment[owner]'"));
          // begin comments
          $output .= "\n".'<blockquote>'.url("user/profile/$comment_author[login]", $comment_author['login']).': '.
                      bbcode($comment['content']).'</blockquote><br/>';
          // end comments
        }
      }
      $output .= '<p>
<form action="'.$home.'blog/commentpost" method="post">
<input type="hidden" name="post" value="'.$post['id'].'">
<input type="hidden" name="post_author" value="'.$post_author['login'].'">
<textarea rows="3" cols="25" name="content"></textarea><br>
<input type="submit" value="'.t("Comentar").'">
</form>
</p>
</div>';
    }
  }
  section($output, t("Meu blog"));
}

function create() {
  global $home;
  requirelogin();
  section('<form method="post" action="'.$home.'blog/createpost">
<p><label for="title">Título:</label><br/>
<input type="text" name="title" id="title"></p>
<p><textarea rows="5" cols="25" name="text"></textarea></p>
<p><input type="submit" value="Postar"></p>
</form>', "Postar");
}

function createpost() {
  requirelogin();
  $_POST = array_map('protect', $_POST);
  $title = is_null($_POST['title']) ? t("Sem título") : $_POST['title'];
  $text = nl2br($_POST['text']);
  $owner = $_SESSION['id'];
  $date = time();
  mysql_query("INSERT INTO blog (`owner`, `title`, `text`, `date`)
                         VALUES ('$owner', '$title', '$text', '$date');");
  note(t("postou em seu blog."), $_SESSION['id']);
  redir("blog");
}

function commentpost() {
  requirelogin();
  $_POST = array_map('protect', $_POST);
  $owner = $_SESSION['id'];
  $post = $_POST['post'];
  $post_author = $_POST['post_author'];
  $content = $_POST['content'];
  mysql_query("INSERT INTO blog_comments (`owner`, `post`, `content`)
                                  VALUES ('$owner', '$post', '$content');");
  redir("blog/lista/$post_author#post_$post");
}

function lista($user) {
  global $dateformat,$home;
  requirelogin();
  include("libs/accounts.php");
  $output = menu($user);
  $owner = resolveuser($user);
  $qry = mysql_query("SELECT * FROM blog WHERE `owner`='$owner' ORDER BY `id` DESC LIMIT 30");
  if(mysql_num_rows($qry)==0) {
    $output .= infobox($user.' '.t("ainda não postou em seu blog."), false);
  } else {
    while($post = mysql_fetch_array($qry)) {
      $post_author = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE `id`='$post[owner]'"));
      // begin post
      $output .= '<div class="row">
                    <h3><a name="post_'.$post['id'].'">'.$post['title'].'</a></h3>
                    <p><i>'.date($dateformat, $post['date']).'</i><br/>
                      '.bbcode($post['text']).'
                    </p>';
      // end post
      $commnt = mysql_query("SELECT * FROM blog_comments WHERE `post`='$post[id]' ORDER BY `id` DESC LIMIT 20");
      if(mysql_num_rows($commnt)!=0) {
        while($comment = mysql_fetch_array($commnt)) {
          $comment_author = mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE `id`='$comment[owner]'"));
          // begin comments
          $output .= "\n".'<blockquote>'.url("user/profile/$comment_author[login]", $comment_author['login']).': '.
                      bbcode($comment['content']).'</blockquote><br/>';
          // end comments
        }
      }
      $output .= '<p>
<form action="'.$home.'blog/commentpost" method="post">
<input type="hidden" name="post" value="'.$post['id'].'">
<input type="hidden" name="post_author" value="'.$post_author['login'].'">
<textarea rows="3" cols="25" name="content"></textarea><br>
<input type="submit" value="Comentar">
</form>
</p>
</div>';
    }
  }
  section($output, t("Blog de").' '.$user);
}

function remove($post) {
  requirelogin();
  $post = protect($post);
  $owner = $_SESSION['id'];
  $qry = mysql_query("SELECT * FROM blog WHERE `id`='$post' AND `owner`='$owner'");
  if(mysql_numrows($qry)!=0) {
    mysql_query("DELETE FROM blog WHERE `id`='$post'");
    mysql_query("DELETE FROM blog_comments WHERE `post`='$post'");
  }
  infobox(t("Post excluído com sucesso."));
}

function edita($post) {
  global $home;
  requirelogin();
  $post = protect($post);
  $qry = mysql_query("SELECT * FROM blog WHERE `id`='$post' AND `owner`='$_SESSION[id]'");
  if(mysql_numrows($qry)==0) {
    redir("error");
  }
  $qry = mysql_fetch_array($qry);
  section('<form method="post" action="'.$home.'blog/editapost">
<input type="hidden" name="post" value="'.$post.'">
<p><label for="title">Título:</label><br/>
<input type="text" name="title" id="title" value="'.$qry['title'].'"></p>
<p><textarea rows="5" cols="25" name="text">'.$qry['text'].'</textarea></p>
<p><input type="checkbox" name="modifydate">Atualizar data do post</p>
<p><input type="submit" value="Postar"></p>
</form>', "Postar");
}

function editapost() {
  requirelogin();
  $_POST = array_map('protect', $_POST);
  $title = is_null($_POST['title']) ? t("Sem título") : $_POST['title'];
  $content = $_POST['text'];
  $post = $_POST['post'];
  $post = protect($post);
  $qry = mysql_query("SELECT * FROM blog WHERE `id`='$post' AND `owner`='$_SESSION[id]'");
  if(mysql_numrows($qry)==0) {
    redir("error");
  }
  mysql_query("UPDATE blog SET `title`='$title', `text`='$content' WHERE `id`='$post'");
  if($_POST['modifydate']) {
    $now = time();
    mysql_query("UPDATE blog SET `date`='$now' WHERE `id`='$post'");
  }
  infobox(t("Atualizado com sucesso."));
}