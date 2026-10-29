<?php
declare(strict_types=1);
require_once __DIR__.'/config/auth.php';require_login();require_once __DIR__.'/config/database.php';
$errors=[];$v=['item_name'=>'','brand_model_variant'=>'','quantity'=>'','price'=>'','date'=>''];
if($_SERVER['REQUEST_METHOD']==='POST'){
 foreach($v as $k=>$old)$v[$k]=trim((string)($_POST[$k]??''));
 if($v['item_name']==='')$errors[]='Item name is required.';
 if($v['brand_model_variant']==='')$errors[]='Brand/model/variant is required.';
 if($v['quantity']===''||filter_var($v['quantity'],FILTER_VALIDATE_INT)===false||(int)$v['quantity']<0)$errors[]='Quantity must be a whole number equal to or greater than zero.';
 if($v['price']===''||!is_numeric($v['price'])||(float)$v['price']<0)$errors[]='Price must be a non-negative number.';
 $d=DateTime::createFromFormat('!Y-m-d',$v['date']);if(!$d||$d->format('Y-m-d')!==$v['date'])$errors[]='A valid date is required.';
 if(!$errors){$s=$pdo->prepare('INSERT INTO inventory(item_name,brand_model_variant,quantity,price,date) VALUES(?,?,?,?,?)');$s->execute([$v['item_name'],$v['brand_model_variant'],(int)$v['quantity'],number_format((float)$v['price'],2,'.',''),$v['date']]);header('Location: inventory.php');exit;}
}
$pageTitle='Add Inventory | MOTO’J Garage';require __DIR__.'/includes/header.php';
?><div class="heading"><div><h1>Add Inventory</h1><p>Enter all five required inventory fields.</p></div><a class="btn secondary" href="inventory.php">Back</a></div><section class="card form-card">
<?php if($errors):?><div class="alert"><ul><?php foreach($errors as $e):?><li><?=htmlspecialchars($e,ENT_QUOTES,'UTF-8')?></li><?php endforeach;?></ul></div><?php endif;?>
<form method="post" data-inventory><div class="grid">
<?php $fields=[['item_name','Item Name','text'],['brand_model_variant','Brand/Model/Variant','text'],['quantity','Quantity','number'],['price','Price (₱)','number'],['date','Date','date']];foreach($fields as [$key,$label,$type]):?>
<div class="group"><label for="<?=$key?>"><?=$label?></label><input class="control" id="<?=$key?>" name="<?=$key?>" type="<?=$type?>" <?php if($key==='quantity'):?>min="0" step="1"<?php elseif($key==='price'):?>min="0" step="0.01"<?php elseif($type==='text'):?>maxlength="150"<?php endif;?> value="<?=htmlspecialchars($v[$key],ENT_QUOTES,'UTF-8')?>" required></div>
<?php endforeach;?></div><div class="buttons"><button class="btn primary">Save Inventory</button><a class="btn secondary" href="inventory.php">Cancel</a></div></form></section><?php require __DIR__.'/includes/footer.php';?>
