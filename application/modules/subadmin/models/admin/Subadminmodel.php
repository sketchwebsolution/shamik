<?php
class subadminmodel extends CI_Model
{
    public function __construct()
	{
        parent::__construct();
        $this->load->database();
	}
    
	
	public function changeadmin($arr,$id=NULL)
    {
            if(empty($id))
            {
            $this->db->insert(tablename('admins'),$arr);
            return $this->db->insert_id();

            }
            else
            {

              $this->db->where("id",$id);
              $this->db->update(tablename('admins'),$arr);
              return "1";

            }


    }

    public function getsubadmin($id)
    {
        $sql="select * from ".tablename('admins')."  where id='".$id."' ";
        $query=$this->db->query($sql);
        $r=$query->row();
        if(!empty($r))
        {
            return $r;
        }
        else
        {
            return;
        }
    }


     

    public function subadmindeletion($id)
    {
        $sql="delete from ".tablename('admins')."  where id='".$id."' ";
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

    public function subadminstatus($id)
    {
        $sql="select status from ".tablename('admins')."  where id='".$id."' ";
        $query=$this->db->query($sql);
        $adminstatus=$query->row();
        if($adminstatus->status==0)
        {
            $status=1;
        }
        else
        {
            $status=0;
        }
        $sq="update ".tablename('admins')."  set status='".$status."' where id='".$id."'";
        $qq=$this->db->query($sq);
        if(!empty($qq))
        {
            return $this->db->affected_rows();
        }
        else
        {
            return;
        }
    }

    public function selectsubadmin($id)
    {
        $sql="select admin.*,role.group_name,role.group_role from ".tablename('admins')." admin,".tablename('roles')." role where admin.parentid='".$id."' and admin.group_code=role.id";
        $query=$this->db->query($sql);
        $r=$query->result();
        if(!empty($r))
        {
            return $r;
        }
        else
        {
            return;
        }
    }

   
    public function selectmodules()
    {
        $sql="select * from ".tablename('modules')." where status='1' ";
        $query=$this->db->query($sql);
        $r=$query->result();
        if(!empty($r))
        {
            return $r;
        }
        else
        {
            return;
        }
    }
	

  public function rolelist()
    {
        
        $sql="select * from ".tablename('roles')."";
        $query=$this->db->query($sql);
        $r=$query->result();
        if(!empty($r))
        {
            return $r;
        }
        else
        {
            return;
        }
    }
  public function getRole($id)
    {
        
        $sql="select * from ".tablename('roles')." where id='".$id."'";
        $query=$this->db->query($sql);
        $r=$query->row();
        if(!empty($r))
        {
            return $r;
        }
        else
        {
            return;
        }
    }

       public function roleinsertion($group_name,$role,$description)
    {
        
        $sq="insert into ".tablename('roles')." set group_name='".$group_name."',group_role='".json_encode($role)."',group_desc='".$description."' ";
        $qq=$this->db->query($sq);
        
        if(!empty($qq))
        {
            return $this->db->insert_id();
        }
        else
        {
            return;
        }
    }
    

       public function roleupdate($id,$group_name,$role,$description)

    {
        
        $sq="update ".tablename('roles')." set group_name='".$group_name."',group_role='".json_encode($role)."',group_desc='".$description."' where id=".$id;
        $qq=$this->db->query($sq);
        
        if(!empty($qq))
        {
            return "1";
        }
        else
        {
            return;
        }
    }

    public function roledeletion($id)
    {
        $sql="delete from ".tablename('roles')." where id=".$id."";
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
	
function isunique($where) {
        $c = $this->db->where($where)->count_all_results(tablename('admins'));
        return $c === 0 ? TRUE : FALSE;
    }
    

}
