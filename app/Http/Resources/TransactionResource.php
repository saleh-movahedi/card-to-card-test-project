<?php

namespace App\Http\Resources;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Transaction|self $this */
        return [
            "id" => $this->id,
            "source_card_id" => $this->source_card_id,
            "destination_card_id" => $this->destination_card_id,
            "fee" => $this->fee,
            "amount" => $this->amount,
            "created_at" => $this->created_at->format('Y-m-d h:i:s'),
        ];
    }
}
