<?$this->load->view('header');?>
<div class="container cont">
  <div class="row clearfix">
    <div class="col-md-12 column">
      <h1><?=lang('edit_group_heading');?></h1>
		<p><?=lang('edit_group_subheading');?></p>

		<div id="infoMessage"><?=$message;?></div>

		<?=form_open(current_url());?>

      <p>
            <?php echo lang('edit_group_name_label', 'group_name');
            $group_name['class'] ='form-control';?>
            <?php echo form_input($group_name);?>
      </p>

      <p>
            <?php echo lang('edit_group_desc_label', 'description');
            $group_description['class'] ='form-control';?>
            <?php echo form_textarea($group_description);?>
      </p>
	<input class="btn btn-success"type="submit" value="<?=lang('edit_group_submit_btn')?>">

<?=form_close();?>
    </div>
  </div>
</div>
<?$this->load->view('footer');?>