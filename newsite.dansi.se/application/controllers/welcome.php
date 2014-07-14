<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|----------------------------------------------------
| Welcome
|----------------------------------------------------
|
| Controller to handle the welcome page. 
| This is the first controller to run, on site load. 
|
| Url = '/'
|
| Main color theme:
| http://www.colorcombos.com/color-schemes/171/ColorCombo171.html
*/
class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('products_model');
    }


	public function index()
	{
        $products = $this->products_model->get_dummy_items(3);
        $data['products'] = $products;

		$main['main_content'] = $this->load->view('welcome/index', $data, true);
		$main['active'] = 'home';

		$data['header'] = $this->load->view('template/header', '', true);
		$data['main'] = $this->load->view('template/main', $main, true);
		$data['footer'] = $this->load->view('template/footer', '', true);

		$this->load->view('template/site', $data);
	}
}
