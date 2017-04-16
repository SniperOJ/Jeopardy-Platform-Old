<?php
    $this->load->language("info");
?>

<?php

    $this->load->helper('captcha');
    $this->load->helper("form");

    $vals = array(
        'img_path'  => './assets/captcha/',
        'img_url'   => site_url('/assets/captcha/'),
        'font_path' => './assets/fonts/texb.ttf',
        'img_width' => 180,
        'img_height' => 50,
        'word_length' => 4,
        'font_size' => 24,
        'pool' => '0123456789',
    );

    $cap = create_captcha($vals);

    $data = array(
        'captcha_time'  => $cap['time'], // why null
        'ip_address'    => $this->input->ip_address(),
        'word'      => $cap['word']
    );

    $query = $this->db->insert_string('captcha', $data);
    $this->db->query($query);
?>


<?php echo validation_errors(); ?>

<?php echo form_open('user/login'); ?>



<form class="form-signin">
    <h2 class="form-signin-heading"><?php echo $this->lang->line('LOGIN_LABEL'); ?></h2>

    <label for="inputUsername" class="sr-only"><?php echo $this->lang->line('LOGIN_USERNAME_LABEL'); ?></label>
    <input type="text" id="inputUsername" class="form-control" placeholder="<?php echo $this->lang->line('LOGIN_USERNAME_PLACEHOLDER'); ?>" name="username" required autofocus>

    <label for="inputPassword" class="sr-only"><?php echo $this->lang->line('LOGIN_PASSWORD_LABEL'); ?></label>
    <input type="password" id="inputPassword" class="form-control"   placeholder="<?php echo $this->lang->line('LOGIN_PASSWORD_PLACEHOLDER'); ?>" name="password" required>

    <label for="captcha" class="sr-only"><?php echo $this->lang->line('LOGIN_CAPTCHA_LABEL'); ?></label>
    <input type="text" id="inputCaptcha" class="form-control" placeholder="<?php echo $this->lang->line('LOGIN_CAPTCHA_PLACEHOLDER'); ?>" name= "captcha" required>
    <?php
        echo $cap['image'].'<br>';
    ?>

    <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $this->lang->line('LOGIN_LABEL'); ?></button>

    <a class="btn btn-lg btn-primary btn-block" href="/user/forget">Forget Password</a>
</form>
