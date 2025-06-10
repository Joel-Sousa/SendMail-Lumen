<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DataService;

class DataController extends Controller
{
    private $dataService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    public function sendMail(Request $request){

        $data =  $this->dataService->sendMail($request);

        return view('index', compact('data'));
    }

    public function cleanLog(){

        $data =  $this->dataService->cleanLog();

        return view('index', compact('data'));
    }
}
