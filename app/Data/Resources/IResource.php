<?php

namespace App\Data\Resources;

use App\Data\Entities\BaseEntity;

interface IResource {

    /**
     * @param BaseEntity $entity
     * @return mixed
     */
    public static function toArray($entity);

}