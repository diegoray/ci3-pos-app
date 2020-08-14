<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	public function __construct()
	{
		Parent::__construct();
    	check_not_login();
		$this->load->model(['itemmodel', 'suppliermodel', 'stockmodel']);
    }
    
    public function stock_in_data()
    {
		$data['row'] = $this->stockmodel->get_stock_in()->result();
		$this->template->load('template', 'transaction/stock_in/stock_in_data', $data);
        
    }

    public function stock_in_add()
    {
		$item = $this->itemmodel->get()->result();
		$supplier = $this->suppliermodel->get()->result();
		$data = ['item' => $item, 'supplier' => $supplier];
		$this->template->load('template', 'transaction/stock_in/stock_in_form', $data);
	}
	
	public function stock_in_delete()
	{
		$stock_id = $this->uri->segment(4);	
		$item_id = $this->uri->segment(5);
		$qty = $this->stockmodel->get($stock_id)->row()->qty;
		$data = ['qty' => $qty, 'item_id' => $item_id];
		$this->itemmodel->update_stock_out($data);
		$this->stockmodel->delete($stock_id);

		if($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data Stock-In has been deleted');
		}
		redirect('stock/in');
	}

    public function process()
    {
        if(isset($_POST['in_add'])) {
			$post = $this->input->post(null, TRUE);
			$this->stockmodel->add_stock_in($post);
			$this->itemmodel->update_stock_in($post);

			if($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Data Stock-In has been saved');
			}
			redirect('stock/in');
		}
    }
}