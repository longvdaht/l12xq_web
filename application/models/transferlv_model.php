<?php
class Transferlv_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get transferlv by his is
    * @param int $transferlv_id 
    * @return array
    */
    public function get_transferlv_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('webtransferforgelevel');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch transferlvs data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_transferlvs($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('id');
		$this->db->select('forgelevel');
		$this->db->select('goodsitemrequiment');
		$this->db->select('desctiption');
		$this->db->from('webtransferforgelevel');
		
		if($search_string){
			$this->db->like('desctiption', $search_string);
		}
		$this->db->group_by('id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');


		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_transferlvs($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('webtransferforgelevel');
		
		if($search_string){
			$this->db->like('desctiption', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('ID', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function add_transferlv($data)
    {
		$insert = $this->db->insert('webtransferforgelevel', $data);
	    return $insert;
	}

    /**
    * Update transferlv
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_transferlv($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('webtransferforgelevel', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

    /**
    * Delete transferlv
    * @param int $id - transferlv id
    * @return boolean
    */
	function delete_transferlv($id){
		$this->db->where('ID', $id);
		$this->db->delete('webtransferforgelevel'); 
	}
 
}
?>	
