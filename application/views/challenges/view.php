<?php
    $this->load->language("challenges");
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
  background-color: #EEEEEE;
  position: relative;
  width: 256px;
  height: 160px;
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

<div class="challenges">

  <ul>
    <?php foreach ($challenges as $challenge_item): ?>
      <div class="click-to-alert-dialog">

      <li id="challenge-<?php echo $challenge_item['challengeID']; ?>" class="challenge-item">
          <?php echo $challenge_item['name']; ?><br>
          <?php echo $challenge_item['score']; ?>
      </li>
        </div>

    <?php endforeach; ?>


  </ul>


</div>

<a href="SniperOJ{This_IS-A_QIanDAOti}"><a>
<script src="/assets/js/alert-dialog.js"></script>