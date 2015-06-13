<?php


namespace Album\Form;


use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods;

class Search extends Form
{

    /**
     * Search constructor.
     */
    public function __construct()
    {
        parent::__construct('album');

        $this->add(array(
            'name' => 'album',
            'type' => 'Text',
            'options' => array(
                'label' => 'Album Name',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Enter Album Name'
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Search',
                'id' => 'submitbutton',
            ),
        ));

        $this
            ->setAttribute('method', 'post')
            ->setHydrator(new ClassMethods(false))
            ->setInputFilter(new InputFilter())
        ;

    }
}