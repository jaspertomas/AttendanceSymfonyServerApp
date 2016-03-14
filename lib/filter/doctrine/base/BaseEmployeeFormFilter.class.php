<?php

/**
 * Employee filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEmployeeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Record'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Record'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('employee_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Employee';
  }

  public function getFields()
  {
    return array(
      'id'   => 'Number',
      'name' => 'ForeignKey',
    );
  }
}
