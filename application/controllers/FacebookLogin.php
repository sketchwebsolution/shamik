<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class FacebookLogin extends CI_Controller {

    public $user = "";

    public function __construct() {
        parent::__construct();
        $this->load->model("front/registration", "customer");
        $this->load->library('facebook', array('appId' => '374705226217166', 'secret' => '46c703ffe9840e931a28dc3169ab1c85'));

        $this->user = $this->facebook->getUser();
    }

    public function index() {

        if ($this->user) {
            $data['user_profile'] = $this->facebook->api('/me?fields=id,name,email,picture');

            //print_r($data['user_profile']); die();

            $url = $this->facebook->getLogoutUrl(array('next' => base_url() . 'facebookLogin/logout'));

            $data['logout_url'] = $url;

            $id=$data['user_profile']['id'];

            $arrdata=array();
            $arrdata['social_type']='FB';
            $arrdata['id']=$id;

            $res=$this->customer->getSocial($arrdata);

            if(!empty($res))
            {
                 //$this->session->set_userdata('sess_playerdet',json_encode($res));
                $this->session->set_userdata('sess_userdtl',json_encode($res));
                $this->session->set_flashdata('successmessage', 'You have successfully logged in.');

                 $picture="http://graph.facebook.com/".$data['user_profile']['id']."/picture?type=large";
                    $this->session->set_userdata('sess_social_pic',$picture);
               

                 redirect(site_url('buyer-profile'));
            }
            else
            {
                $arr=array();
               
                $name=$data['user_profile']['name'];
                $namearr=preg_split('#\s+#', $name, 2);;

                $arr['facebook_id']=$data['user_profile']['id'];
                $arr['fname']=(empty($namearr[0]))?'':$namearr[0];
                $arr['lname']=(empty($namearr[1]))?'':$namearr[1];
                $arr['email']=(empty($data['user_profile']['email']))?'':$data['user_profile']['email'];
                $arr['password']='';
                $arr['status']='1';
                $arr['is_deleted']='0';
                $arr['created_date']=date('Y-m-d H:i:s');
                $arr['modified_date']=date('Y-m-d H:i:s');

                 $picture="http://graph.facebook.com/".$data['user_profile']['id']."/picture?type=large";
                    $this->session->set_userdata('sess_social_pic',$picture);
                    
                $result=$this->customer->registerSocial($arr);

                if(!empty($result))
                 {
                     $this->session->set_userdata('sess_userdtl',json_encode($result));

                   redirect(site_url('buyer-profile'));

                 }
                 else
                 {

                    $this->session->set_flashdata('errormessage', 'Oops.Something went wrong.Please try again later.');
                     redirect(base_url());

                 }


            }


               
           
        } else {

            $link = $this->facebook->getLoginUrl(array('scope' => 'email'));
            echo "<script> location.href='" . $link . "'; </script>";
        }
            
 }
    

    // Logout from facebook
    public function logout() {

        session_destroy();
        $this->session->sess_destroy();
        redirect(base_url());
    }

}

/* End of file users.php */
/* Location: ./application/controllers/front/facebookLogin.php */
