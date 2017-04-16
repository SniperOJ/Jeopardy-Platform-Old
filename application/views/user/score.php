<?php
    $this->load->language("score");
?>


<h1><?php echo $this->lang->line('SCORE_NAME'); ?></h1>
<table class="table table-hover">
  <thead>
    <tr>
      <th><?php echo $this->lang->line('RANK'); ?></th>
      <th><?php echo $this->lang->line('USERNAME'); ?></th>
      <th><?php echo $this->lang->line('COLLEGE'); ?></th>
      <th><?php echo $this->lang->line('SCORE'); ?></th>
    </tr>
  </thead>
  <tbody>
	  <?php 
		  for ($i=0; $i < count($scores); $i++) { 
			echo "<tr>";
			echo "<td>".($i+1)."</td>";
			foreach ($scores[$i] as $key => $value) {
				echo "<td>$value</td>";
			}
			echo "</tr>";
		  }
	  ?>
  </tbody>
</table>