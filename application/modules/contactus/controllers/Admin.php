<?php
/**
 *
 * Main Admin controller 
 * for managing the cms pages. 
 * All the methods containg 
 * all the detailed functionalities 
 * used for managing cms pages.
 *
 * <p>
 *  @author : Suvra Bhattacharyya
 *  @package : contactus, replycontact, replyviewcontact, deletecontact, updatecontact
 *  @copyright : Sketch Web Solutions
 * </p>
 *
 **/
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MX_Controller {

    /**
     * This is the Constructor 
     **/
    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('form_validation');
        $this->load->model('admin/contactusmodel');
        admin_authenticate();
    }

    /**
     * Functionality for 
     * listing of the 
     * contact us details
     *
     * <p>
     *   @author : Suvra Bhattacharyya
     *   @param : None
     * </p>
     *
     **/
    public function contactus() {
        $list = $this->contactusmodel->getAll();
        $data['list'] = $list;

        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | Contact Us Messages');
        $this->layouts->render('admin/contactlist', $data, 'admin');
    }

    public function archievelist() 
    {
        $list = $this->contactusmodel->getarch('1');
        $data['list'] = $list;

        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | Contact Us Archieve');
        $this->layouts->render('admin/archievelist', $data, 'admin');
    }

    /**
     * Functionality for 
     * replying to a contact
     *
     * <p>
     *   @author : Suvra Bhattacharyya
     *   @param : contact-id
     * </p>
     *
     **/
    public function replycontact($id) {
        $id = base64_decode(urldecode($id));
        $data['contact'] = $this->contactusmodel->get($id);

        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | Contact Us Reply');

        $this->layouts->render('admin/replycontact', $data, 'admin');
    }

    /**
     * Functionality for 
     * viewing the detail 
     * of a contact
     *
     * <p>
     *   @author : Suvra Bhattacharyya
     *   @param : contact-id
     * </p>
     *
     **/
    public function replyviewcontact($id) {
        $id = base64_decode(urldecode($id));
        $data['contact'] = $this->contactusmodel->get($id);

        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | Contact Us Reply');

        $this->layouts->render('admin/replyview', $data, 'admin');
    }

    /**
     * Functionality for 
     * deleting a contact 
     * listed in the 
     * contact us management
     *
     * <p>
     *   @author : Suvra Bhattacharyya
     *   @param : contact-id
     * </p>
     *
     **/
    public function deletecontact($id) {
        $id = base64_decode(urldecode($id));
        if ($this->contactusmodel->delete($id)) {
            $this->session->set_flashdata('successmessage', 'Message deleted successfully');
        } else {
            $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
        }

        $redirect=site_url('admin/contact-us');
        redirect($redirect);
    }

    public function updatearch($id) 
    {
        $id = base64_decode(urldecode($id));
        $data['archieve']='1';
        $where['id']=$id;
        if ($this->contactusmodel->updatearch($data,$where)) 
        {
            $this->session->set_flashdata('successmessage', 'Message Archieved successfully');
        } 
        else 
        {
            $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
        }

        $redirect=site_url('admin/contact-us');
        redirect($redirect);
    }

    public function updateres($id) 
    {
        $id = base64_decode(urldecode($id));
        $data['archieve']='0';
        $where['id']=$id;
        if ($this->contactusmodel->updatearch($data,$where)) 
        {
            $this->session->set_flashdata('successmessage', 'Message Restored successfully');
        } 
        else 
        {
            $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
        }

        $redirect=site_url('admin/contact-us-archieve');
        redirect($redirect);
    }

    /**
     * Functionality for 
     * updating the contact 
     * on the contact us management
     *
     * <p>
     *   @author : Suvra Bhattacharyya
     *   @param : None
     * </p>
     *
     **/
    public function updatecontact() {
        $id = $this->input->post('id');
        $reply = $this->input->post('reply');
        $query = $this->input->post('query');
        $email = $this->input->post('email');
        $email = base64_decode(urldecode($email));

        $email = trim($email);
        $reply = trim($reply);
        $reply = addslashes($reply);

        $message = "";

        $id = base64_decode(urldecode($id));

        $where['id'] = trim($id);

        $data['reply'] = $reply;
        $data['reply_status'] = '1';

        if ($this->contactusmodel->update($data, $where)) {
            $this->load->library('parser');
            /*
              message to be sent to the user
             */
            $message .="<p style=\"border: 1px solid #f0f0f0;padding: 12px;background-color: #f0f0f0;\"><strong style=\"display:block;\">Your Query was : </strong> " . $query . "</p>";
            $message .="<p style=\"border: 1px solid #f0f0f0;padding: 12px;background-color: #f0f0f0;\"><strong style=\"display:block;\" >Our Reply : </strong> " . $reply . "</p>";

            $tdata['date'] = date('l F d, Y');
            $tdata['year'] = date("Y");
            $tdata['siteurl'] = $this->config->item('base_url');
            $tdata['logo'] = $tdata['siteurl'] . "assets/images/logo.png";
            $tdata['heading'] = "Contact Us Reply";
            $tdata['message'] = $message;

            $tdata['sitename']=getsitename();
            $ssdet=$this->sitesettingsmodel->loadsitesettings();
            $tdata['siteemail']=$ssdet->siteemail;
            $tdata['siteaddress']=$ssdet->siteaddress;

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <' . get_from_session('email') . '>' . "\r\n";
            /*
              sending date to email tempelate
             */
            $msg = $this->parser->parse('mail/mail-template', $tdata, TRUE);

            /*
              sending mail for reply to contact us
             */
            mail($email, getsitename()." | Contact Us Reply ", $msg, $headers);


            $this->session->set_flashdata('successmessage', 'Contact Replied successfully');
        } else {
            $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
        }

        $redirect=site_url('admin/contact-us');
        redirect($redirect);
    }

    public function bulk_functionality() 
    {
        $opt = $this->input->post('opt');
        $chk = $this->input->post('chk');
        if($opt=="del")
        {
            if ($this->contactusmodel->bulk_del($chk)) 
            {
                $this->session->set_flashdata('successmessage', 'Message deleted successfully');
            }
            else 
            {
                $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
            }
            $redirect=$_SERVER['HTTP_REFERER'];
        }
        if($opt=="arch")
        {
            $val='1';
            if ($this->contactusmodel->bulk_arch($chk,$val)) 
            {
                $this->session->set_flashdata('successmessage', 'Message Archieved successfully');
            }
            else 
            {
                $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
            }
            $redirect=site_url('admin/contact-us');
        }
        if($opt=="res")
        {
            $val='0';
            if ($this->contactusmodel->bulk_arch($chk,$val)) 
            {
                $this->session->set_flashdata('successmessage', 'Message Restored successfully');
            }
            else 
            {
                $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
            }
            $redirect=site_url('admin/contact-us-archieve');
        }
        redirect($redirect);
    }
}