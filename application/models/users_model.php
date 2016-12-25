<?php

class Users_model extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
	function validate($user_name, $password)
	{
		// $this->db->where('user_name', $user_name);
		// $this->db->where('pass_word', $password);
		// $query = $this->db->get('membership');
		$this->db->where('LoginName', $user_name);
		$this->db->where('Password', $password);
		$query = $this->db->get('alluser');
		
		if($query->num_rows == 1)
		{
			// echo '<pre>';
			// print_r($query->result_array());
			// echo '</pre>';
			// exit;
			return $query->result_array();
		}		
	}
	
	function getUserOnline($userId){
		$this->db->select('*');
		$this->db->from('onlineuser');
		$this->db->where('UserID', $userId);
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	function getUserCityInfo($userId){
		$this->db->select('*');
		$this->db->from('cityinfo');
		$this->db->where('UserID', $userId);
		$this->db->where('IsMainCity', '1');
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	function getUserCityGeneralInfo($userId){
		$this->db->select('*');
		$this->db->from('citygeneralinfo');
		$this->db->where('UserID', $userId);
		$this->db->where('IsMainCity', '1');
		$query = $this->db->get();
		return $query->result_array();	
	}

    /**
    * Serialize the session data stored in the database, 
    * store it in a new array and return it to the controller 
    * @return array
    */
	function get_db_session_data()
	{
		$query = $this->db->select('user_data')->get('ci_sessions');
		$user = array(); /* array to store the user data we fetch */
		foreach ($query->result() as $row)
		{
		    $udata = unserialize($row->user_data);
		    /* put data in array using username as key */
		    $user['user_name'] = $udata['user_name']; 
		    $user['is_logged_in'] = $udata['is_logged_in']; 
		}
		return $user;
	}
	
    /**
    * Store the new user's data into the database
    * @return boolean - check the insert
    */	
	function create_member()
	{

		$this->db->where('user_name', $this->input->post('username'));
		$query = $this->db->get('membership');

        if($query->num_rows > 0){
        	echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
			  echo "Username already taken";	
			echo '</strong></div>';
		}else{

			$new_member_insert_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email_addres' => $this->input->post('email_address'),			
				'user_name' => $this->input->post('username'),
				'pass_word' => md5($this->input->post('password'))						
			);
			$insert = $this->db->insert('membership', $new_member_insert_data);
		    return $insert;
		}
	      
	}//create_member
	
	/**
	 * Get user by his is
	 * @param int $user_id 
	 * @return array
	 */
    public function get_city_by_id($id)
    {
		$where_au = "(Icon = '0' OR Icon = '1' OR Icon = '2')";
		$this->db->select('*');
		$this->db->from('citygeneralinfo');
		$this->db->where('CityID', $id);
		$this->db->where($where_au);
		$query = $this->db->get();
		// $xx = $this->db->last_query();
		// echo $xx;
		return $query->result_array(); 
    }
    public function get_user_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('alluser');
		$this->db->where('UserID', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
    /**
	 * Fetch users data from the database
	 * possibility to mix search, filter and order
	 * @param int $manufacuture_id 
	 * @param string $search_string 
	 * @param strong $order
	 * @param string $order_type 
	 * @param int $limit_start
	 * @param int $limit_end
	 * @return array
	 */
    public function get_users($search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('alluser.UserID');
		$this->db->select('alluser.LoginName');
		$this->db->select('alluser.Money');
		$this->db->select('alluser.GiftCertificate');
		$this->db->select('alluser.Gender');
		$this->db->from('alluser');
		
		if($search_string){
			$this->db->like('LoginName', $search_string);
		}
		
		
		
		$this->db->group_by('alluser.UserID');
		
		if($order){
			$this->db->order_by($order, $order_type);
			}else{
		    $this->db->order_by('UserID', $order_type);
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
    function count_users($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('alluser');
		
		if($search_string){
			$this->db->like('LoginName', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
			}else{
		    $this->db->order_by('UserID', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	function changepass($id, $data)
	{
		$this->db->where('UserID', $id);
		$this->db->update('alluser', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
			}else{
			return false;
		}
	}
	
	function resetgift($id, $data){
		$this->db->where('UserID', $id);
		$this->db->update('alluser', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
			}else{
			return false;
		}	
	}
}

