<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|----------------------------------------------------
| Order Model
|----------------------------------------------------
|
| Model to handle the orders placed on the site.
| Takes care of the crud operations for orders. 
| At retrieval also adds all the products to the 
| returned data for conviniance. 
|
*/
class Order_model extends CI_Model {


	public function __construct(){
		$this->model->load('products_model');
	}

	/**
	 * Collects all order that are in the database.
	 * Adds the products that belong to them.
	 *
	 * @return array
	 */
	public function get_all_orders(){

	}

	/**
	 * Stores a new order in the database, given 
	 * an array with the order information.
	 * Updates the orderproducts table with the 
	 * products related to the order.
	 *
	 * @param array with order infromation
	 */
	public function store_new_order($order){

	}

}
