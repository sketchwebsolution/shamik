<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MX_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
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
        $this->load->library('form_validation');
        $this->load->model('admin/bannermodel');
    }

    public function index() {
        $this->load->model('admin/bannermodel');
        $bannerdet=$this->bannermodel->getarch('0');
        $data=array();
        $data['bannerdet']=$bannerdet;
        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | banner');
        $this->layouts->render('admin/bannerlist', $data, 'admin');
    } 

    public function formbanner($bannerid=NULL)
    {
        $bannerid=base64_decode(urldecode($bannerid));
        $data=array();
        $this->load->model('admin/bannermodel');

        $bannerdetsingle=$this->bannermodel->loadbannersingle($bannerid);
        $data['bannerdetsingle']=$bannerdetsingle;

        $getsitename = getsitename();
        if(!empty($bannerid))
        {
            $this->layouts->set_title($getsitename . ' | Edit-banner');
        }
        else
        {
            $this->layouts->set_title($getsitename . ' | Add-banner');
        }
        $this->layouts->render('admin/bannerform', $data, 'admin');
    }

    public function bannermodify()
    {
        $bannerid="";
        if(!empty($this->input->post('bannerid')))
        {
            $bannerid=$this->input->post('bannerid');
        }

        $this->load->model('admin/bannermodel');
        $description=htmlentities($this->input->post('description'),ENT_QUOTES,'utf-8');

        $file=$_FILES['image'];

        if(!empty($file['name']))
        {
            $imagename=$file['name'];
            $imagearr=explode('.',$imagename);
            $ext=end($imagearr);
            $newimage=time().rand().".".$ext;

            if($ext=="jpg" or $ext=="jpeg" or $ext=="png" or $ext=="bmp")
            {
                $this->load->library('image_lib');

                $config['image_library'] = 'gd2';
                $config['source_image'] = $file['tmp_name'];
                $config['new_image'] = APPPATH."../assets/banner/uploads/thumb/".$newimage;
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 200;
                $config['height'] = 60;

                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                $this->image_lib->resize();

                $config1['image_library'] = 'gd2';
                $config1['source_image'] = $file['tmp_name'];
                $config1['new_image'] = APPPATH."../assets/banner/uploads/".$newimage;
                $config1['create_thumb'] = FALSE;
                $config1['maintain_ratio'] = FALSE;
                $config1['width'] = 1042;
                $config1['height'] = 322;

                $this->image_lib->clear();
                $this->image_lib->initialize($config1);
                $this->image_lib->resize();
            }
            else
            {
                $this->session->set_flashdata('errormessage', 'Only .jpg,.jpeg,.bmp and .png image extensions are supported');
            }
        }
        else
        {
            $newimage="";
        }

        $flg=$this->bannermodel->modifybanner($bannerid,$description,$newimage);
        if (!empty($flg)) 
        {
            $this->session->set_flashdata('successmessage', 'Banner modified successfully');
        } 
        else 
        {
            $this->session->set_flashdata('errormessage', 'Oops! Something went wrong');
        }

        $redirect=site_url('admin/banner');
        redirect($redirect);
    }

    public function statusbanner($bannerid)
    {
        $bannerid=base64_decode(urldecode($bannerid));
        $data=array();
        $this->load->model('admin/bannermodel');

        $flg=$this->bannermodel->statusbanner($bannerid);
        if (!empty($flg)) 
        {
            $this->session->set_flashdata('successmessage', 'Banner status changed successfully');
        } 
        else 
        {
            $this->session->set_flashdata('errormessage', 'Oops! Something went wrong');
        }
        $redirect=$_SERVER['HTTP_REFERER'];
        redirect($redirect);
    }

    public function deletebanner($bannerid)
    {
        $bannerid=base64_decode(urldecode($bannerid));
        $data=array();
        $this->load->model('admin/bannermodel');

        $flg=$this->bannermodel->deletebanner($bannerid);
        if (!empty($flg)) 
        {
            $this->session->set_flashdata('successmessage', 'Banner deleted successfully');
        } 
        else 
        {
            $this->session->set_flashdata('errormessage', 'Oops! Something went wrong');
        }
        $redirect=$_SERVER['HTTP_REFERER'];
        redirect($redirect);
    }

    public function archievelist() 
    {
        $this->load->helper('text');
        $list = $this->bannermodel->getarch('1');
        $data['list'] = $list;

        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | Banner Archieve');
        $this->layouts->render('admin/archievelist', $data, 'admin');
    }

    public function updatearch($id) 
    {
        $id = base64_decode(urldecode($id));
        $data['archieve']='1';
        $where['id']=$id;
        if ($this->bannermodel->updatearch($data,$where)) 
        {
            $this->session->set_flashdata('successmessage', 'Banner Archieved successfully');
        } 
        else 
        {
            $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
        }

        $redirect=site_url('admin/banner');
        redirect($redirect);
    }

    public function updateres($id) 
    {
        $id = base64_decode(urldecode($id));
        $data['archieve']='0';
        $where['id']=$id;
        if ($this->bannermodel->updatearch($data,$where)) 
        {
            $this->session->set_flashdata('successmessage', 'Banner Restored successfully');
        } 
        else 
        {
            $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
        }

        $redirect=site_url('admin/banner-archieve');
        redirect($redirect);
    }

    public function bulk_functionality() 
    {
        $opt = $this->input->post('opt');
        $chk = $this->input->post('chk');
        if($opt=="del")
        {
            if ($this->bannermodel->bulk_del($chk)) 
            {
                $this->session->set_flashdata('successmessage', 'Banner deleted successfully');
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
            if ($this->bannermodel->bulk_arch($chk,$val)) 
            {
                $this->session->set_flashdata('successmessage', 'Banner Archieved successfully');
            }
            else 
            {
                $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
            }
            $redirect=site_url('admin/banner');
        }
        if($opt=="res")
        {
            $val='0';
            if ($this->bannermodel->bulk_arch($chk,$val)) 
            {
                $this->session->set_flashdata('successmessage', 'Banner Restored successfully');
            }
            else 
            {
                $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
            }
            $redirect=site_url('admin/banner-archieve');
        }
        if($opt=="stat")
        {
            if ($this->bannermodel->bulk_status($chk)) 
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
