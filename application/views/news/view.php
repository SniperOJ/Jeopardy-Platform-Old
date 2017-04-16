<?php
    $this->load->language("news");
?>

<h1><?php echo $this->lang->line('NEWS_NAME'); ?></h1>
<div class="news">
  <table class="table" style="font-size: 20px">
    <thead>
      <tr>
        <th><?php echo $this->lang->line('NEWS_ID'); ?></th>
        <th><?php echo $this->lang->line('NEWS_TITLE'); ?></th>
        <th><?php echo $this->lang->line('NEWS_CONTENT'); ?></th>
        <th><?php echo $this->lang->line('NEWS_AUTHOR'); ?></th>
        <th><?php echo $this->lang->line('NEWS_SUBMIT_TIME'); ?></th>
        <th><?php echo $this->lang->line('NEWS_VISIT_TIMES'); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      	for ($i=0; $i < count($news); $i++) { 
			echo "<tr>";
			echo '<td>'.$news[$i]['newsID'].'</td>';
			echo '<td>'.$news[$i]['title'].'</td>';
			echo '<td>'.$news[$i]['content'].'</td>';
			echo '<td>'.$news[$i]['authorID'].'</td>';
			echo '<td>'.date('Y-m-d H:i:s', $news[$i]['submit_time']).'</td>';
			echo '<td>'.$news[$i]['visit_times'].'</td>';
			echo "</tr>";
      	}
      ?>
    </tbody>
  </table>
</div>