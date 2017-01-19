<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MX_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -  
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->helper('text');
        $this->load->library('form_validation');
        $this->load->model('admin/faqsmodel');
        admin_authenticate();
    }

    public function index() {
         $this->load->helper('text');
        $result = $this->faqsmodel->getarch('0');
        $data=array();
        $getsitename = getsitename();
        $data['result']=$result;
        $this->layouts->set_title($getsitename . ' | FAQs');
        $this->layouts->render('admin/faq', $data, 'admin');
    }

    public function deleteData($id)
    {
        $id=base64_decode(urldecode($id));


        $delstat=$this->faqsmodel->removedata($id);
        if (!empty($delstat)) 
        {
         
            $this->session->set_flashdata('successmessage', 'Faq deleted successfully');
        } 
        else 
        {
            $this->session->set_flashdata('errormessage', 'Oops! Something went wrong');
        }

        $redirect=$_SERVER['HTTP_REFERER'];
        redirect($redirect);
    }   

    public function formfaqs($id=NULL)
    {
        $id=base64_decode(urldecode($id));
        $data=array();

       $msg="Add Faq ";
        if(!empty($id))
        {
             $msg="Edit Faq ";

             $result=$this->faqsmodel->getData($id);
             $data['result']=$result;

        }

      

        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | '.$msg);
        $this->layouts->render('admin/faqform', $data, 'admin');
    }

    public function faqmodify()
    {
        $arr=$this->input->post();
        $id=$this->input->post('faqid');
        array_pop($arr);
       
        $arr['status']=1;

       
        $updflg=$this->faqsmodel->modifyData($arr,$id);

        if(!empty($updflg))
        {
            if(!empty($id))
            {

                $this->session->set_flashdata('successmessage', 'Faq updated successfully');
            }
            else
            {
                $this->session->set_flashdata('successmessage', 'Faq added successfully');
            }
        }
        else
        {
            $this->session->set_flashdata('errormessage', 'Oops! Something went wrong');
        }
        $redirect=site_url('admin/faqs');
        redirect($redirect);
    }

    public function statusfaq($id)
    {
        $id=base64_decode(urldecode($id));
        $data=array();

        $flg=$this->faqsmodel->statuschange($id);
        if (!empty($flg)) 
        {
            $this->session->set_flashdata('successmessage', 'Faq status changed successfully');
        } 
        else 
        {
            $this->session->set_flashdata('errormessage', 'Oops! Something went wrong');
        }
        $redirect=$_SERVER['HTTP_REFERER'];
        redirect($redirect);
    }


public function checkUnique()
 {
        $field = $this->input->post('field');
        $value = $this->input->post('value');

        $where[$field] = $value;

        echo $this->faqsmodel->isunique($where) ? "true" : "false";
    
 }

    public function archievelist() 
    {
        $this->load->helper('text');
        $list = $this->faqsmodel->getarch('1');
        $data['list'] = $list;

        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | Faq Archieve');
        $this->layouts->render('admin/archievelist', $data, 'admin');
    }

    public function updatearch($id) 
    {
        $id = base64_decode(urldecode($id));
        $data['archieve']='1';
        $where['id']=$id;
        if ($this->faqsmodel->updatearch($data,$where)) 
        {
            $this->session->set_flashdata('successmessage', 'Faq Archieved successfully');
        } 
        else 
        {
            $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
        }

        $redirect=site_url('admin/faqs');
        redirect($redirect);
    }

    public function updateres($id) 
    {
        $id = base64_decode(urldecode($id));
        $data['archieve']='0';
        $where['id']=$id;
        if ($this->faqsmodel->updatearch($data,$where)) 
        {
            $this->session->set_flashdata('successmessage', 'Faq Restored successfully');
        } 
        else 
        {
            $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
        }

        $redirect=site_url('admin/faqs-archieve');
        redirect($redirect);
    }

    public function bulk_functionality() 
    {
        $opt = $this->input->post('opt');
        $chk = $this->input->post('chk');
        if($opt=="del")
        {
            if ($this->faqsmodel->bulk_del($chk)) 
            {
                $this->session->set_flashdata('successmessage', 'Faq deleted successfully');
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
            if ($this->faqsmodel->bulk_arch($chk,$val)) 
            {
                $this->session->set_flashdata('successmessage', 'Faq Archieved successfully');
            }
            else 
            {
                $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
            }
            $redirect=site_url('admin/faqs');
        }
        if($opt=="res")
        {
            $val='0';
            if ($this->faqsmodel->bulk_arch($chk,$val)) 
            {
                $this->session->set_flashdata('successmessage', 'Faq Restored successfully');
            }
            else 
            {
                $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
            }
            $redirect=site_url('admin/faqs-archieve');
        }
        if($opt=="stat")
        {
            if ($this->faqsmodel->bulk_status($chk)) 
            {
                $this->session->set_flashdata('successmessage', 'Status changed successfully');
            }
            else 
            {
                $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
            }
            $redirect=$_SERVER['HTTP_REFERER'];
        }
        redirect($redirect);
    }

   }

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
