<?php
/**
 * Created by PhpStorm.
 * User: saeedtrb
 * Date: 08/02/2019
 * Time: 08:21 PM
 */

namespace App\Data\Repositories\MySql;


use App\Data\Entities\Filter;
use App\Data\Entities\Order;
use App\Data\Entities\User;
use App\Data\Factories\UserFactory;
use App\Data\Repositories\Contracts\IUserRepository;
use App\Repositories\BaseMySqlRepository;
use Illuminate\Support\Collection;

class UserRepository extends BaseMySqlRepository implements IUserRepository
{
    protected $primaryKey = 'id';
    protected $table = 'users';


    /**
     * @param int $userId
     * @return User|null
     */
    public static function getById($userId){
        $instance = self::getInstance();

        $query = self::newQuery();
        $entity = $query
            ->where($instance->primaryKey, $userId)
            ->first();

        return $entity ? UserFactory::make($entity) : null;
    }

    /**
     * @param int $offset
     * @param int $count
     * @param null $total
     * @param Order[]|Collection $orders
     * @param Filter[]|Collection $filters
     * @return User[]|Collection
     */
    public static function getAll($offset = 0, $count = 0, &$total = null, $orders = [], $filters = [])
    {


        $query = self::newQuery();

        $query = self::processOrder($query, $orders);
        $query = self::processFilter($query, $filters);

        $total = $query->count();

        if ($count) {
            $query->offset($offset);
            $query->limit($count);
        }

        $entities = $query->get();
        return UserFactory::makeCollection($entities);
    }

    /**
     * @param User $user
     * @return User $user
     */
    public static function create($user)
    {
        $user->setCreatedAt(time());

        $id = self::newQuery()->insertGetId([
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'mobile' => $user->getMobile(),
            'email' => $user->getMobile(),
            'password' => $user->getMobile(),
            'disabled' => $user->isDisabled(),
            'created_at' => $user->getCreatedAt()
        ]);

        $user->setId($id);

        return $user;
    }

    /**
     * @param User $user
     * @return User $user
     */
    public static function update($user)
    {
        $instance = self::getInstance();

        $user->setUpdatedAt(time());

        self::newQuery()
            ->where($instance->primaryKey, $user->getId())
            ->update([
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'mobile' => $user->getMobile(),
                'email' => $user->getMobile(),
                'password' => $user->getMobile(),
                'disabled' => $user->isDisabled(),
            'updated_at' => $user->getUpdatedAt()
        ]);

        return $user;
    }

    /**
     * @param int $userId
     * @return int
     */
    public static function delete($userId)
    {
        $instance = self::getInstance();
        return self::newQuery()
            ->where($instance->primaryKey, $userId)
            ->delete();
    }
}