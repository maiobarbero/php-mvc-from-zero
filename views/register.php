<h1>Register</h1>

<?php $form = app\core\form\Form::beging('', 'POST');  ?>
<?php echo $form->field($model, 'nickname')->label('Nickname'); ?>
<?php echo $form->field($model, 'email')->emailField()->label('Email address'); ?>
<?php echo $form->field($model, 'password')->passwordField()->label('Password'); ?>
<?php echo $form->field($model, 'repeat_password')->passwordField()->label('Repeat your password'); ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php app\core\form\Form::end();  ?>