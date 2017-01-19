<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class GoogleplusLogin extends CI_Controller {

    /**
     * This functionality is for
     * Google+ login
     *
     * <p>
     *  @author : 
     *  @param : 
     * </p>
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model("front/registration", "customer");
    }

    public function index() {
            
        ########## Google Settings.. Client ID, Client Secret from https://cloud.google.com/console #############
		$google_client_id 		= '91641122566-qvb3cct5kjfb12vj45hq43lpquh0n2t1.apps.googleusercontent.com';
		$google_client_secret 	= 'd6cfFLAXWQK0wpoGV038dilr';
		$google_redirect_url 	= base_url('googleplusLogin'); //path to your script
		 
		
		//include google api files
		require_once APPPATH.'third_party/src/Google_Client.php';
		require_once APPPATH.'third_party/src/contrib/Google_Oauth2Service.php';
		
		
		
		//start session
		//session_start();
		
		$gClient = new Google_Client();
		$gClient->setApplicationName('Kamer G+ login');
		$gClient->setClientId($google_client_id);
		$gClient->setClientSecret($google_client_secret);
		$gClient->setRedirectUri($google_redirect_url);
		
		
		$google_oauthV2 = new Google_Oauth2Service($gClient);
		
		//If user wish to log out, we just unset Session variable
		if (isset($_REQUEST['reset'])) 
		{
		  //unset($_SESSION['token']);
          $this->session->unset_userdata('token');
		  $gClient->revokeToken();
		  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
		}
		
		//If code is empty, redirect user to google authentication page for code.
		//Code is required to aquire Access Token from google
		//Once we have access token, assign token to session variable
		//and we can redirect user back to page and login.
		
		
		if (isset($_GET['code'])) 
		{ 
			$gClient->authenticate($_GET['code']);
			//$_SESSION['token'] = $gClient->getAccessToken();
             $token=$gClient->getAccessToken();
            $this->session->set_userdata('token',$token);

			header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
			return;
		}
		
		
		if (!empty($this->session->userdata('token'))) 
		{ 
			$gClient->setAccessToken($_SESSION['token']);
		}
		
		
		if ($gClient->getAccessToken()) 
		{
			 //For logged in user, get details from google using access token
			 $user= $google_oauthV2->userinfo->get();


               

			 
                         // $data = Array (
                         //                   'socialID'			    =>	$user['id'],
                         //                   'social_name'	            =>  filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS),
                         //                   'social_fname'	            =>  filter_var($user['given_name'], FILTER_SANITIZE_SPECIAL_CHARS),
                         //                   'social_lname' 		    =>	filter_var($user['family_name'], FILTER_SANITIZE_SPECIAL_CHARS),
                         //                   'social_email' 		    =>	filter_var($user['email'], FILTER_SANITIZE_EMAIL),
                         //                   'social_gender' 		    =>	$user['gender'],
                         //                   'user_type' 		=> 'GP'
                         //               );
                        // set session variables
                        //$this->session->set_userdata($data);
                       
            $arrdata=array();
            $arrdata['social_type']='GP';
            $arrdata['id']=$user['id'];

            $res=$this->customer->getSocial($arrdata);

            if(!empty($res))
            {
                 //$this->session->set_userdata('sess_playerdet',json_encode($res));
                $this->session->set_userdata('sess_userdtl',json_encode($res));
                 $this->session->set_userdata('sess_social_pic',$user['picture']);
                $this->session->set_flashdata('successmessage', 'You have successfully logged in.');

                redirect(site_url('buyer-profile'));

            }
            else
            {
                $arr=array();
               
                $name=$user['name'];
                $namearr=preg_split('#\s+#', $name, 2);;

                $arr['google_id']=$user['id'];
                $arr['fname']=(empty($namearr[0]))?'':$namearr[0];
                $arr['lname']=(empty($namearr[1]))?'':$namearr[1];
                $arr['email']=$user['email'];
                $arr['password']='';
                $arr['status']='1';
                $arr['is_deleted']='0';
                $arr['created_date']=date('Y-m-d H:i:s');
                $arr['modified_date']=date('Y-m-d H:i:s');


                $result=$this->customer->registerSocial($arr);

                if(!empty($result))
                 {
                     $this->session->set_userdata('sess_userdtl',json_encode($result));
                     $this->session->set_userdata('sess_social_pic',$user['picture']);

                     redirect(site_url('buyer-profile'));

                 }
                 else
                 {

                    $this->session->set_flashdata('errormessage', 'Oops.Something went wrong.Please try again later.');
                     redirect(base_url());

                 }


            }


                        
                        //  if ($this->usermodel->getSocial($arrdata) == FALSE){
                             
                        //     $this->usermodel->add_social();
                            
                        //     redirect(base_url());
                        // }
                        
                        //   redirect(base_url());
                        
					
		}
		else 
		{
			//For Guest user, get google login url
			$authUrl = $gClient->createAuthUrl();
			redirect($authUrl);
		}
       
                
    }
            
                


}
