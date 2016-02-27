<?php

/**
 * Account filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAccountFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'account_type_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccountType'), 'add_empty' => true)),
      'account_category_id' => new sfWidgetFormFilterInput(),
      'is_special'          => new sfWidgetFormFilterInput(),
      'currentqty'          => new sfWidgetFormFilterInput(),
      'date'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'name'                => new sfValidatorPass(array('required' => false)),
      'account_type_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccountType'), 'column' => 'id')),
      'account_category_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_special'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'currentqty'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'date'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('account_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Account';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'name'                => 'Text',
      'account_type_id'     => 'ForeignKey',
      'account_category_id' => 'Number',
      'is_special'          => 'Number',
      'currentqty'          => 'Number',
      'date'                => 'Date',
    );
  }
}
