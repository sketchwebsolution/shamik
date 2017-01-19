<?php
class authmodel extends CI_Model
{
    public function __construct()
	{
		
        	parent::__construct();
          	$this->load->database();
	}
    
    public function checklogin($email,$password)
    {
        $checkon=$this->input->post('checkon');
        $sql="select * from ".tablename('admins')." where email='".addslashes(trim($email))."' and password='". sha1($password)."'";
		
        $query=$this->db->query($sql);
		$adminrow=$query->row();

        if(!empty($adminrow))
        {
            $adminid=$adminrow->id;
            $useragent=$_SERVER['HTTP_USER_AGENT'];
            $ipaddress=$_SERVER['REMOTE_ADDR'];
            $online=1;
            $modified_date=date('Y-m-d H:i:s');
            $updsql="update ".tablename('admins')." set ip_address='".addslashes($ipaddress)."',user_agent='".addslashes($useragent)."',online_status='".$online."',modified_date='".$modified_date."'";
            $upquery=$this->db->query($updsql);
            if(!empty($upquery))
            {
            	$sql="select * from ".tablename('admins')." where email='".addslashes(trim($email))."' and password='". sha1($password)."'";
		        $query=$this->db->query($sql);
				$adminrow=$query->row();

                $userarr=(array)$adminrow;
                $js_userarray=json_encode($userarr);
                $this->session->set_userdata('admin_uid',$adminid);
                $this->session->set_userdata('admin_detail',$js_userarray);
                if(!empty($checkon))
                {
                    $expire=3660*24*30;
                    set_cookie('admin_uid', $adminid, $expire);
                    set_cookie('admin_detail', $js_userarray, $expire);
                }
                return 1;
            }
            return "";
        }
        return "";
    }
    
    public function checklogout($uid)
    {
        $modified_date=date('Y-m-d H:i:s');
        $sql="update ".tablename('admins')." set ip_address='',user_agent='',online_status='0',last_login='".$modified_date."',modified_date='".$modified_date."'";
        $q=$this->db->query($sql);
        if(!empty($q))
        {
            $this->session->set_userdata('admin_uid','');
            $this->session->set_userdata('admin_detail','');
			delete_cookie('admin_uid');
			delete_cookie('admin_detail');
            return 1;
        }
        else
        {
            return "";
        }
    }
	
	public function emailcheck($email)
	{
		$sql="select id from ".tablename('admins')." where email='".addslashes(trim($email))."'";
		$query=$this->db->query($sql);
		$row=$query->row();
		if(!empty($row))
		{
            $this->load->library('parser');
			$adminid=$row->id;
			$emailarr=explode("@",$email);
			$emuname=sha1($emailarr[0]);
			$activationlink=$this->config->item('base_url')."admin/new-password.html/".$emuname;
			$usql="update ".tablename('admins')." set hash='".$emuname."' where id='".$adminid."'";
			$q=$this->db->query($usql);
			if(!empty($q))
			{
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// More headers
				$headers .= 'From: <'.get_admin_email().'>' . "\r\n";

            $message="Please click the  link to reset your password.<a href='".$activationlink."'> Click Here</a>";

            $tdata['date']=date('l F d, Y');
            $tdata['year']=date("Y");
            $tdata['siteurl']= $this->config->item('base_url');
            $tdata['logo']=$tdata['siteurl']."assets/images/logo.png";
            $tdata['heading'] = "Recover Your Password";
            $tdata['message'] = $message;

            $msg = $this->parser->parse('mail/mail-template', $tdata,TRUE);

				$mm=mail($email,"Recover Password for TCR Member",$msg,$headers);


				//$mm=mail($email,"Recover Password for TCR Member",$activationlink,$headers);
				//sendmail for resetpass
				return 1;
			}
		}
		else
		{
			return "";
		}
	}
	
	public function passwdupd($password,$activationcode)
	{
		$sql="update ".tablename('admins')." set password='".sha1($password)."',hash='' where hash='".$activationcode."'";
		$q=$this->db->query($sql);
		if(!empty($q))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}

 public function checkAdmin($adminid)
	{

   $this -> db -> from(tablename('admins'));
		   $this -> db -> where('id', $adminid);

		   $this -> db -> limit(1);
		 
		   $query = $this->db-> get();
		 
		   if($query -> num_rows() == 1)
		   {
			 return $query->result();
		   }
		   else
		   {
			 return false;
		   }

        }



	public function changePwd($password,$adminid)
	{
		$sql="update ".tablename('admins')." set password='".sha1($password)."' where id='".$adminid."'";
		$q=$this->db->query($sql);
		if(!empty($q))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}


}
