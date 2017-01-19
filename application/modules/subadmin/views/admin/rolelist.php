
        <section class="content-header">
          <h1>
            Role List
            <small>Control Panel</small>
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
               
              
                <a  class="btn btn-primary" href="<?php echo site_url('admin/add-role');?>" >Add Role</a>
             
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Group Name</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($result))
                      {
                        $x = 0;
                       foreach($result as $key =>$row)
                       {
                          $x++;
                       ?>
                       
                     <tr>
                        <td><?=$x;?></td>
                        <td><?=$row->group_name;?></td>
                        <td>
  <a href="#myModal<?php echo $row->id ?>" data-toggle="modal" data-target="#myModal<?php echo $row->id ?>"><span><i class="fa fa-eye"></i></span></a>
<div class="modal fade" id="myModal<?php echo $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"> Group <?php echo $row->group_name;?></h4>
                              </div>
                              <div class="modal-body">

                                                            <p><?php echo $row->group_desc;?></p>

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
                                            $role=json_decode($row->group_role);

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

                            <a href="<?php echo site_url('admin/edit-role');?>/<?php echo urlencode(base64_encode($row->id));?>"><span><i class="fa fa-pencil"></i></span></a>&nbsp;
                            <a href="<?php echo base_url('subadmin/admin/deleteRole');?>/<?php echo urlencode(base64_encode($row->id));?>"><span><i class="fa fa-times"></i></span></a>&nbsp;

                         </td>
                      </tr>
                    

                        <?php
                       }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Group Name</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
        
  
     