<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
	$items = Items::find();
	$this->view->setVar("items", $items);
    }

}

