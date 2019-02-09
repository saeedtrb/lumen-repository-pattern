<?php
namespace App\Data\Repositories\Contracts;


use App\Data\Entities\Filter;
use App\Data\Entities\Order;
use App\Data\Entities\User;
use Illuminate\Support\Collection;

interface IUserRepository
{
    /**
     * @param int $userId
     * @return User|null
     */
    public static function getById($userId);

    /**
     * @param int $offset
     * @param int $count
     * @param null $total
     * @param Order[]|Collection $orders
     * @param Filter[]|Collection $filters
     * @return User[]|Collection
     */
    public static function getAll($offset = 0, $count = 0, &$total = null, $orders = [], $filters = []);

    /**
     * @param User $user
     * @return User $user
     */
    public static function create($user);

    /**
     * @param User $user
     * @return User $user
     */
    public static function update($user);

    /**
     * @param int $userId
     * @return int
     */
    public static function delete($userId);
}