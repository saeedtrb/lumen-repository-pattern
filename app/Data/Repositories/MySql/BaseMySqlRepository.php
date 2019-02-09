<?php namespace App\Repositories;


use App\Data\Entities\Order;
use App\Data\Entities\Filter;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

class BaseMySqlRepository
{
    protected $primaryKey = 'id';
    protected $table = '';

    protected static function getInstance(){
        static $instance = NULL;

        if($instance === NULL){
            #for more information about this method go to https://stackoverflow.com/questions/15898843/what-means-new-static/15899052
            $instance = new static();
        }
        return $instance;
    }

    /**
     * @return Builder
     */
    public static function newQuery()
    {
        $instance = self::getInstance();
        return app('db')->table($instance->table);
    }


    /**
     * @param Builder $query
     * @param Order[]|Collection $orders
     * @return Builder $query
     */
    protected static function processOrder($query, $orders)
    {
        foreach ($orders as $order) {
            $query->orderBy($order->getColumnName(), $order->getValue());
        }
        return $query;
    }

    /**
     * @param Builder $query
     * @param Filter[]|Collection $filters
     * @return Builder $query
     */
    protected static function processFilter($query, $filters)
    {
        foreach ($filters as $filter) {

            switch ($filter->getOperand()) {
                case 'IsEqualTo':
                    $query->where($filter->getColumnName(), '=', $filter->getValue());
                    break;
                case 'IsEqualToOrNull':
                    $query->where(function ($query) use ($filter) {
                        /** @var Builder $query */
                        $query->where($filter->getColumnName(), '=', $filter->getValue())
                            ->orWhereNull($filter->getColumnName());
                    });
                    break;
                case 'IsNull':
                    $query->whereNull($filter->getColumnName());
                    break;
                case 'IsNotEqualTo':
                    $query->where($filter->getColumnName(), '<>', $filter->getValue());
                    break;
                case 'IsNotNull':
                    $query->whereNotNull($filter->getColumnName());
                    break;
                case 'StartWith':
                    $query->where($filter->getColumnName(), 'LIKE', $filter->getValue() . '%');
                    break;
                case 'DoesNotContains':
                    $query->where($filter->getColumnName(), 'NOT LIKE', '%' . $filter->getValue() . '%');
                    break;
                case 'Contains':
                    $query->where($filter->getColumnName(), 'LIKE', '%' . $filter->getValue() . '%');
                    break;
                case 'EndsWith':
                    $query->where($filter->getColumnName(), 'LIKE', '%' . $filter->getValue());
                    break;
                case 'In':
                    $query->whereIn($filter->getColumnName(), $filter->getValue());
                    break;
                case 'NotIn':
                    $query->whereNotIn($filter->getColumnName(), $filter->getValue());
                    break;
                case 'Between':
                    $query->whereBetween($filter->getColumnName(), $filter->getValue());
                    break;
                case 'IsGreaterThanOrEqualTo':
                    $query->where($filter->getColumnName(), '>=', $filter->getValue());
                    break;
                case 'IsGreaterThanOrNull':
                    $query->where(function ($query) use ($filter) {
                        /** @var Builder $query */
                        $query->where($filter->getColumnName(), '>', $filter->getValue())
                            ->orWhereNull($filter->getColumnName());
                    });
                    break;
                case 'IsGreaterThan':
                    $query->where($filter->getColumnName(), '>', $filter->getValue());
                    break;
                case 'IsLessThanOrEqualTo':
                    $query->where($filter->getColumnName(), '<=', $filter->getValue());
                    break;
                case 'IsLessThan':
                    $query->where($filter->getColumnName(), '<', $filter->getValue());
                    break;
                case 'IsAfterThanOrEqualTo':
                    $query->where($filter->getColumnName(), '>=', $filter->getValue());
                    break;
                case 'IsAfterThan':
                    $query->where($filter->getColumnName(), '>', $filter->getValue());
                    break;
                case 'IsBeforeThanOrEqualTo':
                    $query->where($filter->getColumnName(), '<=', $filter->getValue());
                    break;
                case 'IsBeforeThan':
                    $query->where($filter->getColumnName(), '<', $filter->getValue());
                    break;
            }
        }

        return $query;
    }

}