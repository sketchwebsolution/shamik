
        <section class="content-header">
          <h1>
            Settings
            <small>Control Panel</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12 col-xs-12">
              <div class="box">
                <div class="box-header">
                  <!--<h3 class="box-title">CMS Pages List</h3>-->
              <!--     <input type="button" class="btn btn-primary" value="Add New Settings" onclick="window.location.href='<?php //echo site_url('admin/add-settings');?>'" />
 -->
                  <a class="btn btn-primary" data-toggle="modal" href='#addSettings'>Add New Settings</a>

                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>LABEL</th>
                        <th>KEY</th>
                        <th>Value</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($results))
                      {
                        $i=0;
                       foreach($results as $row)
                       {
                         $i++;
                       ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo strtoupper($row->slabel);?></td>

                          <td><?php echo $row->skey;?></td>
                          <td><?php echo $row->svalue;?></td>
                          <td>
                          <a href="javascript:void(0);" onclick="editDetails(this);" class="editsettings" data-slabel="<?php echo $row->slabel;?>" data-svalue="<?php echo $row->svalue;?>"  data-sid="<?php echo $row->id;?>">
                          <span><i class="fa fa-pencil"></i></span>
                          </a>
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
                        <th>KEY</th>
                        <th>Value</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
     



     
     <div class="modal fade" id="addSettings">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             <h4 class="modal-title">Create New Settings</h4>
           </div>
           <div class="modal-body">
                <form action="<?php echo site_url('admin/add-settings');?>" method="POST" role="form">
                  <div class="form-group">
                    <label for="">LABEL</label>
                    <input type="text" class="form-control" id="slabel" name="slabel" placeholder="Input field">
                  </div>                
                  <!-- <div class="form-group">
                    <label for="">KEY</label>
                    <input type="text" class="form-control" id="skey" name="skey" placeholder="Input field">
                  </div> -->
                  <div class="form-group">
                    <label for="">VALUE</label>
                    <input type="text" class="form-control" id="svalue" name="svalue" placeholder="Input field">
                  </div>                
                
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
             
           </div>
           
         </div>
       </div>
     </div>


     
     <div class="modal fade" id="editSettings">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             <h4 class="modal-title">Edit Settings</h4>
           </div>
           <div class="modal-body">
                <form action="<?php echo site_url('admin/edit-settings');?>" method="POST" role="form">
                  <div class="form-group">
                    <label for="">LABEL</label>
                    <input type="text" class="form-control" id="slabeledit" name="slabel" placeholder="Input field">
                  </div>                
                
                  <div class="form-group">
                    <label for="">VALUE</label>
                    <input type="text" class="form-control" id="svalueedit" name="svalue" placeholder="Input field">
                  </div>                
                <input type="hidden" name="sid" id="sidedit" value=""/>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
             
           </div>
           
         </div>
       </div>
     </div>

     <script type="text/javascript">
       
     $("document").on('click','a span i',function(){
       var id=$(this).data('sid');
       $("#sidedit").val(id);
       $("#slabeledit").val($(this).data('slabel'));
       $("#svalueedit").val($(this).data('svalue'));
       $("#editSettings").modal('show');
     });

     function editDetails(current)
     {

       var id=$(current).data('sid');
       $("#sidedit").val(id);
       $("#slabeledit").val($(current).data('slabel'));
       $("#svalueedit").val($(current).data('svalue'));
       $("#editSettings").modal('show');
     }
     </script>