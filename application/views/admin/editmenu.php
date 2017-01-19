
        <section class="content-header">
          <h1>
            Edit Admin Menu
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
                  <form role="form" action="<?php echo $this->config->item('base_url');?>admin/editmenu" method="post">
                    <!-- text input -->                    
                    <!--                     <div class="form-group">
                      <label>Menu Group</label>
                      <select class="form-control" name="m_group" id="m_group">
                        <?php if(!empty($menues)){
                           foreach ($menues as $menu) {
                            ?>
                            <option value="<?= $menu->name ?>"><?= $menu->name; ?></option>
                            <?php     
                           }
                        } ?>
                        
                      </select>
                    </div> -->

                    <div class="form-group">
                      <label>Menu Label</label>
                      <input type="text" class="form-control" name="m_name" value="<?= $menu->label ?>" placeholder=""/>
                    </div>
                    
                    <div class="form-group">
                      <label>Menu Url</label>
                      <input type="text" class="form-control" name="m_url" placeholder="" value="<?= $menu->url ?>"/>
                    </div>
                    
                    <div class="form-group">
                      <label>Menu Icon</label>
                      <input type="text" name="m_icon" value="<?= $menu->icon ?>" class="form-control" placeholder=""/>
                    </div>
                    
                    <div class="form-group">
                      <label>Active</label>
                      <input type="text" class="form-control" name="m_active" placeholder="" value="<?= $menu->active ?>" />
                    </div>
                      <input type="hidden" name="id" value="<?= $id ?>" />
                      <input type="hidden" name="m_status" value="<?= $menu->status ?>" />
                      
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
    
