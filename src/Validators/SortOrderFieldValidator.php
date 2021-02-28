<?php

namespace HRis\Core\Validators;

use Illuminate\Support\Facades\Validator;

class SortOrderFieldValidator implements ValidatorInterface
{
    public function handle(): void
    {
        $this->extend();

        $this->replacer();
    }

    public function extend(): void
    {
        Validator::extend('sort_order_field', function ($attribute, $value, $parameters, $validator) {
            $models = config('hris-saas.models');

            $fields = array_merge($models['employee-fields'], $models['statuses']);

            $key = request()->segment(2);

            $model = (new $fields[$key]);

            if ($value <= 0 || $value > (new $model)::count()) {
                return false;
            }

            return true;
        });
    }

    public function replacer(): void
    {
        Validator::replacer('sort_order_field', function ($message, $attribute, $rule, $parameters, $validator) {
            return $message;
        });
    }
}
