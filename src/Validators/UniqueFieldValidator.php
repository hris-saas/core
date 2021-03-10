<?php

namespace HRis\Core\Validators;

use Illuminate\Support\Facades\Validator;

class UniqueFieldValidator implements ValidatorInterface
{
    public function handle(): void
    {
        $this->extend();

        $this->replacer();
    }

    public function extend(): void
    {
        Validator::extend('unique_field', function ($attribute, $value, $parameters, $validator) {

            $models = config('hris-saas.models');

            $fields = array_merge($models['employee-fields'], $models['statuses']);

            $key = request()->segment(2);

            $model = (new $fields[$key]);

            $locales = config('hris-saas.supported_locales');

            $dbValue = $model::where(function ($query) use ($locales, $attribute, $value) {
                    foreach($locales as $locale) {
                        $query->orWhereJsonContains($attribute, [$locale => $value]);
                    }
                })->get();

            if ($dbValue && count($dbValue) > 0) {
                return false;
            }

            return true;
        });
    }

    public function replacer(): void
    {
        Validator::replacer('unique_field', function ($message, $attribute, $rule, $parameters, $validator) {
            $message = trans('validation.unique');

            $message = str_replace(':attribute', $attribute, $message);

            return $message;
        });
    }
}
