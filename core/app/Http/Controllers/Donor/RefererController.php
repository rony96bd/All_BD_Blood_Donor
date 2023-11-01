<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefererController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function index()
    {
        $pageTitle = "Referers";
        $emptyMessage = "No data found";
        $referer_id = Auth::guard('donor')->user()->referer_id;
        $referers = Donor::where('referer_by', $referer_id)->latest()->with('blood', 'division', 'city', 'location')->paginate(getPaginate());

        return view($this->activeTemplate . 'donor.referer', compact('pageTitle', 'emptyMessage', 'referers'));
    }
}
