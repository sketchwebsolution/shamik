<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $title;?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo $this->config->item('base_url');?>assets/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('base_url');?>assets/admin/bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
<!--     <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar 2.2.5-->
    <link href="<?php echo $this->config->item('base_url');?>assets/admin/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->config->item('base_url');?>assets/admin/plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
    <!-- Theme style -->
    <link href="<?php echo $this->config->item('base_url');?>assets/admin/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo $this->config->item('base_url');?>assets/admin/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
     <!-- DATA TABLES -->
    <link href="<?php echo $this->config->item('base_url');?>assets/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- FONT AWESOME -->
<!--     <link href="<?php echo $this->config->item('base_url');?>assets/font-awesome/font-awesome.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?php echo $this->config->item('base_url');?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo $this->config->item('base_url');?>assets/admin/plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo $this->config->item('base_url');?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <!-- token Input CSS -->
    <link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin/styles/token-input.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin/styles/token-input-facebook.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/admin/css/jquery.gridly.css" type="text/css" />
    <!-- Developer CSS -->
    <link href="<?php echo $this->config->item('base_url');?>assets/developer.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style>
div.error
{
color:#dd0000;
}
</style>
    <!-- jQuery 2.1.3 -->
    <script src="<?php echo $this->config->item('base_url');?>assets/admin/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="<?php echo $this->config->item('base_url');?>assets/admin/js/jquery.validate.min.js"></script>
    <script src="<?php echo $this->config->item('base_url');?>assets/jscolor/jscolor.js"></script>
  
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      
      <header class="main-header">
        <a href="<?php echo $this->config->item('base_url');?>admin" class="logo">Control Panel</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a style="cursor:pointer;" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php $imgadmin=get_from_session('image'); if(!empty($imgadmin)) { echo $this->config->item('upload_dir').get_from_session('image');} else { echo $this->config->item('upload_dir')."placeholder.png"; } ?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo get_from_session('username'); ?></span>

                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php $imgadmin=get_from_session('image'); if(!empty($imgadmin)) { echo $this->config->item('upload_dir').get_from_session('image');} else { echo $this->config->item('upload_dir')."placeholder.png"; } ?>" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo get_from_session('email'); ?>
                      <small>Last Login <?php echo date('jS M Y \a\t h:i:s A',strtotime(get_from_session('last_login'))); ?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->

                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo site_url('admin/profile');?>" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo site_url('admin/logout');?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>

          <div class="navbar-custom-menu">
            <?php
            if (file_exists(APPPATH."modules/language/views/language.php"))
            {
              echo langview();
            }
            ?>
          </div>
        </nav>
      </header>
      <?php
      $errormessage=$this->session->flashdata('errormessage');
      $successmessage=$this->session->flashdata('successmessage');
      if(!empty($errormessage) or !empty($successmessage))
      {
      ?>
      <div class="overlay"></div>
      <?php
      }
      ?>
      
      <?php
      if($errormessage)
      {
      ?>
      <div class="errormessage">
        <span><i class="fa fa-warning"></i></span>
        <div><?php echo $errormessage;?></div>
        <span class="closebutn"><i class="fa fa-close"></i></span>
      </div>
      <?php
      }
      if($successmessage)
      {
      ?>
      <div class="successmessage">
        <span><i class="fa fa-check-circle"></i></span>
        <div><?php echo $successmessage;?></div>
        <span class="closebutn"><i class="fa fa-close"></i></span>
      </div>
      <?php
      }
      ?>
<!-- Sitebar -->
        <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php $imgadmin=get_from_session('image'); if(!empty($imgadmin)) { echo $this->config->item('upload_dir').get_from_session('image');} else { echo $this->config->item('upload_dir')."placeholder.png"; } ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo get_from_session('fname')." ".get_from_session('lname');?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <!--<form action="#" method="get" class="sidebar-form">-->
            <!--<div class="input-group">-->
              <!--<input type="text" name="q" class="form-control" placeholder="Search..."/>-->
              <!--<span class="input-group-btn">-->
              <!--  <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>-->
              <!--</span>-->
            <!--</div>-->
          <!--</form>-->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
            <?php 
            
           $current_uri=$this->uri->segment(2);
           $menu = get_menu_from_setting('admin_sidebar');
           $admintype = $this->session->userdata('admin_type');
     
           ?>
          <ul class="sidebar-menu">
           <?php 
           if(!empty($menu))
           {
             foreach ($menu as $item) {

              $active = explode(',',$item->active);
              if($item->status == 1)
              {
                $submanuclass = !empty($item->submenu) ? "treeview" : ""; 
              ?>
              <li class="<?php if(in_array($current_uri,$active)) echo 'active '; ?><?= $submanuclass ?>">
                 <a href="<?php echo site_url($item->url);?>">
                   <i class="fa <?= $item->icon; ?>"></i> <span><?= $item->label; ?></span>
                   <?php if(!empty($item->submenu)){  ?><i class="fa fa-angle-left pull-right"></i> <?php } ?>
                 </a>

                 <?php

                  if(!empty($item->submenu)){ 
                  ?>
                  <ul class="treeview-menu">
                  <li class="<?php if(in_array($current_uri,$active)) echo 'active '; ?>">
                 <a href="<?php echo site_url($item->url);?>">
                   <i class="fa <?= $item->icon; ?>"></i> <span><?= $item->label; ?></span>
                 </a>
                 </li>
                  <?php
                  foreach ($item->submenu as $key => $item) {
                  
                  $active = explode(',',$item->active);

                  if($item->status == 1)
                  {
                  ?>
                <li <?php if(in_array($current_uri,$active)) echo "class='active'"; ?>>
                 <a href="<?php echo site_url($item->url);?>">
                   <i class="fa <?= $item->icon; ?>"></i> <span><?= $item->label; ?></span>
                 </a>
               </li>
                 <?php
                    }
                   }

                echo '</ul>';
                  } 
                ?>              <?php
              }
             }
           }
           ?>

                 <?php $str=ENVIRONMENT;$a=$_SERVER['REQUEST_URI'];
                 if($str=="development") : ?>

           <li <?php if (strpos($a,'plugin-manager') !== false) { echo "class='active'";}?>>
             <a href="<?php echo site_url('admin/plugin-manager');?>">
               <i class="fa fa-plug"></i> <span>Plugin Management</span>
             </a>
           </li>

           <li <?php if (strpos($a,'menu-manager') !== false) { echo "class='active'";}?>>
             <a href="<?php echo site_url('admin/menu-manager');?>">
               <i class="fa fa-bars"></i> <span>Menu Management</span>
             </a>
           </li>


         <?php endif; ?>

           
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!--End of Sidebar-->

<!-- Sidebar-->

<!-- Content -->

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
<?php echo $content;?>

        
      </div><!-- /.content-wrapper -->
      

<!-- Content  -->


<!-- Footer-->

            <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; <?php echo date('Y');?> <a href="<?php echo $this->config->item('base_url');?>"><?php echo getsitename();?></a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->


    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo $this->config->item('base_url');?>assets/admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->config->item('base_url');?>assets/admin/bootstrap/js/jasny-bootstrap.min.js" type="text/javascript"></script>
    <!-- jQuery UI 1.11.1 -->
    <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="<?php echo $this->config->item('base_url');?>assets/admin/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo $this->config->item('base_url');?>assets/admin/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $this->config->item('base_url');?>assets/admin/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo $this->config->item('base_url');?>assets/admin/dist/js/demo.js" type="text/javascript"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->config->item('base_url');?>assets/admin/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo $this->config->item('base_url');?>assets/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo $this->config->item('base_url');?>assets/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?php echo $this->config->item('base_url');?>assets/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    
    <!-- CKEDITOR -->
    <script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/ckeditor/ckeditor.js"></script>

    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo $this->config->item('base_url');?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- Token Input -->
    <script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/admin/js/jquery.gridly.js"></script>
    
    <script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/admin/src/jquery.tokeninput.js"></script>
    <!-- Developer JS -->
    <script src="<?php echo $this->config->item('base_url');?>assets/developer.js"></script>
    <!-- Page specific script -->
   <script>
    $( document ).ready(function() {
        $("#btnSubmit").click(function() {
          var selectedLanguage = new Array();
                                                           
                                                            $("input[name='productprintids[]']:checked").each(function (){
                                                          // $('input[name="orderprintids[]"]:checked').each(function() {
                                                               selectedLanguage.push(this.value);
                                                             
                                                               $('#test').append('<input type="hidden" name="hodo[]" value="'+this.value+'"/>');
                                                           

                                                           });
                                                         if(selectedLanguage.length > 0)
                                                             {
                                                              
                                                               $('#matching_Form').submit();
                                                              return true;
                                                            }
                                                             else{
                                                                   alert("Please Select At Least One Select Box");
                                                                    return false;}
                                                      //$('#matching_Form').submit();
                                                      var url = "<?php echo $this->config->item('base_url');?>index.php/order/admin/index";
                                                      //$(location).attr('href',url);
    });
  
});
    </script>
    <script type="text/javascript">

	var jsurl='<?php echo $this->config->item('base_url');?>';

      $(function () {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
          ele.each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
              title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
              zIndex: 1070,
              revert: true, // will cause the event to go back to its
              revertDuration: 0  //  original position after the drag
            });

          });
        }
        ini_events($('#external-events div.external-event'));

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
          },
          //Random default events
          events: [
            {
              title: 'All Day Event',
              start: new Date(y, m, 1),
              backgroundColor: "#f56954", //red
              borderColor: "#f56954" //red
            },
            {
              title: 'Long Event',
              start: new Date(y, m, d - 5),
              end: new Date(y, m, d - 2),
              backgroundColor: "#f39c12", //yellow
              borderColor: "#f39c12" //yellow
            },
            {
              title: 'Meeting',
              start: new Date(y, m, d, 10, 30),
              allDay: false,
              backgroundColor: "#0073b7", //Blue
              borderColor: "#0073b7" //Blue
            },
            {
              title: 'Lunch',
              start: new Date(y, m, d, 12, 0),
              end: new Date(y, m, d, 14, 0),
              allDay: false,
              backgroundColor: "#00c0ef", //Info (aqua)
              borderColor: "#00c0ef" //Info (aqua)
            },
            {
              title: 'Birthday Party',
              start: new Date(y, m, d + 1, 19, 0),
              end: new Date(y, m, d + 1, 22, 30),
              allDay: false,
              backgroundColor: "#00a65a", //Success (green)
              borderColor: "#00a65a" //Success (green)
            },
            {
              title: 'Click for Google',
              start: new Date(y, m, 28),
              end: new Date(y, m, 29),
              url: 'http://google.com/',
              backgroundColor: "#3c8dbc", //Primary (light-blue)
              borderColor: "#3c8dbc" //Primary (light-blue)
            }
          ],
          editable: true,
          droppable: true, // this allows things to be dropped onto the calendar !!!
          drop: function (date, allDay) { // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;
            copiedEventObject.backgroundColor = $(this).css("background-color");
            copiedEventObject.borderColor = $(this).css("border-color");

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
              // if so, remove the element from the "Draggable Events" list
              $(this).remove();
            }

          }
        });

        /* ADDING EVENTS */
        var currColor = "#3c8dbc"; //Red by default
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function (e) {
          e.preventDefault();
          //Save color
          currColor = $(this).css("color");
          //Add color effect to button
          $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
        });
        $("#add-new-event").click(function (e) {
          e.preventDefault();
          //Get value and make sure it is not null
          var val = $("#new-event").val();
          if (val.length == 0) {
            return;
          }

          //Create events
          var event = $("<div />");
          event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
          event.html(val);
          $('#external-events').prepend(event);

          //Add draggable funtionality
          ini_events(event);

          $("#new-event").val("");
        });
      });
      
      $(document).ready(function(){
        $('.closebutn').click(function(){
          $('.overlay').fadeOut();
          $('.successmessage').fadeOut();
          $('.errormessage').fadeOut();
        });
      });
      
      $(document).ready(function(){
        $('.overlay').delay(1000).fadeOut();
        $('.successmessage').delay(1000).fadeOut();
        $('.errormessage').delay(1000).fadeOut();
      });
      
      $(document).ready(function(){
        $('.no-print').hide();
      });
    </script>
    
    <script type="text/javascript">
      $(function () {
        $("#example00").dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": true,
          "bSort": false,
          "bInfo": true,
          "bAutoWidth": false,
          "oLanguage": {
           "oPaginate": {
             "sPrevious": "",
             "sNext": ""
           }
         }
        });
        $("#example1").dataTable({
         "oLanguage": {
           "oPaginate": {
             "sPrevious": "",
             "sNext": ""
           }
         }
        });
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false,
          "oLanguage": {
           "oPaginate": {
             "sPrevious": "",
             "sNext": ""
           }
         }
        });
        
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
      });
    </script>
   

<script>
      $(function () {
        //Add text editor
        $("#compose-textarea").wysihtml5();
      });
    </script>
    <script>
      $(function () {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        //$('input[type="checkbox"]').iCheck({
          //checkboxClass: 'icheckbox_flat-blue',
          //radioClass: 'iradio_flat-blue'
        //});

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
          var clicks = $(this).data('clicks');
          if (clicks) {
            //Uncheck all checkboxes
            $("input[type='checkbox']", ".mailbox-messages").iCheck("uncheck");
          } else {
            //Check all checkboxes
            $("input[type='checkbox']", ".mailbox-messages").iCheck("check");
          }
          $(this).data("clicks", !clicks);
        });
      });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-facebook-theme").tokenInput({theme: "facebook"});
        });
    </script>
                  <script type="text/javascript">
                    $("#searchticket").on('click',"#pagination button",function(){
                       var a = $("#ajax").val();
                       if(a)
                       { 
                          var uri = $(this).find('a').attr('href'); //pagination link url
                          var arr = uri.split('/');
                          var pageno = arr[arr.length-1];
                          var stateval = $("#stateval").val();
                          var searchval = $("#searchval").val();
                          searchticket(searchval,stateval,pageno);
                         return false;
                      }
                      else
                      {
                        window.location = $(this).find('a').attr('href');
                      }
                    });

                    $("#searchinbox").on('click',"#pagination button",function(){
                       var a = $("#ajax").val();
                       if(a)
                       { 
                          var uri = $(this).find('a').attr('href');
                          var arr = uri.split('/');
                          p = arr[arr.length-2];
                          var pageno = arr[arr.length-1];
                          var searchval = $("#searchval").val();
                          switch(p)
                          {
                            case 'message-inbox':
                              searchinbox(searchval,pageno);
                              break;
                            case 'message-sent':
                              searchsent(searchval,pageno);
                              break;
                            case 'message-trash':
                                searchtrash(searchval,pageno);
                                break;

                          }
                          
                         return false;
                      }
                      else
                      {
                        window.location = $(this).find('a').attr('href');
                      }
                    });
                  </script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url'); ?>assets/admin/js/jquery.validate.min.js"></script>
                  <script>
                       $(function() {

                                   

                                    // override jquery validate plugin defaults
                                    $.validator.setDefaults({
                                        highlight: function(element) {

                                            $(element).closest('.form-group').addClass('has-error');
                                        },
                                        unhighlight: function(element) {
                                            $(element).closest('.form-group').removeClass('has-error');
                                        },
                                        errorElement: 'span',
                                        errorClass: 'help-block',
                                        errorPlacement: function(error, element) {
                                            if (element.parent('.form-control').length) {
                                                error.insertAfter(element.parent());
                                            } else {
                                                error.insertAfter(element);
                                            }
                                        }
                                    });
                                                    
                                });
                  </script>
                  <script>
  $('.gridly').gridly({
    base: 60, // px 
    gutter: 20, // px
    columns: 12
  });


$(document).ready(function(){
	// $('.brick').shuffle();
        
        $('input[type="text"]').prop("autocomplete","off");
});
</script>
<?php
if (file_exists(APPPATH."modules/language/views/script.php"))
{
  echo scriptview();
}
?>


<script>

$(function(){
   var curli=$("ul.sidebar-menu").find("li.active"),
    ple1=curli.closest('.treeview');
    ple2=curli.closest('.treeview-menu');
    ple1.addClass('active');
    ple2.addClass('active');
    if(ple1.parent().hasClass('treeview-menu'))
      {
         ple1.parent().addClass('active');

      }

        if(ple1.parent().parent().hasClass('treeview'))
        {
           ple1.parent().parent().addClass('active');
        }

 });

</script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/bootstrap/css/bootstrap-datetimepicker.css');?>">
<script type="text/javascript" src="<?php echo base_url('assets/admin/bootstrap/js/moment-with-locales.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/bootstrap/js/bootstrap-datetimepicker.js');?>"></script>
<script type="text/javascript">
 $(function(){
   $('.admindt').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss'});
 });

</script>
<script>

$(function(){
   var curli=$("ul.sidebar-menu").find("li.active"),
    ple1=curli.closest('.treeview');
    ple2=curli.closest('.treeview-menu');
    ple1.addClass('active');
    ple2.addClass('active');
    if(ple1.parent().hasClass('treeview-menu'))
      {
         ple1.parent().addClass('active');

      }

        if(ple1.parent().parent().hasClass('treeview'))
        {
           ple1.parent().parent().addClass('active');
        }

 });

</script>
  </body>
</html>

<!-- Footer-->
