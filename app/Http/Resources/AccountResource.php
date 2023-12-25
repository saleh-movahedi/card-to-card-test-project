<?php

namespace App\Http\Resources;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Account|self $this */
        return [
            'id' => $this->id,
            'balance' => $this->balance,
            'cards' => CardsResource::collection($this->whenLoaded('cards')),
        ];
    }
}
