<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|----------------------------------------------------
| Contact
|----------------------------------------------------
|
| Controller to show a site of contact information.
|
| Url = '/contact'
|
*/
class Contact extends CI_Controller {

	
	public function index()
	{
		$main['main_content'] = $this->load->view('contact/index', '', true);
		$main['active'] = 'contact';

		/* Load the site template with the page. */
		$data['header'] = $this->load->view('template/header', '', true);
		$data['main'] = $this->load->view('template/main', $main, true);
		$data['footer'] = $this->load->view('template/footer', '', true);
		$this->load->view('template/site', $data);
	}
}
