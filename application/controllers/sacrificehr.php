<?php
class Sacrificehr extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('sacrificehr_model');
        
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
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

        //all the posts sent by the view
        //$manufacture_id = $this->input->post('manufacture_id');        
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 
		$filter_session_data = array();

        //pagination settings
        $config['per_page'] = 10;
        $config['base_url'] = base_url().'admin/sacrificehr';
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

            $data['count_sacrificehrs']= $this->sacrificehr_model->count_sacrificehrs($search_string, $order);
            $config['total_rows'] = $data['count_sacrificehrs'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['sacrificehrs'] = $this->sacrificehr_model->get_sacrificehrs($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['sacrificehrs'] = $this->sacrificehr_model->get_sacrificehrs($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['sacrificehrs'] = $this->sacrificehr_model->get_sacrificehrs('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['sacrificehrs'] = $this->sacrificehr_model->get_sacrificehrs('', '', $order_type, $config['per_page'],$limit_end);        
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
            
            $data['count_sacrificehrs']= $this->sacrificehr_model->count_sacrificehrs();
            $data['sacrificehrs'] = $this->sacrificehr_model->get_sacrificehrs('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_sacrificehrs'];


        }

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/sacrificehr/list';
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
            $this->form_validation->set_rules('generallist', 'generallist', 'required');
            $this->form_validation->set_rules('reward', 'reward', 'required');
            $this->form_validation->set_rules('desctiption', 'desctiption', 'required');
            $this->form_validation->set_rules('timestart', 'timestart', 'required');
            $this->form_validation->set_rules('timeend', 'timeend', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_sacrificehr = array(
                    'name' => $this->input->post('name'),
                    'status' => $this->input->post('status'),
                    'generallist' => $this->input->post('generallist'),          
                    'reward' => $this->input->post('reward'),
                    'desctiption' => $this->input->post('desctiption'),
                    'timestart' => $this->input->post('timestart'),
                    'timeend' => $this->input->post('timeend')
                );
				
                //if the insert has returned true then we show the flash message
                if($this->sacrificehr_model->add_sacrificehr($data_to_sacrificehr)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        
        
        //load the view
        $data['main_content'] = 'admin/sacrificehr/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //sacrificehr id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');
            $this->form_validation->set_rules('generallist', 'generallist', 'required');
            $this->form_validation->set_rules('reward', 'reward', 'required');
            $this->form_validation->set_rules('desctiption', 'desctiption', 'required');
            $this->form_validation->set_rules('timestart', 'timestart', 'required');
            $this->form_validation->set_rules('timeend', 'timeend', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_sacrificehr = array(
                    'name' => $this->input->post('name'),
                    'status' => $this->input->post('status'),
                    'generallist' => $this->input->post('generallist'),          
                    'reward' => $this->input->post('reward'),
                    'desctiption' => $this->input->post('desctiption'),
                    'timestart' => $this->input->post('timestart'),
                    'timeend' => $this->input->post('timeend')
                );
                //if the insert has returned true then we show the flash message
                if($this->sacrificehr_model->update_sacrificehr($id, $data_to_sacrificehr) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/sacrificehr/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //sacrificehr data 
        $data['sacrificehr'] = $this->sacrificehr_model->get_sacrificehr_by_id($id);
        
        //load the view
        $data['main_content'] = 'admin/sacrificehr/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete sacrificehr by his id
    * @return void
    */
    public function delete()
    {
        //sacrificehr id 
        $id = $this->uri->segment(4);
        $this->sacrificehr_model->delete_sacrificehr($id);
        redirect('admin/sacrificehr');
    }//edit

}