<?php 

namespace App\Contracts\FailToBan;

use Illuminate\Http\Request;

interface FailToBanLogServiceInterface
{
    public function makeLog(Request $request,$type,$status);
}