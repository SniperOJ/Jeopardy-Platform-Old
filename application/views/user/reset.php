<?php echo validation_errors(); ?>

<?php echo form_open('user/reset'); ?>

<form class="form-signin">

    <h2 class="form-signin-heading">Reset Password</h2>

    <label for="inputPassword" class="sr-only">New Password</label>
    <input type="password" id="inputPassword" class="form-control"   placeholder="Please input new password" name="password" required>

    <input type="hidden" name="reset_code" value="<?php echo $reset_code; ?>"> 

    <button class="btn btn-lg btn-primary btn-block" type="submit">Reset</button>

</form>

