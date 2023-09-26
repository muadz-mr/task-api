<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

abstract class BaseResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'records' => $this->collection,
            'pagination' => [
                'current_page' => $this->currentPage(),
                'last_page' => $this->lastPage(),
                'total_record' => $this->total(),
                'page_size' => $this->perPage(),
                'has_more_page' => $this->hasMorePages(),
            ]
        ];
    }
}
