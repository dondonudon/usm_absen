<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gaji_model extends CI_Model
{

    public $table = 'gaji';
    public $id = 'kode_gaji';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
    }

    // datatables
    function json() {
        $this->datatables->select('gaji.kode_gaji,karyawan.nama_karyawan,gaji.gaji_pokok,gaji.kode_karyawan,gaji.periode,gaji.hasil_gaji');
        $this->datatables->from('gaji');
        $this->datatables->add_column('hasil_gaji', '$1', 'rupiah(hasil_gaji)');
        //add this line for join
        $this->datatables->join('karyawan', 'gaji.kode_karyawan = karyawan.kode_karyawan');
        $this->datatables->add_column('action', anchor(site_url('gaji/prints/$1'),'<i class="fa fa-print" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('gaji/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('gaji/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'kode_gaji');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->select('gaji.kode_gaji as kode_gaji, gaji.gaji_pokok as gaji_pokok, gaji.periode as periode, gaji.kode_karyawan as kode_karyawan, karyawan.nama_karyawan, gaji.tunjangan_makan as tunjangan_makan, gaji.tunjangan_transport as tunjangan_transport, gaji.total_lembur as total_lembur, gaji.potongan_terlambat as potongan_terlambat, gaji.jumlah_bayar as jumlah_bayar, gaji.cicilan_hutang as cicilan_hutang, gaji.hasil_gaji as hasil_gaji');
        $this->db->from('gaji', 'kode_gaji');
        $this->db->join('karyawan', 'gaji.kode_karyawan = karyawan.kode_karyawan');
        $this->db->where('kode_gaji', $id);
        return $this->db->get()->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('kode_gaji', $q);
	$this->db->or_like('kode_karyawan', $q);
    $this->db->or_like('periode', $q);
    $this->db->or_like('gaji_pokok', $q);
	$this->db->or_like('tunjangan_makan', $q);
	$this->db->or_like('tunjangan_transport', $q);
	$this->db->or_like('total_lembur', $q);
	$this->db->or_like('potongan_terlambat', $q);
	$this->db->or_like('cicilan_hutang', $q);
	$this->db->or_like('hasil_gaji', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('kode_gaji', $q);
	$this->db->or_like('kode_karyawan', $q);
    $this->db->or_like('periode', $q);
    $this->db->or_like('gaji_pokok', $q);
	$this->db->or_like('tunjangan_makan', $q);
	$this->db->or_like('tunjangan_transport', $q);
	$this->db->or_like('total_lembur', $q);
	$this->db->or_like('potongan_terlambat', $q);
	$this->db->or_like('cicilan_hutang', $q);
	$this->db->or_like('hasil_gaji', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function get_nama($kode_karyawan){
		$hsl=$this->db->query("SELECT
                                    karyawan.kode_karyawan,
                                    karyawan.nama_karyawan,
                                    ifnull(jabatan.gaji_pokok,0) as gaji_pokok,
                                    ifnull(jabatan.tunjangan_transport,0) as tunjangan_transport,
                                    ifnull(jabatan.tunjangan_makan,0) as tunjangan_makan,
                                    ifnull(hutang.a_hutang,0) as a_hutang
                                FROM
                                    jabatan
                                    INNER JOIN karyawan ON karyawan.kode_jabatan = jabatan.kode_jabatan
                                    LEFT JOIN hutang ON hutang.kode_karyawan = karyawan.kode_karyawan 
                                WHERE
                                    karyawan.kode_karyawan ='$kode_karyawan'");
        if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'kode_karyawan' => $data->kode_karyawan,
                    'nama_karyawan' => $data->nama_karyawan,
                    'gaji_pokok' => $data->gaji_pokok,
                    'tunjangan_transport' => $data->tunjangan_transport,
                    'tunjangan_makan' => $data->tunjangan_makan,
                    'cicilan_hutang' => $data->a_hutang
					);
			}
		}
		return $hasil;
    }

    function get_gaji($kode_karyawan,$periode){
		$hsl=$this->db->query("SELECT
                                    karyawan.nama_karyawan,
                                    IFNULL( SUM( absen.potongan_terlambat ), 0 ) AS potongan_terlambat,
                                    IFNULL( TIMESTAMPDIFF( HOUR, jam_masuk_kantor, lembur.jam_pulang_kantor ), 0 ) *
                                    ifnull(jabatan.nominal_lembur,0) AS total_lembur
                                    
                                FROM
                                    karyawan
                                    LEFT JOIN absen ON karyawan.kode_karyawan = absen.kode_karyawan
                                    LEFT JOIN lembur ON karyawan.kode_karyawan = lembur.kode_karyawan  AND lembur.tgl_lembur = absen.tgl
                                    INNER JOIN jabatan ON jabatan.kode_jabatan = karyawan.kode_jabatan 
                                WHERE
                                    karyawan.kode_karyawan = '$kode_karyawan'
                                    and absen.tgl BETWEEN date_add('$periode',interval -DAY('$periode')+1 DAY) and LAST_DAY('$periode')");
        if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
                    'potongan_terlambat' => $data->potongan_terlambat,
                    'total_lembur' => $data->total_lembur,
					);
			}
		}
		return $hasil;
    }
}

/* End of file Gaji_model.php */
/* Location: ./application/models/Gaji_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-22 08:51:34 */
/* http://harviacode.com */