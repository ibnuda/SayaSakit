<?php
/**
 * Created by PhpStorm.
 * User: Ibnu
 * Date: 27/12/2015
 * Time: 16.19
 */

namespace Prajurit\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Prajurit implements InputFilterAwareInterface
{
    public $id;
    public $nama;
    public $pangkat;
    public $inmission;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->nama = (!empty($data['nama'])) ? $data['nama'] : null;
        $this->pangkat = (!empty($data['pangkat'])) ? $data['pangkat'] : null;
        $this->inmission = (!empty($data['inmission'])) ? $data['inmission'] : null;
    }

    /**
     * Set input filter
     *
     * @param  InputFilterInterface $inputFilter
     * @return InputFilterAwareInterface
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception('Not used');
    }

    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
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
                'name' => 'nama',
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
                'name' => 'pangkat',
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

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}