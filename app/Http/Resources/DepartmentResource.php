<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'workers_count' => $this->workers_count,
            'max_salary' => $this->max_salary,
            'workers' => $this->workers()->get(['worker.id', 'worker.name', 'worker.surname'])->toArray(),
        ];
    }
}
