<?php

namespace App\Http\Controllers\Admin;


use App\Data\Entities\HttpStatusCode;
use App\Data\Entities\Response;
use App\Data\Entities\User;
use App\Data\Factories\FilterFactory;
use App\Data\Factories\OrderFactory;
use App\Data\Repositories\MySql\UserRepository;
use App\Data\Resources\Admin\UserResource;
use App\Data\Resources\Admin\UserResourceCollection;
use App\Events\CreateUserEvent;
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){

        $response = new Response();

        $validator = $this->makeValidator($request, [
            'first_name' => 'required|min:3|max:64',
            'last_name' => 'required|min:3|max:64',
            'mobile' => 'required|min:3|max:64',
            'email' => 'nullable|min:3|max:64',
            'password' => 'required|min:8|max:32'
        ]);

        if ($validator->fails()) {
            $response->code = HttpStatusCode::UNPROCESSABLE_ENTITY;
            $response->error->addValidator($validator);
            return $response->json();
        }

        $user = new User();

        $user->setFirstName($request->get('first_name'));
        $user->setLastName($request->get('last_name'));
        $user->setMobile($request->get('mobile'));
        $user->setEmail($request->get('email'));
        $user->setPassword(User::passwordHash($request->get('password')));
        $user->setDisabled(false);

        $user = UserRepository::create($user);

        event( new CreateUserEvent($user));

        $response->code = HttpStatusCode::CREATE;
        $response->value->add('user', UserResource::toArray($user));
        return $response->json();

    }

    /**
     * @param Request $request
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $userId){


        $response = new Response();

        $validator = $this->makeValidator($request, [
            'first_name' => 'required|min:3|max:64',
            'last_name' => 'required|min:3|max:64',
            'mobile' => 'required|min:3|max:64',
            'email' => 'nullable|min:3|max:64',
            'password' => 'nullable|min:8|max:32',
            'disabled' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            $response->code = HttpStatusCode::UNPROCESSABLE_ENTITY;
            $response->error->addValidator($validator);
            return $response->json();
        }

        $user = new User();

        $user->setId($userId);
        $user->setFirstName($request->get('first_name'));
        $user->setLastName($request->get('last_name'));
        $user->setMobile($request->get('mobile'));
        $user->setEmail($request->get('email'));

        if(!empty($request->get('password'))){
            $user->setPassword(User::passwordHash($request->get('password')));
        }

        $user->setDisabled($request->get('disabled'));

        $user = UserRepository::update($user);

        $response->value->add('user', UserResource::toArray($user));

        return $response->json();

    }

    /**
     * @param Request $request
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $userId){

        $response = new Response();


        $result = UserRepository::delete($userId);

        return $response->json();

    }

}