<?php
declare(strict_types=1);
require_once __DIR__.'/config/auth.php';
if(!empty($_SESSION['user_id'])){header('Location: inventory.php');exit;}
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $username=trim((string)($_POST['username']??'')); $password=(string)($_POST['password']??'');
 if($username===''||$password==='') $error='Username and password are required.';
 elseif(hash_equals(OWNER_USERNAME,$username)&&hash_equals(OWNER_PASSWORD,$password)){
  session_regenerate_id(true);$_SESSION['user_id']=1;$_SESSION['username']=OWNER_USERNAME;header('Location: inventory.php');exit;
 } else $error='Invalid username or password.';
}
$pageTitle="Login | MOTO’J Garage";require __DIR__.'/includes/header.php';
?><div class="login-wrap"><section class="card login-card"><div class="login-brand"><div class="mark">MJ</div><h1>MOTO’J Garage</h1><p>Online Inventory Management System</p></div>
<?php if($error!==''):?><div class="alert"><?=htmlspecialchars($error,ENT_QUOTES,'UTF-8')?></div><?php endif;?>
<form class="login-form" method="post" action="login.php"><div class="group"><label for="username">Username</label><input class="control" id="username" name="username" autocomplete="username" maxlength="100" required></div>
<div class="group"><label for="password">Password</label><input class="control" type="password" id="password" name="password" autocomplete="current-password" required></div><button class="btn primary" type="submit">Log In</button></form><p class="note">Authorized inventory personnel only.</p></section></div>
<?php require __DIR__.'/includes/footer.php';?>
