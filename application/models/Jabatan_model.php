<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jabatan_model extends CI_Model
{

    public $table = 'jabatan';
    public $id = 'kode_jabatan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('kode_jabatan,nama_jabatan,gaji_pokok,tunjangan_makan,tunjangan_transport,nominal_lembur');
        $this->datatables->from('jabatan');
        $this->datatables->add_column('gaji_pokok', '$1', 'rupiah(gaji_pokok)');
        $this->datatables->add_column('tunjangan_makan', '$1', 'rupiah(tunjangan_makan)');
        $this->datatables->add_column('tunjangan_transport', '$1', 'rupiah(tunjangan_transport)');
        $this->datatables->add_column('nominal_lembur', '$1', 'rupiah(nominal_lembur)');
        //add this line for join
        //$this->datatables->join('table2', 'jabatan.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('jabatan/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('jabatan/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('jabatan/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'kode_jabatan');
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
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('kode_jabatan', $q);
	$this->db->or_like('nama_jabatan', $q);
	$this->db->or_like('gaji_pokok', $q);
	$this->db->or_like('tunjangan_makan', $q);
	$this->db->or_like('tunjangan_transport', $q);
	$this->db->or_like('nominal_lembur', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('kode_jabatan', $q);
	$this->db->or_like('nama_jabatan', $q);
	$this->db->or_like('gaji_pokok', $q);
	$this->db->or_like('tunjangan_makan', $q);
	$this->db->or_like('tunjangan_transport', $q);
	$this->db->or_like('nominal_lembur', $q);
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

/* End of file Jabatan_model.php */
/* Location: ./application/models/Jabatan_model.php */
/* Please DO NOT modify this information : */