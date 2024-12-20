<?php
namespace App\Repositories\Backend;

use App\Http\Resources\Backend\UserResource;
use App\Http\Responses\BaseResponse;
use App\Models\User;
use App\Services\MailService;
use Exception;

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
        $role = $request->role;
        $users = User::with('roles','shop')->when($value, function ($query, $value) {
            $query->where('name', 'like', "%$value%")
             ->orWhere('email', 'like', "%$value%")
             ->orWhere('phone', 'like', "%$value%");
           })->when($role, function ($query, $role) {
            $query->whereHas('roles', function ($q) use ($role) {
                $q->where('id', unhash_id($role));
            });
        })->paginate($per_page,['*'],'page',$page);
        return UserResource::collection($users);
       } catch (\Throwable $e) {
        return $this->response->error($e->getMessage(),500);
       }
    }

    public function show($id)
    {
        try{
            $user = User::with('shop')->findOrFail(unhash_id($id));
            return $this->response->success(UserResource::make($user),"Operation Success",200);
        }catch(Exception $e){
            return $this->response->error($e->getMessage(),500);
        }
    }

}