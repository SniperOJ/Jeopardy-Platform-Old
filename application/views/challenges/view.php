<?php
    $this->load->language("challenges");
?>


<?php
  function formatTime($time){       
      $rtime = date("m-d H:i",$time);       
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

<?php
  $all_challenges_number = 0;
  $all_challenges_number += $web_challenges_number;
  $all_challenges_number += $pwn_challenges_number;
  $all_challenges_number += $misc_challenges_number;
  $all_challenges_number += $forensics_challenges_number;
  $all_challenges_number += $stego_challenges_number;
  $all_challenges_number += $crypto_challenges_number;
  $all_challenges_number += $other_challenges_number;

?>

<h1><?php echo $this->lang->line('CHALLENGES'); ?></h1>

<style type=text/css>  
*{
  margin: 0;
  padding: 0;
}
body{
  background-color: lightsalmon;
}
li{
  float: left;
  list-style: none;
  margin-top: 50px;
  margin-left: 50px;
}
.challenge-item{
  padding: 5px;
  background-color: #EEEEEE;
  position: relative;
  width: 256px;
  height: 96px;
  font-size: 32px;
  color: #111;
  text-align: center;
  box-shadow: 0px 0px 2px rgba(0,0,0,0.5),0px -5px 20px rgba(0,0,0,0.1) inset;
}
.challenge-item:hover{
  background-color:cornflowerblue;
  transition: all 0.5s ease;
}

</style>  

<link rel="stylesheet" href="/assets/css/alert-dialog.css">

<!-- <div id="alert-dialog">
  <div id="alert-dialog-title">
    Title
  </div>
  <div id="alert-dialog-content">
    Content
  </div>
</div>
 -->
<div class="challenges">

  <ul>
    <?php foreach ($challenges as $challenge_item): ?>
      <div class="click-to-alert-dialog">

      <li id="challenge-<?php echo $challenge_item['challengeID']; ?>" class="challenge-item">
        

          <?php echo $challenge_item['name']; ?><br>
          <?php echo $challenge_item['score']; ?>

          <!-- <?php echo $challenge_item['description']; ?> -->
<!--           <?php echo $challenge_item['type']; ?>
          <?php
            echo '<td class="hint--right" aria-label="';
            echo date('Y-m-d H:i:s', $challenge_item['online_time']);
            echo '">';
            echo formatTime($challenge_item['online_time']);
            echo '</td>';
          ?>
          <?php echo $challenge_item['solved_times']." / ".$challenge_item['submit_times']; ?>
          <?php
            echo '<td>';
            if (strlen($challenge_item['resource']) == 0){
              echo "无";
            }else{
              echo '<a target="_blank" href="';
              echo $challenge_item['resource']; 
              echo '">';
              if (substr($challenge_item['resource'], -1) === "/"){
                echo "链接";
              }else{
                echo "下载";
              }
              echo '</a>';
            }
            echo '</td>';
          ?>

          <?php 
            if ($challenge_item['document'] === ""){
              echo '<td>无</td>';
            }else{
              echo '<td><a target="_blank" href="';
              echo $challenge_item['document']; 
              echo '">参考资料</a></td>';
            }
          ?>

          <?php
            if ($challenge_item['is_solved'] === 0){
              echo '<form action="/challenges/submit" method="POST">';
              echo '<input type="text" name="flag">';
              echo '<input type="hidden" name="challengeID" value="';
              echo html_escape($challenge_item['challengeID']);
              echo '">';
              echo '<input class="btn btn-default" type="submit">';
              echo '</form>';
            }else{
              echo "Solved";
            }
          ?> -->

      </li>
        </div>

    <?php endforeach; ?>


  </ul>


</div>

<a href="SniperOJ{This_IS-A_QIanDAOti}"><a>
<script src="/assets/js/alert-dialog.js"></script>