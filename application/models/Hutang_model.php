<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hutang_model extends CI_Model
{

    public $table = 'hutang';
    public $id = 'kode_hutang';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('hutang.kode_hutang,karyawan.nama_karyawan,hutang.kode_karyawan,hutang.jumlah_hutang,hutang.a_hutang');
        $this->datatables->from('hutang');
        $this->datatables->add_column('jumlah_hutang', '$1', 'rupiah(jumlah_hutang)');
        $this->datatables->add_column('a_hutang', '$1', 'rupiah(a_hutang)');
        //add this line for join
        $this->datatables->join('karyawan', 'hutang.kode_karyawan = karyawan.kode_karyawan');
        $this->datatables->add_column('action', anchor(site_url('hutang/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('hutang/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('hutang/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'kode_hutang');
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
        $this->db->select('hutang.kode_hutang as kode_hutang, hutang.jumlah_hutang as jumlah_hutang, hutang.kode_karyawan as kode_karyawan, karyawan.nama_karyawan, hutang.a_hutang as a_hutang');
        $this->db->from('hutang', 'kode_hutang');
        $this->db->join('karyawan', 'hutang.kode_karyawan = karyawan.kode_karyawan');
        $this->db->where('kode_hutang', $id);
        return $this->db->get()->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('kode_hutang', $q);
	$this->db->or_like('kode_karyawan', $q);
	$this->db->or_like('jumlah_hutang', $q);
	$this->db->or_like('a_hutang', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('kode_hutang', $q);
	$this->db->or_like('kode_karyawan', $q);
	$this->db->or_like('jumlah_hutang', $q);
	$this->db->or_like('a_hutang', $q);
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

/* End of file Hutang_model.php */
/* Location: ./application/models/Hutang_model.php */
/* Please DO NOT modify this information : */