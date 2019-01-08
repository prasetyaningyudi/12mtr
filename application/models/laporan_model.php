<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {
	
	private $_table1 = "laporan";
	private $_table2 = "jenis_laporan";
	private $_table3 = "periode_laporan";
	private $_table4 = "status_laporan";
	private $_table5 = "seksi";
	private $_table6 = "kppn";
	private $_table7 = "bidang";

    public function __construct(){
		parent::__construct();
    }

	public function get($filters=null, $limit=null){
		$sql = "SELECT A.*, B.NAMA BNAMA, C.NAMA CNAMA, D.NAMA DNAMA, E.NAMA ENAMA, ";
		$sql .= " F.KODE KODE_KPPN, F.NAMA FNAMA, G.NAMA GNAMA FROM " . $this->_table1 . " A ";
		$sql .= " LEFT JOIN " . $this->_table2 . "  B ";
		$sql .= " ON A.JENIS_LAPORAN_ID = B.ID";
		$sql .= " LEFT JOIN " . $this->_table3 . "  C ";
		$sql .= " ON A.PERIODE_LAPORAN_ID = C.ID";
		$sql .= " LEFT JOIN " . $this->_table4 . "  D ";
		$sql .= " ON A.STATUS_LAPORAN_ID = D.ID";
		$sql .= " LEFT JOIN " . $this->_table5 . "  E ";
		$sql .= " ON A.SEKSI_ID = E.ID";
		$sql .= " LEFT JOIN " . $this->_table6 . "  F ";
		$sql .= " ON A.KPPN_ID = F.ID";
		$sql .= " LEFT JOIN " . $this->_table7 . "  G ";
		$sql .= " ON A.BIDANG_ID = G.ID";		
		$sql .= " WHERE 1=1";
		if(isset($filters) and $filters != null){
			foreach ($filters as $filter) {
				$sql .= " AND " . $filter;
			}
		}
		$sql .= " ORDER BY NAMA ASC";
		if(isset($limit) and $limit != null){
			$sql .= " LIMIT ".$limit[0]." OFFSET ".$limit[1];
		}
		//var_dump($sql);
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	public function insert($data){
		$result = $this->db->insert($this->_table1, $data);
		return $result;
	}
	
	public function update($data, $id){;
		$this->db->where('ID', $id);
		$result = $this->db->update($this->_table1, $data);
		return $result;
	}
	
	public function delete($data){
		$result = $this->db->delete($this->_table1, $data);
		return $result;
	}
	
}