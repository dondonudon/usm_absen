<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gaji extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Gaji_model');
        $this->load->library('form_validation');
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','gaji/gaji_list');
    }

    public function json() {
        header('Content-Type: application/json');
        echo $this->Gaji_model->json();
    }

    function get_nama(){
		$kode_karyawan=$this->input->post('kode_karyawan');
		$data=$this->Gaji_model->get_nama($kode_karyawan);
		echo json_encode($data);
    }

    function get_gaji(){
        $kode_karyawan=$this->input->post('kode_karyawan');
        $periode=$this->input->post('periode');
		$data=$this->Gaji_model->get_gaji($kode_karyawan,$periode);
		echo json_encode($data);
	}

    public function read($id)
    {
        $row = $this->Gaji_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kode_gaji' => $row->kode_gaji,
        'kode_karyawan' => $row->kode_karyawan,
        'nama_karyawan' => $row->nama_karyawan,
        'periode' => $row->periode,
        'gaji_pokok' => $row->gaji_pokok,
		'tunjangan_makan' => $row->tunjangan_makan,
		'tunjangan_transport' => $row->tunjangan_transport,
		'total_lembur' => $row->total_lembur,
		'potongan_terlambat' => $row->potongan_terlambat,
        'cicilan_hutang' => $row->cicilan_hutang,
		'hasil_gaji' => $row->hasil_gaji,
	    );
            $this->template->load('template','gaji/gaji_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gaji'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('gaji/create_action'),
	    'kode_gaji' => set_value('kode_gaji'),
        'kode_karyawan' => set_value('kode_karyawan'),
	    'nama_karyawan' => set_value('nama_karyawan'),
        'periode' => set_value('periode'),
        'gaji_pokok' => set_value('gaji_pokok'),
	    'tunjangan_makan' => set_value('tunjangan_makan'),
	    'tunjangan_transport' => set_value('tunjangan_transport'),
	    'total_lembur' => set_value('total_lembur'),
	    'potongan_terlambat' => set_value('potongan_terlambat'),
        'cicilan_hutang' => set_value('cicilan_hutang'),
	    'hasil_gaji' => set_value('hasil_gaji'),
	);
        $this->template->load('template','gaji/gaji_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            //JUMLAH BAYAR
            $kode_karyawan = $this->input->post('kode_karyawan',TRUE);
            $cicilan_hutang = $this->input->post('cicilan_hutang',TRUE);
            $query=$this->db->query("SELECT
                                            jumlah_bayar
                                        FROM
                                            gaji
                                        WHERE
                                            kode_karyawan = '$kode_karyawan'
                                        ORDER BY
                                            periode DESC
                                            LIMIT 1");
            $ret = $query->row();
            $_jumlah_bayar = $ret->jumlah_bayar;
            $jumlah_bayar = $_jumlah_bayar + $cicilan_hutang;


            $query2=$this->db->query("SELECT
                                            jumlah_hutang
                                        FROM
                                            hutang
                                        WHERE
                                            kode_karyawan = '$kode_karyawan'
                                        ORDER BY
                                            kode_hutang DESC
                                            LIMIT 1");
                $ret2 = $query2->row();
                $_jumlah_hutang = $ret2->jumlah_hutang;

            //SISA HUTANG
            $query=$this->db->query("SELECT
            IFNULL( ( SELECT sisa_hutang FROM gaji WHERE kode_karyawan = '$kode_karyawan' ORDER BY periode DESC LIMIT 1 ), 0 ) as sisa_hutang");
            $ret = $query->row();
            $_sisa_hutang = $ret->sisa_hutang;

            if ($sisa_hutang = ($_jumlah_hutang-$jumlah_bayar)<0) {
              $sisa_hutang = 0;
              $cicilan_hutang = 0;
              $cicilan_asli = $this->input->post('cicilan_hutang',TRUE);
              $hasil_asli = $this->input->post('hasil_gaji',TRUE);
              $hasil_gaji = $hasil_asli + $cicilan_asli;
              $data = array(
  		            'kode_karyawan' => $this->input->post('kode_karyawan',TRUE),
                  'periode' => $this->input->post('periode',TRUE),
                  'gaji_pokok' => $this->input->post('gaji_pokok',TRUE),
                  'tunjangan_makan' => $this->input->post('tunjangan_makan',TRUE),
                  'tunjangan_transport' => $this->input->post('tunjangan_transport',TRUE),
                  'total_lembur' => $this->input->post('total_lembur',TRUE),
                  'potongan_terlambat' => $this->input->post('potongan_terlambat',TRUE),
                  'cicilan_hutang' => 0,
                  'hasil_gaji' => $hasil_gaji,
                  'jumlah_bayar' => 0,
                  'sisa_hutang' => 0,
  	    );
            }else {
              $sisa_hutang = $_jumlah_hutang-$jumlah_bayar;
              $data = array(
                'kode_karyawan' => $this->input->post('kode_karyawan',TRUE),
                'periode' => $this->input->post('periode',TRUE),
                'gaji_pokok' => $this->input->post('gaji_pokok',TRUE),
                'tunjangan_makan' => $this->input->post('tunjangan_makan',TRUE),
                'tunjangan_transport' => $this->input->post('tunjangan_transport',TRUE),
                'total_lembur' => $this->input->post('total_lembur',TRUE),
                'potongan_terlambat' => $this->input->post('potongan_terlambat',TRUE),
                'cicilan_hutang' => $this->input->post('cicilan_hutang',TRUE),
                'hasil_gaji' => $this->input->post('hasil_gaji',TRUE),
                'jumlah_bayar' => $jumlah_bayar,
                'sisa_hutang' => $sisa_hutang,
  	    );
            }






            $this->Gaji_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('gaji'));
        }
    }

    public function update($id)
    {
        $row = $this->Gaji_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('gaji/update_action'),
                'kode_gaji' => set_value('kode_gaji', $row->kode_gaji),
                'kode_karyawan' => set_value('kode_karyawan', $row->kode_karyawan),
                'nama_karyawan' => set_value('nama_karyawan', $row->nama_karyawan),
                'periode' => set_value('periode', $row->periode),
                'gaji_pokok' => set_value('periode', $row->gaji_pokok),
                'tunjangan_makan' => set_value('tunjangan_makan', $row->tunjangan_makan),
                'tunjangan_transport' => set_value('tunjangan_transport', $row->tunjangan_transport),
                'total_lembur' => set_value('total_lembur', $row->total_lembur),
                'potongan_terlambat' => set_value('potongan_terlambat', $row->potongan_terlambat),
                'cicilan_hutang' => set_value('cicilan_hutang', $row->cicilan_hutang),
                'hasil_gaji' => set_value('hasil_gaji', $row->hasil_gaji),
	    );
            $this->template->load('template','gaji/gaji_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gaji'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kode_gaji', TRUE));
        } else {
            $data = array(
		'kode_karyawan' => $this->input->post('kode_karyawan',TRUE),
        'periode' => $this->input->post('periode',TRUE),
        'gaji_pokok' => $this->input->post('gaji_pokok',TRUE),
		'tunjangan_makan' => $this->input->post('tunjangan_makan',TRUE),
		'tunjangan_transport' => $this->input->post('tunjangan_transport',TRUE),
		'total_lembur' => $this->input->post('total_lembur',TRUE),
		'potongan_terlambat' => $this->input->post('potongan_terlambat',TRUE),
		'cicilan_hutang' => $this->input->post('cicilan_hutang',TRUE),
		'hasil_gaji' => $this->input->post('hasil_gaji',TRUE),
	    );

            $this->Gaji_model->update($this->input->post('kode_gaji', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('gaji'));
        }
    }

    public function delete($id)
    {
        $row = $this->Gaji_model->get_by_id($id);

        if ($row) {
            $this->Gaji_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('gaji'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('gaji'));
        }
    }

    function prints($id) {
        date_default_timezone_set('Asia/Bangkok');
        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',10);
        $pdf->SetFont('Arial','',10);

        //GET PERIODE
        $query=$this->db->query("SELECT kode_karyawan, periode FROM gaji WHERE kode_gaji = '$id'");
        $ret = $query->row();
        $kode_karyawan = $ret->kode_karyawan;
        $periode = $ret->periode;

        //GET DATA
        $mahasiswa = $this->db->query("SELECT
                                        gaji.kode_gaji AS kode_gaji,
                                        gaji.gaji_pokok AS gaji_pokok,
                                        gaji.periode AS periode,
                                        gaji.kode_karyawan AS kode_karyawan,
                                        karyawan.nama_karyawan,
                                        gaji.tunjangan_makan AS tunjangan_makan,
                                        gaji.tunjangan_transport AS tunjangan_transport,
                                        gaji.total_lembur AS total_lembur,
                                        gaji.potongan_terlambat AS potongan_terlambat,
                                        gaji.cicilan_hutang AS cicilan_hutang,
                                        gaji.hasil_gaji AS hasil_gaji,
                                        gaji.sisa_hutang AS sisa_hutang
                                    FROM
                                        gaji
                                        INNER JOIN karyawan ON gaji.kode_karyawan = karyawan.kode_karyawan
                                    WHERE
                                        gaji.kode_gaji = '$id'")->result();
        //GET SISA CUTI
        $cuti = $this->db->query("SELECT
                                    12- IFNULL(SUM( cuti.jumlah_hari ),0)  as sisa_cuti
                                FROM
                                    gaji
                                    INNER JOIN cuti ON cuti.kode_karyawan = gaji.kode_karyawan
                                WHERE
                                    gaji.kode_gaji = '$id'
                                    -- cuti.kode_karyawan = '$kode_karyawan'
                                    AND EXTRACT( YEAR FROM cuti.datetime ) = EXTRACT( YEAR FROM '$periode')")->result();
        foreach ($cuti as $_cuti){
            foreach ($mahasiswa as $row){
                $pdf->SetFont('Arial','B',12);
                $pdf->Cell(70);
                $pdf->Cell(18,5,'SLIP GAJI',0,1);
                $pdf->Cell(55);
                $pdf->Cell(18,5,'CV. HUTAMA JAYA LESTARI',0,1);
                $pdf->Line(10,20,180,20);
                $pdf->Ln();
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(50,5,'Kode Karyawan',0,0);
                $pdf->Cell(5,5,':',0,0);
                $pdf->Cell(20,5,$row->kode_karyawan,0,0);
                $pdf->Cell(30);
                $pdf->Cell(20,5,'Periode',0,0);
                $pdf->Cell(5,5,':',0,0);
                $pdf->Cell(20,5,$row->periode,0,1);
                $pdf->Cell(50,5,'Nama Karyawan',0,0);
                $pdf->Cell(5,5,':',0,0);
                $pdf->Cell(20,5,$row->nama_karyawan,0,0);
                $pdf->Cell(30);
                $pdf->Cell(20,5,'Sisa Cuti',0,0);
                $pdf->Cell(5,5,':',0,0);
                $pdf->Cell(20,5,$_cuti->sisa_cuti,0,1);
                $pdf->Line(10,35,180,35);
                $pdf->Ln();
                $pdf->Cell(50,5,'Gaji Pokok',0,0);
                $pdf->Cell(5,5,':',0,0);
                $pdf->Cell(20,5,rupiah($row->gaji_pokok),0,1);
                $pdf->Cell(50,5,'Tunjangan Makan',0,0);
                $pdf->Cell(5,5,':',0,0);
                $pdf->Cell(20,5,rupiah($row->tunjangan_makan),0,1);
                $pdf->Cell(50,5,'Tunjangan Transport',0,0);
                $pdf->Cell(5,5,':',0,0);
                $pdf->Cell(20,5,rupiah($row->tunjangan_transport),0,1);
                $pdf->Cell(50,5,'Total Lembur',0,0);
                $pdf->Cell(5,5,':',0,0);
                $pdf->Cell(20,5,rupiah($row->total_lembur),0,1);
                $pdf->Ln();
                $pdf->Cell(50,5,'Potongan Terlambat',0,0);
                $pdf->Cell(5,5,':',0,0);
                $pdf->Cell(20,5,rupiah($row->potongan_terlambat),0,1);
                $pdf->Cell(50,5,'Cicilan Hutang',0,0);
                $pdf->Cell(5,5,':',0,0);
                $pdf->Cell(20,5,rupiah($row->cicilan_hutang),0,1);
                $pdf->Cell(50,5,'Sisa Hutang',0,0);
                $pdf->Cell(5,5,':',0,0);
                $pdf->Cell(20,5,rupiah($row->sisa_hutang),0,1);
                $pdf->Line(10,80,180,80);
                $pdf->Ln();
                $pdf->Cell(50,5,'Total Gaji',0,0);
                $pdf->Cell(5,5,':',0,0);
                $pdf->Cell(20,5,rupiah($row->hasil_gaji),0,1);
                $pdf->Ln();
                $pdf->Cell(20);
                $pdf->Cell(18,5,'DISETUJUI');
                $pdf->Cell(70);
                $pdf->Cell(18,5,'Semarang, ');
                $pdf->Cell(20,5,$row->periode,0,1);
                // $pdf->Cell(20,5,date("Y/m/d"),0,1);
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Cell(20);
                $pdf->Cell(18,5,'DISETUJUI');
                $pdf->Cell(75);
                $pdf->Cell(20,5,strtoupper($row->nama_karyawan),0,1);
            }
        }
        $pdf->Output();
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_karyawan', 'kode karyawan', 'trim|required');
    $this->form_validation->set_rules('periode', 'periode', 'trim|required');
    $this->form_validation->set_rules('gaji_pokok', 'tunjangan gaji_pokok', 'trim|required');
	$this->form_validation->set_rules('tunjangan_makan', 'tunjangan makan', 'trim|required');
	$this->form_validation->set_rules('tunjangan_transport', 'tunjangan transport', 'trim|required');
	$this->form_validation->set_rules('total_lembur', 'total lembur', 'trim|required');
	$this->form_validation->set_rules('potongan_terlambat', 'potongan terlambat', 'trim|required');
	$this->form_validation->set_rules('cicilan_hutang', 'cicilan hutang', 'trim|required');
	$this->form_validation->set_rules('hasil_gaji', 'hasil gaji', 'trim|required');

	$this->form_validation->set_rules('kode_gaji', 'kode_gaji', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "gaji.xls";
        $judul = "gaji";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Periode");
	xlsWriteLabel($tablehead, $kolomhead++, "Tunjangan Makan");
	xlsWriteLabel($tablehead, $kolomhead++, "Tunjangan Transport");
	xlsWriteLabel($tablehead, $kolomhead++, "Total Lembur");
	xlsWriteLabel($tablehead, $kolomhead++, "Potongan Terlambat");
	xlsWriteLabel($tablehead, $kolomhead++, "Cicilan Hutang");
	xlsWriteLabel($tablehead, $kolomhead++, "Hasil Gaji");

	foreach ($this->Gaji_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kode_karyawan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->periode);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tunjangan_makan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tunjangan_transport);
	    xlsWriteNumber($tablebody, $kolombody++, $data->total_lembur);
	    xlsWriteNumber($tablebody, $kolombody++, $data->potongan_terlambat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->cicilan_hutang);
	    xlsWriteNumber($tablebody, $kolombody++, $data->hasil_gaji);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Gaji.php */
/* Location: ./application/controllers/Gaji.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-22 08:51:34 */
/* http://harviacode.com */
