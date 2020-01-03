<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cuti extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Cuti_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','cuti/cuti_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Cuti_model->json();
    }

    public function read($id) 
    {
        $row = $this->Cuti_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_cuti' => $row->kode_cuti,
        'kode_karyawan' => $row->kode_karyawan,
        'nama_karyawan' => $row->nama_karyawan,
        'tgl_cuti_a' => $row->tgl_cuti_a,
        'tgl_cuti_b' => $row->tgl_cuti_b,
        'jumlah_hari' => $row->jumlah_hari,
		'keterangan' => $row->keterangan,
	    );
            $this->template->load('template','cuti/cuti_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cuti'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('cuti/create_action'),
	    'kode_cuti' => set_value('kode_cuti'),
	    'kode_karyawan' => set_value('kode_karyawan'),
        'tgl_cuti_a' => set_value('tgl_cuti_a'),
        'tgl_cuti_b' => set_value('tgl_cuti_b'),
        'jumlah_hari' => set_value('jumlah_hari'),
	    'keterangan' => set_value('keterangan'),
	);
        $this->template->load('template','cuti/cuti_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
        
            //JUMLAH HARI
            $tgl_cuti_a = strtotime($this->input->post('tgl_cuti_a',TRUE));
            $tgl_cuti_b = strtotime($this->input->post('tgl_cuti_b',TRUE));
            $datediff = $tgl_cuti_b - $tgl_cuti_a;
            $jumlah_hari = round($datediff / (60 * 60 * 24))+1;

            $data = array(
        		'kode_karyawan' => $this->input->post('kode_karyawan',TRUE),
                'tgl_cuti_a' => $this->input->post('tgl_cuti_a',TRUE),
                'tgl_cuti_b' => $this->input->post('tgl_cuti_b',TRUE),
                'jumlah_hari'=> $jumlah_hari,
                'keterangan' => $this->input->post('keterangan',TRUE),
                'datetime' => date('Y-m-d H:i:s'),
            );

            $this->Cuti_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('cuti'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Cuti_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('cuti/update_action'),
        		'kode_cuti' => set_value('kode_cuti', $row->kode_cuti),
        		'kode_karyawan' => set_value('kode_karyawan', $row->kode_karyawan),
                'tgl_cuti_a' => set_value('tgl_cuti_a', $row->tgl_cuti_a),
        		'tgl_cuti_b' => set_value('tgl_cuti_b', $row->tgl_cuti_b),
        		'keterangan' => set_value('keterangan', $row->keterangan),
	       );
            $this->template->load('template','cuti/cuti_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cuti'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_cuti', TRUE));
        } else {
            $data = array(
        		'kode_karyawan' => $this->input->post('kode_karyawan',TRUE),
                'tgl_cuti_a' => $this->input->post('tgl_cuti_a',TRUE),
        		'tgl_cuti_b' => $this->input->post('tgl_cuti_b',TRUE),
        		'keterangan' => $this->input->post('keterangan',TRUE),
            );

            $this->Cuti_model->update($this->input->post('kode_cuti', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('cuti'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Cuti_model->get_by_id($id);

        if ($row) {
            $this->Cuti_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('cuti'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cuti'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_karyawan', 'kode karyawan', 'trim|required');
    $this->form_validation->set_rules('tgl_cuti_a', 'tgl cuti a', 'trim|required');
    $this->form_validation->set_rules('tgl_cuti_b', 'tgl cuti b', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('kode_cuti', 'kode_cuti', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "cuti.xls";
        $judul = "cuti";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Cuti");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

	foreach ($this->Cuti_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_karyawan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_cuti);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Cuti.php */
/* Location: ./application/controllers/Cuti.php */
/* Please DO NOT modify this information : */