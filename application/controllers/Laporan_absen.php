<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class laporan_absen extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Lap_Absen_model');
        $this->load->library('form_validation');
	$this->load->library('datatables');
    }

    public function index()
    {
      $countries = $this->Lap_Absen_model->get_list_countries();

  		$opt = array('' => 'Semua');
  		foreach ($countries as $country) {
  			$opt[$country] = $country;
  		}

  		$data['form_country'] = form_dropdown('',$opt,'','id="nama_karyawan" class="form-control"');
      $this->template->load('template','laporan/laporan_absen', $data);
		//$this->load->view('Layout/Template', $data);
	}

  public function ajax_list()
	{
		$list = $this->Lap_Absen_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $customers) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $customers->nama_karyawan;
			$row[] = $customers->tgl;
			$row[] = $customers->jam_masuk;
			$row[] = $customers->jam_pulang;
			$row[] = $customers->potongan_terlambat;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Lap_Absen_model->count_all(),
						"recordsFiltered" => $this->Lap_Absen_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

}

/* End of file Absen.php */
/* Location: ./application/controllers/Absen.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-13 05:14:02 */
/* http://harviacode.com */
