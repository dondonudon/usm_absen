<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Jabatan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','jabatan/jabatan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Jabatan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Jabatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_jabatan' => $row->kode_jabatan,
		'nama_jabatan' => $row->nama_jabatan,
		'gaji_pokok' => $row->gaji_pokok,
		'tunjangan_makan' => $row->tunjangan_makan,
		'tunjangan_transport' => $row->tunjangan_transport,
		'nominal_lembur' => $row->nominal_lembur,
	    );
            $this->template->load('template','jabatan/jabatan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jabatan/create_action'),
	    'kode_jabatan' => set_value('kode_jabatan'),
	    'nama_jabatan' => set_value('nama_jabatan'),
	    'gaji_pokok' => set_value('gaji_pokok'),
	    'tunjangan_makan' => set_value('tunjangan_makan'),
	    'tunjangan_transport' => set_value('tunjangan_transport'),
	    'nominal_lembur' => set_value('nominal_lembur'),
	);
        $this->template->load('template','jabatan/jabatan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
		'gaji_pokok' => $this->input->post('gaji_pokok',TRUE),
		'tunjangan_makan' => $this->input->post('tunjangan_makan',TRUE),
		'tunjangan_transport' => $this->input->post('tunjangan_transport',TRUE),
		'nominal_lembur' => $this->input->post('nominal_lembur',TRUE),
	    );

            $this->Jabatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('jabatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jabatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jabatan/update_action'),
		'kode_jabatan' => set_value('kode_jabatan', $row->kode_jabatan),
		'nama_jabatan' => set_value('nama_jabatan', $row->nama_jabatan),
		'gaji_pokok' => set_value('gaji_pokok', $row->gaji_pokok),
		'tunjangan_makan' => set_value('tunjangan_makan', $row->tunjangan_makan),
		'tunjangan_transport' => set_value('tunjangan_transport', $row->tunjangan_transport),
		'nominal_lembur' => set_value('nominal_lembur', $row->nominal_lembur),
	    );
            $this->template->load('template','jabatan/jabatan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_jabatan', TRUE));
        } else {
            $data = array(
		'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
		'gaji_pokok' => $this->input->post('gaji_pokok',TRUE),
		'tunjangan_makan' => $this->input->post('tunjangan_makan',TRUE),
		'tunjangan_transport' => $this->input->post('tunjangan_transport',TRUE),
		'nominal_lembur' => $this->input->post('nominal_lembur',TRUE),
	    );

            $this->Jabatan_model->update($this->input->post('kode_jabatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jabatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jabatan_model->get_by_id($id);

        if ($row) {
            $this->Jabatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jabatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_jabatan', 'nama jabatan', 'trim|required');
	$this->form_validation->set_rules('gaji_pokok', 'gaji pokok', 'trim|required');
	$this->form_validation->set_rules('tunjangan_makan', 'tunjangan makan', 'trim|required');
	$this->form_validation->set_rules('tunjangan_transport', 'tunjangan transport', 'trim|required');
	$this->form_validation->set_rules('nominal_lembur', 'nominal lembur', 'trim|required');

	$this->form_validation->set_rules('kode_jabatan', 'kode_jabatan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "jabatan.xls";
        $judul = "jabatan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Jabatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Gaji Pokok");
	xlsWriteLabel($tablehead, $kolomhead++, "Tunjangan Makan");
	xlsWriteLabel($tablehead, $kolomhead++, "Tunjangan Transport");
	xlsWriteLabel($tablehead, $kolomhead++, "Nominal Lembur");

	foreach ($this->Jabatan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_jabatan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->gaji_pokok);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tunjangan_makan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tunjangan_transport);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nominal_lembur);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Jabatan.php */
/* Location: ./application/controllers/Jabatan.php */
/* Please DO NOT modify this information : */