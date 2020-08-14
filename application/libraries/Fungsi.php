<?php

Class Fungsi {
    
    protected $ci;

    function __construct() {
        $this->ci =& get_instance();
    }

    function user_login() {
        $this->ci->load->model('usermodel');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->usermodel->get($user_id)->row();
        return $user_data;
    }

    function PdfGenerator($html, $filename, $paper, $orientation) {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper($paper, $orientation);

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($filename, array('Attachment' => 0));
    }

    public function count_item()
    {
        $this->ci->load->model('itemmodel');
        return $this->ci->itemmodel->get()->num_rows();
    }

    public function count_supplier()
    {
        $this->ci->load->model('suppliermodel');
        return $this->ci->suppliermodel->get()->num_rows();
    }

    public function count_customer()
    {
        $this->ci->load->model('customermodel');
        return $this->ci->customermodel->get()->num_rows();
    }

    public function count_user()
    {
        $this->ci->load->model('usermodel');
        return $this->ci->usermodel->get()->num_rows();
    }
}