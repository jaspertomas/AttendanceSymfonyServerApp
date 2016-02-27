<?php

/**
 * AccountCategory filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAccountCategoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'code'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'account_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccountType'), 'add_empty' => true)),
      'parent_code'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'            => new sfValidatorPass(array('required' => false)),
      'code'            => new sfValidatorPass(array('required' => false)),
      'account_type_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccountType'), 'column' => 'id')),
      'parent_code'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('account_category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountCategory';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'name'            => 'Text',
      'code'            => 'Text',
      'account_type_id' => 'ForeignKey',
      'parent_code'     => 'Text',
    );
  }
}
