<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MX_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -  
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('form_validation');
        $this->load->model('admin/subadminmodel','adminsmodel');
        $this->load->helper('admin_permission');
        admin_authenticate();
    }

   
   /*sub-admin management start*/
       public function index()
    {
        admin_authenticate();
        $id=$this->session->userdata('admin_uid');
        $data['subadmins']=$this->adminsmodel->selectsubadmin($id); 
        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | Moderator Management');
        $this->layouts->render('admin/subadminlist',$data , 'admin');

    }

    public function formsubadmin($id=NULL)
    {
        admin_authenticate();
       $admin_uid=$this->session->userdata('admin_uid');
        $msg="Moderator Added Successfully";
       if(!empty($id)){$id=base64_decode(urldecode($id)); $msg="Moderator Updated Successfully";}

        if($this->input->post())
        {
            
            $arr=array();
            $arr['fname']= $fname = $this->input->post('fname');
            $arr['lname'] = $this->input->post('lname');
            $arr['username'] = $this->input->post('username');
            $arr['email'] = $this->input->post('email');
            if(!empty($this->input->post('pass'))){
             $arr['password'] = sha1($this->input->post('pass'));
             }
            $arr['group_code'] = $this->input->post('group');
            if (!empty($_FILES['profile_pic']['name'])) {
              
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['file_name'] = time();

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('profile_pic')) {
                    echo $this->upload->display_errors();exit;
                } else {
                    $upload_data =$this->upload->data();
                    $arr['image']= $upload_data['file_name'];
                }
            } else {
                if(!empty($id)){
                  $arr['image'] = $this->input->post('old-profile-pic');
                }
                else
                {
                  $arr['image'] = "";
                }
            }
            $arr['parentid'] =$admin_uid;
            $arr['status'] = 1;
            $arr['created_date'] = date("Y-m-d H:i:s");
            $arr['modified_date'] =date("Y-m-d H:i:s");

            $returnval = $this->adminsmodel->changeadmin($arr,$id);
            if (!empty($returnval)) {

            if(!empty($this->input->post('pass'))){
                $message ="<p style=\"border: 1px solid #f0f0f0;padding: 12px;background-color: #f0f0f0;\"><strong style=\"display:block;\">Email : </strong> " . $this->input->post('email') . "</p>";
                $message .="<p style=\"border: 1px solid #f0f0f0;padding: 12px;background-color: #f0f0f0;\"><strong style=\"display:block;\" >Password : </strong> " . $this->input->post('pass') . "</p>";
                 $arr=array();
                 $arr['message']=$message;
                 $arr['email']=$this->input->post('email');
                 $arr['subject']=" Moderator Login Details";
                 admin_email($arr);

             }

                $this->session->set_flashdata('successmessage', $msg);

            }
            else {
                $this->session->set_flashdata('errormessage', "Oops! Something went wrong.Please try agagin later.");

            }
            $redirect = site_url('admin/subadmin');
            redirect($redirect);
              

        }
         $data = array();

         if(!empty($id))
         {
           $data['result'] = $this->adminsmodel->getsubadmin($id);
         }
       
        $data['list']=$this->adminsmodel->rolelist(); 
        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | Moderator Management');
        if(!empty($id))
         {
           $this->layouts->render('admin/editsubadmin',$data , 'admin');

         }
         else
         {
          $this->layouts->render('admin/addsubadmin',$data , 'admin');

         }
    }


    public function subadminstatus($id)
    {
        admin_authenticate();
        $id=base64_decode(urldecode($id));
       $status=$this->adminsmodel->subadminstatus($id); 
        if(!empty($status))
        {
           $this->session->set_flashdata('successmessage', 'Moderator status changed successfully');
            $redirect = site_url('admin/subadmin');
            redirect($redirect);

        }  

    }

    public function deleteModerator($id)
    {
        admin_authenticate();
        $id=base64_decode(urldecode($id));
       $delete=$this->adminsmodel->subadmindeletion($id); 
        if(!empty($delete))
        {
           $this->session->set_flashdata('successmessage', 'Moderator deleted successfully');
            $redirect = site_url('admin/subadmin');
            redirect($redirect);

        }  
    }


    public function checkUnique()
 {
        $field = $this->input->post('field');
        $value = $this->input->post('value');

        $where[$field] = $value;

        echo $this->adminsmodel->isunique($where) ? "true" : "false";
    
 }

    /*sub-admin management end*/



   /*-- Start Of Role--*/

      public function role()
    {
        admin_authenticate();

        $data['result']=$this->adminsmodel->rolelist();
        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | Moderator Management');
         $this->layouts->render('admin/rolelist',$data , 'admin');
   }

        public function addRole()
    {
        admin_authenticate();
        if($this->input->post())
        {
            $group_name = $this->input->post('group');
            $role = $this->input->post('role');
            $description = $this->input->post('desc');
            $flag = $this->adminsmodel->roleinsertion($group_name,$role,$description);
            if (!empty($flag)) {
                $this->session->set_flashdata('successmessage', 'Role Added successfully');
            }
            else 
            {
                $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
            }
            $redirect = $this->config->item('base_url') . 'admin/role';
            redirect($redirect);
        }
        else
        {

            $data['role']=$this->adminsmodel->selectmodules(); 
            $getsitename = getsitename();
            $this->layouts->set_title($getsitename . ' | Role Management');
            $this->layouts->render('admin/role_management', $data, 'admin');
        }

    } 



          public function editRole($id)
    {
        admin_authenticate();
        $id=base64_decode(urldecode($id));
        if($this->input->post())
        {
            $group_name = $this->input->post('group');
            $role = $this->input->post('role');
            $description = $this->input->post('desc');
            $flag = $this->adminsmodel->roleupdate($id,$group_name,$role,$description);
            if (!empty($flag)) {
                $this->session->set_flashdata('successmessage', 'Role Updated successfully');
            }
            else 
            {
                $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
            }
            $redirect = $this->config->item('base_url') . 'admin/role';
            redirect($redirect);
        }
        else
        {
            $data['result']=$this->adminsmodel->getRole($id);
            $data['role']=$this->adminsmodel->selectmodules(); 
            $getsitename = getsitename();
            $this->layouts->set_title($getsitename . ' | Role Management');
            $this->layouts->render('admin/role_management', $data, 'admin');
        }

    } 

    
      public function deleteRole($id)
    {
         admin_authenticate();
                 $id=base64_decode(urldecode($id));

       $delete=$this->adminsmodel->roledeletion($id); 
        if(!empty($delete))
        {
           $this->session->set_flashdata('successmessage', 'Role Group deleted successfully');
            $redirect = site_url('admin/role');
            redirect($redirect);

        } 
   }


/*-- End Of Role--*/


   }

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
