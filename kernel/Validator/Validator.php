<?php

namespace App\Kernel\Validator;

class Validator implements ValidatorInterface
{
    private array $errors = [];
    private array $data;
    public function errors(): array
    {
        return $this->errors;
    }
    public function validate(array $data, array $rules): bool
    {
        $this->errors = [];
        $this->data = $data;
        foreach ($rules as $key => $rule) {
            $rules = $rule;
            foreach ($rules as $rule) {
                $rule = explode(':', $rule);

                $ruleName = $rule[0];
                $ruleValue = $rule[1] ?? null;

                $error = $this->validateRule($key, $ruleName, $ruleValue);

                if($error){
                    $this->errors[$key][] = $error;
                }
            }
        }
        return empty($this->errors);
    }
    private function validateRule(string $key, $ruleName, $ruleValue = null): string|false
    {
        $value = $this->data[$key];

        switch ($ruleName){
            case 'required':
                if (empty($value)){
                    return "Поле $key должно быть заполнено";
                }
                break;
            case 'min':
                if (strlen($value) < $ruleValue) {
                    return "Поле $key должно быть минимум $ruleValue символов";
                }
                break;
            case 'max':
                if (strlen($value) > $ruleValue){
                    return "Поле $key должно быть минимум $ruleValue символов";
                }
                break;
            case 'email':
                if (! filter_var($value, FILTER_VALIDATE_EMAIL)){
                    return "Поле $key должно быть вашей почтой";
                }
                break;
        }

        return false;
    }
}