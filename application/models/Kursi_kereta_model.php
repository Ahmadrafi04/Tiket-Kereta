<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kursi_kereta_model extends CI_Model
{
	public function all($id = 0)
	{
		$kursi = $this->db->get_where('kursi', ['kereta_id'=>$id])->result_array(); 
		$count_kursi = $this->db->get_where('kursi', ['kereta_id'=>$id])->num_rows();
		$data = [
			'kursi' => $kursi,
			'count_kursi' => $count_kursi
		];
		return $data;
	}
	public function save_edit($id = 0)
	{
		if(!empty($this->input->post()))
		{
			$data = $this->input->post();
			$input_kursi = [
				'kode_kursi' => $data['kode_kursi']
			];
			if(!empty($id))
			{
				$this->db->select('id');
				$exist = $this->db->get_where('kursi', ['kode_kursi'=>$data['kode_kursi']])->row_array();
				$current_user = $this->db->get_where('kursi', ['id'=>$id])->row_array();
				if($current_user['id'] == $exist['id'] || empty($exist))
				{
					$input_kursi['kereta_id'] = $current_user['kereta_id'];
					$this->db->where('id',$id);
					if($this->db->update('kursi',$data))
					{
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Data berhasil di inputkan.</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
					}
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Data telah di inputkan.</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
				}
			}
		}
		if(!empty($id))
		{
			$data = $this->db->get_where('kursi',['id'=>$id])->row_array();
			return $data;
		}
		return;
	}
	public function save($id = 0)
	{
		if(!empty($this->input->post()))
		{
			$data = $this->input->post();
			$input_kursi = [
				'kereta_id' => $id,
				'kode_kursi' => $data['kode_kursi']
			];

			$this->db->select('id');
			$exist = $this->db->get_where('kursi', ['kode_kursi'=>$data['kode_kursi']])->row_array();
			if(empty($exist))
			{
				if($this->db->insert('kursi',$input_kursi))
				{
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Data berhasil di inputkan.</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
				}
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Data telah di inputkan.</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
			}
		}
		return;
	}
	public function delete($id=0)
	{
		if(!empty($this->input->get('kursi')))
		{
			$kursi = $this->input->get('kursi');
			if($this->db->delete('kursi', ['id'=>$kursi]))
			{
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Data telah di dihapus.</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
				return $id;
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Data gagal di dihapus.</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
				return $id;
			}
		}
	}	
}