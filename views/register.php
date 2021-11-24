<?php
$this->title = 'Sing up';
?>
<div class="form-signin mt-5">
<h1> Sign up </h1>
<div class="form-signin mt-5">
<?php $form = app\base\form\Form::begin('', "post") ?>
<?php echo $form->field($model, 'username') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo $form->field($model, 'password')->passwordField() ?>
<?php echo $form->field($model, 'passwordConfirm')->passwordField() ?>
<button class="w-100 btn btn-lg btn-primary" type="submit" value="Submit">submit</button>
<?php app\base\form\Form::end() ?>
</div>