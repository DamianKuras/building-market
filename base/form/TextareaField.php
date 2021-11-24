<?php

namespace app\base\form;

use app\base\form\BaseField;

class TextareaField extends BaseField
{
    public function renderInput(): string
    {
        return sprintf(
            '<textarea name="%s" class="form-control message-textarea %s " placeholder="%s">%s</textarea> ',
            $this->attribute,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->attribute,
            $this->model->{$this->attribute},
        );
    }
}
