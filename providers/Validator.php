<?php
namespace App\Providers;

class Validator
{

    private $errors = array();
    private $key;
    private $value;
    private $name;

    public function field($key, $value, $name = null)
    {
        $this->key = $key;
        $this->value = $value;
        if ($name == null) {
            $this->name = ucfirst($key);
        } else {
            $this->name = ucfirst($name);
        }
        return $this;
    }

    public function required()
    {
        if (empty($this->value)) {
            $this->errors[$this->key] = "$this->name est obligatoire";
        }
        return $this;
    }

    public function mindate($minvalue)
    {
        $valueDate = strtotime($this->value);
        $minvalue2 = strtotime($minvalue);
        if ($valueDate < $minvalue2) {
            $this->errors[$this->key] = "$this->name doit être aujourd'hui ou plus";
        }
        return $this;
    }

    public function dateFormat($valueDate)
    {
        $format = 'Y-m-d';
        $date = \DateTime::createFromFormat($format, $valueDate);
        if ($date && $date->format($format) == $valueDate) {
            // vérification du format de la donnée reçu
            return $this;
        } else {
            $this->errors[$this->key] = "$this->name doit être un format AAAA-M-D";
        }
    }

    public function max($length)
    {
        if (strlen($this->value) > $length) {
            $this->errors[$this->key] = "$this->name doit avoir moins que $length caractères";
        }
        return $this;
    }

    public function min($length)
    {
        if (strlen($this->value) < $length) {
            $this->errors[$this->key] = "$this->name doit avoir plus que $length caractères";
        }
        return $this;
    }

    public function isSuccess()
    {
        if (empty($this->errors))
            return true;
    }

    public function getErrors()
    {
        if (!$this->isSuccess())
            return $this->errors;
    }

    public function email()
    {
        if (!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$this->key] = "$this->name doit être une adresse email valide";
        }
        return $this;
    }
    public function unique($model)
    {
        $model = 'App\\Models\\' . $model;
        $model = new $model;
        $unique = $model->unique($this->key, $this->value);
        if ($unique) {
            $this->errors[$this->key] = "$this->name doit être unique.";
        }
        return $this;
    }


}

?>