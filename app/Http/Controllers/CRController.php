<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Detail_Asset;

class CRController extends Controller
{
    //index
    public function index()
    {
        $data['detail__assets'] = Detail_Asset::orderBy('id', 'asc')->paginate(10);
        return view('companies.detail', $data);
    }
}