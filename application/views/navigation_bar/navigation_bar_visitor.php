<?php
    $this->load->language("navigation_bar");
?>

<nav class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Sniper OJ</a>
		</div>
		<div class="pull-right">
			<ul class="nav navbar-nav">
				<li><a href='/'>&nbsp;&nbsp;<?php echo $this->lang->line('HOME_LABEL'); ?></a></li>
				<li><a href='/news/view'><?php echo $this->lang->line('NEWS_LABEL'); ?></a></li>
				<li><a href='/user/login'><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;<?php echo $this->lang->line('LOGIN_LABEL'); ?></a></li>
				<li><a href='/user/register'><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;<?php echo $this->lang->line('REGISTERLABEL'); ?></a></li>
			</ul>
		</div>
	</div>
</nav>

