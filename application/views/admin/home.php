<style type="text/css">
  .gridly {
    position: relative;
    width: 960px;
  }
  .brick.small {



  }
  .brick.large {
    width: 300px;
    height: 300px;
  }
  .text-center{
      text-align: center;
      width: 100%;
      height: 100%;
      padding-top: 24%;
  }

  .info-box{
      border: 1px solid #f0f0f0;
  }


</style>
<section class="content-header">
        <div class="col-md-12">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
        </div>  
        </section>
        <br />

        <!-- Main content -->
        <section class="content">
        <?php
    
	    $loggedinip=get_from_session('ip_address');
	    $lastlogin=get_from_session('last_login');
      $menu = get_menu_from_setting('admin_sidebar');
      /*$a = array();
      foreach ($menu as $m) {
        $m = (array)$m;
        $m['status'] = 1;
        $a[] = $m;
      }

      echo json_encode($a);*/
      ?>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 login-section">
                
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Login Details</h3></div>
                        <div class="panel-body">
                            <p>
                                <label>Present logged in IP Address</label>
                                <span><?php echo $loggedinip;?></span>
                            </p>
                            <p>
                                <label>Last logged in time</label>
                                <span><?php echo date('jS F, Y  h:i A',strtotime($lastlogin));?></span>
                            </p>
                        </div>
                    </div>
            </div>
            
            <div class="col-md-12 col-sm-12 col-xs-12 dashboard-section">
                
                <div class="panel panel-default" >
                        <div class="panel-body" >
                           <div class="gridly">
                                   <?php 
                                       if(!empty($menu))
                                       {
                                        $admintype = $this->session->userdata('admin_type');
                                         foreach ($menu as $item) {
                                             if($item->label =='Dashboard')
                                             continue;

                                          $active = explode(',',$item->active);
                                          if($item->status == 1)
                                          {
                                          ?>
                                          <div class="brick small col-md-3 col-sm-6 col-xs-12">
                                            <a href="<?php echo $this->config->item('base_url').$item->url;?>">
                                                <div class="info-box">
                                                  <span class="info-box-icon bg-aqua"><i class="fa <?= $item->icon ?>"></i></span>
                                                  <div class="info-box-content">
                                                    <span class="info-box-text"></span>
                                                    <span class="info-box-number"><?= $item->label; ?></span>
                                                  </div><!-- /.info-box-content -->
                                                </div><!-- /.info-box -->
                                            </a>
                                          </div>
                                          <?php
                                          }
                                         }
                                       }
                                       ?>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="clearfix"></div>
            
            
        </section><!-- /.content -->
      
        
        <style>
            .bdr{margin: 5px; border: solid 1px #999; border-radius: 5px; padding-top:15px; padding-bottom: 15px; }
            .login-section label{ width: 200px;}
            .login-section h3{margin: 0;}
            .dashboard-section a{color: #2a2a2a;}
            .dashboard-section a:hover{opacity: .8;}
            
            @media all (max-width:767px){
                .login-section label{ width: 100%;}
                .login-section span{display: block;}
            }
            
        </style>
