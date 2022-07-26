<?php

namespace App\Http\Controllers;

use App\Imports\GroupsImport;
use App\Imports\MembersImport;
use Maatwebsite\Excel\Facades\Excel;

class MyController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import()
    {
        Excel::import(new MembersImport, request()->file('file_member'));
        
        return back();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function importGroup()
    {
        Excel::import(new GroupsImport, request()->file('file_group'));
        
        return back();
    }
}
