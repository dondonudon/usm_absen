<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Riwayat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Riwayat_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','riwayat/riwayat_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Riwayat_model->json();
    }

    public function read($id) 
    {
        $row = $this->Riwayat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_riwayat' => $row->kode_riwayat,
        'kode_karyawan' => $row->kode_karyawan,
        'nama_karyawan' => $row->nama_karyawan,
		'tgl_masuk' => $row->tgl_masuk,
		'tgl_keluar' => $row->tgl_keluar,
		'status' => $row->status,
	    );
            $this->template->load('template','riwayat/riwayat_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('riwayat'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('riwayat/create_action'),
	    'kode_riwayat' => set_value('kode_riwayat'),
	    'kode_karyawan' => set_value('kode_karyawan'),
	    'tgl_masuk' => set_value('tgl_masuk'),
	    'tgl_keluar' => set_value('tgl_keluar'),
	    'status' => set_value('status'),
	);
        $this->template->load('template','riwayat/riwayat_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_karyawan' => $this->input->post('kode_karyawan',TRUE),
		'tgl_masuk' => $this->input->post('tgl_masuk',TRUE),
		'tgl_keluar' => $this->input->post('tgl_keluar',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Riwayat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('riwayat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Riwayat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('riwayat/update_action'),
		'kode_riwayat' => set_value('kode_riwayat', $row->kode_riwayat),
		'kode_karyawan' => set_value('kode_karyawan', $row->kode_karyawan),
		'tgl_masuk' => set_value('tgl_masuk', $row->tgl_masuk),
		'tgl_keluar' => set_value('tgl_keluar', $row->tgl_keluar),
		'status' => set_value('status', $row->status),
	    );
            $this->template->load('template','riwayat/riwayat_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('riwayat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_riwayat', TRUE));
        } else {
            $data = array(
		'kode_karyawan' => $this->input->post('kode_karyawan',TRUE),
		'tgl_masuk' => $this->input->post('tgl_masuk',TRUE),
		'tgl_keluar' => $this->input->post('tgl_keluar',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Riwayat_model->update($this->input->post('kode_riwayat', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('riwayat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Riwayat_model->get_by_id($id);

        if ($row) {
            $this->Riwayat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('riwayat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('riwayat'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_karyawan', 'kode karyawan', 'trim|required');
	$this->form_validation->set_rules('tgl_masuk', 'tgl masuk', 'trim|required');
	$this->form_validation->set_rules('tgl_keluar', 'tgl keluar', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('kode_riwayat', 'kode_riwayat', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "riwayat.xls";
        $judul = "riwayat";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Karyawan");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Masuk");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Keluar");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");

	foreach ($this->Riwayat_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kode_karyawan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_masuk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_keluar);
	    xlsWriteNumber($tablebody, $kolombody++, $data->status);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Riwayat.php */
/* Location: ./application/controllers/Riwayat.php */
/* Please DO NOT modify this information : */