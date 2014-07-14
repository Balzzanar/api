<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|----------------------------------------------------
| Item
|----------------------------------------------------
|
| Controller to handle the items page. 
| 
|
| Url = '/items'
| Url = '/item/(:num)'
|
*/
class Item extends CI_Controller {

		public function __construct()
       {
            parent::__construct();
            $this->load->model('products_model');
       }

	/**
	 * Shows all items on the site.
	 *
	 */
	public function listing()
	{
		$products = $this->products_model->get_dummy_items(6);
		$data['products'] = $products;

        /* The best selling products */
        $data['best_products'] = $this->products_model->get_dummy_items(3);
		$data['show_top_sellers'] = true;
		$data['active_category'] = '';

		$main['main_content'] = $this->load->view('item/listing', $data, true);
		$main['active'] = 'gallery';	

		/* Load the site template with the page. */
		$data['header'] = $this->load->view('template/header', '', true);
		$data['main'] = $this->load->view('template/main', $main, true);
		$data['footer'] = $this->load->view('template/footer', '', true);
		$this->load->view('template/site', $data);
	}

	/**
	 * Shows all items on the same category.
	 *
	 */
	public function category_listing($category)
	{
		$products = $this->products_model->get_dummy_items(2);
		$data['products'] = $products;
		$data['show_top_sellers'] = false;
		$data['active_category'] = $category;
		
		$main['main_content'] = $this->load->view('item/listing', $data, true);
		$main['active'] = 'gallery';	

		/* Load the site template with the page. */
		$data['header'] = $this->load->view('template/header', '', true);
		$data['main'] = $this->load->view('template/main', $main, true);
		$data['footer'] = $this->load->view('template/footer', '', true);
		$this->load->view('template/site', $data);
	}

	/**
	 * Shows the item with the corresponding id.
	 *
	 */
	public function show_item($item_id)
	{
		die("Show item page");
	}
}
