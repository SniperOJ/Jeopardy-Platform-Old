<?php
    $this->load->language("challenges");
?>
<script type="text/javascript" src="/assets/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/assets/js/jQueryColor.js"></script>
<!--这个插件是瀑布流主插件函数必须-->
<script type="text/javascript" src="/assets/js/jquery.masonry.min.js"></script>
<!--这个插件只是为了扩展jquery的animate函数动态效果可有可无-->
<script type="text/javascript" src="/assets/js/jQeasing.js"></script>
<script type="text/javascript">

  $(function(){
      /*瀑布流开始*/
      var container = $('.waterfull ul');
      /*判断瀑布流最大布局宽度，最大为1280*/
      function tores(){
        var tmpWid=$(window).width();
        // if(tmpWid>1280){
        //   tmpWid=1280;
        // }else{
          var column=Math.floor(tmpWid/320);
          tmpWid=column*320;
        // }
        $('.waterfull').width(tmpWid);
      }
      tores();
      $(window).resize(function(){
        tores();
      });
      function a(){
          container.masonry({
            columnWidth: 320,
            itemSelector : '.item',
            isFitWidth: true,//是否根据浏览器窗口大小自动适应默认false
            isAnimated: true,//是否采用jquery动画进行重拍版
            isRTL:false,//设置布局的排列方式，即：定位砖块时，是从左向右排列还是从右向左排列。默认值为false，即从左向右
            isResizable: true,//是否自动布局默认true
            animationOptions: {
            duration: 800,
            easing: 'easeInOutBack',//如果你引用了jQeasing这里就可以添加对应的动态动画效果，如果没引用删除这行，默认是匀速变化
            queue: false//是否队列，从一点填充瀑布流
          }
          });
        }
        a();
    });
</script>

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

<<<<<<< HEAD
<script src="/assets/js/isotope.pkgd.min.js"></script>


<div class="challenges grid">

=======
<div class="challenges waterfull">
>>>>>>> dde25c20a6b9139d5db35ed393dd0dddecb2add2
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


