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
		$isbn = $this->post('isbn');
		$title = $this->post('title');
		$writer = $this->post('writer');
		$description = $this->post('description');

		$book = array('title' => $title,
				'isbn'=> $isbn,
				'writer' => $writer,
				'description' => $description
			);

		$insert = $this->db->insert('book', $book);

		if($insert)
			$this->response($book, 200);
		else{
			$data = array('status', 'Gagal insert');
			$this->response($data, 502);
		}
	}

}