<?php
$this->title = "Sign in";
?>
<div class="form-signin mt-5">
<h1> Sign in</h1>
<?php $form = app\base\form\Form::begin('/login',"post")?> 
    <?php echo $form->field($model, 'username') ?>
    <?php echo $form->field($model, 'password')->passwordField() ?>
    <button class="w-100 btn btn-lg btn-primary" type="submit" value="Submit">Sing in</button>
<?php app\base\form\Form::end()?>  
</div>

