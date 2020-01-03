<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Riwayat_model extends CI_Model
{

    public $table = 'riwayat';
    public $id = 'kode_riwayat';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('riwayat.kode_riwayat,karyawan.nama_karyawan,riwayat.kode_karyawan,riwayat.tgl_masuk,riwayat.tgl_keluar,riwayat.status');
        $this->datatables->from('riwayat');
        $this->datatables->add_column('status', '$1', 'rename_string_aktif(status)');
        //add this line for join
        $this->datatables->join('karyawan', 'riwayat.kode_karyawan = karyawan.kode_karyawan');
        $this->datatables->add_column('action', anchor(site_url('riwayat/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('riwayat/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('riwayat/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'kode_riwayat');
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
        $this->db->select('riwayat.kode_riwayat as kode_riwayat, riwayat.tgl_masuk as tgl_masuk, riwayat.tgl_keluar as tgl_keluar, karyawan.nama_karyawan as nama_karyawan,riwayat.kode_karyawan as kode_karyawan, riwayat.status as status');
        $this->db->from('riwayat', 'kode_riwayat');
        $this->db->join('karyawan', 'riwayat.kode_karyawan = karyawan.kode_karyawan');
        $this->db->where('kode_riwayat', $id);
        return $this->db->get()->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('kode_riwayat', $q);
	$this->db->or_like('kode_karyawan', $q);
	$this->db->or_like('tgl_masuk', $q);
	$this->db->or_like('tgl_keluar', $q);
	$this->db->or_like('status', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('kode_riwayat', $q);
	$this->db->or_like('kode_karyawan', $q);
	$this->db->or_like('tgl_masuk', $q);
	$this->db->or_like('tgl_keluar', $q);
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

/* End of file Riwayat_model.php */
/* Location: ./application/models/Riwayat_model.php */
/* Please DO NOT modify this information : */