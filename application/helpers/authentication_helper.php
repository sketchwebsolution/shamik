<?php
/************************************************
 * This helper is used for Login Authentication *
 ************************************************/
 
function admin_authenticate()
{
    $CI = & get_instance();
    $admin_uid=$CI->session->userdata('admin_uid');
    if(empty($admin_uid))
    {
        $redirect=base_url('admin');
        redirect($redirect);
    }
}

function user_authenticate()
{
    $CI = & get_instance();
    $playerid=$CI->session->userdata('sess_userdtl');
    if(!empty($playerid))
    {
        $redirect=base_url();
        redirect($redirect);
    }
}

function admin_login($email,$password)
{
    $CI = & get_instance();
    $CI->load->model('admin/authmodel');
    $fl=$CI->authmodel->checklogin($email,$password);
    if(!empty($fl))
    {
        $CI->session->set_flashdata('successmessage','You have logged in successfully');
        $redirect=site_url('admin/dashboard');
        redirect($redirect);
    }
    else
    {
        $CI->session->set_flashdata('errormessage','Invalid Credentials');
        $redirect=base_url('admin');
        redirect($redirect);
    }
}

function admin_logout()
{
    $CI = & get_instance();
    $CI->load->model('admin/authmodel');
    $admin_uid=$CI->session->userdata['admin_uid'];
    $fl=$CI->authmodel->checklogout($admin_uid);
    if(!empty($fl))
    {
        $CI->session->set_flashdata('successmessage','You have logged out successfully');
        $redirect=base_url('admin');
        redirect($redirect);
    }
}

function cookie_authenticate()
{
    $CI = & get_instance();
    $admin_uid=get_cookie('admin_uid');
    $admin_detail=get_cookie('admin_detail');
    if(!empty($admin_uid))
    {
        $CI->session->set_userdata('admin_uid',$admin_uid);
        $CI->session->set_userdata('admin_detail',$admin_detail);
        $redirect=site_url('admin/dashboard');
        redirect($redirect);
    }
}

function get_from_session($key)
{
    $CI = & get_instance();
    $data = $CI->session->userdata('admin_detail');
    $data = json_decode($data);
    if(!empty($data))
    {
        if(!empty($data->$key))
        {
            return $data->$key;
        }
    }

      return "";
}

function get_admin_email(){
 $CI = & get_instance();
 $CI->load->model('admin/authmodel');
 $details=$CI->authmodel->checkAdmin(1);
    if(!empty($details))
    {
        $email=$details[0]->email;
        return $email;
    }
    else {
    return "not valid";

   }
}

function smartdate($timestamp)
{    
    $timestamp = strtotime("$timestamp");
    $diff = time() - $timestamp;
 
    if ($diff < 60) {
        return grammar_date(floor($diff), ' second(s) ago');
    }
    else if ($diff < 60*60) {
        return grammar_date(floor($diff/60), ' minute(s) ago');
    }
    else if ($diff < 60*60*24) {
        return grammar_date(floor($diff/(60*60)), ' hour(s) ago');
    }
    else if ($diff < 60*60*24*30) {
        return grammar_date(floor($diff/(60*60*24)), ' day(s) ago');
    }
    else if ($diff < 60*60*24*30*12) {
        return grammar_date(floor($diff/(60*60*24*30)), ' month(s) ago');
    }
    else {
        return grammar_date(floor($diff/(60*60*24*30*12)), ' year(s) ago');
    }
}
 
function grammar_date($val, $sentence)
{
    if ($val > 1) {
        return $val.str_replace('(s)', 's', $sentence);
    } else {
        return $val.str_replace('(s)', '', $sentence);
    }
}

function front_auth($redirect=false)
{
    $CI = & get_instance();
    $user=$CI->session->userdata('sess_userdtl');
     if(!empty($user))
    {
        return true;
    }
    if($redirect)
    {
    	redirect(base_url());
    }
    return false;

}

function front_auth_pages()
{

     $CI =& get_instance();
         $CI->load->model('front/cms','cms');
 
         $curent = $CI->uri->segment(1);


         foreach ($CI->router->routes as $key => $value) {
           
            if($key == $curent)
            {

                if(in_array($key,$CI->config->item('auth_pages')))
                {
                    if(!front_auth())
                    {
                            redirect(base_url());
                    }
                }
            }
     }
}

function get_from_session_front($key)
{
    $CI = & get_instance();
    $data = $CI->session->userdata('sess_userdtl');
    //
    if(!empty($data))
    {
      $datas = json_decode($data);

        if(!empty($datas->$key))
        {
            return $datas->$key;
        }
    }

      return "not valid";
}

function getHomeRss()
{
    $path="http://www.cnet.com/rss/news/";
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $path);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $contents = curl_exec($ch);
    curl_close($ch);
    $xml=  simplexml_load_string($contents);
    $newsitem=$xml->channel->item;
    $item=array();
    $local=array();
    if(!empty($newsitem))
    {
        $i=1;
        foreach($newsitem as $newsitemlist)
        {
            if($i<=5)
            {
                $thumbnail=(array)$newsitemlist->children('http://search.yahoo.com/mrss/')->thumbnail->attributes()->url;
                $thumbnail=$thumbnail[0];
                $title=(array)$newsitemlist->title;
                $link=(array)$newsitemlist->link;
                $description=(array)$newsitemlist->description;
                $pubDate=(array)$newsitemlist->pubDate;
                $local['title']=$title[0];
                $local['link']=$link[0];
                $local['description']=strip_tags($description[0]);
                $local['pubDate']=date('D M j',strtotime($pubDate[0]));
                $local['thumbnail']=$thumbnail;

                $item[]=(object)$local;
            }
            $i++;
        }
    }
    return $item;
}

function getautoheight($px=NULL)
{
    $CI = & get_instance();
    $CI->load->library('user_agent','agent');
    if($CI->agent->is_mobile())
    {
        $height="auto";
    }
    else
    {
        if(!empty($px))
                    $height=$px."px";
        else
        $height="70px";
    }
    return $height;
}

function pr($par)
{
    echo "<pre>";
    print_r($par);
    echo "</pre>";
}

if ( ! function_exists('project_mail'))
{
    function project_mail($data = array())
    {
          $ci =& get_instance();


          $ci->load->library('parser');
           if(count($data)>0){
         
            
            $tdata['date'] = date('l F d, Y');
            $tdata['year'] = date("Y");
            $tdata['siteurl'] = $ci->config->item('base_url');
            $tdata['logo'] = $ci->config->item('base_url') . "assets/images/logo.jpg";
            $tdata['heading'] = $data['subject'];
            $tdata['message'] = $data['message'];
            $msg = $ci->parser->parse('mail/mail-template', $tdata, TRUE);

            
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $emailadmin="sketch.desg03@gamil.com";
            $headers .= 'From: <' . $emailadmin . '>' . "\r\n";
             mail($data['email'], $data['subject'], $msg, $headers);


          }
    }   
}

    function sociallinks($mediatype)
    {
       $CI = & get_instance();
       $CI->load->model('admin/sitesettingsmodel','ss');
       $socialdet=$CI->ss->getsociallinks();
       if($mediatype=="facebook")
       {
           return $socialdet->fb_link;
       }
       if($mediatype=="twitter")
       {
           return $socialdet->tw_link;
       }
       if($mediatype=="googleplus")
       {
           return $socialdet->gp_link;
       }
       if($mediatype=="linkedin")
       {
           return $socialdet->li_link;
       }
       if($mediatype=="instagram")
       {
           return $socialdet->ins_link;
       }
       if($mediatype=="pininterest")
       {
           return $socialdet->pin_link;
       }
    }

    function get_menu_from_setting($name)
    {
       $CI = & get_instance();
       $CI->load->model('admin/sitesettingsmodel','ss');
       $a = $socialdet=$CI->ss->getmenu($name);
       return json_decode($a[0]->menu);

    }





        function right_current_match()
    {
          $CI = & get_instance();
          $CI->load->model('front/betmatch','matchdata');
          $arr['openstatus']='bets';
          $result = $CI->matchdata->getRandMatch($arr);
          return $result;


    }


        function right_jackpotwinners()
    {
          $CI = & get_instance();
          $CI->load->model('front/betmatch','matchdata');
          $result = $CI->matchdata->getJackpotwinner();
          return $result;


    }