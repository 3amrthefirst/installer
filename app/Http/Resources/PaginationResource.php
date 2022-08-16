<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
    private $dataResource;

    public function __construct($resource, $dataResource = null)
    {
        $this->dataResource = $dataResource;
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'total'        => $this->total(),
            'count'        => $this->count(),
            'per_page'     => $this->perPage(),
            'current_page' => $this->currentPage(),
            'total_pages'  => $this->lastPage(),
            'data'         => $this->dataResource::collection($this)
        ];
    }
}
