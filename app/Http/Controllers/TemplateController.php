<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use EasyWeChat;

class TemplateController extends Controller
{

    public function details($id, $dh)
    {
        $jfjl = DB::table('table_sfjl')->where([['sfdh', '=', $dh], ['xsbh', '=', $id]])->get();
        $je = DB::table('table_sfdmx')->where([['sfdh', '=', $dh], ['xsbh', '=', $id]])->sum('fyje');
        $yjje_sum = 0;
        foreach ($jfjl as $yjje) {
            $yjje_sum += $yjje->sfje;
        }
        $djje = $je - $yjje_sum;
        $sfdmx = DB::table('table_sfdmx')->where([['sfdh', '=', $dh], ['xsbh', '=', $id]])->get();
        return view('template.details', compact('id', 'dh', 'yjje_sum', 'jfjl', 'sfdmx', 'je', 'djje'));
    }

    public function test()
    {
        $time = '20191204172616';
        dump(substr($time,0,4). "年" .substr($time,4,2) . "月" . substr($time,6,2) . '日  ' . substr($time,8,2) . ':' . substr($time,10,2) . ':' . substr($time,12,2));
    }
}
