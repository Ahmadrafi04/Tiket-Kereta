<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		is_log_in_auth();
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('user/login');
		} else {
			$this->login();
		}
	}

	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		$role = $this->db->get_where('user_has_role', ['user_id' => $user['id']])->row_array();
		$role_level = $this->db->get_where('role', ['id' => $role['role_id']])->row_array();

		if ($user) {
			if ($user['active'] == 1) {
					$verify = password_verify($password, $user['password']);
				if (password_verify($password, $user['password'])) {
					$data = [
						'id' => $user['id'],
						'email' => $user['email'],
						'role' => $role_level['level']
					];
					$this->session->set_userdata($data);
					if ($role_level['level'] == 1) {
						redirect('admin');
					} else {
						redirect('user');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Maaf password tidak cocok!!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Maaf email belum di aktifkan!!</strong> silahkan cek gmail anda.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Maaf email belum terdaftar!!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('auth');
		}
	}

	public function regist()
	{
		is_log_in_auth();

		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$e = $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'Email yang anda gunakan sudah ada!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
			'matches' => 'Password tidak sama!',
			'min_length' => 'Password terlalu pendek!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		if ($this->form_validation->run() == false) {
			$this->load->view('user/registrasi');
		} else {
			$email = $this->input->post('email', true);
			$data = [
				'username' => htmlspecialchars($this->input->post('username', true)),
				'email' => htmlspecialchars($email),
				'password' => password_hash($this->input->post(
					'password1'
				), PASSWORD_DEFAULT),
				'active' => 1,
				'token' => random_string('alnum', 5)

			];

			// $token = random_string('alnum', 5);
			// $user_token = [
			// 	'email' => $email,
			// 	'token' => $token,
			// 	'date' => time()
			// ];

			// $this->db->insert('user_token', $user_token);
			// $this->_sendEmail($token, 'verify');
			$q = $this->db->insert('user', $data);

			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Sukses menambah!</strong> Silahkan cek email dan masukkan kode untuk verifikasi akun.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			$this->load->view('user/login');
		}
	}

	private function _sendEmail($token, $type)
	{


		//$this->email->initialize($config);

		//$this->load->library('email', $config);
		$this->load->library('email');
		$this->email->from('admin@musareloadshop.com', 'Admin Master Pulsa Reload');
		$this->email->to($this->input->post('email'));
		if ($type == 'verify') {
			$this->email->subject('Verifikasi akun MPR Member');
			$this->email->message('Kode verifikasi akun anda : ' . urlencode($token) . '');
		} else if ($type == 'lupa') {
			$this->email->subject('Riset password akun MPR Member');
			$this->email->message('Kode verifikasi riset apssword : ' . urlencode($token) . '');
		}
		if ($this->email->send()) {
			return true;
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Failed!!!</strong> Silahkan cek koneksi internet anda.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('auth/regist');
		}
	}

	public function verify()
	{
		$email = $this->input->post('email');
		// var_dump($email);
		// die;
		$token = $this->input->post('kode');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			// var_dump($user);
			// die;
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			// var_dump($user_token);
			// die;
			if ($user_token) {
				if (time() - $user_token['date'] < (60)) {
					$this->db->set('status', 1);
					$this->db->where('email', $email);
					$this->db->update('user');
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>' . $email . '</strong> email anda berhasil diaktifkan! Silahkan login.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
					redirect('auth');
				} else {
					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Token sudah tidak aktif.</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Token tidak falid.</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Aktifasi email gagal! email tidak falid.</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->userdata('id');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role');

		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Berhasil Logout!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		redirect('user');
	}
	public function lupaPassword()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'MPR-Login';
			$this->load->view('partials/auth_header', $data);
			$this->load->view('auth/lupa-password');
			$this->load->view('partials/auth_footer');
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email, 'status' => 1])->row_array();

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date' => time()
				];
				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'lupa');
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Berhasil!</strong> Silahkan cek email anda dan masukkan kode verifikasi untuk melakukan ubah password.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
				$data['title'] = 'MPR-Riset Password';
				$data['judul'] = 'Verifikasi ubah password.';
				$data['email'] = $email;
				$this->load->view('partials/auth_header', $data);
				$this->load->view('auth/verifikasi', $data);
				$this->load->view('partials/auth_footer');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Gagal!</strong> Email belum terdaftar atau aktifkan email anda terlebih dahulu
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
				redirect('auth/lupaPassword');
			}
		}
	}

	public function risetpassword()
	{
		$email = $this->input->post()('email');
		$token = $this->input->post()('kode');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			// var_dump($user_token);
			// die;
			if ($user_token) {
				if (time() - $user_token['date'] < (60)) {
					$this->session->set_userdata('reset_email', $email);
					$this->ubahPassword();
					// var_dump($user_token);
					// die;

				} else {
					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Token sudah tidak aktif.</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
					redirect('auth/lupapassword');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Token tidak falid.</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Aktifasi email gagal! email tidak falid.</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('auth');
		}
	}
	public function ubahPassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}

		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
			'matches' => 'Password tidak sama!',
			'min_length' => 'Password terlalu pendek!'
		]);
		$this->form_validation->set_rules('password2', 'Ulang Password', 'required|trim|min_length[8]|matches[password1]', [
			'matches' => 'Password tidak sama!',
			'min_length' => 'Password terlalu pendek!'
		]);
		if ($this->form_validation->run() == false) {
			$data['title'] = 'MPR-Login';
			$this->load->view('partials/auth_header', $data);
			$this->load->view('auth/ubah-password');
			$this->load->view('partials/auth_footer');
		} else {
			// echo "string";
			// die;
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Berhasil.</strong> password berhasil diubah.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('auth');
		}
	}
}
