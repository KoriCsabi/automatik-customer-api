<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'customer_code' => $this->customer_code,
            'contract_date' => $this->formatDate($this->contract_date)
        ];
    }

    private function formatDate(?string $date = null, string $format = 'Y.m.d H:i:s'): string
    {
        return (is_null($date)) ? '' : date_format(new \DateTime($date), $format);
    }
}
