<?php
/**
 * Created by PhpStorm.
 * User: Ibnu
 * Date: 27/12/2015
 * Time: 19.35
 */

namespace Prajurit\Form;


use Zend\Form\Form;

class PrajuritForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('prajurit');
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'nama',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nama Prajurit',
            ),
        ));

        $this->add(array(
            'name' => 'pangkat',
            'type' => 'Text',
            'options' => array(
                'label' => 'Pangkat Prajurit',
            ),
        ));

        $this->add(array(
            'name' => 'inmission',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'labels' => "Dalam Misi?",
                'options' => array(
                    '1' => 'Ya',
                    '2' => 'Tidak',
                ),
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Tambah',
                'id' => 'submitbutton',
            ),
        ));
    }
}