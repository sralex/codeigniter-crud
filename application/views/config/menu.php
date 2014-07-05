<?
$res = $this->controllerlist->getControllers();
?>
	<div class="row clearfix">
		<div class="col-md-12 column">
			<nav class="navbar navbar-default navbar-static-top" role="navigation">
				<div class="navbar-header">
					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="<?=base_url()?>">Crud Fork</a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<?if($res != null):?>
						<?foreach($res as $row => $value):?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$row?><strong class="caret"></strong></a>
							<ul class="dropdown-menu">
							<?foreach($value as $val):?>
								<li>
									<a href="<?=base_url().'index.php/'.$row.'/'.$val?>"><?=$val?></a>
								</li>
							<?endforeach;?>
							</ul>
						</li>
						<?endforeach;?>
						<?endif;?>
					</ul>
					
				</div>
				
			</nav>
		</div>
	</div>