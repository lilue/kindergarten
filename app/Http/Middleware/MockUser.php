<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Arr;
use Overtrue\Socialite\User as SocialiteUser;

class MockUser
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
        $user = new SocialiteUser([
            'id' => 'olnFD1VcpCil74FydhZBfgnMrUdc',//openid
            'name' => 'ʟɪʟᴜᴇ_',
            'nickname' => 'ʟɪʟᴜᴇ_',
            'avatar' => 'http://thirdwx.qlogo.cn/mmopen/vi_32/KB6o8SQIa6430WibgcXiaGbzMs1yiaBxHXPia1zrnyTibA1molfaSSMKq2YMjJiczWEQm3q3tvF3MKTkibOia6EBiaibFF8Q/132',
            'email' => null,
            'original' => [],
            'provider' => 'WeChat',
            // 'id' => Arr::get($user, 'olnFD1VcpCil74FydhZBfgnMrUdc'),
            // 'name' => Arr::get($user, 'ʟɪʟᴜᴇ_'),
            // 'nickname' => Arr::get($user, 'ʟɪʟᴜᴇ_'),
            // 'avatar' => Arr::get($user, ''),
            // 'email' => null,
            // 'original' => [],
            // 'provider' => 'WeChat',
        ]);
        session(['wechat.oauth_user.default' => $user]); // 同理，`default` 可以更换为您对应的其它配置名
        return $next($request);
    }
}
