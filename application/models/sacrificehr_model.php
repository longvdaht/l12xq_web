<?php
class Sacrificehr_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get sacrificehr by his is
    * @param int $sacrificehr_id 
    * @return array
    */
    public function get_sacrificehr_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('webgeneralsacrifice');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch sacrificehrs data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_sacrificehrs($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('id');
		$this->db->select('name');
		$this->db->select('status');
		$this->db->select('generallist');
		$this->db->select('reward');
		$this->db->select('desctiption');
		$this->db->select('timestart');
		$this->db->select('timeend');
		$this->db->from('webgeneralsacrifice');
		
		if($search_string){
			$this->db->like('name', $search_string);
		}
		$this->db->group_by('ID');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('ID', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');


		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $manufacture_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_sacrificehrs($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('webgeneralsacrifice');
		
		if($search_string){
			$this->db->like('name', $search_string);
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
    function add_sacrificehr($data)
    {
		$insert = $this->db->insert('webgeneralsacrifice', $data);
	    return $insert;
	}

    /**
    * Update sacrificehr
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_sacrificehr($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('webgeneralsacrifice', $data);
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
    * Delete sacrificehr
    * @param int $id - sacrificehr id
    * @return boolean
    */
	function delete_sacrificehr($id){
		$this->db->where('ID', $id);
		$this->db->delete('webgeneralsacrifice'); 
	}
 
}
?>	
