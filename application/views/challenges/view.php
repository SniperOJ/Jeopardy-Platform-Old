<?php
    $this->load->language("challenges");
?>

<style type=text/css>  
*{
  margin: 0;
  padding: 0;
}
body{
  background-color: #333333;
}
li{
  float: left;
  list-style: none;
  margin-top: 50px;
  margin-left: 50px;
}
.challenge-item{
  padding: 5px;
  background-color: #666666;
  position: relative;
  width: 256px;
  height: 160px;
  font-size: 24px;
  color: #111;
  text-align: center;
  box-shadow: 0px 0px 2px rgba(0,0,0,0.5),0px -5px 20px rgba(0,0,0,0.1) inset;
}
.challenge-item:hover{
  background-color:cornflowerblue;
  transition: all 0.5s ease;
}
.challenge-item-web{
  background-color: #0080FF;
} 
.challenge-item-pwn{
  background-color: #FF2D2D;
}
.challenge-item-misc{
  background-color: #FFD306;
}
.challenge-item-crypto{
  background-color: #C07AB8;
}
.challenge-item-stego{
  background-color: #79FF79;
}
.challenge-item-forensics{
  background-color: #B15BFF;
}
.challenge-item-other{
  background-color: #F75000;
}
.challenge-item-solved{
  padding: 5px;
  background-color: #EEEEEE;
  position: relative;
  width: 256px;
  height: 160px;
  font-size: 24px;
  color: #111;
  text-align: center;
  box-shadow: 0px 0px 2px rgba(0,0,0,0.5),0px -5px 20px rgba(0,0,0,0.1) inset;
}
</style>  

<link rel="stylesheet" href="/assets/css/alert-dialog.css">

<div class="challenges">
  <ul>

    <?php foreach ($challenges_web as $challenge_item): ?>
      <?php 
        echo '<div class="click-to-alert-dialog">';

        if($challenge_item['is_solved']){
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-web challenge-item">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-web challenge-item-solved">';
        }
        echo '<h2>'.$challenge_item['name'].'</h2>';
        echo '分数 : '.$challenge_item['score'].'<br>';
        echo '点击量 : '.$challenge_item['visit_times'];
        echo '</li>';
        echo '</div>';
      ?>
    <?php endforeach; ?>

    <?php foreach ($challenges_pwn as $challenge_item): ?>
      <?php 
        echo '<div class="click-to-alert-dialog">';

        if($challenge_item['is_solved']){
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-pwn challenge-item">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-pwn challenge-item-solved">';
        }
        echo '<h2>'.$challenge_item['name'].'</h2>';
        echo '分数 : '.$challenge_item['score'].'<br>';
        echo '点击量 : '.$challenge_item['visit_times'];
        echo '</li>';
        echo '</div>';
      ?>
    <?php endforeach; ?>


    <?php foreach ($challenges_misc as $challenge_item): ?>
      <?php 
        echo '<div class="click-to-alert-dialog">';

        if($challenge_item['is_solved']){
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-misc challenge-item">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-misc challenge-item-solved">';
        }
        echo '<h2>'.$challenge_item['name'].'</h2>';
        echo '分数 : '.$challenge_item['score'].'<br>';
        echo '点击量 : '.$challenge_item['visit_times'];
        echo '</li>';
        echo '</div>';
      ?>
    <?php endforeach; ?>


    <?php foreach ($challenges_crypto as $challenge_item): ?>
      <?php 
        echo '<div class="click-to-alert-dialog">';

        if($challenge_item['is_solved']){
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-crypto challenge-item">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-crypto challenge-item-solved">';
        }
        echo '<h2>'.$challenge_item['name'].'</h2>';
        echo '分数 : '.$challenge_item['score'].'<br>';
        echo '点击量 : '.$challenge_item['visit_times'];
        echo '</li>';
        echo '</div>';
      ?>
    <?php endforeach; ?>


    <?php foreach ($challenges_forensics as $challenge_item): ?>
      <?php 
        echo '<div class="click-to-alert-dialog">';

        if($challenge_item['is_solved']){
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-forensics challenge-item">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-forensics challenge-item-solved">';
        }
        echo '<h2>'.$challenge_item['name'].'</h2>';
        echo '分数 : '.$challenge_item['score'].'<br>';
        echo '点击量 : '.$challenge_item['visit_times'];
        echo '</li>';
        echo '</div>';
      ?>
    <?php endforeach; ?>


    <?php foreach ($challenges_other as $challenge_item): ?>
      <?php 
        echo '<div class="click-to-alert-dialog">';

        if($challenge_item['is_solved']){
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-other challenge-item">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-other challenge-item-solved">';
        }
        echo '<h2>'.$challenge_item['name'].'</h2>';
        echo '分数 : '.$challenge_item['score'].'<br>';
        echo '点击量 : '.$challenge_item['visit_times'];
        echo '</li>';
        echo '</div>';
      ?>
    <?php endforeach; ?>

  </ul>
</div>

<a href="SniperOJ{This_IS-A_QIanDAOti}"><a>
<script src="/assets/js/alert-dialog.js"></script>
