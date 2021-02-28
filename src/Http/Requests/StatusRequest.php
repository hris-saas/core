<?php

namespace HRis\Core\Http\Requests;

use HRis\Core\Eloquent\Status;
use HRis\Auth\Http\Requests\BaseRequest;

class StatusRequest extends BaseRequest
{
    protected $rules = [
        'GET' => [],
        'POST' => [
            'name' => ['required', 'max:255', 'unique_field:'.Status::class.',name'],
        ],
        'PATCH' => [
            'name' => ['filled', 'max:255'],
        ],
        'DELETE' => [],
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $this->addQuery();

        return $this->rules[$this->method()];
    }

    /**
     * Get all request attribute except those two special ones.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->except('model_type', 'model_id');
    }

    /**
     * Add special model_type and model_id attributes to the request array.
     *
     * @return void
     */
    protected function addQuery(): void
    {
        $statuses = config('hris-saas.models.statuses', []);

        // FIXME: Change to correct model_type
        $this->query->add(['model_type' => $statuses[$this->segment(2)]]);

        $this->rules['PATCH']['sort_order'][] = 'sort_order_field:'.Status::class;

        if (count($this->segments()) >= 3) {
            $this->query->add(['model_id' => (int) $this->segment(3)]);
            $this->rules['PATCH']['name'][] = 'unique_field:'.Status::class.',name,'. $this->segment(3);
        }
    }
}
