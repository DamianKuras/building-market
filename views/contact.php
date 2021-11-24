<?php

use app\base\form\Form;
use app\base\form\TextareaField;

$this->title = 'Contact';
?>

<div class="form-contact mt-5">
<h1> Contact </h1>
<?php $form = Form::begin('', 'post') ?>
<?php echo $form->field($model, 'subject') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo new TextareaField($model, 'body') ?>
<button class="w-100 btn btn-lg btn-primary" type="submit" value="Submit">submit</button>
<?php Form::end() ?>
</div>
