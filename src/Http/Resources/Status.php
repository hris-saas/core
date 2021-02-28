<?php

namespace HRis\Core\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Status extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'           => $this->id,
            'parent_id'    => $this->parent_id,
            'sort_order'   => $this->sort_order,
            'name'         => $this->name,
            'is_completed' => $this->is_completed,
        ];
    }
}
