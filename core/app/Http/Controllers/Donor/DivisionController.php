<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;

class DivisionController extends Controller
{

    public function index()
    {
        $pageTitle = "Manage Division";
        $emptyMessage = "No Data Found";
        $divisions = Division::latest()->paginate(getPaginate());
        return view('donor.division.index', compact('pageTitle', 'emptyMessage', 'divisions'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|max:80']);
        $division = new Division();
        $division->name = $request->name;
        $division->status = $request->status ? 1 : 0;
        $division->save();
        $notify[] = ['success', 'Division has been created'];
        return back()->withNotify($notify);
    }


    public function update(Request $request)
    {
        $request->validate(['name' => 'required|max:80']);
        $division = Division::findOrFail($request->id);
        $division->name = $request->name;
        $division->status = $request->status ? 1 : 0;
        $division->save();
        $notify[] = ['success', 'Division has been updated'];
        return back()->withNotify($notify);
    }
}
