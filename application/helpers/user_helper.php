<?php 

function is_log_in()
{
	$ci = get_instance();
	if (!$ci->session->userdata('email')) {
		redirect('auth');
	}
}
function is_log_in_auth(){
	$ci = get_instance();
	if ($ci->session->userdata('email')) {
		if ($ci->session->userdata('role') == 1) {
			redirect('admin');
		} elseif ($ci->session->userdata('role') != 1) {
			redirect('user');
		}
	}
}
function accessAdmin()
{
	$ci = get_instance();
	if ($ci->session->userdata('role') != 1) {
		redirect('auth/logout');
	}
}
function admin()
{
	$ci = get_instance();
	if ($ci->session->userdata('role') == 1) {
		return true;
	}
}
function member()
{
	$ci = get_instance();
	if ($ci->session->userdata('role') != 1) {
		return true;
	}
}
function accessMember()
{
	$ci = get_instance();
	if ($ci->session->userdata('role') == 1) {
		redirect('admin');
	}
}