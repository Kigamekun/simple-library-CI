<?php

class Books_model extends CI_Model
{
	public function __construct()
	{
		
		$this->load->database();
	}

	public function get_all_data()
	{
		$query = $this->db->get('mobil');
		return $query->result();
	}

	public function store()
	{

		
		$config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2000;

        $this->load->library('upload', $config);


        if (!$this->upload->do_upload('thumb')) 
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('dashboard', $error);
        } 
        else 
        {
            $thumb = $this->upload->data();
		
        }

	
		$data = [
			'judul' => $this->input->post('judul'),
			'pengarang' => $this->input->post('pengarang'),
			'deskripsi' => $this->input->post('deskripsi'),
			'thumb' => $thumb['file_name'],
		];

		$this->db->insert('books', $data);
	}

	public function edit($id)
	{
		$query = $this->db->get_where('mobil', ['kdmobil' => $id]);
		return $query->row();
	}

	public function update($id)
	{
		$kondisi = ['id' => $id];
		
	
		$config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2000;

        $this->load->library('upload', $config);


        if (!$this->upload->do_upload('thumb')) 
        {
			$data = [
				'judul' => $this->input->post('judul'),
				'pengarang' => $this->input->post('pengarang'),
				'deskripsi' => $this->input->post('deskripsi'),
				];
			$this->db->update('books', $data, $kondisi);
        } 
        else 
        {
            $thumb = $this->upload->data();
			$data = [
				'judul' => $this->input->post('judul'),
				'pengarang' => $this->input->post('pengarang'),
				'deskripsi' => $this->input->post('deskripsi'),
				'thumb' => $thumb['file_name'],
			];
	
			$this->db->update('books', $data, $kondisi);
        }
		
	}

	public function delete($id)
	{
		$this->db->delete('books', ['id' => $id]);
	}
}

?>
