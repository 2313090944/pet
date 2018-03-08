<?php

namespace App\Repository\Filters;

use Phpno1\Repository\Filters\{
    AbstractFilter,
    IOrder
};

class SearchNameFilter extends AbstractFilter
{
    protected function mappings()
    {
        return [

        ];
    }

    public function filter($entity, $value)
    {
        return $entity->where('name','like', '%'.$value.'%');
    }


}