<?php


class Application_Model_TicketMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Ticket');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Ticket $ticket)
    {
        $data = array(
            'title'   => $ticket->getTitle(),
            'detail' => $ticket->getDetail(),
            'priority' => $ticket->getPriority(),
            'attachment' => $ticket->getAttachment(),
            'created' => date('Y-m-d H:i:s'),
        );

        if (null === ($id = $ticket->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_Ticket $ticket)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $ticket->setId($row->id)
            ->setTitle($row->title)
            ->setDetail($row->detail)
            ->setPriority($row->priority)
            ->setAttachment($row->attachment)
            ->setCreated($row->created);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Ticket();
            $entry->setId($row->id)
                ->setTitle($row->title)
                ->setDetail($row->detail)
                ->setPriority($row->priority)
                ->setAttachment($row->attachment)
                ->setCreated($row->created);
            $entries[] = $entry;
        }
        return $entries;
    }
    public function fetchAllArray()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        return $resultSet;
    }
    public function delete($id)
    {
        $table = new Application_Model_DbTable_Ticket();

        $where = $table->getAdapter()->quoteInto('id = ?', $id);

        $table->delete($where);
    }
}
