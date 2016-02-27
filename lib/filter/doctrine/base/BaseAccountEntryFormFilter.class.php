<?php

/**
 * AccountEntry filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAccountEntryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Account'), 'add_empty' => true)),
      'date'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'description' => new sfWidgetFormFilterInput(),
      'amount'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'notes'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'account_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Account'), 'column' => 'id')),
      'date'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'description' => new sfValidatorPass(array('required' => false)),
      'amount'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'notes'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('account_entry_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountEntry';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'account_id'  => 'ForeignKey',
      'date'        => 'Date',
      'description' => 'Text',
      'amount'      => 'Number',
      'created_at'  => 'Date',
      'notes'       => 'Text',
    );
  }
}
