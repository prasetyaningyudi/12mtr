<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seksi_model extends CI_Model {
	
	private $_table1 = "seksi";
	private $_table2 = "bidang";

    public function __construct(){
		parent::__construct();
    }

	public function get($filters=null, $limit=null){
		$sql = "SELECT A.*, B.NAMA NAMA_SEKSI FROM " . $this->_table1 . " A ";
		$sql .= " LEFT JOIN " . $this->_table2 . "  B";
		$sql .= " ON A.BIDANG_ID = B.ID";				
		$sql .= " WHERE 1=1";
		if(isset($filters) and $filters != null){
			foreach ($filters as $filter) {
				$sql .= " AND " . $filter;
			}
		}
		$sql .= " ORDER BY A.NAMA ASC";
		if(isset($limit) and $limit != null){
			$sql .= " LIMIT ".$limit[0]." OFFSET ".$limit[1];
		}
		
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