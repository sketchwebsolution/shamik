<?php
class cmsmodel extends CI_Model
{
    public function __construct()
	{
        parent::__construct();
        $this->load->database();
	}
    
	public function loadcms()
	{
		$sql="select * from ".tablename('cms');
		$query=$this->db->query($sql);
		$result=$query->result();
		if(!empty($result))
		{
			return $result;
		}
		else
		{
			return "";
		}
	}
	
	public function loadcmssingle($id)
	{
		$sql="select * from ".tablename('cms')." where id='".$id."'";
		$query=$this->db->query($sql);
		$row=$query->row();
		if(!empty($row))
		{
			return $row;
		}
		else
		{
			return "";
		}
	}
	
	public function changecms($id)
	{
		$title=$this->input->post('title');
		$content=$this->input->post('content');
		$content=addslashes($content);
		//$content=htmlentities($content,ENT_QUOTES,'utf-8');
        $meta_title=$this->input->post('meta_title');
		$meta_key=$this->input->post('meta_key');
        $meta_description=$this->input->post('meta_description');
        $meta_description=addslashes($meta_description);

		//$meta_description=htmlentities($meta_description,ENT_QUOTES,'utf-8');
		if(empty($id))
		{
			$ntit=str_replace(' ','-',$title);
			$alias=strtolower($ntit);
			$sql="insert into ".tablename('cms')." set title='".$title."',content='".$content."',meta_title='".$meta_title."',meta_key='".$meta_key."',meta_description='".$meta_description."',alias='".$alias."',creation_date='".date('Y-m-d H:i:s')."',modified_date='".date('Y-m-d H:i:s')."'";
		}
		else
		{
			$sql="update ".tablename('cms')." set title='".$title."',content='".$content."',meta_title='".$meta_title."',meta_key='".$meta_key."',meta_description='".$meta_description."',modified_date='".date('Y-m-d H:i:s')."' where id='".$id."'";
		}
		$query=$this->db->query($sql);
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	public function deletecms($id)
	{
		$sql="delete from ".tablename('cms')." where id='".$id."'";
		$query=$this->db->query($sql);
		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
	
	public function statuscms($id)
	{
		$sql="select on_off from ".tablename('cms')." where id='".$id."'";
		$query=$this->db->query($sql);
		$r=$query->row();
                
		$status=$r->on_off;
                
		if($status==1)
		{
			$ssql="update ".tablename('cms')." set on_off='0' where id='".$id."'";
		}
		if($status==0)
		{
			$ssql="update ".tablename('cms')." set on_off='1' where id='".$id."'";
		}
		$qquery=$this->db->query($ssql);
		if(!empty($qquery))
		{
			return 1;
		}
		else
		{
			return "";
		}
	}
}