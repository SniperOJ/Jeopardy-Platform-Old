<?php
    $this->load->language("score");
?>

<script src="/assets/js/polling.js"></script>


<h1><?php echo $this->lang->line('SCORE_NAME'); ?></h1>
<table class="table table-hover" style="margin-bottom: 50px;">
  <thead>
    <tr>
      <th><?php echo $this->lang->line('RANK'); ?></th>
      <th><?php echo $this->lang->line('USERNAME'); ?></th>
      <th><?php echo $this->lang->line('COLLEGE'); ?></th>
      <th>Submition</th>
      <th>Pass Rate</th>
      <th><?php echo $this->lang->line('SCORE'); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php $rank = 0;?>
    <?php foreach ($scores as $score): ?>
      <?php $rank += 1;?>
      <?php
        echo '<tr>';
        echo '<td>'.$rank.'</td>';
        echo '<td>'.$score['username'].'</td>';
        echo '<td>'.$score['college'].'</td>';
        echo '<td>'.$score['accept_times'].' / '.$score['submit_times'].'</td>';
        echo '<td>'.$score['pass_rate'].'%'.'</td>';
        echo '<td>'.$score['score'].'</td>';
        echo '</tr>'."\n";
      ?>
    <?php endforeach; ?>
  </tbody>
</table>