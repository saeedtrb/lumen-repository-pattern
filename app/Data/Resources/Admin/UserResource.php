<?php
namespace App\Data\Resources\Admin;


use App\Data\Entities\User;
use App\Data\Resources\IResource;

class UserResource implements IResource
{

    /**
     * @param User $user
     * @return array
     */
    public static function toArray($user)
    {
        return $user ? [
            'id' => $user->getId(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'full_name' => $user->getFullName(),
            'mobile' => $user->getMobile(),
            'email' => $user->getEmail(),
            'disabled' => $user->isDisabled(),
            'created_at' => $user->getCreatedAt(),
            'updated_at' => $user->getUpdatedAt()
        ] : null;
    }
}