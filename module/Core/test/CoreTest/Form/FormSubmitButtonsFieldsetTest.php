<?php

namespace CoreTest\Form;

use Core\Form\FormSubmitButtonsFieldset;
use Zend\Form\Element\Button;

/**
 * @covers Core\Form\FormSubmitButtonsFieldset
 */
class FormSubmitButtonsFieldsetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Core\Form\FormSubmitButtonsFieldset
     */
    private $formSubmitButton;

    public function setUp()
    {
        $this->formSubmitButton = new FormSubmitButtonsFieldset();
    }

    public function testInit()
    {
        $this->formSubmitButton->init();

        $this->assertSame('buttons', $this->formSubmitButton->getName());
        $this->assertInstanceOf(Button::class, $this->formSubmitButton->get('submit'));
        $this->assertInstanceOf(Button::class, $this->formSubmitButton->get('cancel'));
    }

    public function testSetOptions()
    {
        $this->formSubmitButton->init();

        $result = $this->formSubmitButton->setOptions(['save_label' => 'foo']);

        $this->assertInstanceOf(FormSubmitButtonsFieldset::class, $result);
        $this->assertSame('foo', $this->formSubmitButton->get('submit')->getLabel());
    }
}
