<?$this->load->view('header');?>
<script>
$(document).ready(function(){
	$('a.des').click(function(){
		$.ajax({
	    url : "<?=base_url()?>/auth/deactivate/"+$(this).attr("id"),
	    type: "get",
	    success: function(data, textStatus, jqXHR)
		    {
		    	$('.modal-content').html(data);
		    },
		    error: function (jqXHR, textStatus, errorThrown)
		    {
		 
		    }
		});

	});
});
</script>
<div class="row clearfix">
<div class="col-md-12 column">
<h1><?php echo lang('index_heading');?></h1>
<div class="btn-group">
<a href="<?=base_url()?>auth/create_user" class="btn btn-default">Craear usuario</a><a class="btn btn-default" href="<?=base_url()?>auth/create_group">Crear grupo</a>
</div>
<p><?php echo lang('index_subheading');?></p>
<div id="infoMessage"><?php echo $message;?></div>
<table cellpadding=0 cellspacing=10 class="table table-striped">
	<tr>
		<th><?php echo lang('index_fname_th');?></th>
		<th><?php echo lang('index_lname_th');?></th>
		<th><?php echo lang('index_email_th');?></th>
		<th><?php echo lang('index_groups_th');?></th>
		<th><?php echo lang('index_action_th');?></th>
	</tr>
	<?php foreach ($users as $user):?>
		<tr>
			<td><?php echo $user->first_name;?></td>
			<td><?php echo $user->last_name;?></td>
			<td><?php echo $user->email;?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo anchor("auth/edit_group/".$group->id, $group->name) ;?><br />
                <?php endforeach?>
			</td>
			<td>
			<div class="btn-group">
			<?=($user->active) ? anchor("auth/#",'<span class="glyphicon glyphicon-off" ></span>',array('class'=>'btn btn-primary des on','id'=>$user->id,"data-toggle"=>"modal","data-target"=>"#myModal")) : anchor("auth/activate/". $user->id,'<span class="glyphicon glyphicon-off" ></span>',array('class'=>'btn btn-default off'));?>
			<?=anchor("auth/edit_user/".$user->id,'<span class="glyphicon glyphicon-pencil" ></span>',array('class'=>'btn btn-primary')) ;?>
			</div>
			</td>
		</tr>
	<?php endforeach;?>
</table>
</div>
</div>
<?$this->load->view('footer');?>