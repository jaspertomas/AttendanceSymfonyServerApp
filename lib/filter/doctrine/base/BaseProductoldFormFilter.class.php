<?php

/**
 * Productold filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProductoldFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'         => new sfWidgetFormFilterInput(),
      'refnum'       => new sfWidgetFormFilterInput(),
      'timestamp'    => new sfWidgetFormFilterInput(),
      'invitemtype'  => new sfWidgetFormFilterInput(),
      'desc'         => new sfWidgetFormFilterInput(),
      'purchasedesc' => new sfWidgetFormFilterInput(),
      'accnt'        => new sfWidgetFormFilterInput(),
      'assetaccnt'   => new sfWidgetFormFilterInput(),
      'cogsaccnt'    => new sfWidgetFormFilterInput(),
      'qnty'         => new sfWidgetFormFilterInput(),
      'qnty1'        => new sfWidgetFormFilterInput(),
      'price'        => new sfWidgetFormFilterInput(),
      'cost'         => new sfWidgetFormFilterInput(),
      'taxable'      => new sfWidgetFormFilterInput(),
      'salestaxcode' => new sfWidgetFormFilterInput(),
      'paymeth'      => new sfWidgetFormFilterInput(),
      'taxvend'      => new sfWidgetFormFilterInput(),
      'prefvend'     => new sfWidgetFormFilterInput(),
      'reorderpoint' => new sfWidgetFormFilterInput(),
      'extra'        => new sfWidgetFormFilterInput(),
      'custfld1'     => new sfWidgetFormFilterInput(),
      'custfld2'     => new sfWidgetFormFilterInput(),
      'custfld3'     => new sfWidgetFormFilterInput(),
      'custfld4'     => new sfWidgetFormFilterInput(),
      'custfld5'     => new sfWidgetFormFilterInput(),
      'dep_type'     => new sfWidgetFormFilterInput(),
      'ispassedthru' => new sfWidgetFormFilterInput(),
      'hidden'       => new sfWidgetFormFilterInput(),
      'delcount'     => new sfWidgetFormFilterInput(),
      'useid'        => new sfWidgetFormFilterInput(),
      'isnew'        => new sfWidgetFormFilterInput(),
      'po_num'       => new sfWidgetFormFilterInput(),
      'serialnum'    => new sfWidgetFormFilterInput(),
      'warranty'     => new sfWidgetFormFilterInput(),
      'location'     => new sfWidgetFormFilterInput(),
      'vendor'       => new sfWidgetFormFilterInput(),
      'assetdesc'    => new sfWidgetFormFilterInput(),
      'saledate'     => new sfWidgetFormFilterInput(),
      'saleexpense'  => new sfWidgetFormFilterInput(),
      'notes'        => new sfWidgetFormFilterInput(),
      'assetnum'     => new sfWidgetFormFilterInput(),
      'costbasis'    => new sfWidgetFormFilterInput(),
      'accumdepr'    => new sfWidgetFormFilterInput(),
      'unrecbasis'   => new sfWidgetFormFilterInput(),
      'purchasedate' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'         => new sfValidatorPass(array('required' => false)),
      'refnum'       => new sfValidatorPass(array('required' => false)),
      'timestamp'    => new sfValidatorPass(array('required' => false)),
      'invitemtype'  => new sfValidatorPass(array('required' => false)),
      'desc'         => new sfValidatorPass(array('required' => false)),
      'purchasedesc' => new sfValidatorPass(array('required' => false)),
      'accnt'        => new sfValidatorPass(array('required' => false)),
      'assetaccnt'   => new sfValidatorPass(array('required' => false)),
      'cogsaccnt'    => new sfValidatorPass(array('required' => false)),
      'qnty'         => new sfValidatorPass(array('required' => false)),
      'qnty1'        => new sfValidatorPass(array('required' => false)),
      'price'        => new sfValidatorPass(array('required' => false)),
      'cost'         => new sfValidatorPass(array('required' => false)),
      'taxable'      => new sfValidatorPass(array('required' => false)),
      'salestaxcode' => new sfValidatorPass(array('required' => false)),
      'paymeth'      => new sfValidatorPass(array('required' => false)),
      'taxvend'      => new sfValidatorPass(array('required' => false)),
      'prefvend'     => new sfValidatorPass(array('required' => false)),
      'reorderpoint' => new sfValidatorPass(array('required' => false)),
      'extra'        => new sfValidatorPass(array('required' => false)),
      'custfld1'     => new sfValidatorPass(array('required' => false)),
      'custfld2'     => new sfValidatorPass(array('required' => false)),
      'custfld3'     => new sfValidatorPass(array('required' => false)),
      'custfld4'     => new sfValidatorPass(array('required' => false)),
      'custfld5'     => new sfValidatorPass(array('required' => false)),
      'dep_type'     => new sfValidatorPass(array('required' => false)),
      'ispassedthru' => new sfValidatorPass(array('required' => false)),
      'hidden'       => new sfValidatorPass(array('required' => false)),
      'delcount'     => new sfValidatorPass(array('required' => false)),
      'useid'        => new sfValidatorPass(array('required' => false)),
      'isnew'        => new sfValidatorPass(array('required' => false)),
      'po_num'       => new sfValidatorPass(array('required' => false)),
      'serialnum'    => new sfValidatorPass(array('required' => false)),
      'warranty'     => new sfValidatorPass(array('required' => false)),
      'location'     => new sfValidatorPass(array('required' => false)),
      'vendor'       => new sfValidatorPass(array('required' => false)),
      'assetdesc'    => new sfValidatorPass(array('required' => false)),
      'saledate'     => new sfValidatorPass(array('required' => false)),
      'saleexpense'  => new sfValidatorPass(array('required' => false)),
      'notes'        => new sfValidatorPass(array('required' => false)),
      'assetnum'     => new sfValidatorPass(array('required' => false)),
      'costbasis'    => new sfValidatorPass(array('required' => false)),
      'accumdepr'    => new sfValidatorPass(array('required' => false)),
      'unrecbasis'   => new sfValidatorPass(array('required' => false)),
      'purchasedate' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('productold_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Productold';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'name'         => 'Text',
      'refnum'       => 'Text',
      'timestamp'    => 'Text',
      'invitemtype'  => 'Text',
      'desc'         => 'Text',
      'purchasedesc' => 'Text',
      'accnt'        => 'Text',
      'assetaccnt'   => 'Text',
      'cogsaccnt'    => 'Text',
      'qnty'         => 'Text',
      'qnty1'        => 'Text',
      'price'        => 'Text',
      'cost'         => 'Text',
      'taxable'      => 'Text',
      'salestaxcode' => 'Text',
      'paymeth'      => 'Text',
      'taxvend'      => 'Text',
      'prefvend'     => 'Text',
      'reorderpoint' => 'Text',
      'extra'        => 'Text',
      'custfld1'     => 'Text',
      'custfld2'     => 'Text',
      'custfld3'     => 'Text',
      'custfld4'     => 'Text',
      'custfld5'     => 'Text',
      'dep_type'     => 'Text',
      'ispassedthru' => 'Text',
      'hidden'       => 'Text',
      'delcount'     => 'Text',
      'useid'        => 'Text',
      'isnew'        => 'Text',
      'po_num'       => 'Text',
      'serialnum'    => 'Text',
      'warranty'     => 'Text',
      'location'     => 'Text',
      'vendor'       => 'Text',
      'assetdesc'    => 'Text',
      'saledate'     => 'Text',
      'saleexpense'  => 'Text',
      'notes'        => 'Text',
      'assetnum'     => 'Text',
      'costbasis'    => 'Text',
      'accumdepr'    => 'Text',
      'unrecbasis'   => 'Text',
      'purchasedate' => 'Text',
    );
  }
}
