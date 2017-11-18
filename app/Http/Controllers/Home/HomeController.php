<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repo\Contracts\LedgerInterface;

class HomeController extends Controller
{
    private $ledger;

    public function __construct(LedgerInterface $ledger)
    {
        $this->ledger = $ledger;
    }

    public function index()
    {
        $data = $this->ledger->getLedger();
//        echo"<pre>";
//        print_r($data);exit();
        return view('home.index')->with('data', $data);
    }


    public function acknowledge(Request $request)
    {
        return response()->json([
            'status' => 'SUCCESS',
            'user' => $request->user
        ]);
    }

    public function acknowledge2(Request $request)
    {
        return response()->json([
            'status' => 'SUCCESS',
            'user' => $request->user
        ]);
    }
}
