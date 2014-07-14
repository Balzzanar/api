<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|----------------------------------------------------
| Product (Single)
|----------------------------------------------------
|
| Controller to handle the page for viewing a single 
| product, wiht related information. 
|
| Url = '/product/(:num)'
| '/product' -> redirect to '/gallery'
|
*/
class Product extends CI_Controller {

	
	public function index()
	{
		echo 'Product page!';
	}
}
