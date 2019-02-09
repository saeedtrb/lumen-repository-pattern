<?php

namespace App\Data\Factories;

use App\Data\Entities\BaseEntity;
use Illuminate\Support\Collection;

interface IFactory {

    /**
     * @param $entity
     * @return BaseEntity
     */
    public static function make($entity);

    /**
     * @param $entity
     * @return BaseEntity
     */
    public static function makeFromArray($entity);

    /**
     * @param $entities
     * @return BaseEntity[]|Collection
     */
    public static function makeCollection($entities);

    /**
     * @param $entities
     * @return BaseEntity[]|Collection
     */
    public static function makeCollectionFromArray($entities);
}