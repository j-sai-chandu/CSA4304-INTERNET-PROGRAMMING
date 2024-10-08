<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>jQuery Ajax Comment System - Demo</title>
<link rel="stylesheet" href="css/style.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/script.js"></script>
</head>
<body>
<div class="wrap">
<h1> Maggy Noodles Comment System</h1>
<?php
?>
// retrive post include('config.php'); include ('function.php'); dbConnect();
$query = mysql_query(
'SELECT *
FROM post
WHERE post_id = 1');
$row = mysql_fetch_array($query);
<div class="post">
<h2><?php echo $row['post_title']?></h2>
<p><?php echo $row['post_body']?></p>
<?php
</div>
// retrive comments with post id
$comment_query = mysql_query( "SELECT *
FROM comment
WHERE post_id = {$row['post_id']} ORDER BY comment_id DESC LIMIT 15");
55
?>
<h2>Comments. ... </h2>
<div class="comment-block">
<?php while($comment = mysql_fetch_array($comment_query)): ?>
<div class="comment-item">
<div class="comment-avatar">
<img src="<?php echo avatar($comment['mail']) ?>" alt="avatar">
</div>
<div class="comment-post">
<h3><?php echo $comment['name'] ?> <span>said. ...</span></h3>
<p><?php echo $comment['comment']?></p>
</div>
</div>
<?php endwhile?>
</div>
<h2>Submit new comment</h2>
<!--comment form -->
<form id="form" method="post">
<!-- need to supply post id with hidden fild -->
<input type="hidden" name="postid" value="<?php echo $row['post_id']?>">
<label>
<span>Name *</span>
<input type="text" name="name" id="comment-name" placeholder="Your name here ... " required>
</label>
<label>
<span>Email *</span>
<input type="email" name="mail" id="comment-mail" placeholder="Your mail here ... " required>
</label>
<label>
<span>Your comment *</span>
<textarea name="comment" id="comment" cols="30" rows="10" placeholder="Type your comment here ... " required></textarea>
</label>
<input type="submit" id="submit" value="Submit Comment">
</form>
</div>
</body>
</html>
Ajax_Comment.php
<?php
if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] )):
include('config.php'); include('function.php'); dbConnect();
if (!empty($_POST['name']) AND !empty($_POST['mail']) AND
!empty($_POST['comment']) AND !empty($_POST['postid'])) {
$name = mysql_real_escape_string($_POST['name']);
$mail = mysql_real_escape_string($_POST['mail']);
$comment = mysql_real_escape_string($_POST['comment']);
$postId = mysql_real_escape_string($_POST['postid']);
56
mysql_query("
INSERT INTO comment (name, mail, comment, post_id)
VALUES('{$name}', '{$mail}', '{$comment}', '{$postId}')");
}
?>
<div class="comment-item">
<div class="comment-avatar">
<img src="<?php echo avatar($mail) ?>" alt="avatar">
</div>
<div class="comment-post">
<h3><?php echo $name ?> <span>said. .. </span></h3>
<p><?php echo $comment?></p>
</div>
<?php
</div>
dbConnect(0);
endif?>
Config.php
<?php
# db configuration define('DB_HOST', 'localhost'); define('DB_USER', 'root');
define('DB_PASS', 'root'); define('DB_NAME', 'dbname');
?>
Function.php
<?php
/**
* Connect to mysql server
* @param bool
* @use true to connect false to close
*/
function dbConnect($close=true){ if (!$close) {
mysql_close($link); return true;
}
$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Could not connect to MySQL DB ') . mysql_error();
if (!mysql_select_db(DB_NAME, $link)) return false;
}
/**
* gravatar Image
* @see http://en.gravatar.com/site/implement/images/
*/
function avatar($mail, $size = 60){
$url = "http://www.gravatar.com/avatar/";
$url .= md5( strtolower( trim( $mail ) ) );
57
// $url .= "?d=" . urlencode( $default );
$url .= "&s=" . $size; return $url;
}
?>
Style.CSS
/* general styling */
*{
}
body{
}
.wrap{
}
margin: 0;
padding: 0;
box-sizing: border-box;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
-webkit-font-smoothing: antialiased;
-moz-font-smoothing: antialiased;
ont-smoothing: antialiased; font-smoothing: antialiased;
text-rendering: optimizeLegibility;
font: 12px Arial,Tahoma,Helvetica,FreeSans,sans-serif; text-transform: inherit;
color: #333; background: #e7edee; width: 100%;
text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2)
width: 720px; margin: 15px auto; padding: 15px 20px; background: white;
border: 2px solid #DBDBDB;
-webkit-border-radius: 5px;
-moz-border-radius: 5px; border-radius: 5px; overflow: hidden;
a{ text-decoration: none; color: #333} h1{
font-family: Georgia, "Times New Roman", Times, serif; font-size: 2.8em;
text-align: center; margin: 25px 0;
}
h2{font-size: 1.5em; margin: 8px 0} h3{
font-size: 1.2em; margin: 5px 0;
58
}
h3 span{
59
}
.item{
}
font-weight: normal; font-size: 1em;
clear: both; margin:0; padding: 10px; overflow: hidden;
border-top: 1px solid #DBDBDB;
.item:last-child{border-bottom:1px solid #DBDBDB}
.item:hover{background: #f9f9f9}
.post{
padding: 10px 0;
border-bottom: 1px solid #E6E6E6;
}
.comment-block{
margin: 20px 0 20px 20px;
}
.comment-item{
overflow: hidden; width: 500px; clear: both; padding: 10px;
border: 1px solid #E6E6E6; border-radius: 5px;
margin: 5px;
}
.comment-avatar{
width: 60px; float: left;
}
.comment-avatar img{
width: 60px; height: 60px; border-radius: 5px;
}
.comment-post{
width: 400px; float: left;
padding: 0 5px 0 10px;
}
#form{
}
clear: both; margin: 10px; width: 500px;
/* form styling */ input[type="text"], input[type="email"], input[type="tel"], input[type="url"],
60
textarea {
width:100%; background: #fff; border: 1px solid #ddd; font-size: 13px;
line-height: 20px; margin: 0; padding: 7px 10px;
box-shadow: inset 0 1px 2px #eee; border:1px solid #CCC;
margin:0 0 5px; border-radius:5px;
}
textarea {
height:100px; max-width:100%;
}
input[type="submit"] {
cursor:pointer; width:100%; border:none; background:#991D57;
background-image:linear-gradient(bottom, #8C1C50 0%, #991D57 52%);
background-image:-moz-linear-gradient(bottom, #8C1C50 0%, #991D57 52%);
background-image:-webkit-linear-gradient(bottom, #8C1C50 0%, #991D57 52%); color:#FFF;
margin:0 0 5px; padding:10px; border-radius:5px;
}
input[type="submit"]:hover {
background-image:linear-gradient(bottom, #9C215A 0%, #A82767 52%);
background-image:-moz-linear-gradient(bottom, #9C215A 0%, #A82767 52%);
background-image:-webkit-linear-gradient(bottom, #9C215A 0%, #A82767 52%);
-webkit-transition:background 0.3s ease-in-out;
-moz-transition:background 0.3s ease-in-out; transition:background-color 0.3s ease-in-out;
}
input[type="submit"]:active {
box-shadow:inset 0 1px 3px rgba(0,0,0,0.5);
}
input:focus, textarea:focus {
outline:0;
border:1px solid #999;
}
label{
}
display: block; margin: 5px 0;
font-weight: 900; cursor: pointer;
61
.alert{
}
display: none;
padding: 8px 35px 8px 14px; margin: 20px 0;
text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
color: #468847; background-color: #dff0d8; border-color: #d6e9c6;
-webkit-border-radius: 4px;
-moz-border-radius: 4px; border-radius: 4px;
Script.js
$(document).ready(function(){ var form = $('form');
var submit = $('#submit');
form.on('submit', function(e) {
// prevent default action e.preventDefault();
// send ajax request
$.ajax({
url: 'ajax_comment.php', type: 'POST',
cache: false,
data: form.serialize(), //form serizlize data beforeSend: function(){
// change submit button value text and disabled it submit.val('Submitting...').attr('disabled', 'disabled');
},
success: function(data){
// Append with fadeIn see http://stackoverflow.com/a/978731 var item = $(data).hide().fadeIn(800);
$('.comment-block').append(item);
// reset form and button form.trigger('reset');
submit.val('Submit Comment').removeAttr('disabled');
},
error: function(e){
alert(e);
});