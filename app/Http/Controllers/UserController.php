<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;
use App\Exports\UserExport;
use App\Models\User;



class UserController extends Controller
{
    public function importView(Request $request){
        return view('importFile');
    }
    public function import(Request $request){
        Excel::import(new UserImport, $request->file('file')->store('files'));
        return redirect()->back();
    }
    public function exportUsers(Request $request){
        return Excel::download(new UserExport,'users.xlsx');
    }
}
