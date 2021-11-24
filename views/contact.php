<?php

use app\base\form\Form;
use app\base\form\TextareaField;

$this->title = 'Kontakt';
?>
<h1> Contact </h1>
<?php $form = Form::begin('', 'post') ?>
<?php echo $form->field($model, 'subject') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo new TextareaField($model, 'body') ?>
<button type="submit" value="Submit">submit</button>
<?php Form::end() ?>