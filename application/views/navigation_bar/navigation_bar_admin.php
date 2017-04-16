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
	        	<li><a href='/news/view'><?php echo $this->lang->line('NEWS_LABEL'); ?></a></li>
	        	<li><a href='/news/create'><?php echo $this->lang->line('CREATE_NEWS_LABEL'); ?></a></li>
	        	<li><a href='/challenges/view'><?php echo $this->lang->line('CHALLENGES_LABEL'); ?></a></li>
	        	<li><a href='/challenges/create'><?php echo $this->lang->line('CREATE_CHALLENGES_LABEL'); ?></a></li>
	        	<li><a href='/challenges/submitlog'><?php echo $this->lang->line('SUBMITLOG_LABEL'); ?></a></li>
	        	<li><a href='/user/loginlog'><?php echo $this->lang->line('LOGIN_LOG_LABEL'); ?></a></li>
	        	<li><a href='/user/score'><?php echo $this->lang->line('SCORE_LABEL'); ?></a></li>
	        	<li><a href='/writeup'><?php echo $this->lang->line('WRITEUP_LABEL'); ?></a></li>
	        	<li><a href='/wiki'><?php echo $this->lang->line('WIKI_LABEL'); ?></a></li>
	        	<li><a href='/user/profile'><?php echo $this->lang->line('PROFILE_LABEL'); ?></a></li>
	        	<li><a href='/user/logout'><?php echo $this->lang->line('LOGOUT_LABEL'); ?></a></li>
	        </ul>
	    </div>
    </div>
</nav>