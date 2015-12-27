<?php
/**
 * Created by PhpStorm.
 * User: Ibnu
 * Date: 27/12/2015
 * Time: 20.58
 */

namespace Senjata\src\Senjata\Model;


use Senjata\Model\Senjata;
use Zend\Db\TableGateway\TableGateway;

class SenjataTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getSenjata($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row)
            throw new \Exception("tak dapat newmu");
        return $row;
    }

    public function saveSenjata(Senjata $senjata)
    {
        $data = array(
            'id' => $senjata->id,
            'jenis' => $senjata->jenis,
            'inmission' => $senjata->inmission,
        );
        $id = (int) $senjata->id;
        if ($id === 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getSenjata($id)){
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('senjata tidak ada.');
            }
        }
    }

    public function deleteSenjata($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}