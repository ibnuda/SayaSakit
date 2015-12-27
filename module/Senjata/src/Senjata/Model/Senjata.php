<?php
/**
 * Created by PhpStorm.
 * User: Ibnu
 * Date: 27/12/2015
 * Time: 20.53
 */

namespace Senjata\Model;


use Zend\InputFilter\InputFilterInterface;

class Senjata
{
    public $id;
    public $jenis;
    public $inmission;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->jenis = (!empty($data['nama'])) ? $data['nama'] : null;
        $this->inmission = (!empty($data['inmission'])) ? $data['inmission'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilterInterface)
    {
        throw new \Exception('Not used');
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter){
            $inputFilter = new InputFilter();
            $inputFilter->add(array(
                'name' => 'id',
                'required' => 'true',
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'jenis',
                'required' => 'true',
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'inmission',
                'required' => 'true',
            ));
        }

        return $inputFilter;
    }
}