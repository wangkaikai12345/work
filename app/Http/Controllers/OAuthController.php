<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;


class OAuthController extends Controller
{
    //单点登录服务器 url
    protected $ssoServerUrl;

    public function __construct()
    {
        $this->ssoServerUrl = config('work.sso_server', 'http://l.ctoblogs.com');
    }

    /**
     * 执行单点登录的入口，会自动跳转到单点登录服务器进行请求授权
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect()
    {
            $query = http_build_query([
            'client_id'     => config('work.sso_client_id'),
            'redirect_uri'  => config('work.sso_client_callback'),
            'response_type' => 'code',
            'scope'         => ''
        ]);

        return redirect($this->ssoServerUrl . '/oauth/authorize?' . $query);
    }

    /**
     * 单点登录回调处理
     *
     * @param Request $request
     */
    public function callback(Request $request)
    {
        try {
            if ($request->has('error')) {
                if ($request->get('error') === 'access_denied') {
                    //todo exception
                    throw new \Exception('您拒绝了授权', 401);
                }
                //todo exception 其他错误
                throw new \Exception('授权登录失败：' . $request->get('error'), 401);
            }

            $http = new \GuzzleHttp\Client;

            $response = $http->post($this->ssoServerUrl . '/oauth/token', [
                'form_params' => [
                    'client_id'     => config('work.sso_client_id'),
                    'client_secret' => config('work.sso_client_secret'),
                    'grant_type'    => 'authorization_code',
                    'redirect_uri'  => config('work.sso_client_callback'),
                    'code'          => $request->code,
                ],
            ]);

            $res = json_decode((string)$response->getBody(), true);

            $accessToken = Arr::get($res, "access_token");
            if (empty($accessToken)) {
                //todo exception
                throw new \Exception('获取 access_token 失败:' . $request->get('error'), 401);
            }

            //传递rbac的app_id
            //todo 请根据当前系统的配置，获取app_id
            $query = http_build_query([
                'client_app_id' => config('work.app_id')
            ]);

            //获取用户信息及权限
            $response = $http->request('GET', $this->ssoServerUrl . '/api/user?' . $query, [
                'headers' => [
                    'Accept'        => 'application/json',
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);

            //获取用户信息
            $userRes = json_decode((string)$response->getBody(), true);
            if (empty($userRes) ) {
                //todo exception
                throw new \Exception('获取用户信息失败:' , 401);
            }


            /*
           * 正常情况下的数据（$userRes）格式为:
           *  [
           *      "code"     => 200,
           *      "message"  => "成功",
           *      "user"    => [ 内容详情见下 ],
           *      "rbac" => [ 内容详情见下  ],
           *  ]
           *
           * 如果定义 $result 为 人资接口 /getWorkerInfo 的返回值(数组格式) ，那么 $userRes['user'] 就对应的是 $result['ResultData']['userInfo'] 的值
           * 如果定义 $result 为 rbac接口 /login 的返回值(数组格式) ，那么 $userRes['rbac'] 就对应的是 $result['ResultData'] 的值
           *
           */

            if($userRes['code'] !== 200){
                //todo exception
                throw new \Exception('获取用户信息失败:'.$userRes['message'] , 401);
            }

        } catch (\Exception $e) {

            \Log::error("用户授权登录失败： ".$e->getMessage());

            //todo exception 显示异常页面。
            abort($e->getCode());
        }

        //todo    接下来，请根据自己的业务需求，处理 $userRes 的信息。
        //以下为答题系统的数据处理，仅供参考

        // 如果用户为超级管理员 则直接跳转
        if ($userRes['user']['guid'] == 'admin') {
            Auth::loginUsingId(1);
            return redirect('/admin');
        }
        // 验证用户是否登陆过
        if ($user = User::where('guid', $userRes['user']['guid'])->first()) {
            // 更新用户的校区备注信息

            $user->phone = $userRes['user']['tel'];
            $user->options = $userRes['user']['first_grade'].'-'.$userRes['user']['second_grade'].'-'.$userRes['user']['thirdly_grade'].' 职务:【'.$userRes['user']['position_name'].'】 部门:【'.$userRes['user']['department'].'】';
            $user->save();

        } else {
            // 创建本地用户
            $user = new User;

            $user->name = $userRes['user']['name'];

            $user->guid = $userRes['user']['guid'];

            $user->phone = $userRes['user']['tel'];

            $user->options = $userRes['user']['first_grade'].'-'.$userRes['user']['second_grade'].'-'.$userRes['user']['thirdly_grade'].' 职务:【'.$userRes['user']['position_name'].'】 部门:【'.$userRes['user']['department'].'】';

            $user->save();
        }

        Auth::login($user);

        return redirect('/admin');
    }
}
