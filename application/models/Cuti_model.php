<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cuti_model extends CI_Model
{

    public $table = 'cuti';
    public $id = 'kode_cuti';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('cuti.kode_cuti as kode_cuti, karyawan.nama_karyawan as nama_karyawan, cuti.tgl_cuti_a as tgl_cuti_a,cuti.tgl_cuti_b as tgl_cuti_b,cuti.jumlah_hari as jumlah_hari, cuti.keterangan as keterangan');
        $this->datatables->from('cuti');
        //add this line for join
        $this->datatables->join('karyawan', 'cuti.kode_karyawan = karyawan.kode_karyawan');
        $this->datatables->add_column('action', anchor(site_url('cuti/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('cuti/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('cuti/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'kode_cuti');
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
        $this->db->select('cuti.kode_cuti as kode_cuti, cuti.tgl_cuti_a as tgl_cuti_a, cuti.tgl_cuti_b as tgl_cuti_b, cuti.jumlah_hari as jumlah_hari, cuti.kode_karyawan as kode_karyawan, karyawan.nama_karyawan, cuti.keterangan as keterangan');
        $this->db->from('cuti', 'kode_cuti');
        $this->db->join('karyawan', 'cuti.kode_karyawan = karyawan.kode_karyawan');
        $this->db->where('kode_cuti', $id);
        return $this->db->get()->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('kode_cuti', $q);
	$this->db->or_like('kode_karyawan', $q);
    $this->db->or_like('tgl_cuti_a', $q);
    $this->db->or_like('tgl_cuti_b', $q);
    $this->db->or_like('jumlah_hari', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('kode_cuti', $q);
	$this->db->or_like('kode_karyawan', $q);
    $this->db->or_like('tgl_cuti_a', $q);
    $this->db->or_like('tgl_cuti_b', $q);
    $this->db->or_like('jumlah_hari', $q);
	$this->db->or_like('keterangan', $q);
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

/* End of file Cuti_model.php */
/* Location: ./application/models/Cuti_model.php */
/* Please DO NOT modify this information : */