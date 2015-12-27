<?php
/**
 * Created by PhpStorm.
 * User: Ibnu
 * Date: 27/12/2015
 * Time: 16.23
 */

namespace Prajurit\Model;

use Zend\Db\TableGateway\TableGateway;

class PrajuritTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getPrajurit($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row)
            throw new \Exception("tak dapat nemu");
        return $row;
    }

    public function savePrajurit(Prajurit $prajurit)
    {
        $data = array(
            'id' => $prajurit->id,
            'nama' => $prajurit->nama,
            'pangkat' => $prajurit->pangkat,
            'inmission' => $prajurit->inmission,
        );
        $id = (int) $prajurit->id;
        if ($id === 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getPrajurit($id)){
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('prajurit tidak ada.');
            }
        }
    }

    public function deletePrajurit($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}