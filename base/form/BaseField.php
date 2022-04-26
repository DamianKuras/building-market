<?php

namespace app\base\form;

use app\base\Model;

abstract class BaseField
{
    abstract public function renderInput(): string;
    public Model $model;
    public $attribute;
    public function __construct(Model $model, $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }
    public function __toString()
    {
        return sprintf(
            '
        <div class="form-floating mb-2">
            %s
            <label for="floatingInput">%s:</label>
            
            <div class="text-danger">
                %s
            </div>
        </div>
        ',
           
            $this->renderInput(),
            $this->model->getLabel($this->attribute),
            $this->model->getFirstError($this->attribute)
        );
    }
}
