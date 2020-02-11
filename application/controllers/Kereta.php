<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kereta extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		is_log_in();
		$this->load->model('kereta_model');
		$this->load->model('kursi_kereta_model');
	}

	public function list_kursi($id = 0)
	{
		$data = $this->kursi_kereta_model->save($id);
		$data['data'] = $this->kursi_kereta_model->all($id);
		$kereta = $this->kereta_model->all();
		$o_kereta = [];
		foreach ($kereta as $key => $value) {
			$o_kereta[$value['id']] = $value['nama'];
		}
		$this->load->view('admin-lte/index', ['data' => $data, 'o_kereta' => $o_kereta]);
	}

	public function edit_kursi($id = 0)
	{
		$data['data'] = $this->kursi_kereta_model->save_edit($id);
		$this->load->view('admin-lte/index', ['data' => $data]);
	}

	public function delete_kursi($id = 0)
	{
		if (!empty($id)) {
			$data = $this->kursi_kereta_model->delete($id);
			$this->load->view('admin-lte/index', ['data' => $data]);
		}
	}

	public function list()
	{
		$data = $this->kereta_model->save();
		$data['data'] = $this->kereta_model->all();
		$this->load->view('admin-lte/index', ['data' => $data]);
	}

	public function edit($id = 0)
	{
		$data['data'] = $this->kereta_model->save($id);
		$this->load->view('admin-lte/index', ['data' => $data]);
	}
	public function delete($id = 0)
	{
		if (!empty($id)) {
			$data = $this->kereta_model->delete($id);
			$this->load->view('admin-lte/index', ['data' => $data]);
		}
	}
}
