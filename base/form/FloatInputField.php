<?php

namespace app\base\form;

use app\base\Model;
use app\base\form\BaseField;

class FloatInputField extends BaseField
{
    private float $min = 0.00;
    private float $max = 10000.00;
    
    public function renderInput(): string
    {
        return sprintf(
            '<input type="number" min="%s" max="%s" name="%s" step="%s" value="%s" class="form-control %s">',
            $this->min,
            $this->max,
            $this->attribute,
            0.01,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
        );
    }
    public function setMinAndMax(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }
}
