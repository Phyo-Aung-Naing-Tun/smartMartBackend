<?php
namespace App\Repositories\Backend;

use App\Http\Resources\Backend\UserResource;
use App\Http\Responses\BaseResponse;
use App\Models\User;

class UserRepository{
    private $response;

    public function __construct(BaseResponse $baseResponse)
    {
        $this->response = $baseResponse;
    }

    public function index($request)
    {
       try {
        $per_page = $request->per_page ?? 5;
        $page = $request->page ?? 1;
        $value = $request->search;
        $users = User::when($value, function ($query, $value) {
            $query->where('name', 'like', "%$value%")
             ->orWhere('email', 'like', "%$value%")
             ->orWhere('phone', 'like', "%$value%");
           })->paginate($per_page,['*'],'page',$page);
        return UserResource::collection($users);
       } catch (\Throwable $e) {
        return $this->response->error($e->getMessage(),500);
       }
    }

}