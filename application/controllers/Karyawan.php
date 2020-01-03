<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Karyawan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','karyawan/karyawan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Karyawan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Karyawan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_karyawan' => $row->kode_karyawan,
		'nama_karyawan' => $row->nama_karyawan,
		'alamat_karyawan' => $row->alamat_karyawan,
		'nomor_telp' => $row->nomor_telp,
		'jenkel' => $row->jenkel,
		'agama' => $row->agama,
		'tempat_lahir' => $row->tempat_lahir,
		'tgl_lahir' => $row->tgl_lahir,
		'pendidikan' => $row->pendidikan,
        'jabatan' => $row->jabatan,
        //'kode_jabatan' => $row->kode_jabatan,
		'status' => $row->status,
	    );
            $this->template->load('template','karyawan/karyawan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('karyawan/create_action'),
	    'kode_karyawan' => set_value('kode_karyawan'),
	    'nama_karyawan' => set_value('nama_karyawan'),
	    'alamat_karyawan' => set_value('alamat_karyawan'),
	    'nomor_telp' => set_value('nomor_telp'),
	    'jenkel' => set_value('jenkel'),
	    'agama' => set_value('agama'),
	    'tempat_lahir' => set_value('tempat_lahir'),
	    'tgl_lahir' => set_value('tgl_lahir'),
	    'pendidikan' => set_value('pendidikan'),
	    'kode_jabatan' => set_value('kode_jabatan'),
	    'status' => set_value('status'),
	);
        $this->template->load('template','karyawan/karyawan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_karyawan' => $this->input->post('nama_karyawan',TRUE),
		'alamat_karyawan' => $this->input->post('alamat_karyawan',TRUE),
		'nomor_telp' => $this->input->post('nomor_telp',TRUE),
		'jenkel' => $this->input->post('jenkel',TRUE),
		'agama' => $this->input->post('agama',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
		'pendidikan' => $this->input->post('pendidikan',TRUE),
		'kode_jabatan' => $this->input->post('kode_jabatan',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Karyawan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('karyawan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Karyawan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('karyawan/update_action'),
		'kode_karyawan' => set_value('kode_karyawan', $row->kode_karyawan),
		'nama_karyawan' => set_value('nama_karyawan', $row->nama_karyawan),
		'alamat_karyawan' => set_value('alamat_karyawan', $row->alamat_karyawan),
		'nomor_telp' => set_value('nomor_telp', $row->nomor_telp),
		'jenkel' => set_value('jenkel', $row->jenkel),
		'agama' => set_value('agama', $row->agama),
		'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
		'tgl_lahir' => set_value('tgl_lahir', $row->tgl_lahir),
		'pendidikan' => set_value('pendidikan', $row->pendidikan),
		'kode_jabatan' => set_value('kode_jabatan', $row->kode_jabatan),
		'status' => set_value('status', $row->status),
	    );
            $this->template->load('template','karyawan/karyawan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_karyawan', TRUE));
        } else {
            $data = array(
		'nama_karyawan' => $this->input->post('nama_karyawan',TRUE),
		'alamat_karyawan' => $this->input->post('alamat_karyawan',TRUE),
		'nomor_telp' => $this->input->post('nomor_telp',TRUE),
		'jenkel' => $this->input->post('jenkel',TRUE),
		'agama' => $this->input->post('agama',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
		'pendidikan' => $this->input->post('pendidikan',TRUE),
		'kode_jabatan' => $this->input->post('kode_jabatan',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Karyawan_model->update($this->input->post('kode_karyawan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('karyawan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Karyawan_model->get_by_id($id);

        if ($row) {
            $this->Karyawan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('karyawan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_karyawan', 'nama karyawan', 'trim|required');
	$this->form_validation->set_rules('alamat_karyawan', 'alamat karyawan', 'trim|required');
	$this->form_validation->set_rules('nomor_telp', 'nomor telp', 'trim|required');
	$this->form_validation->set_rules('jenkel', 'jenkel', 'trim|required');
	$this->form_validation->set_rules('agama', 'agama', 'trim|required');
	$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
	$this->form_validation->set_rules('tgl_lahir', 'tgl lahir', 'trim|required');
	$this->form_validation->set_rules('pendidikan', 'pendidikan', 'trim|required');
	$this->form_validation->set_rules('kode_jabatan', 'kode jabatan', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('kode_karyawan', 'kode_karyawan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "karyawan.xls";
        $judul = "karyawan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Karyawan");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Karyawan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nomor Telp");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenkel");
	xlsWriteLabel($tablehead, $kolomhead++, "Agama");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Pendidikan");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Jabatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");

	foreach ($this->Karyawan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_karyawan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_karyawan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomor_telp);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jenkel);
	    xlsWriteNumber($tablebody, $kolombody++, $data->agama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_lahir);
	    xlsWriteNumber($tablebody, $kolombody++, $data->pendidikan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kode_jabatan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->status);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Karyawan.php */
/* Location: ./application/controllers/Karyawan.php */
/* Please DO NOT modify this information : */