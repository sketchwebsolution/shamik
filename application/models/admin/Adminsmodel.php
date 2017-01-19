<?php
class adminsmodel extends CI_Model
{
    public function __construct()
	{
		
        	parent::__construct();
          	$this->load->database();
	}
    
    public function updateadmin($fname,$lname,$email,$profilepic,$username)
	{
		$admin_uid=$this->session->userdata('admin_uid');
		if(!empty($profilepic))
		{
			$profilepic=json_decode($profilepic);
			
			$this->load->library('upload');
			
			$filename=$profilepic->profile_pic->name;
					
			$imarr=explode(".",$filename);
					
			$ext=end($imarr);
			
			$_FILES['profile_pic']['name']=$profilepic->profile_pic->name;
			$_FILES['profile_pic']['type']=$profilepic->profile_pic->type;
			$_FILES['profile_pic']['tmp_name']=$profilepic->profile_pic->tmp_name;
			$_FILES['profile_pic']['error']=$profilepic->profile_pic->error;
			$_FILES['profile_pic']['size']=$profilepic->profile_pic->size;
			
			$config = array(
				'file_name' => str_replace(".","",microtime(true)).".".$ext,
				'allowed_types' => 'gif|png|jpg|jpeg',
				'upload_path' => APPPATH.'../assets/uploads',
				'max_size' => 2000
			);
			
			$this->upload->initialize($config);
			
			if (!$this->upload->do_upload('profile_pic'))
			{
				$errormsg=$this->upload->display_errors();
				$arr=array('error'=>1,'success'=>'','errormsg'=>strip_tags($errormsg));
				return json_encode($arr);
			}
			else
			{
				$image_data = $this->upload->data();
				$upName=$image_data['file_name'];
				$viewdet['status']=1;
			
				$config = array(
					'source_image' => $image_data['full_path'],
					'new_image' => APPPATH.'../assets/uploads/thumbs',
					'maintain_ration' => true,
					'width' => 200,
					'height' => 150
				);
			
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				
				$imagename=$image_data['file_name'];
				
				$sql="update ".tablename('admins')." set image='".$imagename."' where id='".$admin_uid."'";
				$query=$this->db->query($sql);
				
				$adminimage=get_from_session('image');
				
				@unlink(APPPATH.'../assets/uploads/'.$adminimage);
				@unlink(APPPATH.'../assets/uploads/thumbs/'.$adminimage);
			}
		}
		
		$sql="update ".tablename('admins')." set fname='".$fname."',lname='".$lname."',username='".$username."',email='".$email."' where id='".$admin_uid."'";
		$qq=$this->db->query($sql);
		
		$selsql="select * from ".tablename('admins')." where id='".$admin_uid."'";
		$query=$this->db->query($selsql);
		$admindet=$query->row();
		$admindet=json_encode((array)$admindet);
		$arr=array('error'=>'','success'=>1,'errormsg'=>'');
		$this->session->set_userdata('admin_detail',$admindet);
		return json_encode($arr);
	}
}