<?php
class buyers extends CI_Model
{
    public function __construct()
	{
        parent::__construct();
        $this->load->database();
	}
    
	
	
	public function getAllInterests()
	{
		$result=$this->db->where('status','1')->get(tablename('interest'))->result();

         return $result; 
	}
	
	public function updateBuyerInfo($arr,$id)
	{
		$result=$this->db->where('id',$id)->update(tablename('users'),$arr);
   
        return $result; 
	}

	public function getBuyerInfo($id)
	{
		$result=$this->db->where('id',$id)->get(tablename('users'))->result();
   
        return $result; 
	}


	public function getBuyerInterest($id)
	{
		$result=$this->db->where('user_id',$id)->get(tablename('user_interest'))->result();
		$rows=array();
		if(!empty($result))
		{
			foreach($result as $row)
			{
             $rows[]=$row->interest;
			}
		}
   
        return $rows; 
	}

	public function updateBuyerInfoInterest($arr,$id)
	{
		$c=0;
		if(!empty($arr))
		{
			foreach($arr as $r)
			{
				$userdata=array('user_id'=>$id,'interest'=>$r);
				$result=$this->db->where($userdata)->get(tablename('user_interest'))->row();
				if(!empty($result))
				{

					$userdata['modified_date']=date("Y-m-d H:i:s");

                      		$result1=$this->db->where('id',$result->id)->update(tablename('user_interest'),$userdata);

                         $c++;
				}
				else
				{
					$userdata['created_date']=date("Y-m-d H:i:s");
					$userdata['modified_date']=date("Y-m-d H:i:s");
                      		$result1=$this->db->insert(tablename('user_interest'),$userdata);
                         $c++;

				}

			}

		  $infoarr=implode(",",$arr);
		  $sql="delete from ".tablename('user_interest')." where interest NOT IN(".$infoarr.") and user_id=$id";
				$query=$this->db->query($sql);


			// $infoarr=implode(",",$arr);
			// $this->db->where_not_in('interest', $infoarr);
			// $this->db->where('user_id',$id);
			// $this->db->delete(tablename('user_interest')); 
		}


   
        return $c; 
	}

}
