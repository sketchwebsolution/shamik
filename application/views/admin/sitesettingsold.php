
        <section class="content-header">
          <h1>
            Site Settings
            <small>Control panel</small>
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-body">
                  <form  enctype="multipart/form-data" id="site_settings" name="site_settings" role="form" action="<?php echo $this->config->item('base_url');?>admin/siteupdate" method="post">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Site Name</label>
                      <input type="text" class="form-control" name="sitename" value="<?php echo $sitesettings->sitename;?>" placeholder="Enter Site Name"/>
                    </div>
                    <div class="form-group">
                      <label>Site Logo</label>
                     <input type="file" name="sitelogo" id="sitelogo" />

                     <br>
                     <?php 
                        $img=$sitesettings->sitelogo;
                        if(!empty($img)){
                     ?>
                        <img src="<?php echo $this->config->item('base_url');?>/assets/images/<?php echo $img;?>" width="200" />
                     
                     <input type="hidden" name="oldsitelogo" id="<?=$img;?>" class="form-control"  placeholder="Enter Site Logo"/>

                     <?php } ?>
                    </div>

                    <div class="form-group">
                      <label>Login Background color</label>
                      <input type="text" class="form-control color" name="logback_color" value="<?php echo $sitesettings->logback_color;?>" placeholder="Enter Login Background Color"/>
                      <input type="hidden" name="old_logback_color" value="<?php echo $sitesettings->logback_color;?>"/>
                    </div>

                    <div class="form-group">
                      <label>Base Color</label>
                      <input type="text" class="form-control color" name="base_color" value="<?php echo $sitesettings->base_color;?>" placeholder="Enter Base Color"/>
                      <input type="hidden" name="old_base_color" value="<?php echo $sitesettings->base_color;?>"/>
                    </div>

                    <div class="form-group">
                      <label>Contrast Color</label>
                      <input type="text" class="form-control color" name="contrast_color" value="<?php echo $sitesettings->contrast_color;?>" placeholder="Enter Contrast Color"/>
                      <input type="hidden" name="old_contrast_color" value="<?php echo $sitesettings->contrast_color;?>"/>
                    </div>
                    
                    <div class="form-group">
                      <label>Facebook Link</label>
                      <input type="text" class="form-control" name="fb_link" value="<?php echo $sitesettings->fb_link;?>" placeholder="Enter Facebook Link"/>
                    </div>
                    
                    <div class="form-group">
                      <label>Twitter Link</label>
                      <input type="text" class="form-control" name="tw_link" placeholder="Enter Twitter Link" value="<?php echo $sitesettings->tw_link;?>"/>
                    </div>
                    
                    <div class="form-group">
                      <label>Google Plus</label>
                      <input type="text" name="gp_link" value="<?php echo $sitesettings->gp_link;?>" class="form-control" placeholder="Enter Google Plus Link"/>
                    </div>
                    
                    <div class="form-group">
                      <label>Linked Link</label>
                      <input type="text" class="form-control" name="li_link" placeholder="Enter Linked Link" value="<?php echo $sitesettings->li_link;?>" />
                    </div>
                    
                    <div class="form-group">
                      <label>Instagram Link</label>
                      <input type="text" class="form-control" name="ins_link" placeholder="Enter Instagram Link" value="<?php echo $sitesettings->ins_link;?>"/>
                    </div>
                    
                    <div class="form-group">
                      <label>Pinterest Link</label>
                      <input type="text" class="form-control" name="pin_link" placeholder="Enter Pinterest" value="<?php echo $sitesettings->pin_link;?>"/>
                    </div>

                    <div class="form-group">
                      <label>Admin Commission Percentage</label>
                      <div class="input-group">
                        <input type="text" name="commission" class="form-control" placeholder="Enter Admin commission Percentage" <?php if(!empty($sitesettings->commission)) { ?> value="<?php echo $sitesettings->commission;?>" <?php } ?> />
                        <div class="input-group-addon">%</div>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="radio">
                        <label>
                          <input type="radio" class="minimal" name="online_status" value="1" <?php if($sitesettings->online_status==1) {  ?> checked="true" <?php } ?>>
                          Site Online
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" class="minimal" name="online_status" value="0" <?php if($sitesettings->online_status==0) {  ?> checked="true" <?php } ?>>
                          Site Offline
                        </label>
                      </div>
                      
                      <!--<div class="form-group">-->
                      <input class="btn btn-primary" type="submit" value="Update"/>
                    <!--</div>-->
                    </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
        <script>
          $("document").ready(function(){
            $("#site_settings").validate({
              rules:{
                sitename:"required",
                fb_link:{ 
                  "required":true,
                  "url":true
                },
                tw_link:{
                  "required":true,
                  "url":true
                },
                gp_link:{
                  "required":true,
                  "url":true
                },
                li_link:{
                  "required":true,
                  "url":true
                },
                ins_link:{
                  "required":true,
                  "url":true
                },
                pin_link:{
                  "required":true,
                  "url":true
                },
                commission:{
                  "required":true,
                  "number":true
                },
                online_status:"required"
              },
              messages:{
                sitename:"Please Enter Site Name..!!",
                fb_link:{
                  "required":"Please Enter Facebook Link..!!",
                  "url":"Please Enter Valid Facebook Link..!!"
                },
                tw_link:{
                  "required":"Please Enter Twitter Link..!!",
                  "url":"Please Enter Valid Twitter Link..!!"
                },
                gp_link:{
                  "required":"Please Enter Google Plus Link..!!",
                  "url":"Please Enter Valid Google Plus Link..!!"
                },
                li_link:{
                  "required":"Please Enter Linked Link..!!",
                  "url":"Please Enter Valid Linked Link..!!"
                },
                ins_link:{
                  "required":"Please Enter Instagram Link..!!",
                  "url":"Please Enter Valid Instagram Link..!!"
                },
                pin_link:{
                  "required":"Please Enter Pinterest Link..!!",
                  "url":"Please Enter Valid Pinterest Link..!!"
                },
                commission:{
                  "required":"Please Enter Admin Commission Percentage..!!",
                  "number":"Commission Percentage will be a number..!!"
                },
                online_status:"Please Select Online Status..!!"
              }
            });
          });
        </script>
        <style>
          .error{
            color: #dd0000;
          }
        </style>

    
