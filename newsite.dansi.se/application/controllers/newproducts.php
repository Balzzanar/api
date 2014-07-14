<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|----------------------------------------------------
| New products
|----------------------------------------------------
|
| Controller to handle the new products page, where 
| products are added to the site. 
| Can only enter the site if the user connects from 
| a specific ip-adress.
|
| Url = '/newproducts'
|
*/
class Newproducts extends CI_Controller {

	public function index()
	{	
		if ($_SERVER['REMOTE_ADDR'] == MASTER_IP_RED_PRODUCTS)
		{
			redirect('/');				
		}

		$this->load->model('products_model');
		$data['products'] = $this->products_model->get_all_products();
		$main['main_content'] = $this->load->view('newproducts/index', $data, true);
		$main['active'] = 'home';

		$data['header'] = $this->load->view('template/header', '', true);
		$data['main'] = $this->load->view('template/main', $main, true);
	//	$data['footer'] = $this->load->view('template/footer', '', true);

		$this->load->view('template/site', $data);
	}

	/**
	' Dose validation of data sent from the new products form. 
	* if passed a new product is created, with the newly uploaded
	* product image. 
	*/
	public function newproduct()
	{
		if ($_SERVER['REMOTE_ADDR'] != MASTER_IP_RED_PRODUCTS)
                {
                        redirect('/');
                }
		
		$this->load->model('products_model');
		if ($this->input->post())
		{
			$post = $this->input->post();
			$is_new_data = false;
			$product = array();

			if (isset($post['p_name']) && $post['p_name'] != '')
			{
				$product['name'] = $post['p_name'];
				$is_new_data = true;
			} 
			
			if (isset($post['p_cat']) && $post['p_cat'] != '')
                        {
                                $product['cat'] = $post['p_cat'];
                                $is_new_data = true;
                        }

			if (isset($post['p_price']) && $post['p_price'] != '')
			{
				$product['price'] = $post['p_price'];
				$is_new_data = true;
			} 

			if (isset($post['p_description']) && $post['p_description'] != '')
			{
				$product['descript'] = $post['p_description'];
				$is_new_data = true;
			} 

			if (! $is_new_data) 
			{
				redirect('/newproducts');		
			}
			else 
			{
				/* Try to upload the selected image. */
				$product['uploaded_file'] = $this->products_model->uploadImg();	

				/* Store the new product. */
				$this->products_model->store_new_product($product);
				redirect('/newproducts');
			}
		} 
		else 
		{
			redirect('/newproducts');
		}
		
	}
}
