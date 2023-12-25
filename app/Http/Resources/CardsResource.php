<?php

namespace App\Http\Resources;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Card|self $this */
        return [
            'id' => $this->id,
            'card_number' => $this->card_number,
            'transactions' => TransactionResource::collection($this->whenLoaded('transactions')),
        ];
    }
}
