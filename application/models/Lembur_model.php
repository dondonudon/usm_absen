<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lembur_model extends CI_Model
{

    public $table = 'lembur';
    public $id = 'kode_lembur';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('lembur.kode_lembur,karyawan.nama_karyawan,lembur.kode_karyawan,lembur.tgl_lembur,lembur.jam_masuk_kantor,lembur.jam_pulang_kantor,lembur.keterangan,lembur.hari_lembur');
        $this->datatables->from('lembur');
        //add this line for join
        $this->datatables->join('karyawan', 'lembur.kode_karyawan = karyawan.kode_karyawan');
        $this->datatables->add_column('action', anchor(site_url('lembur/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('lembur/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('lembur/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'kode_lembur');
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
        $this->db->select('lembur.kode_lembur as kode_lembur, lembur.kode_karyawan as kode_karyawan, lembur.tgl_lembur as tgl_lembur, lembur.jam_masuk_kantor as jam_masuk_kantor, lembur.jam_pulang_kantor as jam_pulang_kantor, lembur.keterangan as keterangan,lembur.hari_lembur as hari_lembur, karyawan.nama_karyawan as nama_karyawan');
        $this->db->from('lembur', 'kode_lembur');
        $this->db->join('karyawan', 'lembur.kode_karyawan = karyawan.kode_karyawan');
        $this->db->where('kode_lembur', $id);
        return $this->db->get()->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('kode_lembur', $q);
	$this->db->or_like('kode_karyawan', $q);
	$this->db->or_like('tgl_lembur', $q);
	$this->db->or_like('jam_masuk_kantor', $q);
	$this->db->or_like('jam_pulang_kantor', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->or_like('hari_lembur', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('kode_lembur', $q);
	$this->db->or_like('kode_karyawan', $q);
	$this->db->or_like('tgl_lembur', $q);
	$this->db->or_like('jam_masuk_kantor', $q);
	$this->db->or_like('jam_pulang_kantor', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->or_like('hari_lembur', $q);
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

/* End of file Lembur_model.php */
/* Location: ./application/models/Lembur_model.php */
/* Please DO NOT modify this information : */