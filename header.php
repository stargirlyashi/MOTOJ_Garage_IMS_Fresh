<?php
$pageTitle=$pageTitle??"MOTO’J Garage IMS"; $loggedIn=!empty($_SESSION['user_id']);
?><!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?=htmlspecialchars($pageTitle,ENT_QUOTES,'UTF-8')?></title><link rel="stylesheet" href="assets/css/style.css"></head><body>
<header class="top"><a class="brand" href="<?=$loggedIn?'inventory.php':'login.php'?>"><span class="mark">MJ</span><span><b>MOTO’J Garage</b><small>Inventory Management System</small></span></a>
<?php if($loggedIn):?><nav><a href="inventory.php">Inventory</a><a href="xml/inventory_export.php">Export XML</a><a href="logout.php">Log out</a></nav><?php endif;?></header><main class="wrap">
