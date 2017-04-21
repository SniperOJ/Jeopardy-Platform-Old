<?php
    $this->load->language("navigation_bar");
?>

<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
	    <div class="navbar-header">
	        <a class="navbar-brand" href="#">Sniper OJ</a>
		    <img src="../../assets/images/icon.png" alt="" style="width: 48px;
		      height:48px;
		      border-radius:24px;padding: 5px;">
	    </div>
	    <div class="pull-right">
	        <ul class="nav navbar-nav">
	        <li><a href='/news/view'><?php echo $this->lang->line('NEWS_LABEL'); ?></a></li>
	        <li><a href='/challenges/view'><?php echo $this->lang->line('CHALLENGES_LABEL'); ?></a></li>
	        <li><a href='/user/score'><?php echo $this->lang->line('SCORE_LABEL'); ?></a></li>
	        <li><a href='/user/profile'><?php echo $this->lang->line('PROFILE_LABEL'); ?></a></li>
	        <li><a href='/user/logout'><?php echo $this->lang->line('LOGOUT_LABEL'); ?></a></li>
	        </ul>
	    </div>
    </div>
</nav>


