<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SizeResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                            => $this->id,
            'name'                          => $this->name,
            'description'                   => $this->description,
            'system'                        => $this->system,
            'height'                        => $this->system,
            'weight'                        => $this->system,
            'flight_modifier'               => $this->flight_modifier,
            'stealth_modifier'              => $this->stealth_modifier,
            'attack_modifier'               => $this->attack_modifier,
            'defense_modifier'              => $this->defense_modifier,
            'damage_modifier'               => $this->damage_modifier,
            'damage_reduction_modifier'     => $this->damage_reduction_modifier,
            'races'                         => $this->races
        ];
    }
}
