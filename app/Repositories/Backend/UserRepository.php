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
        return UserResource::collection(User::paginate($per_page,['*'],'page',$page));
       } catch (\Throwable $e) {
        return $this->response->error($e->getMessage(),500);
       }
    }
}