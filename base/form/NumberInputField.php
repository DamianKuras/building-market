<?php

namespace app\base\form;

use app\base\Model;
use app\base\form\BaseField;

class NumberInputField extends BaseField
{
    private int $min = 0;
    private int $max = 10000;
    public function __construct(Model $model, int $attribute)
    {
        parent::__construct($model, $attribute);
    }
    public function renderInput(): string
    {
        return sprintf(
            '<input type="number" min="%s" max="%s" name="%s" step="%s" value="%s" class="%s">',
            $this->min,
            $this->max,
            $this->attribute,
            1,
            $this->attribute,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
        );
    }
    public function setMinAndMax(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }
}
