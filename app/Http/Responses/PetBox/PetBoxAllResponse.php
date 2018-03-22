<?php

namespace App\Http\Responses\PetBox;

use Illuminate\Contracts\Support\Responsable;
use App\Traits\ResponseTrait;

class PetBoxAllResponse implements Responsable
{
    use ResponseTrait;

    protected $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function toResponse($request)
    {
        $data = $this->transform();

        return $data;
    }

    protected function transform()
    {
        $this->result->transform(function ($petBox) {
            return [
                'value'           => $petBox->value,
                'label'           => $petBox->label
            ];
        });
        return $this->responseJson($this->result);
    }
}