<?php
namespace App\Data\Resources\Admin;


use App\Data\Entities\User;
use App\Data\Resources\IResourceCollection;
use Illuminate\Support\Collection;

class UserResourceCollection implements IResourceCollection
{

    /**
     * @param User[]|Collection $users
     * @return []
     */
    public static function toArray($users)
    {
        $list = [];

        foreach ($users as $user){
            $list[] = [
                'id' => $user->getId(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'full_name' => $user->getFullName(),
                'mobile' => $user->getMobile(),
                'email' => $user->getEmail(),
                'disabled' => $user->isDisabled(),
                'created_at' => $user->getCreatedAt(),
                'updated_at' => $user->getUpdatedAt()
            ];
        }

        return $list;
    }
}