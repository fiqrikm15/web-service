<?php

require APPPATH . '/libraries/REST_Controller.php';

class Book Extends REST_Controller{

	function __construct($config = 'rest'){
		parent::__construct($config);
	}

	// menamppilkandata
	function index_get(){
		$data = $this->db->get('books')->result();
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

		$insert = $this->db->insert('books', $book);

		if($insert)
			$this->response($book, 200);
		else{
			$data = array('status', 'Gagal insert');
			$this->response($data, 502);
		}
	}

	function index_put(){
		$isbn = $this->put('isbn');
		$title = $this->put('title');
		$writer = $this->put('writer');
		$description = $this->put('description');
		
		$book = $this->db->get_where('books', array('isbn' => $isbn));

		if($book->num_rows > 0){

			$book = array(
				'title' => $title,
				'writer' => $writer,
				'description' => $description
			);

			$this->db->where('isbn', $isbn);
			$update = $this->db->update('books', $book);

			if($update)
				$this->response($book, 200);
			else{
				$data = array('status', 'Gagal insert');
				$this->response($data, 502);
			}
		}else{
			$data = array(
				'status' => "Bbuku dengan ISBN: " .$isbn . " tidak ada"
			);

			$this->response($data, 200);
		}
	}

	function index_delete($isbn){
		$isbn = $this->delete('isbn');

		$book = $this->db->get_where('books', array('isbn' => $isbn));

		if($book->num_rows > 0){
			$this->db->where('isbn', $isbn);
			$this->db->delete('books');
			$data = array(
				'status' => "Berhasil menghaus data dengan ISBN: " .$isbn
			);

			$this->response($data, 200);
		}else{
			$data = array(
				'status' => "Bbuku dengan ISBN: " .$isbn . " tidak ada"
			);

			$this->response($data, 200);
		}
	}
}