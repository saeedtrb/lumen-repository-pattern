<?php

namespace App\Data\Resources;

use App\Data\Entities\BaseEntity;
use Illuminate\Support\Collection;

interface IResourceCollection {

    /**
     * @param BaseEntity[]|Collection $entities
     * @return mixed
     */
    public static function toArray($entities);

}