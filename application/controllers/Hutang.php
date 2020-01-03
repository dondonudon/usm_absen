<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hutang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Hutang_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','hutang/hutang_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Hutang_model->json();
    }

    public function read($id) 
    {
        $row = $this->Hutang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_hutang' => $row->kode_hutang,
        'nama_karyawan' => $row->nama_karyawan,
        'kode_karyawan' => $row->kode_karyawan,
		'jumlah_hutang' => $row->jumlah_hutang,
        'a_hutang' => $row->a_hutang,
	    );
            $this->template->load('template','hutang/hutang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hutang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('hutang/create_action'),
	    'kode_hutang' => set_value('kode_hutang'),
	    'kode_karyawan' => set_value('kode_karyawan'),
	    'jumlah_hutang' => set_value('jumlah_hutang'),
	    'a_hutang' => set_value('a_hutang'),
	);
        $this->template->load('template','hutang/hutang_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_karyawan' => $this->input->post('kode_karyawan',TRUE),
		'jumlah_hutang' => $this->input->post('jumlah_hutang',TRUE),
		'a_hutang' => $this->input->post('a_hutang',TRUE),
	    );

            $this->Hutang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('hutang'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Hutang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('hutang/update_action'),
		'kode_hutang' => set_value('kode_hutang', $row->kode_hutang),
		'kode_karyawan' => set_value('kode_karyawan', $row->kode_karyawan),
		'jumlah_hutang' => set_value('jumlah_hutang', $row->jumlah_hutang),
		'a_hutang' => set_value('a_hutang', $row->a_hutang),
	    );
            $this->template->load('template','hutang/hutang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hutang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_hutang', TRUE));
        } else {
            $data = array(
		'kode_karyawan' => $this->input->post('kode_karyawan',TRUE),
		'jumlah_hutang' => $this->input->post('jumlah_hutang',TRUE),
		'a_hutang' => $this->input->post('a_hutang',TRUE),
	    );

            $this->Hutang_model->update($this->input->post('kode_hutang', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('hutang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Hutang_model->get_by_id($id);

        if ($row) {
            $this->Hutang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('hutang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hutang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_karyawan', 'kode karyawan', 'trim|required');
	$this->form_validation->set_rules('jumlah_hutang', 'jumlah hutang', 'trim|required');
	$this->form_validation->set_rules('a_hutang', 'a hutang', 'trim|required');

	$this->form_validation->set_rules('kode_hutang', 'kode_hutang', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "hutang.xls";
        $judul = "hutang";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Hutang");
	xlsWriteLabel($tablehead, $kolomhead++, "A Hutang");

	foreach ($this->Hutang_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kode_karyawan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_hutang);
	    xlsWriteNumber($tablebody, $kolombody++, $data->a_hutang);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Hutang.php */
/* Location: ./application/controllers/Hutang.php */
/* Please DO NOT modify this information : */