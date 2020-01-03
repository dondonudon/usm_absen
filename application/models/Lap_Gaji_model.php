<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lap_Gaji_model extends CI_Model
{

    public $table = 'view_laporan_gaji';
    public $id = 'kode_gaji';

    //var $table = 'customers';
    var $column_order = array(null, 'nama_karyawan','tgl','jam_masuk','jam_pulang','potongan_terlambat'); //set column field database for datatable orderable
    var $column_search = array('nama_karyawan','tgl'); //set column field database for datatable searchable
    //var $order = array('id' => 'asc'); // default order
    //public $order = 'DESC';

    //var $table = 'customers';

    function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
	{

		//add custom filter here
		if($this->input->post('nama_karyawan'))
		{
			$this->db->where('nama_karyawan', $this->input->post('nama_karyawan'));
		}
		if($this->input->post('tgl_a')&&$this->input->post('tgl_b'))
		{
			$this->db->where('periode >=', $this->input->post('tgl_a'));
      $this->db->where('periode <=', $this->input->post('tgl_b'));
		}

		$this->db->from($this->table);
		$i = 0;

		foreach ($this->column_search as $item) // loop column
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{

				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_list_countries()
	{
		$this->db->select('nama_karyawan,kode_karyawan');
		$this->db->from($this->table);
		$this->db->order_by('kode_karyawan','asc');
		$query = $this->db->get();
		$result = $query->result();

		$countries = array();
		foreach ($result as $row)
		{
			$countries[] = $row->nama_karyawan;
		}
		return $countries;
	}

}

/* End of file Absen_model.php */
/* Location: ./application/models/Absen_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-13 05:14:02 */
/* http://harviacode.com */
