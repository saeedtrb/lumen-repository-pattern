<?php

namespace App\Data\Factories;


use App\Data\Entities\User;
use Illuminate\Support\Collection;

class UserFactory implements IFactory
{

    /**
     * @param $entity
     * @return User
     */
    public static function make($entity)
    {
        $user = new User();

        $user->setId($entity->id);
        $user->setFirstName($entity->first_name);
        $user->setLastName($entity->last_name);
        $user->setMobile($entity->mobile);
        $user->setEmail($entity->email);
        $user->setPassword($entity->password);
        $user->setDisabled($entity->disabled ? true : false);
        $user->setCreatedAt($entity->created_at);
        $user->setUpdatedAt($entity->updated_at);

        return $user;
    }

    /**
     * @param $entity
     * @return User
     */
    public static function makeFromArray($entity)
    {
        // TODO: Implement makeFromArray() method.
    }

    /**
     * @param $entities
     * @return User[]|Collection
     */
    public static function makeCollection($entities)
    {
        $users = collect();

        foreach ( $entities as $entity){
            $users->push(self::make($entity));
        }

        return $users;
    }

    /**
     * @param $entities
     * @return User[]|Collection
     */
    public static function makeCollectionFromArray($entities)
    {
        // TODO: Implement makeCollectionFromArray() method.
    }
}