<?php

namespace App\Http\Controllers\Admin;


use App\Data\Entities\Response;
use App\Data\Factories\FilterFactory;
use App\Data\Factories\OrderFactory;
use App\Data\Repositories\MySql\UserRepository;
use App\Data\Resources\Admin\UserResource;
use App\Data\Resources\Admin\UserResourceCollection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request){

        $page = $request->get('page', null);
        $count = $request->get('count', null);

        $filters = FilterFactory::makeCollectionFromRequest($request, ['id','first_name', 'last_name', 'phone']);
        $orders = OrderFactory::makeCollectionFromRequest($request, ['id','first_name', 'last_name', 'phone']);

        $response = new Response();

        $offset = 0;
        $total = 0;

        if ($page) {
            $count = $count ?: config('app.default_fetch_count', 10);
            $page = $page ?: 1;
            $offset = ($page - 1) * $count;
        }

        $users = UserRepository::getAll($offset, $count, $total, $orders, $filters);

        $response->value->add('total', $total);
        $response->value->add('users', UserResourceCollection::toArray($users));

        return $response->json();

    }

    /**
     * @param Request $request
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetails(Request $request, $userId){

        $response = new Response();

        $user = UserRepository::getById($userId);

        $response->value->add('user', UserResource::toArray($user));

        return $response->json();

    }

}