<?php

class Main extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('auth_model');
		$this->load->model('books_model');
		$this->load->helper('url', 'form'); 
		$this->load->library('form_validation');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data = $this->db->get('books');

		$this->load->view('dashboard',['data'=>$data]);
	}


	public function store()
	{
		$this->books_model->store();
		redirect('main');
	}

	

	public function update($id)
	{
		$this->books_model->update($id);
		redirect('main');
	}

	public function delete($id)
	{
		$this->books_model->delete($id);
		redirect('main');
	}

	
}
