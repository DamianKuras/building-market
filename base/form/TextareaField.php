<?php

namespace app\base\form;

use app\base\form\BaseField;

class TextareaField extends BaseField
{
    public function renderInput(): string
    {
        return sprintf(
            '<textarea name="%s" class="%s textarea">%s</textarea>',
            $this->attribute,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->model->{$this->attribute},
        );
    }
}
