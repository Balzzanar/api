<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|----------------------------------------------------
| Gallery
|----------------------------------------------------
|
| Controller to handle the image gallery page. 
| Will just show images of the products, they will be
| clickable where the page for viewing a single
| product is shown, with the chosen product. 
|
| Url = '/gallery'
|
*/
class Gallery extends CI_Controller {

	
	public function index()
	{
		$main['main_content'] = $this->load->view('gallery/index', '', true);
		$main['active'] = 'gallery';	

		/* Load the site template with the page. */
		$data['header'] = $this->load->view('template/header', '', true);
		$data['main'] = $this->load->view('template/main', $main, true);
		$data['footer'] = $this->load->view('template/footer', '', true);
		$this->load->view('template/site', $data);
	}
}
