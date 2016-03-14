<?php

/**
 * Record filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRecordFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'employee_name' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Employee'), 'add_empty' => true)),
      'datetime'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'filename'      => new sfWidgetFormFilterInput(),
      'is_valid'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'employee_name' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Employee'), 'column' => 'id')),
      'datetime'      => new sfValidatorPass(array('required' => false)),
      'filename'      => new sfValidatorPass(array('required' => false)),
      'is_valid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('record_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Record';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'employee_name' => 'ForeignKey',
      'datetime'      => 'Text',
      'filename'      => 'Text',
      'is_valid'      => 'Number',
    );
  }
}
