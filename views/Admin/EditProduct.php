<?php
use app\base\form\Form;
use app\base\form\TextareaField;
use app\base\form\NumberInputField;

$this->title = 'Edycja produktu';
?>
<h1> Edytuj </h1>
<?php $form = app\base\form\Form::begin('', "post") ?>
<input type="hidden" id="id" name="id" value=<?php echo $model->id?> />
<?php echo $form->field($model, 'name') ?>
<?php echo $form->field($model, 'price')->numberField() ?>
<?php echo $form->field($model, 'category') ?>
<?php echo $form->field($model, 'imageLink') ?>
<?php echo $form->field($model, 'brand') ?>
<?php echo $form->field($model, 'quantityInStock')->numberField() ?>
<?php echo new TextareaField($model, 'description') ?>
<button type="submit" class="btn btn-primary mb-5" value="Submit">submit</button>
<?php app\base\form\Form::end() ?>