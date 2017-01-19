<?php
/**
 *
 * This helper is used 
 * for retrieving the sitename 
 * defined in the sitesettings
 *
 * <p>
 *  @author : Suvra Bhattacharyya
 *  @param : Without paramater for retrieving sitename. and name of the logo can be passed for retrieval of the full logo path
 * </p>
 *
 */

function getsitename($LOGO=NULL)
{
    $CI = & get_instance();
    $CI->load->model('admin/sitesettingsmodel');
    $detail=$CI->sitesettingsmodel->loadsitesettings();
    if(!empty($detail))
    {
        $result=$detail->sitename;
        if($LOGO)
        {
            $result=$detail->sitelogo;
        }
        return $result;
    }
    else
    {
      return "";
    }
    
}