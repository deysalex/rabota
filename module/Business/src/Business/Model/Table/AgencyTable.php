<?php
/**
 * Created by PhpStorm.
 * User: Deys
 * Date: 11.04.2015
 * Time: 17:57
 */
namespace Business\Model\Table;

use Business\Model\Object\Agency;
use Zend\Db\TableGateway\TableGateway;

class AgencyTable
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

    public function get($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function save(Agency $agency)
    {
        $data = array(
            'title'  => $agency->title,
            'description'  => $agency->description,
        );

        $id = (int) $agency->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->get($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Agency id does not exist');
            }
        }
    }

    public function delete($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}