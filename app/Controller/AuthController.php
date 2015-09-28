<?php
namespace App\Controller;

use App\Kernel\Controller;
use App\Kernel\Middleware;
use App\Request\Request;
use App\Response\JsonResponse;
use App\Model\Entites\User;

class AuthController extends Controller implements Middleware
{

    public function __construct(Request $request, JsonResponse $response)
    {
        $request->setBadReqRes($response);
        $request->filterPostParams('account','password');
        $this->request = $request;
        $this->response = $response;
    }

    public function handle()
    {
        $user = $this->check();
        if ($user) {
            return $user;
        }
        return $this->response->forBidden();
    }

    public function check()
    {
        $user = User::where('account', $this->request->account)
                    ->where('password', $this->request->password)
                    ->first();

        if ($user) {
            $user->remember_token = md5($user->id);
            $user->save();
            return $user;
        }

        return false;
    }

    public function store()
    {
        $user = User::where('account',$this->request->account)->first();
        if ($user) {
            return $this->response->ok(['error_code' => 1]);
        }
        $user = User::create($this->request->all);
        $user->info()->create(['name' => '']);
        return $this->response->ok(['error_code' => 0]);
    }

    public function update($id)
    {
        $this->request->filterPostParams('name','gender','phone','birthday','image');
        $user = $this->check();
        if (!$user) {
            return $this->response->forBidden();
        }
        if ($id != $user->id) {
            return $this->response->forBidden();
        }
        unset($this->request->all['account']);
        unset($this->request->all['password']);
        $user->info()->update($this->request->all);
        return $this->response->ok(['error_code' => 0]);
    }
}