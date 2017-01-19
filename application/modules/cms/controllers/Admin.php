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
 *  @package : cms, formcms, cmsupdate, deletecms, statuscms
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
        $this->load->model('admin/cmsmodel');
        admin_authenticate();
    }

    /**
     *
     * Functionality for 
     * listing of the cms pages
     *
     * <p>
     *   @author : Suvra Bhattacharyya
     *   @param : None
     * </p>
     *
     **/
    public function cms() {
        $cmsdet = $this->cmsmodel->loadcms();
        $data['cmsdet'] = $cmsdet;
        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | CMS Pages');
        $this->layouts->render('admin/cmslist', $data, 'admin');
    }

    /**
     *
     * Functionality for 
     * cms add or edit form
     *
     * <p>
     *   @author : Suvra Bhattacharyya
     *   @param : cms-id for edit, none for add
     * </p>
     *
     **/
    public function formcms($id = NULL) {
        $name = "";
        $data = array();
        if (!empty($id)) {
            $id = base64_decode(urldecode($id));
            $cmslist = $this->cmsmodel->loadcmssingle($id);
            $data['cmslist'] = $cmslist;
            $name = "Edit CMS";
            //$data['pagetype']="Edit CMS";
        } else {
            //$data['pagetype']="Add CMS";
            $name = "Add CMS";
        }

        $getsitename = getsitename();
        $this->layouts->set_title($getsitename . ' | ' . $name);
        $this->layouts->render('admin/cmsform', $data, 'admin');
    }

    /**
     *
     * Functionality for 
     * modifying the cms pages section
     *
     * <p>
     *   @author : Suvra Bhattacharyya
     *   @param : cms id
     * </p>
     *
     **/
    public function cmsupdate($id = NULL) {
        if (!empty($id)) {
            $id = base64_decode(urldecode($id));
        }
        /* $this->form_validation->set_rules('title', 'Title', 'trim|required|is_unique[tbl_cms.title]|xss_clean');
          $this->form_validation->set_rules('content', 'Content', 'trim|required|is_unique[tbl_cms.content]|xss_clean');
          $this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required|is_unique[tbl_cms.meta_title]|xss_clean');
          $this->form_validation->set_rules('meta_key', 'Meta Key', 'trim|required|is_unique[tbl_cms.meta_key]|xss_clean');
          $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required|is_unique[tbl_cms.meta_description]|xss_clean'); */
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('content', 'Content', 'trim|required');
        $this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required');
        $this->form_validation->set_rules('meta_key', 'Meta Key', 'trim|required');
        $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');

        if ($this->input->post('titlecms') !== $this->input->post('title')) {
            $type_name1 = str_replace(' ', '', strtolower($this->input->post('title')));
            $original_value = $this->cmsmodel->loadcms();

            //$original_value="select * from tbl_cms where status='1'";
            //echo "<pre>";print_r($original_value);die;

            $arr = array();
            if (count($original_value) > 0) {
                foreach ($original_value as $key => $tax_name2) {
                    $arr[$key] = str_replace(' ', '', strtolower($tax_name2->title));
                }
            }
            $is_unique = '';
            if (!empty($arr)) {
                if (in_array($type_name1, $arr)) {

                    $is_unique = '|is_unique['.tablename("cms").'.title]';
                } else {

                    $is_unique = '';
                }
            }

            $this->form_validation->set_rules('title', 'Title', 'required' . $is_unique);
            //$this->form_validation->set_rules('tax_name', 'tax_name', 'required|is_unique[tax.tax_name]');
        }

        if ($this->input->post('metatitlecms') !== $this->input->post('meta_title')) {
            $type_name1 = str_replace(' ', '', strtolower($this->input->post('meta_title')));
            $original_value = $this->cmsmodel->loadcms();

            //$original_value="select * from tbl_cms where status='1'";
            //echo "<pre>";print_r($original_value);die;

            $arr = array();
            if (count($original_value) > 0) {
                foreach ($original_value as $key => $tax_name2) {
                    $arr[$key] = str_replace(' ', '', strtolower($tax_name2->meta_title));
                }
            }
            $is_unique = '';
            if (!empty($arr)) {
                if (in_array($type_name1, $arr)) {

                    $is_unique = '|is_unique['.tablename("cms").'.meta_title]';
                } else {

                    $is_unique = '';
                }
            }

            $this->form_validation->set_rules('meta_title', 'Meta Title', 'required' . $is_unique);
            //$this->form_validation->set_rules('tax_name', 'tax_name', 'required|is_unique[tax.tax_name]');
        }

        if ($this->input->post('metakeycms') !== $this->input->post('meta_key')) {
            $type_name1 = str_replace(' ', '', strtolower($this->input->post('meta_key')));
            $original_value = $this->cmsmodel->loadcms();

            //$original_value="select * from tbl_cms where status='1'";
            //echo "<pre>";print_r($original_value);die;

            $arr = array();
            if (count($original_value) > 0) {
                foreach ($original_value as $key => $tax_name2) {
                    $arr[$key] = str_replace(' ', '', strtolower($tax_name2->meta_key));
                }
            }
            $is_unique = '';
            if (!empty($arr)) {
                if (in_array($type_name1, $arr)) {

                    $is_unique = '|is_unique['.tablename("cms").'.meta_key]';
                } else {

                    $is_unique = '';
                }
            }

            $this->form_validation->set_rules('meta_key', 'Meta Key', 'required' . $is_unique);
            //$this->form_validation->set_rules('tax_name', 'tax_name', 'required|is_unique[tax.tax_name]');
        }
        $this->form_validation->set_message('required', 'Please enter %s');
        $this->form_validation->set_message('is_unique', '%s already added');

        if ($this->form_validation->run() != FALSE) {
            $flg = $this->cmsmodel->changecms($id);

            if (!empty($flg)) {
                if (!empty($id)) {
                    $stat = 'edited';
                } else {
                    $stat = 'added';
                }
                $this->session->set_flashdata('successmessage', 'CMS ' . $stat . ' successfully');
            } else {
                $this->session->set_flashdata('errormessage', 'Oops! Something went wrong. Please try again.');
            }
            $redirect=site_url('admin/cms');
            redirect($redirect);
        } else {
            $data = array();
            if (!empty($id)) {
                $id = base64_decode(urldecode($id));
                $cmslist = $this->cmsmodel->loadcmssingle($id);
                $data['cmslist'] = $cmslist;
                $name = "Edit CMS";
                //$data['pagetype']="Edit CMS";
            }
            $name = "Add CMS";
            $getsitename = getsitename();
            $this->layouts->set_title($getsitename . ' | ' . $name);
            $this->layouts->render('admin/cmsform', $data, 'admin');
        }
    }

    /**
     *
     * Functionality for 
     * deleting a cms page
     *
     * <p>
     *   @author : Suvra Bhattacharyya
     *   @param : cms id
     * </p>
     *
     */
    public function deletecms($id) {
        $id = base64_decode(urldecode($id));
        $flg = $this->cmsmodel->deletecms($id);
        if (!empty($flg)) {
            $this->session->set_flashdata('successmessage', 'CMS deleted successfully');
        } else {
            $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
        }
        $redirect=site_url('admin/cms');
        redirect($redirect);
    }

    /**
     *
     * Functionality for 
     * changing of status 
     * for the cms pages
     *
     * <p>
     *   @author : Suvra Bhattacharyya
     *   @param : cms id
     * </p>
     *
     **/
    public function statuscms($id) {
        $id = base64_decode(urldecode($id));
        $arr = array(13, 14, 15, 16, 17, 18, 19);
        if (in_array($id, $arr)) {

            $this->session->set_flashdata('errormessage', 'You can not change the status of this page.');
        } else {

            $flg = $this->cmsmodel->statuscms($id);
            if (!empty($flg)) {
                $this->session->set_flashdata('successmessage', 'Status changed successfully');
            } else {
                $this->session->set_flashdata('errormessage', 'Oops! something went wrong. Please try again');
            }
        }
        $redirect=site_url('admin/cms');
        redirect($redirect);
    }
}