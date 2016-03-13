<?php

/**
 * AccountEntry form base class.
 *
 * @method AccountEntry getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAccountEntryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'account_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Account'), 'add_empty' => false)),
      'date'            => new sfWidgetFormDate(),
      'description'     => new sfWidgetFormTextarea(),
      'amount'          => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'notes'           => new sfWidgetFormTextarea(),
      'android_id'      => new sfWidgetFormInputText(),
      'android_user_id' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'account_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Account'))),
      'date'            => new sfValidatorDate(),
      'description'     => new sfValidatorString(array('required' => false)),
      'amount'          => new sfValidatorNumber(),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'notes'           => new sfValidatorString(array('required' => false)),
      'android_id'      => new sfValidatorInteger(array('required' => false)),
      'android_user_id' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('account_entry[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountEntry';
  }

}
