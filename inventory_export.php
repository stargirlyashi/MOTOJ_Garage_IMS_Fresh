<?php
declare(strict_types=1);
require_once __DIR__.'/../config/auth.php';require_login();require_once __DIR__.'/../config/database.php';
if(!class_exists('XMLWriter')){http_response_code(500);exit('XML export unavailable: enable PHP XMLWriter extension.');}
$s=$pdo->query('SELECT id,item_name,brand_model_variant,quantity,price,date FROM inventory ORDER BY date DESC,id DESC');$items=$s->fetchAll();
header('Content-Type: application/xml; charset=utf-8');header('Content-Disposition: attachment; filename="motoj_inventory.xml"');
$x=new XMLWriter();$x->openURI('php://output');$x->startDocument('1.0','UTF-8');$x->setIndent(true);$x->startElement('inventoryRecords');
foreach($items as $i){$x->startElement('inventoryRecord');$x->writeElement('id',(string)$i['id']);$x->writeElement('itemName',(string)$i['item_name']);$x->writeElement('brandModelVariant',(string)$i['brand_model_variant']);$x->writeElement('quantity',(string)$i['quantity']);$x->writeElement('price',number_format((float)$i['price'],2,'.',''));$x->writeElement('date',(string)$i['date']);$x->endElement();}
$x->endElement();$x->endDocument();$x->flush();exit;
