<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Record', 'doctrine');

/**
 * BaseRecord
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $employee_name
 * @property string $datetime
 * @property string $filename
 * @property integer $is_valid
 * 
 * @method integer getId()            Returns the current record's "id" value
 * @method string  getEmployEE_namE() Returns the current record's "employee_name" value
 * @method string  getDatetime()      Returns the current record's "datetime" value
 * @method string  getFilename()      Returns the current record's "filename" value
 * @method integer getIs_valId()      Returns the current record's "is_valid" value
 * @method Record  setId()            Sets the current record's "id" value
 * @method Record  setEmployEE_namE() Sets the current record's "employee_name" value
 * @method Record  setDatetime()      Sets the current record's "datetime" value
 * @method Record  setFilename()      Sets the current record's "filename" value
 * @method Record  setIs_valId()      Sets the current record's "is_valid" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRecord extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('record');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('employee_name', 'string', 25, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('datetime', 'string', 20, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 20,
             ));
        $this->hasColumn('filename', 'string', 30, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 30,
             ));
        $this->hasColumn('is_valid', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}