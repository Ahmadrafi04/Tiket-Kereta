<?php defined('BASEPATH') or exit('No direct script access allowed');

class Setasiun extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_log_in();
		$this->load->model('setasiun_model');
	}

	public function list()
	{
		$data = $this->setasiun_model->save();
		$data['data'] = $this->setasiun_model->all();
		$this->load->view('admin-lte/index', ['data' => $data]);
	}

	public function edit($id = 0)
	{
		$data['data'] = $this->setasiun_model->save($id);
		$this->load->view('admin-lte/index', ['data' => $data]);
	}
	public function delete($id = 0)
	{
		if (!empty($id)) {
			$data = $this->setasiun_model->delete($id);
			$this->load->view('admin-lte/index', ['data' => $data]);
		}
	}
}
