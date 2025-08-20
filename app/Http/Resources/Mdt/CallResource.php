<?php

namespace App\Http\Resources\Mdt;

use App\Enum\CallNatures;
use App\Enum\CallResource as CallResourceEnum;
use App\Enum\CallStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CallResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            // Include related address data
            'address' => [
                'postal' => $this->postal ?? null,
                'street' => $this->street ?? null,
                'city' => $this->city ?? null,
            ],

            'status' => [
                'value' => $this->status,
                'code' => $this->status,
                'label' => CallStatus::from($this->status->value)->label(),
                'color' => CallStatus::from($this->status->value)->color(),
            ],

            'nature' => [
                'value' => $this->nature,
                'code' => $this->nature,
                'label' => CallNatures::from($this->nature->value)->label(),
            ],

            'resource' => [
                'value' => $this->getAttribute('resource'),
                'label' => CallResourceEnum::from($this->getAttribute('resource')->value)->label(),
            ],

            'priority' => $this->priority,
            'time' => $this->time,
            'narrative' => $this->narrative,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
