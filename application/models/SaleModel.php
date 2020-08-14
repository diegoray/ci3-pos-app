<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaleModel extends CI_Model {

    public function invoice_number()
    {
        $sql = "SELECT MAX(MID(invoice,9,4)) AS invoice_number
                FROM t_sale
                WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            $row = $query->row();
            $no = ((int)$row->invoice_number) + 1;
            $number = sprintf("%'.04d", $no);
        } else {
            $number = "0001";
        }

        $invoice = "PA".date('ymd').$number;
        return $invoice;
    }
}