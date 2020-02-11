<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setasiun_model extends CI_Model
{
	public function all()
	{
		return $this->db->get('stasiun')->result_array();
	}
	public function save($id = 0)
	{
		if(!empty($this->input->post()))
		{
			$data = $this->input->post();
			if(!empty($id))
			{
				$this->db->select('id');
				$exist = $this->db->get_where('stasiun', ['nama_stasiun'=>$data['nama_stasiun']])->row_array();
				$current_user = $this->db->get_where('stasiun', ['id'=>$id])->row_array();
				if($current_user['id'] == $exist['id'] || empty($exist))
				{
					$this->db->where('id',$id);
					if($this->db->update('stasiun',$data))
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
			}else{
				$this->db->select('id');
				$exist = $this->db->get_where('stasiun', ['nama_stasiun'=>$data['nama_stasiun']])->row_array();
				if(empty($exist))
				{
					if($this->db->insert('stasiun',$data))
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
			$data = $this->db->get_where('stasiun',['id'=>$id])->row_array();
			return $data;
		}
		return;
	}
	public function delete($id=0)
	{
		if(!empty($id))
		{
			if($this->db->delete('stasiun', ['id'=>$id]))
			{
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Data telah di dihapus.</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
				return;
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Data gagal di dihapus.</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
				return;
			}
		}
	}	
}