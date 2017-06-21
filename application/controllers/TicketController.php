<?php

class TicketController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
        $this->view->messages = $this->_helper->FlashMessenger->getMessages();
        $ticket = new Application_Model_TicketMapper();
        $this->view->tickets = $ticket->fetchAll();
    }

    public function addAction()
    {
        $request = $this->getRequest();
        $form = new Application_Form_Ticket();

        if ($this->getRequest()->isPost()) {

            if ($form->isValid($request->getPost())) {
                print_r($form->getValues());
                $comment = new Application_Model_Ticket($form->getValues());
                $mapper = new Application_Model_TicketMapper();
                $mapper->save($comment);
                $this->_helper->flashMessenger->addMessage(" Ticket Added ");
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');

        $mapper = new Application_Model_TicketMapper();
        $mapper->delete($id);
        $this->_helper->flashMessenger->addMessage(" Ticket Deleted ");
        return $this->_helper->redirector('index');
    }

    public function jsonAction()
    {
        $this->_helper->viewRenderer->setNeverRender();
        $ticket = new Application_Model_TicketMapper();
        $tickets = $ticket->fetchAllArray();
        $this->getResponse()->setHeader('Content-Type', 'application/json');
        $this->getResponse()->setHttpResponseCode(200);
        return $this->_helper->json($tickets);
    }

    public function csvAction()
    {
        $this->_helper->viewRenderer->setNeverRender();
        $this->getHelper('Layout')->disableLayout();
        $this->getHelper('ViewRenderer')->setNoRender();

        $ticket = new Application_Model_TicketMapper();
        $tickets = $ticket->fetchAllArray();

        $this->getResponse()->setHeader('Content-Type', 'text/csv; charset=utf-8');
        $this->getResponse()->setHeader('Content-Disposition', 'attachment; filename=tickets.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['id', 'title', 'detail', 'priority', 'attachment', 'created']);
        foreach ($tickets as $ticket) {
            fputcsv($output, [$ticket->id,$ticket->title,$ticket->detail,$ticket->priority,$ticket->attachment,$ticket->created]);
        }
    }


}







