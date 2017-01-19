<section class="content-header">
    <h1>
        Role Management
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

<form role="form" action="<?php if(empty($result)){echo site_url('admin/add-role');}else{echo site_url('admin/edit-role')."/".urlencode(base64_encode($result->id));}?>" method="post" name="role">

             <div class="form-group">
                      <label>Group Name</label>
                      <input type="text" name="group" class="form-control" value="<?php if(!empty($result)){ echo $result->group_name;}?>">
          			
                    </div>

                   
                    <div class="form-group">
                      <label>Roles</label>
                      <?php
                      foreach($role as $rl)
          				    {

          			    ?>
                <div class="row">
                  <div class="col-md-6">
                    <input type="hidden" name="role[<?php echo $rl->alias ?>]" value="<?php echo $rl->alias ?>" class="role_parent" ><?php echo $rl->name ?>
                  </div> 
                  <div class="col-md-6">

                         <input type="checkbox"  value="all"  class="chkbox chkbox_all" id="chkbox_all_<?php echo $rl->alias ?>">All


                        <input type="checkbox" name="role[<?php echo $rl->alias ?>][A]" value="add" id="chkbox_add_<?php echo $rl->alias ?>" class="chkbox chkbox_one"  

                     <?php $count=0; if(!empty($result))
                         {   
                            $roletype=(array)json_decode($result->group_role);
                         
                            if (array_key_exists($rl->alias,$roletype))
                            {
                                
                               $arr= (array)$roletype[$rl->alias];
                               if(array_key_exists("A", $arr))
                               {
                                  echo "checked='checked'";
                                  $count++;

                               }
                            }
                         }
                         

                         ?>

                        >ADD
                        <input type="checkbox" name="role[<?php echo $rl->alias ?>][E]" value="edit" id="chkbox_edit_<?php echo $rl->alias ?>"  class="chkbox chkbox_one"

                    <?php if(!empty($result))
                         {   
                            $roletype=(array)json_decode($result->group_role);
                         
                            if (array_key_exists($rl->alias,$roletype))
                            {
                                
                               $arr= (array)$roletype[$rl->alias];
                               if(array_key_exists("E", $arr))
                               {
                                  echo "checked='checked'";
                                  $count++;


                               }
                            }
                         }
                         

                         ?>

                        >Edit
                        <input type="checkbox" name="role[<?php echo $rl->alias ?>][D]" value="delete" id="chkbox_delete_<?php echo $rl->alias ?>"  class="chkbox chkbox_one" 

                      <?php if(!empty($result))
                         {   
                            $roletype=(array)json_decode($result->group_role);
                         
                            if (array_key_exists($rl->alias,$roletype))
                            {
                                
                               $arr= (array)$roletype[$rl->alias];
                               if(array_key_exists("D", $arr))
                               {
                                  echo "checked='checked'";
                                  $count++;

                               }
                            }
                         }
                         

                         ?>

                        >Delete
                        <input type="checkbox" name="role[<?php echo $rl->alias ?>][V]" value="view" id="chkbox_view_<?php echo $rl->alias ?>" class="chkbox chkbox_one" 

                     <?php if(!empty($result))
                         {   
                            $roletype=(array)json_decode($result->group_role);
                         
                            if (array_key_exists($rl->alias,$roletype))
                            {
                                
                               $arr= (array)$roletype[$rl->alias];
                               if(array_key_exists("V", $arr))
                               {
                                  echo "checked='checked'";
                                  $count++;

                               }
                            }
                         }


                         ?>

                        >View
                        <input type="checkbox" name="role[<?php echo $rl->alias ?>][S]" value="status" id="chkbox_status_<?php echo $rl->alias ?>"  class="chkbox chkbox_one" 



                      <?php if(!empty($result))
                         {   
                            $roletype=(array)json_decode($result->group_role);
                         
                            if (array_key_exists($rl->alias,$roletype))
                            {
                                
                               $arr= (array)$roletype[$rl->alias];
                               if(array_key_exists("S", $arr))
                               {
                                  echo "checked='checked'";
                                  $count++;

                               }
                            }
                         }
                         

                         ?>

                        >Status
                  </div>

                  <?php if($count==5){ $ids="chkbox_all_".$rl->alias; ?> 

                    <script>

                      $(function(){

                        var ids='<?php echo $ids;?>';
                        $("#"+ids).prop("checked",true);

                      });
                    </script>
                  <?php } ?>
                </div>
                <?php
          				}
          			?>




                    </div>

                    <div class="form-group">
                    	<label>Group Description</label>
                      	<input type="text" name="desc" class="form-control" value="<?php if(!empty($result)){ echo $result->group_desc;}?>">
                    </div>

                    <div class="form-group">
                      <input class="btn btn-primary" type="submit" name="submit" value="Save"/>
                      <a class="btn btn-primary" href="<?php echo site_url('admin/role');?>">Back</a>

                    </div>
                    </form>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
    
        
<script type="text/javascript">
$(".role_parent").change(function(){
     var ele = $(this).parent().next().find('input[type="checkbox"]')
     if($(this).is(':checked'))
     {
        ele.attr("disabled",false);
     }
     else
     {
      ele.removeAttr("checked");
      ele.attr("disabled",true);
     }
 });


$(".chkbox_all").on('click',function(){

     if($(this).prop("checked")==true)
      {
           $(this).parent().find('input[type="checkbox"]').prop("checked",true);
      }
    else
      {
           $(this).parent().find('input[type="checkbox"]').prop("checked",false);
      }
  });

  $(".chkbox_one").on('click',function(){
    var checkboxcount=$(".chkbox_one").length;
    var allcount=$(".chkbox_one:checked").length;

     if(checkboxcount==allcount)
      {
           $(this).parent().find('input[type="checkbox"]').prop("checked",true);
      }
    else
      {
           $(this).parent().find('input[type="checkbox"]:eq(0)').prop("checked",false);
      }

  });
</script>

<style>
.chkbox{width: 10%;}
.role_parent,.role_parent_all{margin-right:15px !important;}
</style>



