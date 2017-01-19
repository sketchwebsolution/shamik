<?php
class settingsmodel extends CI_Model
{
    public function __construct()
	{
        parent::__construct();
        $this->load->database();
	}
    
	public function loadsettings()
	{
		$sql="select * from ".tablename('settings');
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;
	}


		public function getData($id)
	{
		$sql="select * from ".tablename('settings')." where id='".$id."'";
		$query=$this->db->query($sql);
		$row=$query->row();
		return $row;
	}

		public function getDataSlug($slug)
	{
		$sql="select * from ".tablename('settings')." where skey='".$slug."' and status='1'";
		$query=$this->db->query($sql);
		$row=$query->row();
		return $row;
	}

		public function getDataSlugArray($slug)
	{
		$sql="select * from ".tablename('settings')." where skey IN ('".$slug."') and status='1'";
		$query=$this->db->query($sql);
		$row=$query->result_array();
		return $row;
	}


	public function modifyData($arr,$id=NULL)
	{
	
		if(empty($id))
		{
			
			$this->db->insert(tablename('settings'), $arr); 

           	$inserid=$this->db->insert_id();
			if(!empty($inserid))
			{
				return 1;
			}
			else
			{
				return;
			}
		}
		else
		{
			
			$this->db->where('id', $id);
			$this->db->update(tablename('settings'), $arr); 

               return 1;
		}
		
	}
	public function deleteData($id)
	{
		$sql="delete from ".tablename('settings')." where id='".$id."'";
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
	
	public function statusData($id)
	{
		$sql="select on_off from ".tablename('settings')." where id='".$id."'";
		$query=$this->db->query($sql);
		$r=$query->row();
                
		$status=(($r->on_off=='0') || ($r->on_off==0))?'1':'0';
                
		$ssql="update ".tablename('settings')." set on_off='0' where id='".$id."'";
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
