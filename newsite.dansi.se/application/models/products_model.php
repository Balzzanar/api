<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|----------------------------------------------------
| Porducts Model
|----------------------------------------------------
|
| Model to handle the products that exists on the site.
| Takes care of the crud operations for the products.
|
| Product categorys:
| 	1 == 'Örhänge'
| 	2 == 'Halsband'
| 	3 == 'Armband'
| 	4 == ''
|
*/
class Products_model extends CI_Model 
{
	/**
	 * Collects all the products from the database
	 * and returns them in an array.
	 * 
	 * @return array
	 */
	public function get_all_products()
	{
		$this->load->database();

		$sql = "CALL dansi_products_get()";
		$query = $this->db->query($sql);
		$result = $query->result(); 
		return $result;
	}


	/**
	 * Returns a product given it's id.
	 *
	 * @return array
	 */
	public function get_project_by_id($id_product)
	{

	}

	/**
	 * Uploads the file selected in the 'newproduct form'.
	 * Generates a new name, and stores it on the server, 
	 * in a public folder.
	 */
	public function uploadImg()
	{
		$config = array (
				'allowed_types' => 'jpg|jpeg|png',
				'upload_path' => realpath(APPPATH.'../public/uploads'),
				'file_name' => time()
			);
		$this->load->library('upload', $config);


		if ( ! $this->upload->do_upload())
        {
		echo("{errors: {id:'name', msg:'" . $this->upload->display_errors() . "'}}");
        	return;
        }    
        else
        {
            $errUpload = "";
            $uploadData = $this->upload->data();
            $path = $uploadData['file_name'];
            return $path;
    	}
	}

	/**
	 * Stores the new product to the database!
	 */
	public function store_new_product($product)
	{
		$this->load->database();
		echo 'Will store this product to the database: '."<br /><br />";
		var_dump($product);
		$sql = "CALL dansi_product_new(?,?,?,?,?)";
		$params = array(
			$product['name'],
			$product['price'],
			$product['descript'],
			$product['uploaded_file'],
			'' // No thumb image, so far!
		);
                $query = $this->db->query($sql, $params);
	}

	/**
	* Dummy data!
	* 
	*/
	public function get_dummy_items($num)
	{
		$arr = array();	
		for ($i = 0; $i < $num; $i++)
		{
			$res = new stdClass();
			$res->name = 'Test item 1';
			$res->price = '195';
			$res->idproduct = '22';
			$res->descript = 'Hejsan test test';
			$res->img = 'img src!!';
			$res->img_thumb = 'thumb!!';
			$arr[] = $res;			
		}
		
		return $arr;
	}

}
