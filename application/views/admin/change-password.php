 <section class="content-header">
          <h1>
            Change Password
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

<?php echo form_open('admin/changePassword',array("id"=>"changepwd","name"=>"changepwd"));?>


             <div class="form-group">
                      <label>Old Password</label>



 <?php 

             $data = array('name'=> 'oldpassword','id' => 'passold','placeholder'=> 'Old Password','class'=> 'form-control');
          
            echo  form_password($data);
          
          ?>
          
                    </div>

                   
                    <div class="form-group">
                      <label>Password</label>



 <?php 
         
             $data1 = array('name'=> 'password','id' => 'pass','placeholder'=> 'New Password','class'=> 'form-control');
          
            echo  form_password($data1);
          
          ?>
          
                    </div>
                    
                    <div class="form-group">
                      <label>Confirm Password</label>
                   
                   <?php 

             $data2 = array('name'=> 'passconf','id' => 'con_pass','placeholder'=> 'Confirm Password','class'=> 'form-control');
          
            echo  form_password($data2);
          
          ?>
          
                   
                    </div>
                    
                    <div class="form-group">
                      
<input type="hidden" name="id" value="<?php if(count($details)>0){echo $details[0]->id;}?>" />
<input type="hidden" name="oldpass_actual" value="<?php if(count($details)>0){echo $details[0]->password;}?>" />
                      <?php   
       

                    $data = array('name'=> 'Submit','id' => 'Submit','value'=> 'Update','class'=> 'btn btn-primary');
                    
                    echo form_submit($data);
                  ?>
                  
                    <!--</div>-->
                    </div>
                 <?php echo form_close();?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
    
        <script>
          $("document").ready(function(){
            $("#changepwd").validate({
              rules:{
                oldpassword:"required",
                password:"required",
                passconf:{
                  "required":true,
                  "equalTo":"#pass"
                }
              },
              messages:{
                oldpassword:"Please Enter Old Password..!!",
                password:"Please Enter Password..!!",
                passconf:{
                  "required":"Please Enter Confirm Password..!!",
                  "equalTo":"Pasword and Confirm password must be same..!!"
                }
              }
            });
          });
        </script>
        <style>
          .error{
            color: #dd0000;
          }
        </style>





