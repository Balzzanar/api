<?php

class ProductsController extends \Phalcon\Mvc\Controller {
	
	public function indexAction(){
		$this->view->setVar('product', Products::findFirst());
	}

	public function hejsanAction(){
		//$this->view->setVar('product', Products::findFirst());
	}

}