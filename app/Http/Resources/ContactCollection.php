<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ContactCollection extends ResourceCollection
{
    private $total;

    public function __construct($resource)
    {
        $this->total = $resource->total();

        $resource = $resource->getCollection();

        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            "recordsTotal" => $this->total,
            "recordsFiltered" => $this->total
        ];
        // return json_encode(array(("recordsTotal"=>10, "recordsFiltered"=>10, "data"=>$data));
    }
}
