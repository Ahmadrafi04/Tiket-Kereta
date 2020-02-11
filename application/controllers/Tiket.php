<?php defined('BASEPATH') or exit('No direct script access allowed');

class Tiket extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_log_in();
		$this->load->model('tiket_model');
	}

	public function list()
	{
		$data = $this->tiket_model->save();
		$data['data'] = $this->tiket_model->all();
		$this->load->view('admin-lte/index', ['data' => $data]);
	}

	public function edit($id = 0)
	{
		$data['data'] = $this->tiket_model->save($id);
		$this->load->view('admin-lte/index', ['data' => $data]);
	}
	public function delete($id = 0)
	{
		if (!empty($id)) {
			$data = $this->tiket_model->delete($id);
			$this->load->view('admin-lte/index', ['data' => $data]);
		}
	}
}
