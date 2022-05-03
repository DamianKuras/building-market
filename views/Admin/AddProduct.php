<?php

use app\base\form\Form;
use app\base\form\TextareaField;
use app\base\form\NumberInputField;
use app\base\form\FloatInputField;
$this->title = 'Adding product';
?>
<h1> Adding product </h1>
<?php $form = app\base\form\Form::begin('', "post") ?>
<?php echo $form->field($model, 'name') ?>
<?php echo $form->field($model, 'price')->numberField() ?>
<?php echo $form->field($model, 'category') ?>
<?php echo $form->field($model, 'image_link') ?>
<?php echo $form->field($model, 'brand') ?>
<?php echo $form->field($model, 'quantity_in_stock')->numberField() ?>
<?php echo new TextareaField($model, 'description') ?>
<button type="submit" class="btn btn-primary mb-5" value="Submit">Submit</button>
<?php app\base\form\Form::end() ?>