<div class="news">
  <table class="table" style="font-size: 20px">
    <thead>
      <tr>
        <th>NewsID</th>
        <th>Title</th>
        <th>Content</th>
        <th>AuthorID</th>
        <th>Submit Time</th>
        <th>Visit Times</th>
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
	      		echo '<td>'.$news[$i]['submit_time'].'</td>';
	      		echo '<td>'.$news[$i]['visit_times'].'</td>';
      		echo "</tr>";

      	}
      ?>
    </tbody>
  </table>
</div>