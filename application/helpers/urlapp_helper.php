<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('js_url'))
{
    function js_url($url = '')
    {
        $CI =& get_instance();
        return base_url()."assets/front/js/".$url;
    }   
}


if ( ! function_exists('font_awesome_url'))
{
    function font_awesome_url($url = '')
    {
        $CI =& get_instance();
        return base_url()."assets/front/font-awesome/".$url;
    }   
}

if ( ! function_exists('css_url'))
{
    function css_url($url = '')
    {
        $CI =& get_instance();
        return base_url()."assets/front/css/".$url;
    }   
}


if ( ! function_exists('image_url'))
{
    function image_url($url = '')
    {
        $CI =& get_instance();
        return base_url()."assets/front/images/".$url;
    }   
}

if ( ! function_exists('media_url'))
{
    function media_url($url = '')
    {
        $CI =& get_instance();
        return base_url()."assets/front/media/".$url;
    }   
}

if ( ! function_exists('banner_image_url'))
{
    function banner_image_url($url = '')
    {
        $CI =& get_instance();
        return base_url()."assets/images/banner/".$url;
    }   
}

  


function isLogin($redirect=FALSE)
{
    $CI = & get_instance();
    $id=$CI->session->userdata('sess_userdtl');
    if(empty($id))
    {
        if($redirect)
        {
          $CI->session->set_flashdata('errormessage', 'You are not authorized.');
          $path=base_url();
          redirect($path);
        }
        else
        {
     return FALSE;

        }
    }
    else
    {
     return TRUE;

    }
   
}

function getUserDetails($uid)
{
    $CI = & get_instance();
    $CI->load->model('front/users');
    $row= $CI->users->getUserInfo($uid);
   return $row;
}


function getSettingsData()
{
    $CI = & get_instance();
    $CI->load->model('admin/sitesettingsmodel');
    $detail=$CI->sitesettingsmodel->loadsitesettings();
  
  return $detail;
}


  function generateUniqueCode($str,$userid)
  {

    $length=strlen($userid);
    $total=10;
    $remaining=$total-$length;
    $uniqueid=$str.str_repeat("0",$remaining).$userid;
    return $uniqueid;

  }


  function userProfileCompleteData()
  {
     $CI = & get_instance();
     $result=$CI->session->userdata('sess_userdtl');
     if(!empty($result))
     {
        $data=(Array)json_decode($result);
        $c=0; $total=6;
         if($data['facebook_id']!='' ||$data['google_id']!='' || $data['email']!='' )
         {
            $c++;
         }
         if($data['password']!='')
         {
            $c++;
         }         
         if($data['user_code']!='')
         {
            $c++;
         }
          if($data['fname']!='')
         {
            $c++;
         }  
          if($data['lname']!='')
         {
            $c++;
         } 

        if($data['mobile']!='')
         {
            $c++;
         }  

         $percentage=intval(($c/$total)*100);
         return $percentage;                      
     }
     else
     {
        return 0;
     }

  }

  function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = '';
    return $ipaddress;
}

  function get_client_agent() {
       $agent = '';
       $CI = & get_instance();
       $CI->load->library('user_agent');

        if ($CI->agent->is_browser())
        {
                $agent = 'browser';
        }
        elseif ($CI->agent->is_robot())
        {
                $agent = 'robot';
        }
        elseif ($CI->agent->is_mobile())
        {
                $agent = 'mobile';
        }
        else
        {
                $agent = '';
        }

        return $agent;
    }



function getSettingsInfo($key)
{ 
    if(!empty($key))
    {
        $CI = & get_instance();
        $CI->load->model('admin/settingsmodel');
        $detail=$CI->settingsmodel->getDataSlug($key);
        if(!empty($detail))
        {
          return $detail->svalue; 

        }
          else
        {
            return ''; 

        } 
    }
    else
    {
        return ''; 

    }

}


function getArraySettingsInfo($keys)
{ 
    if(!empty($keys))
    {

        $CI = & get_instance();
        $CI->load->model('admin/settingsmodel');
          $nk=implode("','",$keys);
        $detail=$CI->settingsmodel->getDataSlugArray($nk);
        if(!empty($detail))
        {
          return $detail; 
        }
          else
        {
            return ''; 
        } 
    }
    else
    {
        return ''; 

    }

}
