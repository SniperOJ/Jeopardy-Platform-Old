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
.challenge-item:hover{
  background-color:cornflowerblue;
  transition: all 0.5s ease;
}
.challenge-item-web{
  
}
.challenge-item-pwn{
  
}
.challenge-item-misc{
  
}
.challenge-item-crypto{
  
}
.challenge-item-stego{
  
}
.challenge-item-forensics{
  
}
.challenge-item-other{
  
}
</style>  

<link rel="stylesheet" href="/assets/css/alert-dialog.css">

<div class="challenges">
  <h1>Web</h1>
  <ul>

    <?php foreach ($challenges_web as $challenge_item): ?>
      <?php 
        echo '<div class="click-to-alert-dialog challenge-item-web">';

        if($challenge_item['is_solved']){
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-solved">';
        }
        echo '名称 : '.$challenge_item['name'].'<br>';
        echo '分数 : '.$challenge_item['score'].'<br>';
        echo '点击量 : '.$challenge_item['visit_times'];
        echo '</li>';
        echo '</div>';
      ?>
    <?php endforeach; ?>

    <?php foreach ($challenges_pwn as $challenge_item): ?>
      <?php 
        echo '<div class="click-to-alert-dialog challenge-item-pwn">';

        if($challenge_item['is_solved']){
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-solved">';
        }
        echo '名称 : '.$challenge_item['name'].'<br>';
        echo '分数 : '.$challenge_item['score'].'<br>';
        echo '点击量 : '.$challenge_item['visit_times'];
        echo '</li>';
        echo '</div>';
      ?>
    <?php endforeach; ?>


    <?php foreach ($challenges_misc as $challenge_item): ?>
      <?php 
        echo '<div class="click-to-alert-dialog challenge-item-misc">';

        if($challenge_item['is_solved']){
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-solved">';
        }
        echo '名称 : '.$challenge_item['name'].'<br>';
        echo '分数 : '.$challenge_item['score'].'<br>';
        echo '点击量 : '.$challenge_item['visit_times'];
        echo '</li>';
        echo '</div>';
      ?>
    <?php endforeach; ?>


    <?php foreach ($challenges_crypto as $challenge_item): ?>
      <?php 
        echo '<div class="click-to-alert-dialog challenge-item-crypto">';

        if($challenge_item['is_solved']){
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-solved">';
        }
        echo '名称 : '.$challenge_item['name'].'<br>';
        echo '分数 : '.$challenge_item['score'].'<br>';
        echo '点击量 : '.$challenge_item['visit_times'];
        echo '</li>';
        echo '</div>';
      ?>
    <?php endforeach; ?>


    <?php foreach ($challenges_forensics as $challenge_item): ?>
      <?php 
        echo '<div class="click-to-alert-dialog challenge-item-forensics">';

        if($challenge_item['is_solved']){
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-solved">';
        }
        echo '名称 : '.$challenge_item['name'].'<br>';
        echo '分数 : '.$challenge_item['score'].'<br>';
        echo '点击量 : '.$challenge_item['visit_times'];
        echo '</li>';
        echo '</div>';
      ?>
    <?php endforeach; ?>


    <?php foreach ($challenges_other as $challenge_item): ?>
      <?php 
        echo '<div class="click-to-alert-dialog challenge-item-other">';

        if($challenge_item['is_solved']){
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="challenge-item-solved">';
        }
        echo '名称 : '.$challenge_item['name'].'<br>';
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
