<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $domains = DB::table('tbl_pbn')->get();
        return view('pages.home',compact('domains'));
    }

    public function addDomain()
    {
        return view('pages.AddDomain');
    }

    public function postAddDomain(Request $request)
    {
        $this->validate($request,[
            'domain' => 'bail|required|unique:tbl_pbn',
            'dns' => 'bail|required',
            'cdn' => 'bail|required',
            'ip' => 'bail|required|ipv4',
            'name_register' => 'bail|required',
            'email' => 'bail|required|email',
            'register_date' => 'bail|required|date_format:d/m/Y',
            'expried_date' => 'bail|required|date_format:d/m/Y',

        ],[
            'domain.required' => 'Tên domain không được để trống',
            'domain.unique' => 'Tên domain đã tồn tại',
            'dns.required' => 'DNS không được để trống',
            'cdn.required' => 'CDN không được để trống',
            'ip.required' => 'IP không được để trống',
            'ip.ipv4' => 'IP không hợp lệ',
            'name_register.required' => 'Tên nhà đăng ký không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'register_date.required' => 'Ngày đăng ký không được để trống',
            'register_date.date_format' => 'Ngày đăng ký không hợp lệ',
            'expried_date.required' => 'Ngày hết hạn không được để trống',
            'expried_date.date_format' => 'Ngày hết hạn không hợp lệ',
        ]);

        DB::table('tbl_pbn')->insert([
            'domain' => $request->domain,
            'dns' => $request->dns,
            'cdn' => $request->cdn,
            'ip' => $request->ip,
            'name_register' => $request->name_register,
            'email' => $request->email,
            'expired_date' => $request->expried_date,
            'register_date' => $request->register_date,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);


        return redirect()->back()->with('message','success');
    }
}
