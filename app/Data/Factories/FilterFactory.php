<?php

namespace App\Data\Factories;


use App\Data\Entities\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class FilterFactory implements IFactory
{
    public static function make($entity)
    {
        // TODO: Implement make() method.
    }

    /**
     * @param [] $entity
     * @return Filter
     */
    public static function makeFromArray($entity)
    {
        $filter = new Filter();

        $filter->setColumnName($entity['column_name']);
        $filter->setOperand($entity['operand']);
        $filter->setValue($entity['value']);

        return $filter;
    }

    public static function makeCollection($entities)
    {
        // TODO: Implement makeCollection() method.
    }

    /**
     * @param $entities
     * @return Filter[]|Collection
     */
    public static function makeCollectionFromArray($entities)
    {
        $filters = collect();

        foreach ($entities as $entity){
            $filters->push(self::makeFromArray($entity));
        }

        return $filters;
    }

    /**
     * @param Request $request
     * @param [] $allows
     * @return Filter[]|Collection
     */
    public static function makeCollectionFromRequest($request, $allows = [])
    {
        $entities = $request->get('filters', []);
        $filters = collect();

        foreach ($entities as $columnName => $filter){
            if( count($allows) > 0 && !isset($allows)){
                continue;
            }

            $filter['column_name'] = $columnName;

            $filters->push(self::makeFromArray($filter));
        }

        return $filters;
    }


}