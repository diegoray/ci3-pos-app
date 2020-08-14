<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		Parent::__construct();
		check_not_login();
		check_admin();
		$this->load->model('usermodel');
        $this->load->library('form_validation');
	}

	public function index()
	{
        $data['row'] = $this->usermodel->get();
		$this->template->load('template', 'user/user_data', $data);
    }
    
    public function add()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|is_unique[user.username]');
        $this->form_validation->set_rules('fullname', 'Name', 'required');
        $this->form_validation->set_rules('password', 'Passord', 'required|min_length[3]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]', 
          	array('matches' => '%s dont match with your password')
        );
        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if($this->form_validation->run() == FALSE) {
    		$this->template->load('template', 'user/user_form_add');
        } else {
			$post = $this->input->post(null, TRUE);
			$this->usermodel->add($post);
			if($this->db->affected_rows() > 0) {
				echo "<script>alert('Data berhasil disimpan');</script>";
			}
			echo "<script>window.location='".site_url('user')."';</script>";
        }

	}

	public function edit($id)
    {
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|callback_username_check');
		$this->form_validation->set_rules('fullname', 'Name', 'required');
		if($this->input->post('password')) {
			$this->form_validation->set_rules('password', 'Passord', 'min_length[3]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[password]', 
				  array('matches' => '%s dont match with your password')
			);
		}
		if($this->input->post('passconf')) {
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'matches[password]', 
				  array('matches' => '%s dont match with your password')
			);
		}      
        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if($this->form_validation->run() == FALSE) {
			$query = $this->usermodel->get($id);
			if($query->num_rows() > 0) {
				$data['row'] = $query->row();
				$this->template->load('template', 'user/user_form_edit', $data);
			} else {
				echo "<script>alert('Data tidak ditemukan');</script>";
				echo "<script>window.location='".site_url('user')."';</script>";
				
			}
        } else {
			$post = $this->input->post(null, TRUE);
			$this->usermodel->edit($post);
			if($this->db->affected_rows() > 0) {
				echo "<script>alert('Data berhasil disimpan');</script>";
			}
			echo "<script>window.location='".site_url('user')."';</script>";
        }

	}

	function username_check() {
		$post = $this->input->post(null, TRUE);
		$query = $this->db->query("SELECT * FROM user WHERE username = '$post[username]' AND user_id != '$post[user_id]'");
		if($query->num_rows() > 0) {
			$this->form_validation->set_message('username_check', 'This {field} has been used, please change');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	public function delete()
	{
		$id = $this->input->post('user_id');
		$this->usermodel->delete($id);

		if($this->db->affected_rows() > 0) {
			echo "<script>alert('Data berhasil dihapus');</script>";
		}
		echo "<script>window.location='".site_url('user')."';</script>";
	}
}
