<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lembur extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Lembur_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','lembur/lembur_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Lembur_model->json();
    }

    public function read($id) 
    {
        $row = $this->Lembur_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_lembur' => $row->kode_lembur,
        'kode_karyawan' => $row->kode_karyawan,
        'nama_karyawan' => $row->nama_karyawan,
		'tgl_lembur' => $row->tgl_lembur,
		'jam_masuk_kantor' => $row->jam_masuk_kantor,
		'jam_pulang_kantor' => $row->jam_pulang_kantor,
		'keterangan' => $row->keterangan,
		'hari_lembur' => $row->hari_lembur,
	    );
            $this->template->load('template','lembur/lembur_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('lembur'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('lembur/create_action'),
	    'kode_lembur' => set_value('kode_lembur'),
	    'kode_karyawan' => set_value('kode_karyawan'),
	    'tgl_lembur' => set_value('tgl_lembur'),
	    'jam_masuk_kantor' => set_value('jam_masuk_kantor'),
	    'jam_pulang_kantor' => set_value('jam_pulang_kantor'),
	    'keterangan' => set_value('keterangan'),
	    'hari_lembur' => set_value('hari_lembur'),
	);
        $this->template->load('template','lembur/lembur_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_karyawan' => $this->input->post('kode_karyawan',TRUE),
		'tgl_lembur' => $this->input->post('tgl_lembur',TRUE),
		'jam_masuk_kantor' => $this->input->post('jam_masuk_kantor',TRUE),
		'jam_pulang_kantor' => $this->input->post('jam_pulang_kantor',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'hari_lembur' => $this->input->post('hari_lembur',TRUE),
	    );

            $this->Lembur_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('lembur'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Lembur_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('lembur/update_action'),
		'kode_lembur' => set_value('kode_lembur', $row->kode_lembur),
		'kode_karyawan' => set_value('kode_karyawan', $row->kode_karyawan),
		'tgl_lembur' => set_value('tgl_lembur', $row->tgl_lembur),
		'jam_masuk_kantor' => set_value('jam_masuk_kantor', $row->jam_masuk_kantor),
		'jam_pulang_kantor' => set_value('jam_pulang_kantor', $row->jam_pulang_kantor),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'hari_lembur' => set_value('hari_lembur', $row->hari_lembur),
	    );
            $this->template->load('template','lembur/lembur_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('lembur'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_lembur', TRUE));
        } else {
            $data = array(
		'kode_karyawan' => $this->input->post('kode_karyawan',TRUE),
		'tgl_lembur' => $this->input->post('tgl_lembur',TRUE),
		'jam_masuk_kantor' => $this->input->post('jam_masuk_kantor',TRUE),
		'jam_pulang_kantor' => $this->input->post('jam_pulang_kantor',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'hari_lembur' => $this->input->post('hari_lembur',TRUE),
	    );

            $this->Lembur_model->update($this->input->post('kode_lembur', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('lembur'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Lembur_model->get_by_id($id);

        if ($row) {
            $this->Lembur_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('lembur'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('lembur'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_karyawan', 'kode karyawan', 'trim|required');
	$this->form_validation->set_rules('tgl_lembur', 'tgl lembur', 'trim|required');
	$this->form_validation->set_rules('jam_masuk_kantor', 'jam masuk kantor', 'trim|required');
	$this->form_validation->set_rules('jam_pulang_kantor', 'jam pulang kantor', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('hari_lembur', 'hari lembur', 'trim|required');

	$this->form_validation->set_rules('kode_lembur', 'kode_lembur', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "lembur.xls";
        $judul = "lembur";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Lembur");
	xlsWriteLabel($tablehead, $kolomhead++, "Jam Masuk Kantor");
	xlsWriteLabel($tablehead, $kolomhead++, "Jam Pulang Kantor");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Hari Lembur");

	foreach ($this->Lembur_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kode_karyawan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_lembur);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jam_masuk_kantor);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jam_pulang_kantor);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->hari_lembur);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Lembur.php */
/* Location: ./application/controllers/Lembur.php */
/* Please DO NOT modify this information : */