<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

	public function __construct()
	{
		Parent::__construct();
		check_not_login();
		$this->load->model('unitmodel');
	}

	public function index()
	{
		$data['row'] = $this->unitmodel->get();
		$this->template->load('template', 'product/unit/unit_data', $data);
	}

	public function add()
	{
		$unit = new stdClass();
		$unit->unit_id = null;
		$unit->name = null;
		$data = array(
			'page' => 'add',
			'row' => $unit
		);
		$this->template->load('template', 'product/unit/unit_form', $data);
	}

	public function edit($id)
	{
		$query = $this->unitmodel->get($id);
		if($query->num_rows() > 0) {
			$unit = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $unit
			);
			$this->template->load('template', 'product/unit/unit_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');</script>";
			echo "<script>window.location='".site_url('unit')."';</script>";
		}
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])) {
			$this->unitmodel->add($post);
		} elseif(isset($_POST['edit'])) {
			$this->unitmodel->edit($post);
		}

		if($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data has been saved');
		}
		redirect('unit');
	}

	public function delete($id)
	{
		$this->unitmodel->delete($id);

		if($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data has been deleted');
		}
		redirect('unit');
	}
}
