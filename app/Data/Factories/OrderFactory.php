<?php

namespace App\Data\Factories;


use App\Data\Entities\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class OrderFactory implements IFactory
{
    public static function make($entity)
    {
        // TODO: Implement make() method.
    }

    public static function makeFromArray($entity)
    {
        $order = new Order();

        $order->setColumnName($entity['column_name']);
        $order->setValue($entity['value']);

        return $order;
    }

    public static function makeCollection($entities)
    {
        // TODO: Implement makeCollection() method.
    }

    /**
     * @param $entities
     * @return Order[]|Collection
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
     * @param array $allows
     * @return Order[]|Collection
     */
    public static function makeCollectionFromRequest($request, $allows = [])
    {
        $entities = $request->get('orders', []);
        $orders = collect();

        foreach ($entities as $columnName => $order){

            if( count($allows) > 0 && !isset($allows)){
                continue;
            }

            $order['column_name'] = $columnName;

            $orders->push(self::makeFromArray($order));
        }

        return $orders;
    }


}