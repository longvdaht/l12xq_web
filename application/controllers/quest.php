<?php
class Quest extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('quest_model');
        
		$this->load->library('ckeditor');
		$this->load->library('ckfinder');

		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		// $this->ckeditor->config['toolbar'] = array(
		// array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
		// );
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['width'] = '530px';
		$this->ckeditor->config['height'] = '200px';            
		
		//Add Ckfinder to Ckeditor
		$this->ckfinder->SetupCKEditor($this->ckeditor,'../../assets/ckfinder/');	

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
        if($this->session->userdata('user_info') != '2212'){
            redirect('member');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {
      
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 
		$filter_session_data = array();

        //pagination settings
        $config['per_page'] = 5;
        $config['base_url'] = base_url().'admin/quest';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 10;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';    
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        


        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($search_string !== false && $order !== false || $this->uri->segment(3) == true){ 
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */
            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            $this->session->set_userdata($filter_session_data);

            $data['count_quests']= $this->quest_model->count_quests($search_string, $order);
            $config['total_rows'] = $data['count_quests'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['quests'] = $this->quest_model->get_quests($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['quests'] = $this->quest_model->get_quests($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['quests'] = $this->quest_model->get_quests('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['quests'] = $this->quest_model->get_quests('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{
			
            //clean filter data inside section
            
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            
            $data['order'] = 'id';

            //fetch sql data into arrays
            
            $data['count_quests']= $this->quest_model->count_quests();
            $data['quests'] = $this->quest_model->get_quests('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_quests'];

        }
		
		
		foreach($data['quests'] as $ky=>$val){
			$item_need = $val['goodsitemrequiment'];
			$item_reward = $val['reward'];
			$item_need_arr = explode(';',$item_need);
			$item_reward_arr = explode(';',$item_reward);
			
			$data_item_need = array(); // item quest yêu c?u
			$data_item_reward = array();
			$array_item_need = array();
			$array_item_reward = array();
			foreach ($item_need_arr as $key=>$value){
				$array_val = explode('=',$value);
				if($array_val[0] != ''){
					$array_item_need[]=$array_val[0];
					$data_item_need[$array_val[0]] = $array_val[1];
				}
			}
			foreach ($item_reward_arr as $key=>$value){
				$array_val = explode('=',$value);
				if($array_val[0] != ''){
					$array_item_reward[]=$array_val[0];
					$data_item_reward[$array_val[0]] = $array_val[1];
				}
				
			}
			$items_need = $this->quest_model->get_item_inquest($array_item_need);
			$items_reward = $this->quest_model->get_item_inquest($array_item_reward);
			$data_listquest_fixed[$ky] = $val;
			$data_listquest_fixed[$ky]['items_need'] = $items_need;
			$data_listquest_fixed[$ky]['items_reward'] = $items_reward;
			$data_listquest_fixed[$ky]['data_item_need'] = $data_item_need;
			$data_listquest_fixed[$ky]['data_item_reward'] = $data_item_reward;
		}
		
		// echo '<pre>';
		// print_r( $data_listquest_fixed);
		// echo '</pre>';
		$data['quests'] = $data_listquest_fixed;
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/quest/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
		
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');
            $this->form_validation->set_rules('typegoods', 'typegoods', 'required|numeric');
            $this->form_validation->set_rules('goodsitemrequiment', 'goodsitemrequiment', 'required');
            $this->form_validation->set_rules('reward', 'reward', 'required');
            $this->form_validation->set_rules('desctiption', 'desctiption', 'required');
            $this->form_validation->set_rules('timestart', 'timestart', 'required');
            $this->form_validation->set_rules('timeend', 'timeend', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_quest = array(
                    'name' => $this->input->post('name'),
                    'status' => $this->input->post('status'),
                    'typegoods' => $this->input->post('typegoods'),
                    'goodsitemrequiment' => $this->input->post('goodsitemrequiment'),          
                    'reward' => $this->input->post('reward'),
                    'desctiption' => $this->input->post('desctiption'),
                    'timestart' => $this->input->post('timestart'),
                    'timeend' => $this->input->post('timeend')
                );
				
                //if the insert has returned true then we show the flash message
                if($this->quest_model->add_quest($data_to_quest)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
            }
        }

        //load the view
        $data['main_content'] = 'admin/quest/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //quest id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');
            $this->form_validation->set_rules('typegoods', 'typegoods', 'required|numeric');
            $this->form_validation->set_rules('goodsitemrequiment', 'goodsitemrequiment', 'required');
            $this->form_validation->set_rules('reward', 'reward', 'required');
            $this->form_validation->set_rules('desctiption', 'desctiption', 'required');
            $this->form_validation->set_rules('timestart', 'timestart', 'required');
            $this->form_validation->set_rules('timeend', 'timeend', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_quest = array(
                    'name' => $this->input->post('name'),
                    'status' => $this->input->post('status'),
                    'typegoods' => $this->input->post('typegoods'),
                    'goodsitemrequiment' => $this->input->post('goodsitemrequiment'),          
                    'reward' => $this->input->post('reward'),
					'desctiption' => $this->input->post('desctiption'),
					'timestart' => $this->input->post('timestart'),
					'timeend' => $this->input->post('timeend')
                );
                //if the insert has returned true then we show the flash message
                if($this->quest_model->update_quest($id, $data_to_quest) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/quest/update/'.$id.'');

            }//validation run
        }
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //quest data 
        $data['quest'] = $this->quest_model->get_quest_by_id($id);
        
		$item_need = $data['quest'][0]['goodsitemrequiment'];
		$item_reward = $data['quest'][0]['reward'];
		$item_need_arr = explode(';',$item_need);
		$item_reward_arr = explode(';',$item_reward);
		$data_item_need = array(); // item quest yêu c?u
		$data_item_reward = array();
		$array_item_need = array();
		$array_item_reward = array();
		foreach ($item_need_arr as $key=>$value){
			$array_val = explode('=',$value);
			if($array_val[0] != ''){
				$array_item_need[]=$array_val[0];
				$data_item_need[$array_val[0]] = $array_val[1];
			}
		}
		foreach ($item_reward_arr as $key=>$value){
			$array_val = explode('=',$value);
			if($array_val[0] != ''){
				$array_item_reward[]=$array_val[0];
				$data_item_reward[$array_val[0]] = $array_val[1];
			}
			
		}
		$user_id = $this->session->userdata('user_id');
		
        $data['items_need'] = $this->quest_model->get_item_inquest($array_item_need);
		$data['items_reward'] = $this->quest_model->get_item_inquest($array_item_reward);
		$data['qty_data_item_need'] = $data_item_need;
		$data['qty_data_item_reward'] = $data_item_reward;

        //load the view
        $data['main_content'] = 'admin/quest/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete quest by his id
    * @return void
    */
    public function delete()
    {
        //quest id 
        $id = $this->uri->segment(4);
        $this->quest_model->delete_quest($id);
        redirect('admin/quest');
    }//edit

}