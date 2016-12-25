<?php
class Quest_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_quest_transferlv_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('webtransferforgelevel');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    public function get_quest_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('webquestinfo');
		$this->db->where('ID', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch products data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_quests($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('id');
		$this->db->select('name');
		$this->db->select('status');
		$this->db->select('typegoods');
		$this->db->select('goodsitemrequiment');
		$this->db->select('reward');
		$this->db->select('desctiption');
		$this->db->select('timestart');
		$this->db->select('timeend');
		$this->db->from('webquestinfo');
		
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
	
	public function get_list_transferlvs($status)
    {
	    
		$this->db->select('id');
		$this->db->select('forgelevel');
		$this->db->select('goodsitemrequiment');
		$this->db->select('desctiption');
		$this->db->from('webtransferforgelevel');
		
		//$this->db->where('status', $status);
		$this->db->group_by('id');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
	
	public function get_list_quests($status)
    {
	    
		$this->db->select('id');
		$this->db->select('name');
		$this->db->select('status');
		$this->db->select('typegoods');
		$this->db->select('goodsitemrequiment');
		$this->db->select('reward');
		$this->db->select('desctiption');
		$this->db->select('timestart');
		$this->db->select('timeend');
		$this->db->from('webquestinfo');
		
		$this->db->where('status', $status);
		$this->db->group_by('ID');
		$this->db->order_by('ID', 'asc');
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
    function count_quests($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('webquestinfo');
		
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
    function add_quest($data)
    {
		$insert = $this->db->insert('webquestinfo', $data);
	    return $insert;
	}
	
    

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_quest($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('webquestinfo', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
	
	function add_item_quest($data)
    {
		$insert = $this->db->insert('playerbaggoodsinfo', $data);
	    return $insert;
	}
	
    function delete_item_hero_quest($id, $GoodsID, $item_ne_byquest)
    {
		$this->db->where('UserID', $id);
		$this->db->where('GoodsID', $GoodsID);
		$this->db->limit($item_ne_byquest);
		$this->db->delete('playerbagequipinfo'); 
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
	
    function update_item_quest($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('playerbaggoodsinfo', $data);
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
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	function delete_quest($id){
		$this->db->where('ID', $id);
		$this->db->delete('webquestinfo'); 
	}
	
	function get_item_inquest($needitem=null)
	{
	    
		$this->db->select('GoodsID');
		$this->db->select('GoodsName');
		$this->db->from('goodsinfo');
		
		if($needitem){
			$this->db->where_in('GoodsID', $needitem);
		}
		
		$this->db->group_by('GoodsID');

		$this->db->order_by('GoodsID', 'asc');


		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
	
	function get_item_inbag($userid, $needitem=null)
	{
		$this->db->select('playerbaggoodsinfo.ID');
		$this->db->select('playerbaggoodsinfo.UserID');
		$this->db->select('playerbaggoodsinfo.GoodsID');
		$this->db->select('playerbaggoodsinfo.Num');
		$this->db->select('goodsinfo.GoodsName');
		$this->db->from('playerbaggoodsinfo');
		if($needitem){
			$this->db->where_in('playerbaggoodsinfo.GoodsID', $needitem);
		}
		$this->db->where('playerbaggoodsinfo.UserID', $userid);
		$this->db->join('goodsinfo', 'playerbaggoodsinfo.GoodsID = goodsinfo.GoodsID', 'left');

		$this->db->group_by('playerbaggoodsinfo.ID');
		$this->db->order_by('playerbaggoodsinfo.ID', 'asc');
		$query = $this->db->get();
		
		return $query->result_array(); 
	}
	
	function get_item_hero_inbag($userid, $needitem=null)
	{
		$select =   array(
			'playerbagequipinfo.EquipUniqueID',
			'playerbagequipinfo.UserID',
			'playerbagequipinfo.GoodsID',
			'goodsinfo.GoodsName',
			'count(playerbagequipinfo.EquipUniqueID) as Num'
		); 
		
		$this->db->select($select);
		$this->db->from('playerbagequipinfo');
		if($needitem){
			$this->db->where_in('playerbagequipinfo.GoodsID', $needitem);
			
		}
		$this->db->where('playerbagequipinfo.UserID', $userid);
		$this->db->having ('Num >', '0');
		$this->db->join('goodsinfo', 'playerbagequipinfo.GoodsID = goodsinfo.GoodsID', 'left');

		$this->db->group_by('playerbagequipinfo.GoodsID');

		$this->db->order_by('playerbagequipinfo.GoodsID', 'asc');


		$query = $this->db->get();
		
		return $query->result_array(); 
	}
}
?>	
