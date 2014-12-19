<?php echo form_open("auth/deactivate/".$user->id);?>
  <?php echo form_hidden($csrf); ?>
  <?php echo form_hidden(array('id'=>$user->id)); ?>
	 <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo lang('deactivate_heading');?></h4>
      </div>
      <div class="modal-body">
      <h3><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></h3>
      <p>
	    <input type="hidden" name="confirm" value="yes" checked="checked" />
	  </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-warning">Ok</button>
      </div>
      <?php echo form_close();?>