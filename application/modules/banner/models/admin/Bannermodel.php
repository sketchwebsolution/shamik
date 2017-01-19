<?php
class bannermodel extends CI_Model
{
    public function __construct()
	{
        parent::__construct();
        $this->load->database();
	}
    
	public function loadbanner($id=NULL)
	{
		$sql="select * from ".tablename('banner');
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

	public function loadactivebanner()
	{
		$det=$this->db->where(array('status'=>'1','archieve'=>'0'))->get(tablename('banner'))->result();
		if(!empty($det))
		{
			return $det;
		}
		else
		{
			return;
		}
	}
	
	public function loadbannersingle($id)
	{
		$sql="select * from ".tablename('banner')." where id='".$id."'";
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

	public function modifybanner($bannerid=NULL,$description,$newimage=NULL)
	{
		if(!empty($bannerid))
		{
			if(!empty($newimage))
			{
				$presql="select image from ".tablename('banner')." where id='".$bannerid."'";
				$query=$this->db->query($presql);
				$r=$query->row();
				$oldimage=$r->image;
				if(!empty($oldimage))
				{
					unlink(APPPATH."../assets/banner/uploads/".$oldimage);
					unlink(APPPATH."../assets/banner/uploads/thumb/".$oldimage);
				}
				$sql="update ".tablename('banner')." set image='".$newimage."',description='".$description."',status='1' where id='".$bannerid."'";
			}
			else
			{
				$sql="update ".tablename('banner')." set description='".$description."',status='1' where id='".$bannerid."'";
			}
		}
		else
		{
			$sql="insert into ".tablename('banner')." set image='".$newimage."',description='".$description."',status='1'";
		}
		$flg=$this->db->query($sql);
		if(!empty($flg))
		{
			return 1;
		}
		else
		{
			return;
		}
	}

	public function statusbanner($bannerid)
	{
		$sql="select status from ".tablename('banner')." where id='".$bannerid."'";
		$q=$this->db->query($sql);
		$r=$q->row();
		if(!empty($r))
		{
			$status=$r->status;
			if($status==0)
			{
				$newstatus=1;
			}
			else
			{
				$newstatus=0;
			}
			$sql="update ".tablename('banner')." set status='".$newstatus."' where id='".$bannerid."'";
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
		else
		{
			return;
		}
	}

	public function deletebanner($bannerid)
	{
		$presql="select image from ".tablename('banner')." where id='".$bannerid."'";
		$query=$this->db->query($presql);
		$r=$query->row();
		$image=$r->image;
		if(!empty($image))
		{
			unlink(APPPATH."../assets/banner/uploads/".$image);
			unlink(APPPATH."../assets/banner/uploads/thumb/".$image);
			$sql="delete from ".tablename('banner')." where id='".$bannerid."'";
			$q=$this->db->query($sql);
			if(!empty($q))
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
			return;
		}
	}

	public function getarch($val)
	{
		$list = $this->db->where(array('archieve'=>$val))->get(tablename('banner'))->result();
		return !empty($list) ? $list : array();
	}

	public function updatearch($data,$where)
	{
		$r = $this->db->update(tablename('banner'),$data,$where);
		return $r;
	}

	public function bulk_del($where)
	{
		$chk=explode(",",$where);
		$c=0;
		for($i=0;$i<count($chk);$i++)
		{
			$presql="select image from ".tablename('banner')." where id='".$chk[$i]."'";
			$query=$this->db->query($presql);
			$r=$query->row();
			$image=$r->image;
			if(!empty($image))
			{
				unlink(APPPATH."../assets/banner/uploads/".$image);
				unlink(APPPATH."../assets/banner/uploads/thumb".$image);
				$sql="delete from ".tablename('banner')." where id='".$chk[$i]."'";
				$q=$this->db->query($sql);
				if(!empty($q))
				{
					$c++;
				}
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

	public function bulk_arch($where,$val)
	{
		$sql="update ". tablename('banner') ." set archieve='".$val."' where id in($where) ";
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
			$sql="select status from ".tablename('banner')." where id='".$chk[$i]."'";
			$query=$this->db->query($sql);
			$r=$query->row();
	        $status=($r->status==1)?0:1;
	        $this->db->where('id', $chk[$i]);
			$arr=array("status"=>$status);
			$res=$this->db->update(tablename('banner'), $arr); 
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