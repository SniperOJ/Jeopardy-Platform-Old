<?php
    $this->load->language("challenges");
?>

<script src="/assets/js/isotope.pkgd.min.js"></script>

<style type=text/css>  
*{
  transition: all 1s ease;
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
  margin:10px;
  padding: 5px;
  background-color: #666666;
  position: relative;
  width: 256px;
  height: 160px;
  font-size: 24px;
  color: #000;
  text-align: center;
  box-shadow: 0px 0px 2px rgba(0,0,0,0.5),0px -5px 20px rgba(0,0,0,0.1) inset;
}
.challenge-item-web{
  padding: 10px;
  border-radius: 20px;
  font-size: 20px;
  background-color: #0080FF;
} 
.challenge-item-pwn{
  padding: 10px;
  border-radius: 20px;
  font-size: 20px;
  background-color: #FF2D2D;
}
.challenge-item-misc{
  padding: 10px;
  border-radius: 20px;
  font-size: 20px;
  background-color: #FFD306;
}
.challenge-item-crypto{
  padding: 10px;
  border-radius: 20px;
  font-size: 20px;
  background-color: #C07AB8;
}
.challenge-item-stego{
  padding: 10px;
  border-radius: 20px;
  font-size: 20px;
  background-color: #79FF79;
}
.challenge-item-forensics{
  padding: 10px;
  border-radius: 20px;
  font-size: 20px;
  background-color: #B15BFF;
}
.challenge-item-other{
  padding: 10px;
  border-radius: 20px;
  font-size: 20px;
  background-color: #F75000;
}
.challenge-item-solved{
  padding: 10px;
  border-radius: 20px;
  font-size: 20px;
  background-color: #EEEEEE;
  opacity:0.1;
  color: #000;
}
.challenge:hover{
  transition: all 0.5s ease;
  font-size: 36px;
  padding: 20px;
}
</style>  

<link rel="stylesheet" href="/assets/css/alert-dialog.css">

<div class="challenges grid">

  <ul>

    <?php foreach ($challenges_web as $challenge_item): ?>
      <?php 
        echo '<div class="click-to-alert-dialog">';
        echo '<div class="grid-item">';
        if($challenge_item['is_solved']){
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="item challenge challenge-item-web challenge-item-solved">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="item challenge challenge-item-web">';
        }
        echo '<strong>'.$challenge_item['name'].'</strong><br>';
        echo '分数 : '.$challenge_item['score'].'<br>';
        echo '点击量 : '.$challenge_item['visit_times'];
        echo '</li>';
        echo '</div>';
        echo '</div>';
      ?>
    <?php endforeach; ?>

    <?php foreach ($challenges_pwn as $challenge_item): ?>
      <?php 
        echo '<div class="click-to-alert-dialog">';

        if($challenge_item['is_solved']){
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="item challenge challenge-item-pwn challenge-item-solved">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="item challenge challenge-item-pwn">';
        }
        echo '<strong>'.$challenge_item['name'].'</strong><br>';
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
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="item challenge challenge-item-misc challenge-item-solved">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="item challenge challenge-item-misc">';
        }
        echo '<strong>'.$challenge_item['name'].'</strong><br>';
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
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="item challenge challenge-item-crypto challenge-item-solved">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="item challenge challenge-item-crypto">';
        }
        echo '<strong>'.$challenge_item['name'].'</strong><br>';
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
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="item challenge challenge-item-forensics challenge-item-solved">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="item challenge challenge-item-forensics">';
        }
        echo '<strong>'.$challenge_item['name'].'</strong><br>';
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
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="item challenge challenge-item-other challenge-item-solved">';
        }else{
          echo '<li id="challenge-'.$challenge_item['challengeID'].'" class="item challenge challenge-item-other">';
        }
        echo '<strong>'.$challenge_item['name'].'</strong><br>';
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


