<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	public function __construct()
	{
		Parent::__construct();
		check_not_login();
		$this->load->model(['itemmodel', 'categorymodel', 'unitmodel']);
    }
    
    function get_ajax() {
        $list = $this->itemmodel->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $item->barcode.'<br><a href="'.site_url('item/barcode_qrcode/'.$item->item_id).'" class="btn btn-default btn-xs">Generate <i class="fa fa-barcode"></i></a>';
            $row[] = $item->name;
            $row[] = $item->category_name;
            $row[] = $item->unit_name;
            $row[] = indo_currency($item->price);
            $row[] = $item->stock;
            $row[] = $item->image != null ? '<img src="'.base_url('uploads/product/'.$item->image).'" class="img" style="width:100px">' : null;
            // add html for action
            $row[] = '<a href="'.site_url('item/edit/'.$item->item_id).'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
                    <a href="'.site_url('item/del/'.$item->item_id).'" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->itemmodel->count_all(),
                    "recordsFiltered" => $this->itemmodel->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

	public function index()
	{
		$data['row'] = $this->itemmodel->get();
		$this->template->load('template', 'product/item/item_data', $data);
	}

	public function add()
	{
		$item = new stdClass();
		$item->item_id = null;
        $item->barcode = null;
		$item->name = null;
		$item->category_id = null;
		$item->price = null;
        
        $query_category = $this->categorymodel->get();

        $query_unit = $this->unitmodel->get();
        $unit[null] = '- Choose -';
        foreach($query_unit->result() as $unt) {
            $unit[$unt->unit_id] = $unt->name;
        }

		$data = array(
			'page' => 'add',
            'row' => $item,
            'category' => $query_category,
            'unit' => $unit, 
            'selectedunit' => null
		);
		$this->template->load('template', 'product/item/item_form', $data);
	}

	public function edit($id)
	{
        $query = $this->itemmodel->get($id);
        
		if($query->num_rows() > 0) {
            $item = $query->row();
            
			$query_category = $this->categorymodel->get();

            $query_unit = $this->unitmodel->get();
            $unit[null] = '- Choose -';
            foreach($query_unit->result() as $unt) {
                $unit[$unt->unit_id] = $unt->name;
            }

            $data = array(
                'page' => 'edit',
                'row' => $item,
                'category' => $query_category,
                'unit' => $unit, 
                'selectedunit' => $item->unit_id
            );
            $this->template->load('template', 'product/item/item_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');</script>";
			echo "<script>window.location='".site_url('item')."';</script>";
		}
	}

	public function process()
	{
        $config['upload_path']   = './uploads/product/'; 
        $config['allowed_types'] = 'gif|png|jpg|jpeg'; 
        $config['max_size']      = 2048; 
        $config['file_name']     = 'item-'.date('ymd').'-'.substr(md5(rand()),0,10); 
        $this->load->library('upload', $config);

        $post = $this->input->post(null, TRUE);
        
		if(isset($_POST['add'])) {
            if($this->itemmodel->check_barcode($post['barcode'])->num_rows() > 0 ) {
                $this->session->set_flashdata('error', "Barcode $post[barcode] sudah dipakai barang lain");
                redirect('item/add');
            } else {
                if(@$_FILES['image']['name'] != null) {
                    if($this->upload->do_upload('image')) {
                        $post['image'] = $this->upload->data('file_name');
                        $this->itemmodel->add($post);

                        if($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data has been saved');
                        }
                        redirect('item');
                    } else {
                        $error = $this->upload->display_error();
                        $this->session->set_flashdata('error', $error);
                        redirect('item/add');
                    }
                } else {
                    $post['image'] = null;
                    $this->itemmodel->add($post);

                    if($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data has been saved');
                    }
                    redirect('item');
                }

            }
		} else if(isset($_POST['edit'])) {
            if($this->itemmodel->check_barcode($post['barcode'], $post['id'])->num_rows() > 0 ) {
                $this->session->set_flashdata('error', "Barcode $post[barcode] sudah dipakai barang lain");
                redirect('item/edit/'.$post['id']);
            } else {
                if(@$_FILES['image']['name'] != null) {
                    if($this->upload->do_upload('image')) {

                        $item = $this->itemmodel->get($post['id'])->row();
                        if($item->image != null) {
                            $target_file = './uploads/product/'.$item->image;
                            unlink($target_file); 
                        }

                        $post['image'] = $this->upload->data('file_name');
                        $this->itemmodel->edit($post);

                        if($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data has been saved');
                        }
                        redirect('item');
                    } else {
                        $error = $this->upload->display_error();
                        $this->session->set_flashdata('error', $error);
                        redirect('item/edit');
                    }
                } else {
                    $post['image'] = null;
                    $this->itemmodel->edit($post);

                    if($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data has been saved');
                    }
                    redirect('item');
                }
            }
		}
	}

	public function delete($id)
	{
        $item = $this->itemmodel->get($id)->row();
        if($item->image != null) {
            $target_file = './uploads/product/'.$item->image;
            unlink($target_file); 
        }

		$this->itemmodel->delete($id);

		if($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data has been deleted');
		}
		redirect('item');
    }
    
    function barcode_qrcode($id) {
        $data['row'] = $this->itemmodel->get($id)->row();
		$this->template->load('template', 'product/item/barcode_qrcode', $data);
    } 

    function barcode_print($id) {
        $data['row'] = $this->itemmodel->get($id)->row();
        $html = $this->load->view('product/item/barcode_print', $data, true);
        $this->fungsi->PdfGenerator($html, 'barcode-'.$data['row']->barcode, 'A4', 'landscape');
    }

    function qrcode_print($id) {
        $data['row'] = $this->itemmodel->get($id)->row();
        $html = $this->load->view('product/item/qrcode_print', $data, true);
        $this->fungsi->PdfGenerator($html, 'qrcode-'.$data['row']->barcode, 'A4', 'portrait');
    }
}
