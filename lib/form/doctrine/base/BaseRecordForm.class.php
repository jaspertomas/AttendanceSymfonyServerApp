<?php

/**
 * Record form base class.
 *
 * @method Record getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRecordForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'employee_name' => new sfWidgetFormInputText(),
      'datetime'      => new sfWidgetFormInputText(),
      'filename'      => new sfWidgetFormInputText(),
      'is_valid'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'employee_name' => new sfValidatorString(array('max_length' => 25)),
      'datetime'      => new sfValidatorString(array('max_length' => 20)),
      'filename'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'is_valid'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('record[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Record';
  }

}
