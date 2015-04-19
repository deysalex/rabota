<?php
/**
 * Created by PhpStorm.
 * User: Deys
 * Date: 11.04.2015
 * Time: 17:57
 */
namespace Business\Model\Table;

use Business\Model\Object\Vacancy;
use Zend\Db\TableGateway\TableGateway;

class VacancyTable
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

    public function getById($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function save(Vacancy $vacancy)
    {
        $data = array(
            'title'  => $vacancy->title,
            'description'  => $vacancy->description,
            'education'  => $vacancy->education,
            'price'  => $vacancy->price,
        );

        $id = (int) $vacancy->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getById($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('User id does not exist');
            }
        }
    }

    public function deleteById($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}