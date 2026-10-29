<?php
declare(strict_types=1);
if(session_status()!==PHP_SESSION_ACTIVE){
 session_set_cookie_params(['httponly'=>true,'samesite'=>'Lax','secure'=>!empty($_SERVER['HTTPS'])&&$_SERVER['HTTPS']!=='off']);
 session_start();
}
// Demo credentials requested for local classroom testing only.
// Replace with secure database-backed authentication before public deployment.
const OWNER_USERNAME='Joann Balud';
const OWNER_PASSWORD='12345';
function require_login(): void {
 if(empty($_SESSION['user_id'])) { header('Location: login.php'); exit; }
}
