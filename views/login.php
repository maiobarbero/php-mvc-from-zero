<?php

/**
 *  @var $model \app\models\User
 */

?>

<h1>Login</h1>

<?php $form = app\core\form\Form::beging('', 'POST');  ?>
<?php echo $form->field($model, 'email')->emailField()->label('Email address'); ?>
<?php echo $form->field($model, 'password')->passwordField()->label('Password'); ?>
<button type="submit" class="btn btn-primary">Submit</button>

<?php app\core\form\Form::end();  ?>