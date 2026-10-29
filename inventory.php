<?php
declare(strict_types=1);
require_once __DIR__.'/config/auth.php';require_login();require_once __DIR__.'/config/database.php';
$search=trim((string)($_GET['search']??''));
if($search!==''){$like='%'.$search.'%';$stmt=$pdo->prepare('SELECT id,item_name,brand_model_variant,quantity,price,date FROM inventory WHERE item_name LIKE ? OR brand_model_variant LIKE ? ORDER BY date DESC,id DESC');$stmt->execute([$like,$like]);}
else{$stmt=$pdo->query('SELECT id,item_name,brand_model_variant,quantity,price,date FROM inventory ORDER BY date DESC,id DESC');}
$items=$stmt->fetchAll();$pageTitle="Inventory | MOTO’J Garage";require __DIR__.'/includes/header.php';
?><div class="heading"><div><h1>Inventory</h1><p>View, search, add, and update inventory records.</p></div><a class="btn primary" href="add_inventory.php">+ Add Inventory</a></div>
<section class="card toolbar"><form class="search" method="get" action="inventory.php"><label class="sr-only" for="search">Search inventory</label><input class="control" type="search" id="search" name="search" value="<?=htmlspecialchars($search,ENT_QUOTES,'UTF-8')?>" placeholder="Search by item name or brand/model/variant"><button class="btn primary">Search</button><?php if($search!==''):?><a class="btn secondary" href="inventory.php">Clear</a><?php endif;?></form></section>
<?php if($search!==''):?><p class="muted">Search results: <?=count($items)?> record(s)</p><?php endif;?>
<section class="card table-card"><?php if(!$items):?><div class="empty"><p><?=$search!==''?'No inventory records match your search.':'No inventory records yet.'?></p><?php if($search!==''):?><a class="btn secondary" href="inventory.php">View all inventory</a><?php endif;?></div><?php else:?><div class="table-wrap"><table><thead><tr><th>Item Name</th><th>Brand/Model/Variant</th><th>Quantity</th><th>Price</th><th>Date</th><th>Actions</th></tr></thead><tbody>
<?php foreach($items as $item):?><tr><td><?=htmlspecialchars($item['item_name'],ENT_QUOTES,'UTF-8')?></td><td><?=htmlspecialchars($item['brand_model_variant'],ENT_QUOTES,'UTF-8')?></td><td><?=(int)$item['quantity']?></td><td>₱<?=number_format((float)$item['price'],2)?></td><td><?=htmlspecialchars($item['date'],ENT_QUOTES,'UTF-8')?></td><td><div class="actions"><a class="btn secondary" href="edit_inventory.php?id=<?=(int)$item['id']?>">Edit</a></div></td></tr><?php endforeach;?>
</tbody></table></div><?php endif;?></section><?php require __DIR__.'/includes/footer.php';?>
