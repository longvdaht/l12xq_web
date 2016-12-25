<?php
class Member extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('quest_model');
        

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {
		//member data 
		$data = array();
		$user_name = $this->session->userdata('user_name');
		$user_id = $this->session->userdata('user_id');
		$city_id = $this->session->userdata('city_id');
        $data['member'] = $this->users_model->get_user_by_id($user_id);
        $data['city'] = $this->users_model->get_city_by_id($city_id);

        //load the view
        $data['main_content'] = 'member/infos/information';
        $this->load->view('includes/template', $data);  

    }//index

	function changepass()
	{
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		
		if($this->form_validation->run() == FALSE)
		{
			//$this->load->view('member/infos/changepass');
		}
		
		else
		{		
			$user_id = $this->session->userdata('user_id');
			$data_password = array(
				'password' => md5($this->input->post('password'))
			);
			
			if($this->users_model->changepass($user_id, $data_password) == TRUE){
				$this->session->set_flashdata('flash_message', 'updated');
                }else{
				$this->session->set_flashdata('flash_message', 'not_updated');
			}
			redirect('member/infos/changepass/');
			
		}
		
		$data['main_content'] = 'member/infos/changepass';
        $this->load->view('includes/template', $data); 	
		
	}
	
    public function resetgift()
    {
        //member id 
        $user_id = $this->session->userdata('user_id');
		$resetxu = array(
		'GiftCertificate' => '500000'
		);
		if($this->users_model->resetgift($user_id, $resetxu) == TRUE){
			$this->session->set_flashdata('rsgift_message', 'updated');
		}else{
			$this->session->set_flashdata('rsgift_message', 'not_updated');
		}
        //$this->users_model->resetgift($user_id, $resetxu);
        redirect('member');
    }//edit

	public function transferLvItemsList()
	{
		
		$data = array();
		$user_name = $this->session->userdata('user_name');
		$user_id = $this->session->userdata('user_id');
		$city_id = $this->session->userdata('city_id');
        $data['member'] = $this->users_model->get_user_by_id($user_id);
        $data['transferlvs'] = $this->quest_model->get_list_transferlvs('1'); 
        //load the view
        $data['main_content'] = 'member/transferlv/list';
        $this->load->view('includes/template', $data);
	}
	public function questItemsList()
	{
		
		$data = array();
		$user_name = $this->session->userdata('user_name');
		$user_id = $this->session->userdata('user_id');
		$city_id = $this->session->userdata('city_id');
        $data['member'] = $this->users_model->get_user_by_id($user_id);
        $data['quests_lists'] = $this->quest_model->get_list_quests('1'); 
        //load the view
        $data['main_content'] = 'member/quest/list';
        $this->load->view('includes/template', $data);
	}
	
	public function viewQuestTransferLv(){
		//quest id 
        $id = $this->uri->segment(4);
		//quest data 
        $data['quest'] = $this->quest_model->get_quest_transferlv_by_id($id);
		$item_need = $data['quest'][0]['goodsitemrequiment'];
		$item_need_arr = explode(';',$item_need);
		
		$data_item_need = array(); // item quest yêu cầu
		$array_item_need = array();
		foreach ($item_need_arr as $key=>$value){
			$array_val = explode('=',$value);
			if($array_val[0] != ''){
				$data_item_need[$array_val[0]] = $array_val[1];
				$array_item_need[]=$array_val[0];
			}
			
		}
		$user_id = $this->session->userdata('user_id');
		$data['user_id'] = $user_id;
		
		//item need by user
		$data['items_need'] = $this->quest_model->get_item_inbag($user_id, $array_item_need);
		
		
		//print_r($data['items_reward']  );
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
			$post_userid = $this->input->post('hide_userid');
			if($user_id == $post_userid){
				
				//$update_quest_member = $this->checkQuest($user_id, $data['items_need'], $data['items_reward'], $data_item_need, $data_item_reward);			
				$update_quest_member = false;
				
				if($update_quest_member == TRUE){
					$this->session->set_flashdata('submit_quest_message', 'updated');
					redirect('member/quest/view/'.$id);
					}else{
					$this->session->set_flashdata('submit_quest_message', 'not_updated');
					redirect('member/quest/view/'.$id);
				}
			}
		}
        //load the view
        $data['main_content'] = 'member/transferlv/view';
        $this->load->view('includes/template', $data); 
	}
	
	public function viewQuest(){
		//quest id 
        $id = $this->uri->segment(4);
		//quest data 
        $data['quest'] = $this->quest_model->get_quest_by_id($id);
		$item_need = $data['quest'][0]['goodsitemrequiment'];
		$item_reward = $data['quest'][0]['reward'];
		$typegoods = $data['quest'][0]['typegoods'];
		$item_need_arr = explode(';',$item_need);
		$item_reward_arr = explode(';',$item_reward);
		$data_item_need = array(); // item quest yêu cầu
		$data_item_reward = array();
		$array_item_need = array();
		$array_item_reward = array();
		foreach ($item_need_arr as $key=>$value){
			$array_val = explode('=',$value);
			if($array_val[0] != ''){
				$data_item_need[$array_val[0]] = $array_val[1];
				$array_item_need[]=$array_val[0];
			}
			
		}
		foreach ($item_reward_arr as $key=>$value){
			$array_val = explode('=',$value);
			if($array_val[0] != ''){
				$data_item_reward[$array_val[0]] = $array_val[1];
				$array_item_reward[]=$array_val[0];
			}
			
		}
		$user_id = $this->session->userdata('user_id');
		$data['user_id'] = $user_id;
		if($typegoods == 1){
		//item need by user
			$data['items_need'] = $this->quest_model->get_item_inbag($user_id, $array_item_need);
		}else{
			//item hero need by user
			$data['items_need'] = $this->quest_model->get_item_hero_inbag($user_id, $array_item_need);		
		}
		//item reward by user
		$data['items_reward'] = $this->quest_model->get_item_inbag($user_id, $array_item_reward);
		
		//show data quest
		$data['inquest_items_need'] = $this->quest_model->get_item_inquest($array_item_need);
		$data['inquest_items_reward'] = $this->quest_model->get_item_inquest($array_item_reward);
		$data['qty_data_item_need'] = $data_item_need;
		$data['qty_data_item_reward'] = $data_item_reward;
		//show data quest end
		//print_r($data['items_reward']  );
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
			$post_userid = $this->input->post('hide_userinfo');
			$check_online_game = $this->session->userdata('check_online_game');
			if($check_online_game == 1){
				$this->session->set_flashdata('submit_quest_message', 'not_logout');
				redirect('member/quest/view/'.$id);
			}else{
				if(md5($user_id) == $post_userid){
					if($typegoods == 1){
						$update_quest_member = $this->checkQuest($user_id, $data['items_need'], $data['items_reward'], $data_item_need, $data_item_reward);			
					}else{
						$update_quest_member = $this->checkQuestHero($user_id, $data['items_need'], $data['items_reward'], $data_item_need, $data_item_reward);				
							
					}
					
					if($update_quest_member == TRUE){
						$this->session->set_flashdata('submit_quest_message', 'updated');
						redirect('member/quest/view/'.$id);
						}else{
						$this->session->set_flashdata('submit_quest_message', 'not_updated');
						redirect('member/quest/view/'.$id);
					}
				}
			}
			
		}
		$data['quests_lists'] = $this->quest_model->get_list_quests('1'); 
        //load the view
        $data['main_content'] = 'member/quest/view';
        $this->load->view('includes/template', $data); 
	}
	
	public function checkQuestHero($user_id, $item_need_byuser, $item_reward_byuser, $item_need_byquest, $item_reward_byquest)
	{
		$data_check = true;
		//check item in bag user 
		if(count($item_need_byuser)){
			foreach($item_need_byuser as $key=>$value){
				
				if($value['Num'] < $item_need_byquest[$value['GoodsID']]){
					$data_check = false;
				}
				if(count($item_need_byuser) != count($item_need_byquest)){
					$data_check = false;
				}
			}	
		}else{
			$data_check = false;	
		}

		if($data_check == true){
			
			// action update item reward
			if(count($item_reward_byuser)){	
				foreach($item_reward_byuser as $key=>$value){
					//create new array
					$new_arr_it_rew_byuser[$value['GoodsID']] = $value;
				}				
				foreach($item_reward_byquest as $key=>$value){
					$item_rew_byquest = $value;
					if(!isset($new_arr_it_rew_byuser[$key]['Num'])){
						$item_rew_byuser = 0;
						$item_is_yes = 0;
						}elseif($new_arr_it_rew_byuser[$key]['Num'] == 0){
						$item_rew_byuser = 0;
						$item_is_yes = 1;
						}else{
						$item_rew_byuser = $new_arr_it_rew_byuser[$key]['Num'];	
						$item_is_yes = 1;
						
					}
					$item_reward_after_total = $item_rew_byquest + $item_rew_byuser;
					$item_need_after_total = '';
				
					if($item_is_yes == 1){
						$data_update = array(
						'Num' => $item_reward_after_total
						);
						$this->quest_model->update_item_quest($new_arr_it_rew_byuser[$key]['ID'], $data_update);	
					}else{
						$data_add = array(
						'UserID' => $user_id,
						'GoodsID' => $key,
						'Num' => $item_reward_after_total,
						'GiftCertificateBuyNum' => '0'
						);
						$this->quest_model->add_item_quest($data_add);
					}
				}	
			}else{
				foreach($item_reward_byquest as $key=>$value){
					$item_reward_after_total = $value;
					$data_add = array(
					'UserID' => $user_id,
					'GoodsID' => $key,
					'Num' => $item_reward_after_total,
					'GiftCertificateBuyNum' => '0'
					);
					$this->quest_model->add_item_quest($data_add);
				}	
			}
			
			//action update item need
			foreach ($item_need_byuser as $key=>$value){
				$item_ne_byuser = $value['Num'];
				$item_ne_byquest = $item_need_byquest[$value['GoodsID']];
				$this->quest_model->delete_item_hero_quest($user_id, $value['GoodsID'], $item_ne_byquest);
				$check_update_sql = true;
			}
			return $check_update_sql;
			}else{
			return $data_check;
		}
	}
	
	public function checkQuest($user_id, $item_need_byuser, $item_reward_byuser, $item_need_byquest, $item_reward_byquest)
	{
		$data_check = true;
		// check item in bag user
		foreach($item_need_byuser as $key=>$value){
			
			if($value['Num'] < $item_need_byquest[$value['GoodsID']]){
				$data_check = false;
			}
			if(count($item_need_byuser) != count($item_need_byquest)){
				$data_check = false;
			}
		}
		if($data_check == true){
				
			if(count($item_reward_byuser)){	
				foreach($item_reward_byuser as $key=>$value){
					//create new array
					$new_arr_it_rew_byuser[$value['GoodsID']] = $value;
				}
				// action update item reward
				foreach($item_reward_byquest as $key=>$value){
					$item_rew_byquest = $value;
					if(!isset($new_arr_it_rew_byuser[$key]['Num'])){
						$item_rew_byuser = 0;
						$item_is_yes = 0;
						}elseif($new_arr_it_rew_byuser[$key]['Num'] == 0){
						$item_rew_byuser = 0;
						$item_is_yes = 1;
						}else{
						$item_rew_byuser = $new_arr_it_rew_byuser[$key]['Num'];	
						$item_is_yes = 1;
						
					}
					$item_reward_after_total = $item_rew_byquest + $item_rew_byuser;
					$item_need_after_total = '';
					
					if($item_is_yes == 1){
						$data_update = array(
						'Num' => $item_reward_after_total
						);
						$this->quest_model->update_item_quest($new_arr_it_rew_byuser[$key]['ID'], $data_update);	
						}else{
						$data_add = array(
						'UserID' => $user_id,
						'GoodsID' => $new_arr_it_rew_byuser[$key]['GoodsID'],
						'Num' => $item_reward_after_total,
						'GiftCertificateBuyNum' => '0'
						);
						$this->quest_model->add_item_quest($data_add);
					}
					
				}
			}else{
				foreach($item_reward_byquest as $key=>$value){
					$item_reward_after_total = $value;
					$data_add = array(
					'UserID' => $user_id,
					'GoodsID' => $key,
					'Num' => $item_reward_after_total,
					'GiftCertificateBuyNum' => '0'
					);
					$this->quest_model->add_item_quest($data_add);
				}		
			}
			
			
			//action update item need
			foreach ($item_need_byuser as $key=>$value){
				$item_ne_byuser = $value['Num'];
				$item_ne_byquest = $item_need_byquest[$value['GoodsID']];
				$item_need_after_total = $item_ne_byuser - $item_ne_byquest;
				// $item_need_after_total_array[$key]['qty'] = $item_need_after_total;
				// $item_need_after_total_array[$key]['id'] = $value['GoodsID'];
				$data_update = array(
					'Num' => $item_need_after_total
				);
				$check_update_sql = $this->quest_model->update_item_quest($value['ID'], $data_update);
			}
			return $check_update_sql;
		}else{
			return $data_check;
		}
		
	}
}