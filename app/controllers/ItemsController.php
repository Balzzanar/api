<?php

class ItemsController extends Phalcon\Mvc\Controller
{


    public function indexAction()
    {
        $this->view->setVar('items', Items::find());
    }

    public function showAction($id)
    {

    }

    public function createAction()
    {

    }

    public function updateAction()
    {
    }

    public function deleteAction()
    {
    }

}
