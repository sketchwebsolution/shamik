<?php
class contactusmodel extends CI_Model
{
    public function __construct()
	{
        parent::__construct();
        $this->load->database();
	}
    
    	public function insertdata($arr)
	{
		$this->db->insert(tablename('contactus'),$arr);
		return $this->db->insert_id();
	}

	public function getAll()
	{
		$list = $this->db->get(tablename('contactus'))->result();
		return $list;
	}
	
	public function get($id)
	{
		$list = $this->db->where(array('id'=>$id))->get(tablename('contactus'))->result();
		return !empty($list) ? $list[0] : array();
	}

	public function getarch($val)
	{
		$list = $this->db->where(array('archieve'=>$val))->get(tablename('contactus'))->result();
		return !empty($list) ? $list : array();
	}
	
	public function delete($id)
	{
		$r = $this->db->delete(tablename('contactus'),array('id'=>$id));
		return $r;
	}


	public function update($data,$where)
	{
		$r = $this->db->update(tablename('contactus'),$data,$where);
		return $r;
	}

	public function updatearch($data,$where)
	{
		$r = $this->db->update(tablename('contactus'),$data,$where);
		return $r;
	}

	public function bulk_del($where)
	{
		echo $sql="delete from ". tablename('contactus') ." where id in($where) ";
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
		$sql="update ". tablename('contactus') ." set archieve='".$val."' where id in($where) ";
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
}