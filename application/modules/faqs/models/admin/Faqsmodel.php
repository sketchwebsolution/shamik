<?php
class faqsmodel extends CI_Model
{
    public function __construct()
	{
        parent::__construct();
        $this->load->database();
	}
    
	public function loadAll($id=NULL)
	{
		$sql="select * from ".tablename('faqs');
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
	
	public function getData($id)
	{
		$sql="select * from ".tablename('faqs')." where id='".$id."'";
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
	
	public function modifyData($arr,$id)
	{
		
		if(empty($id))
		{
			
           $this->db->insert(tablename('faqs'), $arr); 

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
			$this->db->update(tablename('faqs'), $arr); 

               return 1;
		}
	
	}

	public function removedata($id)
	{
		$sql="delete from ".tablename('faqs')." where id='".$id."'";
		$query=$this->db->query($sql);

		if(!empty($query))
		{
			return 1;
		}
		else
		{
			return;
		}
	}
	
	public function statuschange($id)
	{
		$sql="select status from ".tablename('faqs')." where id='".$id."'";
		$query=$this->db->query($sql);
		$r=$query->row();
        
		$status=$r->status;
                
		if($status==1)
		{
			$this->db->where('id', $id);
			$arr=array("status"=>0);
			$this->db->update(tablename('faqs'), $arr); 
				return 1;

		}
		if($status==0)
		{
				$this->db->where('id', $id);
			$arr=array("status"=>1);
			$this->db->update(tablename('faqs'), $arr);
				return 1; 
		}
		
	}

	

	
function isunique($where) {
        $c = $this->db->where($where)->count_all_results(tablename('faqs'));
        return $c === 0 ? TRUE : FALSE;
    }


    public function getarch($val)
	{
		$list = $this->db->where(array('archieve'=>$val))->get(tablename('faqs'))->result();
		return !empty($list) ? $list : array();
	}

	public function updatearch($data,$where)
	{
		$r = $this->db->update(tablename('faqs'),$data,$where);
		return $r;
	}

	public function bulk_del($where)
	{
		$sql="delete from ". tablename('faqs') ." where id in($where) ";
		$query=$this->db->query($sql);
		if(!empty($query))
		{
			return true;
		}
		else
		{
			return;
		}
	}

	public function bulk_arch($where,$val)
	{
		$sql="update ". tablename('faqs') ." set archieve='".$val."' where id in($where) ";
		$query=$this->db->query($sql);
		if(!empty($query))
		{
			return true;
		}
		else
		{
			return;
		}
	}

	public function bulk_status($ids)
	{
		$chk=explode(",",$ids);
		$c=0;
		for($i=0;$i<count($chk);$i++)
		{
			$sql="select status from ".tablename('faqs')." where id='".$chk[$i]."'";
			$query=$this->db->query($sql);
			$r=$query->row();
	        $status=($r->status==1)?0:1;
	        $this->db->where('id', $chk[$i]);
			$arr=array("status"=>$status);
			$res=$this->db->update(tablename('faqs'), $arr); 
			if(!empty($res))
			{
				$c++;
			}
		}
		if($c>0)
		{
			return true;
		}
		else
		{
			return;
		}
	}    

}
