<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LinkRequest;
use DB;

class PagesController extends Controller
{
    /**
     * @description: 
     * @param {type} 
     * @return: 
     * @author: Lilue
     */
    public function root()
    {
        $user = session('wechat.oauth_user.default');
        $students = DB::table("table_xsxx")->where('openid', $user->id)->get();
        return view('pages.root', compact('students'));
    }

    public function search()
    {
        return view('pages.search');
    }

    public function linked(LinkRequest $request)
    {
        $match = DB::table("table_xsxx")->where([
            ['xsbh', '=', $request->xsbh],
            ['sjhm', '=', $request->phone],
        ])->first();
        // dd($match->OPENID);
        if(empty($match))
        {
            return back()->withErrors(['手机号与学生编号不匹配，请检查！'])->withInput();
        }
        if(!empty($match->OPENID))
        {
            return back()->withErrors(['学生编号已关联微信，请先取消关联'])->withInput();
        }
        $user = session('wechat.oauth_user.default');
        $result = DB::table('table_xsxx')->where('xsbh', $request->xsbh)->update(['openid' => $user->id]);
        if(empty($result))
        {
            return back()->withErrors(['网络波动,关系失败，请重新关联'])->withInput();
        }
        return redirect()->route('pages.root')->with('success', '关联成功');
    }

    public function show($id)
    {
        $date = DB::table('table_xsxx')->where('xsbh', $id)->first();
        $orders = DB::select("select sfdh,sum(fyje) as je from table_sfdmx where xsbh=". $id ." group by sfdh");
        // dd($order);
        // dd($date);
        return view('pages.show', compact('date', 'orders'));
    }

    public function customize($id, $dh, $je)
    {
        $yjjes = DB::table('table_sfjl')->where([['sfdh', '=', $dh], ['xsbh', '=', $id]])->get();
        $yjje_sum = 0;
        foreach ($yjjes as $yjje) {
            $yjje_sum += $yjje->sfje;
        }
        $djje = $je - $yjje_sum;
        $jfjl = DB::table('table_sfjl')->where([['sfdh', '=', $dh], ['xsbh', '=', $id]])->get();
        return view('pages.custom', compact('id', 'dh', 'je', 'djje', 'yjje_sum', 'jfjl'));
    }

    public function cancel($id)
    {
        $result = DB::table('table_xsxx')->where('xsbh', $id)->update(['openid' => ""]);
        // dd($result);
        return redirect()->route('pages.root')->with('success', '关联成功');
    }

}
