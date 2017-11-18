<?php

namespace App\Http\Middleware;

use App\Http\Models\AuthToken;
use Closure;
use \Config;
use Illuminate\Support\Facades\DB;

class ApiAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        if(!$request->header('token')){
            return response()->json([
                'status'=>'FAILED',
                'error'=>Config::get('custom_messages.TOKEN_REQUIRED')
            ]);
        }


        $token = $request->header('token');
        $query = DB::table('auth_tokens');
        $query->join('users','users.id','=','auth_tokens.user_id');
        $query->where('auth_tokens.token','=',$token);
        $query->select(
            'users.first_name',
            'users.last_name',
            'auth_tokens.token'
        );

        $user = $query->first();

        if($user){
            $request->user = $user;
            return $next($request);
        }
        return response()->json([
            'status'=>'FAILED',
            'error'=>Config::get('custom_messages.INVALID_TOKEN')
        ]);


    }
}
