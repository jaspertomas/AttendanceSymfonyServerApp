<?php


class AccountTable extends Doctrine_Table
{

    public static $ASSET=1;
    public static $LIABILITY=2;
    public static $CAPITAL=3;
    public static $INCOME=4;
    public static $EXPENSE=5;

    public static $CASH=1;
    public static $SALES_INCOME=2;
    public static $SUPPLIES_EXPENSE=3;

    public static function populate()
    {
      Doctrine_Query::create()
        ->delete('Account a')
        ->execute();

      $account=new Account();
      $account->setId(self::$CASH);
      $account->setName("Cash");
      $account->setAccountTypeId(self::$ASSET);
      $account->save();

      $account=new Account();
      $account->setId(self::$SALES_INCOME);
      $account->setName("Supplies Expense");
      $account->setAccountTypeId(self::$INCOME);
      $account->save();

      $account=new Account();
      $account->setId(self::$SUPPLIES_EXPENSE);
      $account->setName("Supplies Expense");
      $account->setAccountTypeId(self::$EXPENSE);
      $account->save();

    }
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Account');
    }
    public static function fetchById($id)
    {
       return Doctrine_Query::create()
        ->from('Account s')
        ->where('s.id ='.$id)
        ->fetchOne();
    }
    public static function fetch($warehouse_id, $product_id)
    {
       $account = Doctrine_Query::create()
        ->from('Account s')
        ->where('s.warehouse_id ='.$warehouse_id)
        ->andWhere('s.product_id ='.$product_id)
        ->fetchOne();
       if(!$account)
       {
          $account=new Account();
          $account->setWarehouseId($warehouse_id);
          $account->setProductId($product_id);
          $account->setCurrentqty(0);
          $account->setDate("2011-01-01");
          $account->save();
       }
       return $account;
    }
}
