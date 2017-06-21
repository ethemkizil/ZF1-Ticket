<?php

class Application_Form_Ticket extends Zend_Form
{

    public function init()
    {
        $this->setAttrib('enctype', 'multipart/form-data');

        $this->setMethod('post');

        $this->addElement('text', 'title', array(
            'label' => 'Title :',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 300))
            )
        ));

        $this->addElement('textarea', 'detail', array(
            'label' => 'Detail :',
            'required' => true,
            'rows'=> 10,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 300))
            )
        ));

        $this->addElement('select', 'priority', array(
            'label' => 'Priority :',
            'value' => '2',
            'required' => true,
            'multiOptions' => array(
                '1'    => 'Low',
                '2'   => 'Normal',
                '3'  => 'High',
            ),
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 1000))
            )
        ));

        $element = new Zend_Form_Element_File('attachment');
        $element->setLabel('Upload attachment:')->setDestination('upload');
        $element->addValidator('Count', false, 1);
        $element->addValidator('Size', false, 102400);
        $element->setValueDisabled(false);
        $this->addElement($element, 'attachment');

        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Add Ticket',
            'class' => 'btn btn-primary'
        ));

        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }


}

