<?php

namespace app\base\form;

use app\base\Model;
use app\base\form\BaseField;

class NumberInputField extends BaseField
{
    private float $min = 0;
    private float $max = 10000;
    
    public function __construct(Model $model, float $attribute)
    {
        parent::__construct($model, $attribute);
    }
    public function renderInput(): string
    {
        return sprintf(
            '<input type="number" step="0.01" min="%s" max="%s" name="%s" value="%s" class="%s">',
            $this->min,
            $this->max,
            $this->attribute,
            $this->attribute,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
        );
    }
    public function setMinAndMax(float $min, float $max)
    {
        $this->min = $min;
        $this->max = $max;
    }
}
