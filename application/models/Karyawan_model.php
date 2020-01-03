<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Karyawan_model extends CI_Model
{

    public $table = 'karyawan';
    public $id = 'kode_karyawan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('kode_karyawan,nama_karyawan,alamat_karyawan,nomor_telp,jenkel,agama,tempat_lahir,tgl_lahir,pendidikan,kode_jabatan,status');
        $this->datatables->from('karyawan');
        $this->datatables->add_column('status', '$1', 'rename_string_kawin(status)');
        //add this line for join
        //$this->datatables->join('table2', 'karyawan.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('karyawan/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('karyawan/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('karyawan/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'kode_karyawan');
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
        $this->db->select('karyawan.kode_karyawan as kode_karyawan,karyawan.nama_karyawan as nama_karyawan,karyawan.alamat_karyawan as alamat_karyawan,karyawan.nomor_telp as nomor_telp,karyawan.jenkel as jenkel,ref_agama.agama as agama,karyawan.tempat_lahir as tempat_lahir,karyawan.tgl_lahir as tgl_lahir,ref_pendidikan.pendidikan as pendidikan, karyawan.kode_jabatan as kode_jabatan,jabatan.nama_jabatan as jabatan,karyawan.status as status');
        $this->db->from('karyawan', 'kode_karyawan');
        $this->db->join('jabatan', 'jabatan.kode_jabatan = karyawan.kode_jabatan');
        $this->db->join('ref_agama', 'ref_agama.kode_agama = karyawan.agama');
        $this->db->join('ref_pendidikan', 'ref_pendidikan.kode_pendidikan = karyawan.pendidikan');
        $this->db->where('kode_karyawan', $id);
        return $this->db->get()->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('kode_karyawan', $q);
	$this->db->or_like('nama_karyawan', $q);
	$this->db->or_like('alamat_karyawan', $q);
	$this->db->or_like('nomor_telp', $q);
	$this->db->or_like('jenkel', $q);
	$this->db->or_like('agama', $q);
	$this->db->or_like('tempat_lahir', $q);
	$this->db->or_like('tgl_lahir', $q);
	$this->db->or_like('pendidikan', $q);
	$this->db->or_like('kode_jabatan', $q);
	$this->db->or_like('status', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('kode_karyawan', $q);
	$this->db->or_like('nama_karyawan', $q);
	$this->db->or_like('alamat_karyawan', $q);
	$this->db->or_like('nomor_telp', $q);
	$this->db->or_like('jenkel', $q);
	$this->db->or_like('agama', $q);
	$this->db->or_like('tempat_lahir', $q);
	$this->db->or_like('tgl_lahir', $q);
	$this->db->or_like('pendidikan', $q);
	$this->db->or_like('kode_jabatan', $q);
	$this->db->or_like('status', $q);
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

}

/* End of file Karyawan_model.php */
/* Location: ./application/models/Karyawan_model.php */
/* Please DO NOT modify this information : */