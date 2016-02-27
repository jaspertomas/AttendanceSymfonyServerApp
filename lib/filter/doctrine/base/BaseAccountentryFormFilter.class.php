<?php

/**
 * Accountentry filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAccountentryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Account'), 'add_empty' => true)),
      'qty'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'balance'      => new sfWidgetFormFilterInput(),
      'ref_class'    => new sfWidgetFormFilterInput(),
      'ref_id'       => new sfWidgetFormFilterInput(),
      'priority'     => new sfWidgetFormFilterInput(),
      'type'         => new sfWidgetFormFilterInput(),
      'is_cancelled' => new sfWidgetFormFilterInput(),
      'description'  => new sfWidgetFormFilterInput(),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'account_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Account'), 'column' => 'id')),
      'qty'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'date'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'balance'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'ref_class'    => new sfValidatorPass(array('required' => false)),
      'ref_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'priority'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'type'         => new sfValidatorPass(array('required' => false)),
      'is_cancelled' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'description'  => new sfValidatorPass(array('required' => false)),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('accountentry_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Accountentry';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'account_id'   => 'ForeignKey',
      'qty'          => 'Number',
      'date'         => 'Date',
      'balance'      => 'Number',
      'ref_class'    => 'Text',
      'ref_id'       => 'Number',
      'priority'     => 'Number',
      'type'         => 'Text',
      'is_cancelled' => 'Number',
      'description'  => 'Text',
      'created_at'   => 'Date',
    );
  }
}
