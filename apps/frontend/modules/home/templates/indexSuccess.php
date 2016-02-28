<h1>Home Page</h1>

<?php if($sf_user->hasCredential(array('admin'), false)){?>
<h1><?php //echo link_to("View temporary invoices (For Approval)",'invoice/listforapproval'); ?></h1>
<?php } ?>

<?php
/*
      $products= Doctrine_Query::create()
        ->from('Product p')
  ->where('p.id >=390')
  ->andWhere('p.id<=395')
  ->execute();

foreach($products as $product)
{
	$product->setName($product->getName()." Square Raised");
	$product->save();
}
*/

//echo sha1("cc1f2f6421dde7479bdb328774efd1c7"."admin");

?>
