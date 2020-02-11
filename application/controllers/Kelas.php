<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('kelas_model');
		is_log_in();
	}

	public function list()
	{
		$data = $this->kelas_model->save();
		$data['data'] = $this->kelas_model->all();
		$this->load->view('admin-lte/index', ['data' => $data]);
	}

	public function edit($id = 0)
	{
		$data['data'] = $this->kelas_model->save($id);
		$this->load->view('admin-lte/index', ['data' => $data]);
	}
	public function delete($id = 0)
	{
		if (!empty($id)) {
			$data = $this->kelas_model->delete($id);
			$this->load->view('admin-lte/index', ['data' => $data]);
		}
	}
}
