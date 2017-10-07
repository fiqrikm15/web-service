<?php

require APPPATH . '/libraries/REST_Controller.php';

class Book Extends REST_Controller{

	function __construct($config = 'rest'){
		parent::__construct($config);
	}

	// menamppilkandata
	function index_get(){
		$data = $this->db->get('book')->result();
		return $this->response($data,200);
	}

	// mengirim data
	function index_post(){

	}

}