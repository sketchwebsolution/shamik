<?php
/**
 *
 * Main Admin controller
 * All the methods
 * containing all the 
 * detailed functionality
 *
 * <p>
 *  @author : Suvra Bhattacharyya
 *  @package : index, forgetpass, dashboard, checklogin, checkemail, newpass, updatepass, profile, profupdate, logout, siteoffline, sitesettings, siteupdate, changePassword, addMenu, listMenu, editmenu, menustatus, deletemenu, plugins, pluginupload, plugindelete, pluginstat
 *  @copyright : Sketch Web Solutions
 * </p>
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    /**
     * This is the Constructor 
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('form_validation');
    }

    /**
     *
     * This is the method
     * for the Index Page
     *
     * <p>
     *  @author : Suvra Bhattacharyya
     *  @param : None
     * </p>
     *
     */
    public function index() {
        //cookie_authenticate();
        $admin_uid = $this->session->userdata('admin_uid');
        //$data['pagetype']="Log In";
        //$this->load->view('admin/login',$data);
        if (!empty($admin_uid)) {
            redirect(site_url('admin/dashboard'));
        }
        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | Log in');
        $this->layouts->render('admin/login', array(), 'admin_login');
    }

    /**
     * This functionality is for
     * Admin Forget Password Section
     *
     * <p>
     *  @author : Suvra Bhattacharyya
     *  @param : None
     * </p>
     *
     */
    public function forgetpass() {
        //cookie_authenticate();
        //$data['pagetype']="Forget Password";
        //$this->load->view('admin/forgetpass',$data);
        $admin_uid = $this->session->userdata('admin_uid');

        if (!empty($admin_uid)) {
            redirect(site_url('admin/dashboard'));
        }

        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | Forget Password');
        $this->layouts->render('admin/forgetpass', array(), 'admin_login');
    }

    /**
     * This is the functionality 
     * for the admin dashboard
     *
     * <p>
     *  @author : Suvra Bhattacharyya
     *  @param : None
     * </p>
     *
     */
    public function dashboard() {
        admin_authenticate();
        $data['pagetype'] = "Dashboard";
        //$this->load->view('admin/home',$data);

        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | Dashboard');
        $this->layouts->render('admin/home', $data, 'admin');
    }

    /**
     * This is the functionality for
     * admin login checking
     *
     * <p>
     *  @author : Suvra Bhattacharyya
     *  @param : None
     * </p>
     *
     */
    public function checklogin() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $checkon = $this->input->post('checkon');
        admin_login($email, $password);
    }

    /**
     * This functionality is for
     * checking the mail entered is
     * authenticated or not
     *
     * <p>
     *  @author : Suvra Bhattacharyya
     *  @param : None
     * </p>
     *
     */
    public function checkemail() {
        $email = $this->input->post('email');
        $this->load->model('admin/authmodel');
        $emailchk = $this->authmodel->emailcheck($email);
        if (empty($emailchk)) {
            $this->session->set_flashdata('errormessage', 'Invalid email entered');
        } else {
            $this->session->set_flashdata('successmessage', 'An activation link has been sent to your Email');
        }

        $redirect=site_url('admin/forget-password');
        redirect($redirect);
    }

    /**
     * This is the functionality 
     * for making admin to enter
     * new password after sending a request
     * for forget password
     *
     * <p>
     *  @author : Suvra Bhattacharyya
     *  @param : Activation code sent via email
     * </p>
     *
     */
    public function newpass($activationcode) {
        $data['pagetype'] = "New Password";
        $data['activationcode'] = $activationcode;
        //$this->load->view('admin/newpass',$data);

        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | New Password');
        $this->layouts->render('admin/newpass', $data, 'admin_login');
    }

    /**
     * This is the functionality for
     * updating the new password for the admin
     * into the database.
     *
     * <p>
     *  @author : Suvra Bhattacharyya
     *  @param : None
     * </p>
     *
     */
    public function updatepass() {
        $newpass = $this->input->post('password');
        $confpass = $this->input->post('confirm_password');
        $activationcode = $this->input->post('activationcode');
        if ($newpass != $confpass) {
            $this->session->set_flashdata('errormessage', 'Password and confirm Password not matches');
            $redirect = site_url('admin/new-password.html/' . $activationcode);
            redirect($redirect);
        } else {
            $this->load->model('admin/authmodel');
            $chk = $this->authmodel->passwdupd($newpass, $activationcode);
            if (!empty($chk)) {
                $this->session->set_flashdata('successmessage', 'Password updated successfully');
                $redirect = base_url('admin');
                redirect($redirect);
            } else {
                $this->session->set_flashdata('errormessage', 'Wrong activation code');
                $redirect = site_url('admin/new-password.html/' . $activationcode);
                redirect($redirect);
            }
        }
    }

    /**
     * This is the functionality
     * for viewing of
     * the admin profile
     *
     * <p>
     *  @author : Suvra Bhattacharyya
     *  @param : None
     * </p>
     *
     */
    public function profile() {
        admin_authenticate();
        //$data['pagetype']="Profile";
        //$this->load->view('admin/admin-profile',$data);

        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | Profile');
        $this->layouts->render('admin/admin-profile', array(), 'admin');
    }

    /**
     * This is the functionality for
     * updating admin profile
     *
     * <p>
     *  @author : Suvra Bhattacharyya
     *  @param : None
     * </p>
     *
     */
    public function profupdate() {
        admin_authenticate();
        $this->load->model('admin/adminsmodel');
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        if (!empty($_FILES['profile_pic']['name'])) {
            $profile_pic = json_encode($_FILES);
        } else {
            $profile_pic = "";
        }
        $returnval = $this->adminsmodel->updateadmin($fname, $lname, $email, $profile_pic, $username);
        $returnval = (array) json_decode($returnval);
        if ($returnval['error'] == 1) {
            $errormsg = $returnval['errormsg'];
            $this->session->set_flashdata('errormessage', $errormsg);
        }
        if ($returnval['success'] == 1) {
            $this->session->set_flashdata('successmessage', 'Profile updated successfully');
        }
        $redirect=site_url('admin/profile');
        redirect($redirect);
    }

    /**
     * Functionality for
     * admin logout
     *
     * <p>
     *  @author : Suvra bhattacharyya
     *  @param : None
     * </p>
     *
     */
    public function logout() {
        admin_logout();
    }

    /**
     * Functionality to
     * view site when offline
     *
     * <p>
     *  @author : Suvra Bhattacharyya
     *  @param : None
     * </p>
     *
     */
    public function siteoffline() {
        $this->load->view('admin/websitedown');
    }

    /**
     * Functionality for 
     * listing of 
     * site settings
     *
     * <p>
     *  @author : Suvra Bhattacharyya
     *  @param : None
     * </p>
     *
     */
    public function sitesettings() {
        admin_authenticate();
        $this->load->model('admin/settingsmodel');
        $data['results'] = $this->settingsmodel->loadsettings();


        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' |Site Settings');
        $this->layouts->render('admin/settings', $data, 'admin');
    }


    public function addSettings()
    {

        //print_r($_POST); die();
        admin_authenticate();
        $this->load->model('admin/settingsmodel');
           $arr['slabel']=$this->input->post('slabel');
           $arr['svalue']=$this->input->post('svalue');
           $arr['skey']=str_replace('','-',strtolower($this->input->post('slabel')));

        $flg = $this->settingsmodel->modifyData($arr);
        if (!empty($flg)) {
            $this->session->set_flashdata('successmessage', 'New Settings added successfully');
        } else {
            $this->session->set_flashdata('errormessage', 'Oops! Something went wrong. Please try again');
        }
        $redirect=site_url('admin/site-settings');
        redirect($redirect);

    }

    public function editSettings()
    {

        //print_r($_POST); die();
        admin_authenticate();
        $this->load->model('admin/settingsmodel');
           $arr['slabel']=$this->input->post('slabel');
           $arr['svalue']=$this->input->post('svalue');
           $id=$this->input->post('sid');

        $flg = $this->settingsmodel->modifyData($arr,$id);
        if (!empty($flg)) {
            $this->session->set_flashdata('successmessage', 'Settings updated successfully');
        } else {
            $this->session->set_flashdata('errormessage', 'Oops! Something went wrong. Please try again');
        }
        $redirect=site_url('admin/site-settings');
        redirect($redirect);

    }


    /**
     * Functionality for
     * update site settings
     *
     * <p>
     *  @author : Suvra Bhattacharyya
     *  @param : None
     * </p>
     *
     */
    public function siteupdate() {
        admin_authenticate();
        $this->load->model('admin/sitesettingsmodel');
        $flg = $this->sitesettingsmodel->updsitesettings();
        if (!empty($flg)) {
            $this->session->set_flashdata('successmessage', 'Settings updated successfully');
        } else {
            $this->session->set_flashdata('errormessage', 'Oops! Something went wrong. Please try again');
        }
        $redirect=site_url('admin/sitesettings');
        redirect($redirect);
    }

    /**
     * Functionality for 
     * change password in the 
     * admin section.
     *
     * <p>
     *  @author : Suvra Bhattacharyya
     *  @param : None
     * </p>
     *
     */
    public function changePassword() {
        admin_authenticate();

        $this->load->helper('form', 'url');

        $admin_id = $this->session->userdata('admin_uid');
        $this->load->model('admin/authmodel');

        $details = $this->authmodel->checkAdmin($admin_id);

        $data = array();
        if ($details) {
            $data['details'] = $details;
        }

        if (!empty($_POST)) {
            $newpass = $this->input->post('password');
            $confpass = $this->input->post('passconf');

            $oldpassword = $this->input->post('oldpassword');
            $oldpass_actual = $this->input->post('oldpass_actual');
            $res = sha1($oldpassword);
            if (empty($newpass) || empty($confpass) || empty($oldpassword)) {

                $this->session->set_flashdata('errormessage', 'Old password ,New Password and confirm Password are required');
                $redirect=site_url('admin/change-password');
                redirect($redirect);
            } else if ($oldpass_actual != $res) {


                $this->session->set_flashdata('errormessage', 'Old password is not match');
                $redirect=site_url('admin/change-password');
                redirect($redirect);
            } else if ($newpass != $confpass) {
                $this->session->set_flashdata('errormessage', 'New Password and confirm Password not matches');
                $redirect=site_url('admin/change-password');
                redirect($redirect);
            } else {


                $this->load->model('admin/authmodel');
                $uid = $this->session->userdata('admin_uid');
                $chk = $this->authmodel->changePwd($newpass, $uid);
                if (!empty($chk)) {
                    $this->session->set_flashdata('successmessage', 'Password updated successfully');
                    $redirect=site_url('admin/change-password');
                    redirect($redirect);
                } else {
                    $this->session->set_flashdata('errormessage', '');
                    $redirect=site_url('admin/change-password');
                    redirect($redirect);
                }
            }
        } else {
            $this->layouts->set_title(getsitename() . ' | Change Password');
            $this->layouts->render('admin/change-password', $data, 'admin');
        }
    }

    /**
    * Functionality for 
    * adding menu from the 
    * menu management
    *
    * <p>
    *   @author : Suvra Bhattacharyya
    *   @param : None
    * </p>
    *
    */
    public function addMenu()
    {
         $this->load->model('admin/sitesettingsmodel','ss');
        if($this->input->post())
        {
            $name = $this->input->post('m_name');
            $url = $this->input->post('m_url');
            $icon = $this->input->post('m_icon');
            $active = $this->input->post('m_active');
            $group = $this->input->post('m_group');
            $pid = $this->input->post('m_pid');

            $menu_arr = array(
                'icon' => $icon,
                'url'  =>$url,
                'label'=>$name,
                'active'=>$active,
                'status' => '1'
                );
            $flg = $this->ss->addmenu($menu_arr,$group,$pid);
            if (!empty($flg)) {
                $this->session->set_flashdata('successmessage', 'Menu added successfully');
            } else {
                $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
            }
            $redirect=site_url('admin/menu-manager');
            redirect($redirect);
        }
        $data = array();
       
        $data['menues'] =$this->ss->getallmenu();
        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' |Site Settings');
        $this->layouts->render('admin/addmenu', $data, 'admin');
    }

    /**
    * Functionality for 
    * listing of the menu 
    * in menu management
    *
    * <p>
    *   @author : Riaz Ali Laskar
    *   @param : None
    * </p>
    *
    */
    public function listMenu()
    {
 
        $this->load->model('admin/sitesettingsmodel','ss');
        $data['menues'] =get_menu_from_setting('admin_sidebar');

        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' |Site Settings');
        $this->layouts->render('admin/menulist', $data, 'admin');

    }

    /**
    * Functionality for modification 
    * of the menu for menu management
    *
    * <p>
    *   @author : Riaz Ali Laskar
    *   @param : Menu ID
    * </p>
    *
    */
    public function editmenu($id)
    {
        $this->load->model('admin/sitesettingsmodel','ss');

        if($this->input->post())
        {
            $name = $this->input->post('m_name');
            $url = $this->input->post('m_url');
            $icon = $this->input->post('m_icon');
            $active = $this->input->post('m_active');
            $pid = $this->input->post('m_pid');
            $status = $this->input->post('m_status');
            $id = $this->input->post('id');

            $menu_arr = array(
                'icon' => $icon,
                'url'  =>$url,
                'label'=>$name,
                'active'=>$active,
                'status' =>$status
                );

            $flag = $this->ss->updatemenuitem($id,$menu_arr,$pid);
            if (!empty($flag)) {
                $this->session->set_flashdata('successmessage', 'Menu updated successfully');
            } else {
                $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
            }
            $redirect=site_url('admin/menu-manager');
            redirect($redirect);
        }
        $id = base64_decode(urldecode($id));
        
        $data['menu'] = $this->ss->getmenuitem($id);
        $data['id'] = $id;
        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' |Site Settings');
        $this->layouts->render('admin/editmenu', $data, 'admin');
    }

    /**
    * Functionality for 
    * activate or deactivate 
    * menu in the menu management
    *
    * <p>
    *   @author : Riaz Ali Laskar
    *   @param : Menu ID
    * </p>
    *
    */
    public function menustatus($id)
    {
        $id = base64_decode(urldecode($id));
        $m =get_menu_from_setting('admin_sidebar');
        $menu = &$m;
        if(!empty($menu))
        {
            $c = $menu->$id;
             
            if($c->status == 0)
            {
                $s = 1;
            }
            else
            {
                $s = 0;
            }

           $c->status = $s; 
        }

            $flag = $this->ss->updatemenuitem($id,$c);
            if (!empty($flag)) {
                $this->session->set_flashdata('successmessage', 'Status changed successfully');
            } else {
                $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
            }
            $redirect=site_url('admin/menu-manager');
            redirect($redirect);
    }

    /**
    * Functionality for 
    * deletion of the menus 
    * from the menu management
    *
    * <p>
    *   @author : Riaz Ali Laskar
    *   @param : Menu ID
    * </p>
    *
    */
    public function deletemenu($id)
    {
        $id = base64_decode(urldecode($id));
        $m =get_menu_from_setting('admin_sidebar');
        $newmenu = array();
        $menu = &$m;
        if(!empty($menu))
        {
            foreach ($menu as $key => $value) {
               if($key != $id) 
                 $newmenu[] = $value;
             } 
        }

            $flag = $this->ss->updatemenu($newmenu,'admin_sidebar');
            if (!empty($flag)) {
                $this->session->set_flashdata('successmessage', 'Menu deleted successfully');
            } else {
                $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
            }
            $redirect=site_url('admin/menu-manager');
            redirect($redirect);
    }

    /**
     * Functionality for 
     * the implementation of 
     * plugin management listing
     *
     * <p>
     *  @author : Suvra Bhattacharyya
     *  @param : None
     * </p>
     *
     */
    public function plugins() {
        $this->load->model('admin/pluginmodel');
        $plugindet = $this->pluginmodel->loadplugin();
        $data['plugindet'] = $plugindet;
        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | Plugin Managers');
        $this->layouts->render('admin/pluginlist', $data, 'admin');
    }

    /**
     * Functionality for 
     * uploading the created 
     * or downloaded plugin zip 
     * and installing
     *
     * <p>
     *  @author : Suvra Bhattacharyya
     *  @param : None
     * </p>
     *
     */
    public function pluginupload()
    {
        $this->load->model('admin/pluginmodel');
        $pluginfile=$_FILES['pluginfile']['name'];
        $temppluginfile=$_FILES['pluginfile']['tmp_name'];
        $pos=strpos('aa'.$pluginfile, 'plugin_');
        $arr=explode('.',$pluginfile);
        $ext=end($arr);
        if($ext=="zip")
        {
            if(!empty($pos))
            {
                $pluginname=str_replace('.zip','',str_replace('plugin_', '', $pluginfile));
                $zip = new ZipArchive;
                if ($zip->open($temppluginfile) === TRUE) 
                {
                    $zip->extractTo('application/modules/');
                    $zip->close();
                    rename('application/modules/plugin_'.$pluginname,'application/modules/'.$pluginname);
                    exec ("find application/modules/".$pluginname." -type d -exec chmod 0777 {} +");
                    exec ("find application/modules/".$pluginname." -type f -exec chmod 0777 {} +");

                    $fp=fopen('application/modules/'.$pluginname.'/security/name.json','r');
                    $namejson=fgets($fp);

                    $namearr=json_decode($namejson);

                    $modname=$namearr->name;
                    $moddescription=$namearr->description;
                    $modversion=$namearr->version;
                    $modauthor=$namearr->author;

                    $flg=$this->pluginmodel->installplugin($modname,$moddescription,$pluginname,$modversion,$modauthor);
                    if(!empty($flg))
                    {
                        $this->session->set_flashdata('successmessage', 'Plugin installed successfully');   
                    }
                    else
                    {
                        $this->session->set_flashdata('errormessage', 'Error installing the plugin. Please check if already this name exists');
                    }
                }
            }
            else
            {
                $this->session->set_flashdata('errormessage', 'Zip name will have the name format plugin_EXAMPLE');
            }
        }
        else
        {
            $this->session->set_flashdata('errormessage', 'Plugin will be in zip format');
        }
        $redirect = site_url('admin/plugin-manager');
        redirect($redirect);
    }

    /**
     * Functionality for 
     * deleting the plugin 
     * only if the plugin 
     * is in deactive mode
     *
     * <p>
     *  @author : Suvra Bhattacharyya
     *  @param : None
     * </p>
     *
     */
    public function plugindelete($pluginid)
    {
        $this->load->model('admin/pluginmodel');
        $flg=$this->pluginmodel->delplugin($pluginid);
        if(!empty($flg))
        {
            $this->session->set_flashdata('successmessage', 'Plugin installed successfully');   
        }
        else
        {
            $this->session->set_flashdata('errormessage', 'Error installing the plugin. Please check if already this name exists');
        }
        $redirect = site_url('admin/plugin-manager');
        redirect($redirect);
    }

    /**
     * Functionality for 
     * activating or deactivating 
     * the plugin
     *
     * <p>
     *  @author : Suvra Bhattacharyya
     *  @param : None
     * </p>
     *
     */
    public function pluginstat($pluginid,$status)
    {
        $this->load->model('admin/pluginmodel');
        if($status==1)
        {
            $flg=$this->pluginmodel->deactiveplugin($pluginid);
            if(!empty($flg))
            {
                $this->session->set_flashdata('successmessage', 'Plugin deactivated successfully');   
            }
            else
            {
                $this->session->set_flashdata('errormessage', 'Error in activating the plugin');
            }
        }
        else
        {
            $flg=$this->pluginmodel->activeplugin($pluginid);
            if(!empty($flg))
            {
                $this->session->set_flashdata('successmessage', 'Plugin activated successfully');
            }
            else
            {
                $this->session->set_flashdata('errormessage', 'Error in activating the plugin');
            }
        }
        $redirect = site_url('admin/plugin-manager');
        redirect($redirect);
    }



}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */