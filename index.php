<?php
declare(strict_types=1);
require_once __DIR__.'/config/auth.php';
header('Location: '.(!empty($_SESSION['user_id'])?'inventory.php':'login.php')); exit;
