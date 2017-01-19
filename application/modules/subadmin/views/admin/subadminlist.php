
        <section class="content-header">
          <h1>
            Moderator List
            <small>Control Panel</small>
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header">
               
                <a class="btn btn-primary" href="<?php echo site_url('admin/add-moderator');?>" >Add Moderator</a>
               
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($subadmins))
                      {
                        $x = 0;
                       foreach($subadmins as $key => $subadmin)
                       {
 
                       ?>
                        <tr>
                          <td><?php echo ++$x ; ?></td>
                          <td><?php echo $subadmin->fname." ".$subadmin->lname; ?></td>
                          <td><?php echo $subadmin->username;?></td>
                          <td><?php echo $subadmin->email;?></td>
                          
                          <td>
                            <?php
                            if($subadmin->status==1)
                            {
                            ?>
                            <a href="javascript:void(0);" onclick="window.location.href='<?php echo base_url('subadmin/admin/subadminstatus');?>/<?php echo urlencode(base64_encode($subadmin->id));?>'"><span style="color: #00bc00;"><i class="fa fa-unlock"></i></span></a>
                            <?php
                            }
                            if($subadmin->status==0)
                            {
                            ?>
                            <a href="javascript:void(0);" onclick="window.location.href='<?php echo base_url('subadmin/admin/subadminstatus');?>/<?php echo urlencode(base64_encode($subadmin->id));?>'"><span style="color: #c90000;"><i class="fa fa-lock"></i></span></a>
                            <?php
                            }
                            ?>
                          </td>
                          
                          <td>


                           <a href="#myModal<?php echo $subadmin->id ?>" data-toggle="modal" data-target="#myModal<?php echo $subadmin->id ?>"><span><i class="fa fa-eye"></i></span></a>
<div class="modal fade" id="myModal<?php echo $subadmin->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Group <?php echo $subadmin->group_name;?></h4>
                              </div>
                              <div class="modal-body">


                                <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th width="10%">Module Name</th>
                                      <th width="20%">Add</th>
                                      <th width="20%">Edit</th>
                                      <th width="20%">Delete</th>
                                      <th width="20%">View</th>
                                      <th width="30%">Status</th>

                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                     
                                      <?php 
                                            $role=json_decode($subadmin->group_role);

                                            if(!empty($role))
                                            {
                                              foreach($role as $key=>$val)
                                              {
                                                $f=array();

                                                 if(is_object($val))
                                                {
                                                  
                                                  foreach($val as $k=>$value)
                                                  {
                                                    
                                                    $f[]=$k;
                                                  }
                                                  
                                                 
                                                }

                                                ?>
                                                 <tr>
                                             <td>  <?php  echo strtoupper(str_replace("-"," ",$key)); ?></td>

                                              <td><?php if(in_array("A",$f)){ ?>  <span><i class="fa fa-check"></i></span>  <?php } else { ?> <span><i class="fa fa-times"></i></span> <?php } ?> </td>
                                              <td><?php if(in_array("E",$f)){ ?>  <span><i class="fa fa-check"></i></span>  <?php } else { ?> <span><i class="fa fa-times"></i></span> <?php } ?> </td>
                                              <td><?php if(in_array("D",$f)){ ?>  <span><i class="fa fa-check"></i></span>  <?php } else { ?> <span><i class="fa fa-times"></i></span> <?php } ?> </td>
                                              <td><?php if(in_array("V",$f)){ ?>  <span><i class="fa fa-check"></i></span>  <?php } else { ?><span><i class="fa fa-times"></i></span> <?php } ?> </td>
                                              <td><?php if(in_array("S",$f)){ ?>  <span><i class="fa fa-check"></i></span>  <?php } else { ?> <span><i class="fa fa-times"></i></span> <?php } ?> </td>
 
                                               </tr> 
                                               <?php
                                               
                                               
                                              }
                                            }
                                          ?>

                                        
                                      
                                  </tbody>
                              </table>

                            </div>
                          </div>
                        </div>
                        </div>


                         
                            <a href="<?php echo site_url('admin/edit-moderator');?>/<?php echo urlencode(base64_encode($subadmin->id));?>"><span><i class="fa fa-pencil"></i></span></a>&nbsp;
                            
                            <a href="<?php echo base_url('subadmin/admin/deleteSubadmin');?>/<?php echo urlencode(base64_encode($subadmin->id));?>"><span><i class="fa fa-times"></i></span></a>&nbsp;
                           </td>
                           </tr>

                           <?php } } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
        
  
     