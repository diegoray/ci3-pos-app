<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale extends CI_Controller {

    public function __construct()
	{
		Parent::__construct();
		check_not_login();
		$this->load->model('salemodel');
		$this->load->model('customermodel');
	}

	public function index()
	{
        $customer = $this->customermodel->get()->result();
        $data = array(
            'customer' => $customer,
            'invoice'=> $this->salemodel->invoice_number()
        );
		$this->template->load('template', 'transaction/sale/sale_form', $data);
	}
}
