<?php

namespace App\Http\Controllers;

use App\Mail\DataMail;
use Illuminate\Http\Request;
use App\Services\DataService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
