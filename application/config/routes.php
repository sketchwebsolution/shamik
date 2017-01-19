<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['site-offline'] = "admin/siteoffline";

$route['404_override'] = '';

$route['admin/forget-password'] = "admin/forgetpass";
$route['admin/site-settings'] = "admin/sitesettings";
$route['admin/add-settings'] = "admin/addSettings";
$route['admin/edit-settings'] = "admin/editSettings";

$route['admin/new-password.html/(:any)'] = "admin/newpass/$1";
$route['admin/change-password'] = "admin/changePassword";

$route['admin/cms'] = "cms/admin/cms";
$route['admin/add-cms'] = "cms/admin/formcms";
$route['admin/edit-cms.html/(:any)'] = "cms/admin/formcms/$1";
$route['admin/delete-cms.html/(:any)'] = "cms/admin/deletecms/$1";
$route['admin/cms-status.html/(:any)'] = "cms/admin/statuscms/$1";

$route['admin/contact-us'] = "contactus/admin/contactus";
$route['admin/delete-contact.html/(:any)'] = "contactus/admin/deletecontact/$1";
$route['admin/contact-us-archieve'] = "contactus/admin/archievelist";
$route['admin/reply-contact.html/(:any)'] = "contactus/admin/replycontact/$1";
$route['admin/reply-view.html/(:any)'] = "contactus/admin/replyviewcontact/$1";

$route['admin/add-members'] = "admin/formusers";
$route['admin/edit-members.html/(:any)'] = "admin/formusers/$1";
$route['admin/delete-members.html/(:any)'] = "admin/deleteusers/$1";
$route['admin/members-status.html/(:any)'] = "admin/statususers/$1";

$route['admin/add-menu'] = "admin/addMenu";
$route['admin/edit-menu.html/(:any)'] = "admin/editmenu/$1";
$route['admin/delete-menu.html/(:any)'] = "admin/deletemenu/$1";

$route['admin/plugin-manager'] = "admin/plugins";
$route['admin/menu-manager'] = "admin/listMenu";




$route['default_controller'] = 'front';
$route['about-us'] = "front/aboutus";
$route['contact-us'] = "front/contactus";
$route['faqs'] = "front/faqs";



$route['forgot-password'] = "front/forgotpassword";
$route['recover-password.html/(:any)/(:any)'] = "front/recoverpassword/$1/$2";
$route['reset-password'] = "front/resetpassword";
$route['change-password'] = "front/changepassword";
$route['facebook-login'] = "facebookLogin/index";
$route['signup'] = "front/signup";
$route['login'] = "front/login";
$route['logout'] = "front/logout";
$route['acivate-hiberce-account.html/(:any)'] = "front/acivateaccount/$1";
$route['confirm-hiberce-account.html/(:any)'] = "front/confirmaccount/$1";
$route['buyer-profile'] = "front/buyerprofile";




require_once( BASEPATH .'database/DB'. EXT );
 $db =& DB();
$query = $db->get( 'h_cms' );
 $result = $query->result();
 if(count($result)>0){
 foreach($result as $row){

	 		if($row->alias!=="home" )
                  {
		     
			$route[$row->alias] = "front/pages/$1";


                      }
                 
	 
	       }

 }
//-------HMVC MODULES --------//

$route['admin/moderator'] = "subadmin/admin";
$route['admin/add-moderator'] = "subadmin/admin/formsubadmin";
$route['admin/edit-moderator.html/(:any)'] = "subadmin/admin/formsubadmin/$1";
$route['admin/role'] = "subadmin/admin/role";
$route['admin/add-role'] = "subadmin/admin/addRole";
$route['admin/edit-role.html/(:any)'] = "subadmin/admin/editRole/$1";
$route['admin/faqs'] = "faqs/admin";
$route['admin/add-faqs'] = "faqs/admin/formfaqs";
$route['admin/faqs-archieve'] = "faqs/admin/archievelist";
$route['admin/edit-faqs.html/(:any)'] = "faqs/admin/formfaqs/$1";



$route['admin/banner'] = "banner/admin";
$route['admin/add-banner'] = "banner/admin/formbanner";
$route['admin/edit-banner.html/(:any)'] = "banner/admin/formbanner/$1";
$route['admin/banner-archieve'] = "banner/admin/archievelist";



