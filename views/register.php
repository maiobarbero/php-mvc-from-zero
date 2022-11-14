<h1>Register</h1>

<?php $form = app\core\form\Form::beging('', 'POST');  ?>
<?php echo $form->field($model, 'nickname', 'Nickname'); ?>
<?php echo $form->field($model, 'email', 'Email address')->emailField(); ?>
<?php echo $form->field($model, 'password', 'Password')->passwordField(); ?>
<?php echo $form->field($model, 'repeat_password', 'Repeat your password')->passwordField(); ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php app\core\form\Form::end();  ?>