<?php

namespace app\core\form;

use app\core\Model;

class Field
{
  public const TYPE_TEXT = 'text';
  public const TYPE_PASSWORD = 'password';
  public const TYPE_EMAIL = 'email';


  public Model $model;
  public string $attribute;
  public string $label;
  public string $type;

  public function __construct($model, $attribute, $label)
  {
    $this->model = $model;
    $this->attribute = $attribute;
    $this->label = $label;
    $this->type = self::TYPE_TEXT;
  }

  public function __toString()
  {
    return sprintf(
      '
    <div class="mb-3 form-group">
      <label class="form-label">%s</label>
      <input type="%s" name="%s" value="%s" class="form-control %s">
      <div class=text-danger error-feedback">
        %s
      </div>
    </div>
    ',
      $this->label,
      $this->type,
      $this->attribute,
      $this->model->{$this->attribute},
      $this->model->hasError($this->attribute) ? 'is-invalid' : '',
      $this->model->getFirstError($this->attribute)
    );
  }

  public function passwordField()
  {
    $this->type = self::TYPE_PASSWORD;
    return $this;
  }
  public function emailField()
  {
    $this->type = self::TYPE_EMAIL;
    return $this;
  }
}