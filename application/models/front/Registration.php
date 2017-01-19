<?php
class Registration extends CI_Model
{
    public function __construct()
	{
        parent::__construct();
        $this->load->database();
	}
    
	
	
	public function register($data=array())
	{
		$email=$data['email'];	
		$password=$data['password'];

		$data['password']=sha1($data['password']);

		$chkdup=$this->db->where('email',$data['email'])->get(tablename('users'))->num_rows();
		if($chkdup>0)
		{
			return '0';
		}
		else
		{
			$flg=$this->db->insert(tablename('users'),$data);
			$uid=$this->db->insert_id();
			if(!empty($uid))
			{
			 $datas['user_code']=generateUniqueCode('HB',$uid);
			 $playerdet=$this->db->where('id',$uid)->update(tablename('users'),$datas);
			 //$result=$this->db->where('id',$uid)->get(tablename('users'))->row();
			// $this->session->set_userdata('sess_userdtl',json_encode($result));

               $idval=urlencode(base64_encode($uid));
               $link=base_url('acivate-hiberce-account.html/'.$idval);


              
                $message ="<p>Hi  <strong>".$data['fname']."</strong></p><p>WELCOME TO HIBERCE! </p>";
                $message .="<p><strong>Email : </strong> " .$email  . "</p>";
                $message .="<p><strong >Password : </strong> " . $password . "</p>";
                $message .="<p><strong><a href='".$link."'>Click Here To active your account</a> </strong> </p>";
                 $arr=array();
                 $arr['message']=$message;
                 $arr['email']=$email;
                 $arr['subject']="User Login Details";

                 project_mail($arr);


			 return $flg;	
			}
			else
			{
				return '0';

			}

		}
	}

	public function login($arr)
	{
		$password=$arr['password'];
		$oldpassword=sha1($password);
		unset($arr['password']);
		$result=$this->db->where($arr)->get(tablename('users'))->row();
		if(!empty($result))
		{
			if($result->password==$oldpassword) // Password checking for login
			{


				switch($result->status)
					{
						case '1':
						case '3':  $uid=$result->id;
						           $datas['user_id']=$uid;
						            	/*-- Get Last Login Logger--*/       
						            $resultlog=$this->db->where($datas)->order_by("created_date","desc")->get(tablename('login_log'))->row();
						            	/*-- Get Last Login Logger--*/
						             $arrnewlog=array();

						             $ip=get_client_ip();
						             $agent=get_client_agent();  


						             if(!empty($resultlog))  
						             {
                                        if($resultlog->login_ip==$ip && $resultlog->login_device==$agent)
                                           {
                                           	 if($result->status==3)
                                              {
                                           	  $this->db->where('id',$uid)->update(tablename('users'),array('status'=>'1')); // Activate account if its deactivate
                                           	  }
                                           		/*-- Login New Logger --*/


									            $arrnewlog['user_id']=$uid;
									            $arrnewlog['login_ip']=$ip;
									            $arrnewlog['login_device']=$agent; 
									            $arrnewlog['login_agent']=$_SERVER['HTTP_USER_AGENT']; 
			 									$arrnewlog['created_date']=date('Y-m-d H:i:s'); 
									            $arrnewlog['modified_date']=date('Y-m-d H:i:s'); 
									            $arrnewlog['last_login']=(empty($resultlog->created_date))?'':$resultlog->created_date;
												$arrnewlog['last_login_ip']=(empty($resultlog->login_ip))?'':$resultlog->login_ip;
									            $this->db->insert(tablename('login_log'),$arrnewlog);

									            /*-- Login New Logger --*/


                                                $checkon=$this->input->post('remember');
									             if(!empty($checkon))
								                {
                                                    
								                	$email=$arr['email'];
								                	
								                    $expire=3660*24*30;


								                    $em=get_cookie("hiberceemail"); $pwd=get_cookie("hibercepassword");
								                    if(empty($em))
								                     {
								                     	set_cookie('hiberceemail', $email, $expire);
								                     }
								                    if(empty($pwd))
								                     {
								                      set_cookie('hibercepassword', $password, $expire);
								                     }	                     
								                }
								                else
								                {
								                    $em=get_cookie("hiberceemail"); $pwd=get_cookie("hibercepassword");
								                    if(!empty($em))
								                     {
								                     	delete_cookie('hiberceemail');
								                     }
								                    if(!empty($pwd))
								                     {
								                      delete_cookie('hibercepassword');
								                     }
								                }



		 										$this->session->set_userdata('sess_userdtl',json_encode($result));
								            	$this->session->set_flashdata('successmessage', 'You have successfully logged in.');
						           				return 1;
                                           }
                                           else
                                           {
                                           	$idval=urlencode(base64_encode($uid));

               								$link=base_url('confirm-hiberce-account.html/'.$idval);
               								$message ="<p>Hello ".$result->fname.' '.$result->lname."</p>";

							                $message .="<p>Someone tries to login your account using your login details</p>";
               								$message .="<p><strong><a href='".$link."'>Click Here To unblock your account</a> </strong> </p>";		             								                
							                 $arr=array();
							                 $arr['message']=$message;
							                 $arr['email']=$result->email;
							                 $arr['subject']="Login From Another Device";

							                 project_mail($arr);
											$this->session->set_flashdata('errormessage', 'Someone tries to login your account using your login details.Please check your mail to unblock your account');


			
			                              $this->db->where('id',$uid)->update(tablename('users'),array('status'=>'3')); // Deactivate account

 											return 2;
                                           }

										
						             }
						             else 
						             {
										// no data found. First time login


										/*-- Login New Logger --*/


									            $arrnewlog['user_id']=$uid;
									            $arrnewlog['login_ip']=$ip;
									            $arrnewlog['login_device']=$agent; 
									            $arrnewlog['login_agent']=$_SERVER['HTTP_USER_AGENT']; 
			 									$arrnewlog['created_date']=date('Y-m-d H:i:s'); 
									            $arrnewlog['modified_date']=date('Y-m-d H:i:s'); 
									            $arrnewlog['last_login']=(empty($resultlog->created_date))?'':$resultlog->created_date;
												$arrnewlog['last_login_ip']=(empty($resultlog->login_ip))?'':$resultlog->login_ip;
									            $this->db->insert(tablename('login_log'),$arrnewlog);

									            /*-- Login New Logger --*/

									           $this->session->set_userdata('sess_userdtl',json_encode($result));
									           $this->session->set_flashdata('successmessage', 'You have successfully logged in.');
									           return 1;
						             }
						           break;
						case '2':  $this->session->set_flashdata('errormessage', 'Your email address is not yet verified');
						           return 0;	 
						           break;
						case '0':  $this->session->set_flashdata('errormessage', 'Your account is not deactivated.please contact Hiberce admin for more details');
						           return 0;	 
						           break;	
					}

            }
		   else
		   {
				$this->session->set_flashdata('errormessage', 'You have entered a wrong password');
				return 0;
		   }
		}
		else
		{
			$this->session->set_flashdata('errormessage', 'You have entered a wrong login details');
			return 0;
		}
	}

   public function getSocial($arr)
   {
     if($arr['social_type']=='FB')
     {
        $result=$this->db->where('facebook_id',$arr['id'])->get(tablename('users'))->row();

         return $result; 	
     }
     else if($arr['social_type']=='TW')
     {
        $result=$this->db->where('twitter_id',$arr['id'])->get(tablename('users'))->row();

         return $result; 	
     }     
     else
     {
        $result=$this->db->where('google_id',$arr['id'])->get(tablename('users'))->row();

         return $result; 	
     }    

   }


   public function registerSocial($arr)
   {
    $this->db->insert(tablename('users'),$arr);


    $id=$this->db->insert_id();

    if($id!='0' || $id!='0')
    {
    	$datas['user_code']=generateUniqueCode('HB',$id);
		$this->db->where('id',$id)->update(tablename('users'),$datas);

 		$result=$this->db->where('id',$id)->get(tablename('users'))->row();
        return $result;

    }
    else
    {
    	    return '';

    }
   }

   	public function activateAccount($id)
	{
 		$sql="SELECT  u.* FROM `h_users` u where time_to_sec(TIMEDIFF(NOW(),u.created_date))/3600 <=24 and id=$id";
 		$query=$this->db->query($sql);
		$row=$query->row();
		if(!empty($row))
		{
			$datas['status']='1';
			$result=$this->db->where('id',$id)->update(tablename('users'),$datas);


			 $this->session->set_userdata('sess_userdtl',json_encode($row));

			return '1';
		}
		else
		{
			return "0";
		}


	}

   	public function confirmAccount($id)
	{
 		$result=$this->db->where(array("id"=>$id))->get(tablename('users'))->row();
		if(!empty($result))
		{
			if($result->status=='3')
			{
            	$this->db->where('id',$id)->update(tablename('users'),array('status'=>'1')); // Deactivate account
            	$this->session->set_userdata('sess_userdtl',json_encode($result));

                $this->session->set_flashdata('errormessage', 'You have successfully logged in.');



                  $arrnewlog=array();

						             $ip=get_client_ip();
						             $agent=get_client_agent();  
													/*-- Login New Logger --*/


									            $arrnewlog['user_id']=$id;
									            $arrnewlog['login_ip']=$ip;
									            $arrnewlog['login_device']=$agent; 
									            $arrnewlog['login_agent']=$_SERVER['HTTP_USER_AGENT']; 
			 									$arrnewlog['created_date']=date('Y-m-d H:i:s'); 
									            $arrnewlog['modified_date']=date('Y-m-d H:i:s'); 
									            $arrnewlog['last_login']=(empty($resultlog->created_date))?'':$resultlog->created_date;
												$arrnewlog['last_login_ip']=(empty($resultlog->login_ip))?'':$resultlog->login_ip;
									            $this->db->insert(tablename('login_log'),$arrnewlog);

									            /*-- Login New Logger --*/


			    return '1';
			}
			else
			{
			$this->session->set_flashdata('errormessage', 'Confimation link has been expire');

						return '1';
	
			}
			

		}
		else
		{
			$this->session->set_flashdata('errormessage', 'Not a valid confimation link');

			return "0";
		}


	}



public function isunique($field,$value)
{
			$result=$this->db->where(array($field=>$value))->get(tablename('users'))->row();
           return count($result);

}



public function getData($arr)
{
			$result=$this->db->where($arr)->get(tablename('users'))->row();
           return $result;

}


public function modifyFewData($id,$datas)
{
	$result=$this->db->where('id',$id)->update(tablename('users'),$datas);

}

public function totalPreference($id)
{
	$query = $this->db->query("select * from ".tablename('user_interest')." where user_id=$id");
	return $query->num_rows();
}

}
