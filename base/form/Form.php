<?php

namespace app\base\form;

use app\base\Model;
use PDO;

class Form
{
    public static function begin($action, $method, $options = [])
    {
        $attributes = [];
        foreach ($options as $key => $value) {
            $attributes[] = "$key=\"$value\"";
        }
        echo sprintf('<form action="%s" method="%s" %s>', $action, $method, implode(" ", $attributes));
        return new Form();
    }
    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new InputField($model, $attribute);
    }
    public function NumberField(Model $model, $attribute, int $min = 0, int $max = 1000000)
    {
        $intAtrribute = intval($attribute);
        $inputField = new NumberInputField($model, $intAtrribute);
        $inputField->setMinAndMax($min, $max);
        return  $inputField;
    }
    public function FloatField(Model $model, $attribute, float $min = 0, float $max = 1000000){
        $floatAtribute = floatval($attribute);
        $inputField = new FloatInputField($model, $intAtrribute);
        $inputField->setMinAndMax($min, $max);
        return  $inputField;
    }
}
