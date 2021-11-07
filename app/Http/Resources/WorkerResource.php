<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'patronymic' => $this->patronymic,
            'gender' => $this->gender,
            'salary' => $this->salary,
            'departments' => $this->departments()->get(['department.id', 'department.name'])->toArray(),
        ];
    }
}
