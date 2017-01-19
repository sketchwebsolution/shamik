
        <section class="content-header">
          <h1>
            Menu List
            <small>Control Panel</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header">
                  <!--<h3 class="box-title">User List</h3>-->
                <input type="button" class="btn btn-primary" value="Add Menu" onclick="window.location.href='<?php echo site_url('admin/add-menu');?>'" />
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Icon</th>
                        <th>URL</th>
                        <th>Active url</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($menues))
                      {
                        $x = 0;
                       foreach($menues as $key => $menu)
                       {
 
                       ?>
                        <tr>
                          <td><?php echo ++$x ; ?></td>
                          <td><?php echo stripslashes($menu->label) ; ?></td>
                          <td><?php echo stripslashes($menu->icon);?></td>
                          <td><?php echo stripslashes($menu->url);?></td>
                          <td><?php echo stripslashes($menu->active); ?></td>
                          <td>
                            <?php
                            if($menu->status==1)
                            {
                            ?>
                            <a href="javascript:void(0);" onclick="window.location.href='<?php echo $this->config->item('base_url');?>admin/menustatus/<?php echo urlencode(base64_encode($key));?>'"><span style="color: #00bc00;"><i class="fa fa-unlock"></i></span></a>
                            <?php
                            }
                            if($menu->status==0)
                            {
                            ?>
                            <a href="javascript:void(0);" onclick="window.location.href='<?php echo $this->config->item('base_url');?>admin/menustatus/<?php echo urlencode(base64_encode($key));?>'"><span style="color: #c90000;"><i class="fa fa-lock"></i></span></a>
                            <?php
                            }
                            ?>
                          </td>
                          <td><a href="<?php echo site_url('admin/edit-menu');?>/<?php echo urlencode(base64_encode($key));?>"><span><i class="fa fa-pencil"></i></span></a>
                          <!--&nbsp;<a href="<?php //echo site_url('admin/delete-menu');?>/<?php //echo urlencode(base64_encode($key));?>"><span><i class="fa fa-times"></i></span></a></td>-->
                        </tr>
                        <?php
                       }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Icon</th>
                        <th>URL</th>
                        <th>Active url</th>
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
     
