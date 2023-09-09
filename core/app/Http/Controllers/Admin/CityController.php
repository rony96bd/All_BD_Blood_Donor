<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Division;

class CityController extends Controller
{

    public function index()
    {
        $pageTitle = "Manage City";
        $emptyMessage = "No Data Found";
        $citys = City::latest()->with('division')->paginate(getPaginate());
        $divisions = Division::where('status', 1)->select('id', 'name')->get();
        return view('admin.city.index', compact('pageTitle', 'emptyMessage', 'citys', 'divisions'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|max:80']);
        $city = new City();
        $city->name = $request->name;
        $city->division_id = $request->division;
        $city->status = $request->status ? 1: 0;
        $city->save();
        $notify[] = ['success', 'City has been created'];
        return back()->withNotify($notify);
    }


    public function update(Request $request)
    {
        $request->validate(['name' => 'required|max:80']);
        $city = City::findOrFail($request->id);
        $city->name = $request->name;
        $city->division_id = $request->division;
        $city->status = $request->status ? 1: 0;
        $city->save();
        $notify[] = ['success', 'City has been updated'];
        return back()->withNotify($notify);
    }
}
