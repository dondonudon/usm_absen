<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Absen extends CI_Controller
{
    private $filename = "import_data";

    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Absen_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','absen/absen_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Absen_model->json();
    }

    public function read($id) 
    {
        $row = $this->Absen_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_absen' => $row->kode_absen,
		'kode_karyawan' => $row->kode_karyawan,
		'jam_masuk' => $row->jam_masuk,
		'jam_pulang' => $row->jam_pulang,
		'potongan_terlambat' => $row->potongan_terlambat,
	    );
            $this->template->load('template','absen/absen_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('absen'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('absen/create_action'),
	    'kode_absen' => set_value('kode_absen'),
	    'kode_karyawan' => set_value('kode_karyawan'),
	    'jam_asli_masuk' => set_value('jam_asli_masuk'),
	    'jam_masuk_kantor' => set_value('jam_masuk_kantor'),
	    'jam_keluar_kantor' => set_value('jam_keluar_kantor'),
	    'jam_pulang_kantor' => set_value('jam_pulang_kantor'),
	    'potongan_terlambat' => set_value('potongan_terlambat'),
	);
        $this->template->load('template','absen/absen_upload');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_karyawan' => $this->input->post('kode_karyawan',TRUE),
		'jam_asli_masuk' => $this->input->post('jam_asli_masuk',TRUE),
		'jam_masuk_kantor' => $this->input->post('jam_masuk_kantor',TRUE),
		'jam_keluar_kantor' => $this->input->post('jam_keluar_kantor',TRUE),
		'jam_pulang_kantor' => $this->input->post('jam_pulang_kantor',TRUE),
		'potongan_terlambat' => $this->input->post('potongan_terlambat',TRUE),
	    );

            $this->Absen_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('absen'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Absen_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('absen/update_action'),
		'kode_absen' => set_value('kode_absen', $row->kode_absen),
		'kode_karyawan' => set_value('kode_karyawan', $row->kode_karyawan),
		'jam_asli_masuk' => set_value('jam_asli_masuk', $row->jam_asli_masuk),
		'jam_masuk_kantor' => set_value('jam_masuk_kantor', $row->jam_masuk_kantor),
		'jam_keluar_kantor' => set_value('jam_keluar_kantor', $row->jam_keluar_kantor),
		'jam_pulang_kantor' => set_value('jam_pulang_kantor', $row->jam_pulang_kantor),
		'potongan_terlambat' => set_value('potongan_terlambat', $row->potongan_terlambat),
	    );
            $this->template->load('template','absen/absen_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('absen'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_absen', TRUE));
        } else {
            $data = array(
		'kode_karyawan' => $this->input->post('kode_karyawan',TRUE),
		'jam_asli_masuk' => $this->input->post('jam_asli_masuk',TRUE),
		'jam_masuk_kantor' => $this->input->post('jam_masuk_kantor',TRUE),
		'jam_keluar_kantor' => $this->input->post('jam_keluar_kantor',TRUE),
		'jam_pulang_kantor' => $this->input->post('jam_pulang_kantor',TRUE),
		'potongan_terlambat' => $this->input->post('potongan_terlambat',TRUE),
	    );

            $this->Absen_model->update($this->input->post('kode_absen', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('absen'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Absen_model->get_by_id($id);

        if ($row) {
            $this->Absen_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('absen'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('absen'));
        }
    }

    public function form(){
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di Absen_model.php
			$upload = $this->Absen_model->upload_file($this->filename);
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		$this->template->load('template','absen/absen_upload', $data);
		//$this->load->view('form', $data);
	}
	
	public function import(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		
		$numrow = 1;
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			
			if($numrow > 1){
				// Kita push (add) array data ke variabel data
				$jadwal = strtotime('08:00:00');
				$jam_masuk_a = strtotime($row['C']);
				$diff = $jam_masuk_a-$jadwal;
				if($jam_masuk_a<$jadwal){
					$potongan = 0;
				} else {
					$potongan   = floor($diff / (60 * 60))*5000;
				}

				array_push($data, array(
					'kode_karyawan'=>$row['A'], // Insert data nis dari kolom A di excel
					'tgl'=>$row['B'], // Insert data jenis kelamin dari kolom C di excel
					'jam_masuk'=>$row['C'], // Insert data jenis kelamin dari kolom C di excel
					'jam_pulang'=>$row['D'],
					'potongan_terlambat'=> $potongan,// Insert data alamat dari kolom D di excel
				));
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->Absen_model->insert_multiple($data);
		
		redirect("absen"); // Redirect ke halaman awal (ke controller absen fungsi index)
	}

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_karyawan', 'kode karyawan', 'trim|required');
	$this->form_validation->set_rules('jam_asli_masuk', 'jam asli masuk', 'trim|required');
	$this->form_validation->set_rules('jam_masuk_kantor', 'jam masuk kantor', 'trim|required');
	$this->form_validation->set_rules('jam_keluar_kantor', 'jam keluar kantor', 'trim|required');
	$this->form_validation->set_rules('jam_pulang_kantor', 'jam pulang kantor', 'trim|required');
	$this->form_validation->set_rules('potongan_terlambat', 'potongan terlambat', 'trim|required');

	$this->form_validation->set_rules('kode_absen', 'kode_absen', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Absen.php */
/* Location: ./application/controllers/Absen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-13 05:14:02 */
/* http://harviacode.com */