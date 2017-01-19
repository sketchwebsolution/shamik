<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Front extends CI_Controller {


    public function __construct() {
        parent::__construct();
    }

    /*-- Landing Page --*/
    public function index() {
       
       $this->load->helper('captcha');

    
        $data=array();


       // numeric random number for captcha
      $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
      // setting up captcha config
      $vals = array(
             'word' => $random_number,
             'img_path' => './assets/captcha/',
             'img_url' => base_url().'assets/captcha/',
             'img_width' => 140,
             'img_height' => 45,
             'expiration' => 7200,
             'img_id'=>'captha_image' 
            );
      $data['captcha'] = create_captcha($vals);
      $this->session->set_userdata('captchaWord',$data['captcha']['word']);
      
        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . '');
        // $this->layouts->render('front/index',$data);
        $this->layouts->render('front/home', $data);
    }

    /*-- CMS Page --*/

      public function pages() {
        //front_auth_pages();
        $this->load->model('front/cms', 'cms');

        $slug = $this->uri->segment(1);
        $arr = explode('.', $slug);
        $slug = $arr[0];
        $data['cms'] = $this->cms->getCms($slug);
        $data['active'] = $data['cms']->id;
        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . '');
         if($data['cms']->alias=="privacy-policy" || $data['cms']->alias=="terms-and-conditions")
         {
             $this->layouts->render('front/tremsandpolicy', $data,'header-inner');

         }
         else
         {
             $this->layouts->render('front/pages', $data,'header-inner');
         }
    
    }

    /*-- Sign UP --*/

   public function signup()
   {
      
      if(empty($this->input->post()))
      {
        $this->session->set_flashdata('errormessage', 'Please fill all data for create account');
        $path=base_url();
        redirect($path);
      }
      else
      {
        $this->load->model('front/registration');

        if(filter_has_var($this->input->post('uemail'), FILTER_VALIDATE_EMAIL))
        {
            $this->session->set_flashdata('errormessage', 'The email could not be sent. Please update your email address.');
        $path=base_url();
        redirect($path);

        }

        $data=array();
        $data['fname']=$this->input->post('fname');
        $data['lname']=$this->input->post('lname');
        $data['email']=$this->input->post('uemail');
        $data['password']=$this->input->post('upassword');
        $data['status']='2';
        $data['is_deleted']='0';
        $data['created_date']=date('Y-m-d H:i:s');
        $data['modified_date']=date('Y-m-d H:i:s');

        $flg=$this->registration->register($data);
        if(!empty($flg))
        {
               
          $this->session->set_flashdata('registermessage', 'We just sent you an email confirmation link. Please click on the link to confirm your email address.');
                  

        }
        else
        {
          $this->session->set_flashdata('errormessage', 'Oops.Something went wrong');

        }
        $path=base_url();
        redirect($path);
      }

   }
   
    public function acivateaccount()
    {

     $code = $this->uri->segment(2);
     if(!empty($code))
     {
         $code=base64_decode(urldecode($code));

         $this->load->model('front/registration');
         $flg=$this->registration->activateAccount($code);

        if(!empty($flg))
        {
          $this->session->set_flashdata('successmessage', 'You have successfully logged in.');
          //$path=base_url();
          $path=site_url('buyer-profile');
        }
        else
        {
          $this->session->set_flashdata('errormessage', 'Activation link has been expire');
          $path=base_url();
        }
        redirect($path);

     }
      else
      {
        $this->session->set_flashdata('errormessage', 'Not a valid link');
        $path=base_url();
        redirect($path);
      }
    }

       /*-- LOGIN--*/

    public function login()
    {
      
      $data=array();
      if(empty($this->input->post()))
      {
        $this->session->set_flashdata('errormessage', 'Please fill all data for login into account');
        $path=base_url();
        redirect($path);
      }
      else
      {
        $this->load->model('front/registration');

        $data['email']=$this->input->post('semail');
        $data['password']=$this->input->post('spassword');
        $data['is_deleted']='0';
        
        $flg=$this->registration->login($data);
         $path=base_url();
        if(!empty($flg))
        {
              if($flg==1)
              {
                         $path=site_url('buyer-profile');

              }
        }
       
        redirect($path);
      }
    }

     /*-- UNBLOCK PROFILE IF LOGIN FROM ANOTHER DEVICE--*/
    public function confirmaccount()
    {
     $code = $this->uri->segment(2);
     //echo $code; die();

     if(!empty($code))
     {
         $code=base64_decode(urldecode($code));
         $this->load->model('front/registration');
         $flg=$this->registration->confirmAccount($code);
         $path=base_url();
         redirect($path);
     }
      else
      {
        $this->session->set_flashdata('errormessage', 'Not a valid link');
        $path=base_url();
        redirect($path);
      }
    }

    
    /*-- LOGOUT--*/

    public function logout()
    {
      $this->session->unset_userdata('sess_userdtl');
      $this->session->set_flashdata('successmessage', 'You have logged out successfully');
      $redirect=base_url();
      redirect($redirect);
    }

    /*-- SIGN UP EMAIL UNIQUE CHECKING--*/

public function checkunique()
 {
        $this->load->model('front/registration');
        $field = $_POST['field'];
        $value = $_POST['value'];
        $result=$this->registration->isunique($field,$value);
        echo ($result==0) ? "true" : "false";
    
 }



    /*-- Create Capcha Text--*/

  public function check_captcha(){
    $word = $this->session->userdata('captchaWord');
    $str=$this->input->post('userCaptcha');

     echo ($word==$str) ? "true" : "false";
   
  }


public function captcha()
{
      $this->load->helper('captcha');

  $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
      // setting up captcha config
      $vals = array(
             'word' => $random_number,
             'img_path' => './assets/captcha/',
             'img_url' => base_url().'assets/captcha/',
             'img_width' => 140,
             'img_height' => 45,
             'expiration' => 7200
            );
      $dataval = create_captcha($vals);
     
      
      $this->session->set_userdata('captchaWord',$dataval['word']);
       
      echo   base_url().'assets/captcha/'.$dataval['filename'] ;
}


public function forgotpassword()
{
  $email=$this->input->post('ufemail');
  $mobile=$this->input->post('ufmobile');
        $this->load->model('front/registration');

  if(!empty($email))
  {

      $uuidcode=mt_rand(100000,999999);
      $arr['email']=$email;

      $result=$this->registration->getData($arr);

      if(!empty($result))
      {
      if($result->login_attempt<3)
      {

      $datas['temp_password']=$uuidcode;
      $datas['pwd_check_status']=1;

      $this->registration->modifyFewData($result->id,$datas); // One Time Password Set

      $idval=urlencode(base64_encode($result->id));
      $dt=urlencode(base64_encode(date("Y-m-d")));
      $link=base_url('recover-password.html/'.$idval.'/'.$dt);
      $message ="<p>Hello ".$result->fname."</p>";
      $message .="<p>UUID Password ".$uuidcode."</p>";
      $message .="<p>Please click following link to login using uuid password</p>";
      $message .="<p><strong><a href='".$link."'>Recover Password</a> </strong> </p>";                                
      $arr=array();
      $arr['message']=$message;
      $arr['email']=$email;
      $arr['subject']="Hiberce Account Password Recover";
      project_mail($arr);
      $this->session->set_flashdata('successmessage', 'We just sent you an password recover link. Please click on the link to reset password of your account.');
         $path=base_url();
         redirect($path);

       
       }
       else
       {
              $this->session->set_flashdata('successmessage', 'You have exceeded the maximum number of attempts for today. The temporary password expired. Please try again tomorrow.');
         $path=base_url();
         redirect($path);
       }

     }
     else
     {
      $this->session->set_flashdata('successmessage', 'Email address is not register');
         $path=base_url();
         redirect($path);
     }

  }
  else if(!empty($mobile)){

    // $ch = curl_init();

    // curl_setopt($ch, CURLOPT_URL,"http://textbelt.com/text");
    // curl_setopt($ch, CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_POSTFIELDS,
    //             "number=9051335696&message=tttt");
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // $server_output = curl_exec ($ch);

    // curl_close ($ch);

    // $data=json_decode($server_output);
    // if ( $data['success']) {  

    //     $this->session->set_flashdata('successmessage', 'We just sent you an password recover  link. Please click on the link to reset password of your account.');

    //   } else {   

    //      $this->session->set_flashdata('errormessage', 'Unable to send sms ');

    //       }

 $this->session->set_flashdata('errormessage', 'Working on SMS gateway');

         $path=base_url();
         redirect($path);

  }
  else
  {
         $this->session->set_flashdata('errormessage', 'Oops.Something went wrong.Please try again later');

         $path=base_url();
         redirect($path);
  }  

}


public function recoverpassword()
{
     $codedt = $this->uri->segment(3);
     $code = $this->uri->segment(2);
     $this->load->model('front/registration');

     if(!empty($code) && !empty($codedt))
     {
           $id=base64_decode(urldecode($code));
           $dt=base64_decode(urldecode($codedt));
           if($dt!=date("Y-m-d"))
           {
            $this->session->set_flashdata('errormessage', 'Recovery Password link has been expired.Please click forget password link to get new recovery link');
            $this->session->unset_userdata('sess_recoverlink');
            $this->session->unset_userdata('sess_recoverlinkid');



            $datas1['temp_password']='';
            $datas1['pwd_check_status']='0';

            $this->registration->modifyFewData($id,$datas1); // RESET PASSWORD RECOVER PARAMETER

            
             $path=base_url();
             redirect($path);
           }


           $arr['id']=$id;
           $result=$this->registration->getData($arr);
           if(!empty($result))
           {
             $countattempt=$result->login_attempt;//Get Total Attempt of current date
             $attemptdt=$result->last_attempt_date;//Get Last Attempt Date

           

             if($attemptdt==date("Y-m-d")) // attempt on same day 
             {
                if(!empty($countattempt))
                {
                 $countattempt=intval($countattempt)+1;
                 $datas['login_attempt']=$countattempt;

                 if($countattempt >3)
                   {
                     $this->session->set_flashdata('errormessage', 'You have exceeded the maximum number of attempts for today. The temporary password expired. Please try again tomorrow.');
                   }
                   else
                   {
                          $this->session->set_userdata('sess_recoverlinkid',$id);

                          $this->session->set_userdata('sess_recoverlink','1');

                   }
                }
                else
                {
                 $datas['login_attempt']=1;
                                           $this->session->set_userdata('sess_recoverlinkid',$id);

                       $this->session->set_userdata('sess_recoverlink','1');

                }
             }
             else
             {
                $datas['login_attempt']=1;
                $this->session->set_userdata('sess_recoverlinkid',$id);

                $this->session->set_userdata('sess_recoverlink','1');               
             }
               $datas['last_attempt_date']=date("Y-m-d");
               $this->registration->modifyFewData($id,$datas);

           }
           else
           {
             $this->session->set_flashdata('errormessage', 'Not a valid user');
           }



         $path=base_url();
         redirect($path);
     }
    else
      {
        $this->session->set_flashdata('errormessage', 'Not a valid recovery link');
        $path=base_url();
        redirect($path);
      }

}


public function resetpassword()
{

  $this->load->model('front/registration');
  $id=$this->session->userdata('sess_recoverlinkid');
  $this->session->unset_userdata('sess_recoverlink');
  $this->session->unset_userdata('sess_recoverlinkid');
  $arr['id']=$id;
  $result=$this->registration->getData($arr);

  // print_r($result);

  // die();

  if(!empty($result))
   {
    if($result->last_attempt_date==date('Y-m-d'))
    {
      if ($result->temp_password==$this->input->post('temppwd')) {

           if($result->login_attempt >3)
           {
           
             $this->session->set_flashdata('errormessage',"You have exceeded the maximum number of attempts for today. The temporary password expired. Please try again tomorrow.");
           }
           else
           {

             $datas['password']=sha1($this->input->post('password1'));
             $datas['login_attempt']=0; 
             $datas['pwd_check_status']=0; 

             $this->registration->modifyFewData($id,$datas);

             $this->session->set_flashdata('successmessage', 'The password has been reset successfully');    
           }
        
      }
      else
      {

             $leftno=3-intval($result->login_attempt);
             $this->session->set_flashdata('errormessage',"You have ".$leftno." attempts left.");
      }
         
    }
    else
    {
       $this->session->set_flashdata('errormessage', 'Recover Password link has been expired.');
    }

   }
   else
   { 
      $this->session->set_flashdata('errormessage', 'Not a valid user');
   }

      $path=base_url();
      redirect($path);
      
}



public function buyerprofile()
{

  isLogin(true);
    $this->load->model('front/buyers');

  $data=array();
  $data['interests']=$this->buyers->getAllInterests();

    $result=$this->session->userdata('sess_userdtl');

  $data['details']= json_decode($result);
  $data['buyerinterests']=$this->buyers->getBuyerInterest($data['details']->id);
  $getsitename = getsitename();
  $this->layouts->set_title($getsitename . '');
  $this->layouts->render('front/buyerprofile', $data,'buyer_layout');

}



public function personalinfo()
{
   $this->load->library('user_agent');
   $this->load->model('front/buyers');
  $result=$this->session->userdata('sess_userdtl');
  $data=(Array)json_decode($result);

  if(!empty($this->input->post()))
  {
    $arr['fname']=$this->input->post('fname');
    $arr['lname']=$this->input->post('sname');
    $arr['job_title']=$this->input->post('jtitle');
    $arr['employer']=$this->input->post('employer');
    $arr['gender']=$this->input->post('sex');
    $arr['dob']=empty($this->input->post('dob'))? '':date("Y-m-d",strtotime($this->input->post('dob')));
    $arr['year_of_passing']=empty($this->input->post('yr_of_pasing'))? '':date("Y-m-d",strtotime($this->input->post('yr_of_pasing')));
    $arr['highest_education']=$this->input->post('education');
    $arr['relationship_status']=$this->input->post('relation');
    $arr['address']=$this->input->post('autocomplete');
    $arr['highest_edu_from']=$this->input->post('satent');
    $arr['address2']=$this->input->post('address2');
    $arr['state']=$this->input->post('state');
    $arr['country']=$this->input->post('country');
    $arr['zip']=$this->input->post('zip');

    $info=$this->buyers->updateBuyerInfo($arr,$data['id']);
    $infointerest=$this->buyers->updateBuyerInfoInterest($this->input->post('checkbox'),$data['id']);
    if(!empty($info))
    {
       $infoarr=$this->buyers->getBuyerInfo($data['id']);

      // print_r($infoarr[0]);

    //  $this->session->unset_userdata('sess_userdtl');
       $this->session->set_userdata('sess_userdtl',json_encode($infoarr[0]));
       $this->session->set_flashdata('successmessage', 'Profile is updated successfully');
    }
    else
    {
        $this->session->set_flashdata('errormessage', 'Oops.Something went wrong>please try again later.');      
    }
  }
  else
  {
      $this->session->set_flashdata('errormessage', 'Oops.Something went wrong>please try again later.');

  }
 redirect($this->agent->referrer());

}

public function basicinfosocial()
{
   $this->load->library('user_agent');
   $this->load->model('front/buyers');
  $result=$this->session->userdata('sess_userdtl');
  $data=(Array)json_decode($result);
  if(!empty($this->input->post()))
  {
    $arr['mobile']=$this->input->post('mnumber');    

   $info=$this->buyers->updateBuyerInfo($arr,$data['id']);

    if(!empty($info))
    {
       $infoarr=$this->buyers->getBuyerInfo($data['id']);
       $this->session->set_userdata('sess_userdtl',json_encode($infoarr[0]));
       $this->session->set_flashdata('successmessage', 'Mobile number is updated successfully');
    }
    else
    {
        $this->session->set_flashdata('errormessage', 'Oops.Something went wrong>please try again later.');      
    }

  }
   else
  {
      $this->session->set_flashdata('errormessage', 'Oops.Something went wrong>please try again later.');

  }
 redirect($this->agent->referrer());

}

public function basicinfo()
{
   $this->load->library('user_agent');
   $this->load->model('front/buyers');
  $result=$this->session->userdata('sess_userdtl');
  $data=(Array)json_decode($result);

  if(!empty($this->input->post()))
  {
    $arr['mobile']=$this->input->post('mnumber');    
    $arr['email']=$this->input->post('emailadd');
    if(!empty($this->input->post('psw')) && ($this->input->post('psw')==$this->input->post('conpsw')))
    {
      $arr['password']=sha1($this->input->post('psw'));
    }
    $info=$this->buyers->updateBuyerInfo($arr,$data['id']);

        if(!empty($info))
    {
       $infoarr=$this->buyers->getBuyerInfo($data['id']);
       $this->session->set_userdata('sess_userdtl',json_encode($infoarr[0]));
       $this->session->set_flashdata('successmessage', 'Profile is updated successfully');
    }
    else
    {
        $this->session->set_flashdata('errormessage', 'Oops.Something went wrong>please try again later.');      
    }
 
  }
   else
  {
      $this->session->set_flashdata('errormessage', 'Oops.Something went wrong>please try again later.');

  }
 redirect($this->agent->referrer());

}

public function buyerimage()
{
   $this->load->library('user_agent');
   $this->load->model('front/buyers');



  $result=$this->session->userdata('sess_userdtl');
  $data=(Array)json_decode($result);

  $config['upload_path']          = './assets/uploads/buyers/';
  $config['allowed_types']        = '*';

  $config1['upload_path']          = './assets/uploads/buyers/banners/';
  $config1['allowed_types']        = '*';
  $arr=array();


  $this->load->library('upload',$config);
  if (!$this->upload->do_upload('bp_pic'))
  {
          $error = array('error' => $this->upload->display_errors());
          print_r($error);

  }
 else
  {
          $dataimage = $this->upload->data();
        $arr['profile_pic']=$dataimage['file_name'];
  }
    $this->upload->initialize($config1); 

   $this->load->library('upload',$config1);
     if (!$this->upload->do_upload('bp_pic_banner'))
  {
          $error = array('error' => $this->upload->display_errors());

          print_r($error);

  }
 else
  {
        $dataimage = $this->upload->data();
        $arr['banner_pic']=$dataimage['file_name'];
  }




   if(count($arr) >0)
   {
      $info=$this->buyers->updateBuyerInfo($arr,$data['id']);

     if(!empty($info))
        {
           $infoarr=$this->buyers->getBuyerInfo($data['id']);
           $this->session->set_userdata('sess_userdtl',json_encode($infoarr[0]));
           if(!empty($arr['banner_pic']) && !empty($arr['profile_pic']))
           {
              unlink('assets/uploads/buyers/'.$_POST['old_profile_image']);
              unlink('assets/uploads/buyers/banners/'.$_POST['old_banner_image']);
              $this->session->set_flashdata('successmessage', 'Profile and Banner picures are  updated successfully');
           }
           else if(empty($arr['banner_pic']) && !empty($arr['profile_pic']))
           {
              unlink('assets/uploads/buyers/'.$_POST['old_profile_image']);
              $this->session->set_flashdata('successmessage', 'Profile picure is updated successfully');
           }  
           else  if(!empty($arr['banner_pic']) && empty($arr['profile_pic']))
           {
              unlink('assets/uploads/buyers/banners/'.$_POST['old_banner_image']);
              $this->session->set_flashdata('successmessage', 'Banner picure is updated successfully');
           }   
           else {}               
           
        }
        else
        {
            $this->session->set_flashdata('errormessage', 'Oops.Something went wrong.please try again later.');      
        }
         
   }
   else
   {
       $this->session->set_flashdata('errormessage', 'Oops.Something went wrong.please try again later.');    
   }


  redirect($this->agent->referrer());

}




}


/* End of file front.php */
/* Location: ./application/controllers/front.php */
