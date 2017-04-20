<?php
    $this->load->language("profile");
    $this->load->language("submit_log");
?>


<?php
  function formatTime($time){       
      $rtime = date("Y年m月d日 H:i",$time);       
      $htime = date("H:i",$time);             
      $time = time() - $time;         
      if ($time < 60){           
          $str = '刚刚';       
      }elseif($time < 60 * 60){           
          $min = floor($time/60);           
          $str = $min.'分钟前';       
      }elseif($time < 60 * 60 * 24){           
          $h = floor($time/(60*60));           
          $str = $h.'小时前 ';       
      }elseif($time < 60 * 60 * 24 * 3){           
          $d = floor($time/(60*60*24));           
          if($d==1){  
              $str = '昨天 '.$htime;
          }else{  
              $str = '前天 '.$htime;       
          }  
      }else{           
          $str = $rtime;       
      }       
      return $str;   
  } 
?>

<link href="../../assets/css/style.css" rel='stylesheet' type='text/css' />
<div class="banner-info">
	<div class="col-md-7 header-right" style="color:#111;text-align:initial;padding-left: 400px;">
		<h1><?php echo $this->lang->line('PROFILE_NAME'); ?></h1>
		<ul class="address">
		
		<li>
				<ul class="address-text">
					<li><b><?php echo $this->lang->line('USERNAME'); ?></b></li>
					<li><?php echo $user_data['username']; ?></li>
				</ul>
			</li>
			<li>
				<ul class="address-text">
					<li><b><?php echo $this->lang->line('EMAIL'); ?></b></li>
					<li><a href="<?php echo $user_data['email']; ?>"><?php echo $user_data['email']; ?></a></li>
				</ul>
			</li>
			<li>
				<ul class="address-text">
					<li><b><?php echo $this->lang->line('COLLEGE'); ?></b></li>
					<li><?php echo $user_data['college']; ?></li>
				</ul>
			</li>
			<li>
				<ul class="address-text">
					<li><b><?php echo $this->lang->line('REGISTER_TIME'); ?></b></li>
					<li><?php echo $user_data['registe_time']; ?></li>
				</ul>
			</li>
			<li>
				<ul class="address-text">
					<li><b><?php echo $this->lang->line('REGISTER_IP'); ?></b></li>
					<li><?php echo $user_data['registe_ip']; ?></li>
				</ul>
			</li>
			<li>
				<ul class="address-text">
					<li><b><?php echo $this->lang->line('SCORE'); ?></b></li>
					<li><?php echo $user_data['score']; ?></li>
				</ul>
			</li>
			<li>
			</li>
		</ul>
	</div>
	<div class="col-md-5 header-left">
		<img src="../../assets/images/avatar.png" alt="" style="width: 240px;
  height:240px;
  border-radius:120px">
	</div>
</div>

<table class="table table-hover" style="margin-bottom: 50px;">
  <caption><h3><?php echo $this->lang->line('SUBMIT_LOG_NAME'); ?></h3></caption>
  <thead>
    <tr>
      <th><?php echo $this->lang->line('SUBMIT_ID'); ?></th>
      <th><?php echo $this->lang->line('CHALLENGE_NAME'); ?></th>
      <th><?php echo $this->lang->line('FLAG'); ?></th>
      <th><?php echo $this->lang->line('SUBMIT_TIME'); ?></th>
      <th><?php echo $this->lang->line('CURRENT'); ?></th>
    </tr>
  </thead>
  <tbody>
	  <?php 
		  for ($i=0; $i < count($submit_log); $i++) { 
			echo "<tr>";
			echo "<td>".(count($submit_log) - ($i))."</td>";
			echo "<td>".$submit_log[$i]['challengeName']."</td>";
			echo "<td>".$submit_log[$i]['flag']."</td>";
            echo '<td class="hint--right" aria-label="';
            echo date('Y-m-d H:i:s', $submit_log[$i]['submit_time']);
            echo '">';
            echo formatTime($submit_log[$i]['submit_time']);
            echo '</td>';
			if ($submit_log[$i]['is_current'] == 1){
				echo "<td>√</td>";
			}else{
				echo "<td>×</td>";
			}
			echo "</tr>";
		  }
	  ?>
  </tbody>
</table>