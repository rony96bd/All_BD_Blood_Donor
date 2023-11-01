<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blood;
use App\Models\City;
use App\Models\Division;
use App\Models\Donor;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageDonorController extends Controller
{

    public function index()
    {
        $pageTitle = "Manage Donor List";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $donors = Donor::latest()->with('blood', 'location')->paginate(getPaginate());

        return view('admin.donor.index', compact('pageTitle', 'emptyMessage', 'donors', 'bloods'));
    }

    public function pending()
    {
        $pageTitle = "Pending Donor List";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $donors = Donor::where('status', 0)->latest()->with('blood', 'location')->paginate(getPaginate());
        return view('admin.donor.index', compact('pageTitle', 'emptyMessage', 'donors', 'bloods'));
    }

    public function approved()
    {
        $pageTitle = "Approved Donor List";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $donors = Donor::where('status', 1)->latest()->with('blood', 'location')->paginate(getPaginate());
        return view('admin.donor.index', compact('pageTitle', 'emptyMessage', 'donors', 'bloods'));
    }

    public function banned()
    {
        $pageTitle = "Banned Donor List";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $donors = Donor::where('status', 2)->latest()->with('blood', 'location')->paginate(getPaginate());
        return view('admin.donor.index', compact('pageTitle', 'emptyMessage', 'donors', 'bloods'));
    }

    public function referer()
    {
        $pageTitle = "Banned Donor List";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $donors = Donor::whereNotNull('referer_id')->latest()->with('blood', 'location')->paginate(getPaginate());
        return view('admin.donor.index', compact('pageTitle', 'emptyMessage', 'donors', 'bloods'));
    }

    public function create()
    {
        $pageTitle = "Donor Create";
        $data['divisions'] = Division::get(["name", "id"]);
        $cities = City::where('status', 1)->select('id', 'name')->with('location')->get();
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        return view('admin.donor.create', $data, compact('pageTitle', 'cities', 'bloods'));
    }

    public function donorBloodSearch(Request $request)
    {
        $request->validate([
            'blood_id' => 'required|exists:bloods,id'
        ]);
        $bloodId = $request->blood_id;
        $blood = Blood::findOrFail($request->blood_id);
        $pageTitle = $blood->name . " Blood Group Donor List";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $donors = Donor::where('blood_id', $request->blood_id)->latest()->with('blood', 'location')->paginate(getPaginate());
        return view('admin.donor.index', compact('pageTitle', 'emptyMessage', 'donors', 'bloods', 'bloodId'));
    }

    public function searchData(Request $request)
    {
        $pageTitle = "Donor Search";
        $emptyMessage = "No data found";
        $search = $request->search;
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $donors = Donor::where('name', 'like', "%$search%")->latest()->with('blood', 'division', 'city', 'location')->paginate(getPaginate());

        return view('admin.donor.search-data', compact('pageTitle', 'emptyMessage', 'donors', 'bloods', 'search'))->render();
    }

    public function search(Request $request)
    {
        $pageTitle = "Donor Search";
        $emptyMessage = "No data found";
        $search = $request->search;
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $donors = Donor::where('name', 'like', '%' . $request->search_string . '%')
        ->orWhere('phone', 'like', '%' . $request->search_string . '%')
            ->orWhere('referer_by', 'like', '%' . $request->search_string . '%')
        ->latest()->with('blood', 'division', 'city', 'location')->paginate(getPaginate());

        if ($donors->count() >= 1) {
            return view('admin.donor.search-data', compact('pageTitle', 'emptyMessage', 'donors', 'bloods'))->render();
        } else {
            return response()->json([
                'status' => 'nothing_found',
            ]);
        }

        return view('admin.donor.index', compact('pageTitle', 'emptyMessage', 'donors', 'bloods', 'search'));
    }

    public function approvedStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:donors,id'
        ]);
        $donor = Donor::findOrFail($request->id);
        $donor->status = 1;
        $donor->save();
        $notify[] = ['success', 'Donor has been approved'];
        return back()->withNotify($notify);
    }

    public function bannedStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:donors,id'
        ]);
        $donor = Donor::findOrFail($request->id);
        $donor->status = 2;
        $donor->save();
        $notify[] = ['success', 'Donor has been canceled'];
        return back()->withNotify($notify);
    }


    public function featuredInclude(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:donors,id'
        ]);
        $donor = Donor::findOrFail($request->id);
        $donor->featured = 1;
        $donor->save();
        $notify[] = ['success', 'Include this donor featured list'];
        return back()->withNotify($notify);
    }

    public function featuredNotInclude(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:donors,id'
        ]);
        $donor = Donor::findOrFail($request->id);
        $donor->featured = 0;
        $donor->save();
        $notify[] = ['success', 'Remove this donor featured list'];
        return back()->withNotify($notify);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:80',
            'gender' => 'required|in:1,2',
            'division' => 'required|exists:divisions,id',
            'city' => 'required|exists:cities,id',
            'location' => 'required|exists:locations,id',
            'religion' => 'required|max:40',
            'blood' => 'required|exists:bloods,id',
            'birth_date' => 'required',
            'imageUpload' => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'phone' => 'required|max:40|unique:donors,phone',
            'password' => 'required|confirmed|min:6',
        ]);
        $donor = new Donor();
        $donor->name = $request->name;
        $donor->gender = $request->gender;
        $donor->division_id = $request->division;
        $donor->city_id = $request->city;
        $donor->location_id = $request->location;
        $donor->religion = $request->religion;
        $donor->blood_id = $request->blood;
        $donor->last_donate = $request->last_donate;
        $donor->birth_date =  $request->birth_date;
        $donor->email = $request->email;
        $donor->facebook = $request->facebook;

        $input = $request->all();

        $size = imagePath()['donor']['size'];

        if ($input['base64image'] || $input['base64image'] != '0') {

            // Available alpha caracters
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            // generate a pin based on 2 * 7 digits + a random character
            $pin = mt_rand(1000000, 9999999)
                . mt_rand(1000000, 9999999)
                . $characters[rand(0, strlen($characters) - 1)];

            // shuffle the result
            $string = str_shuffle($pin);

            $path = imagePath()['donor']['path'] . '/';
            $image_parts = explode(";base64,", $input['base64image']);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $filename = time() . '_' . $string . '.' . $image_type;
            $file = $path . $filename;
            file_put_contents($file, $image_base64);
            $donor->image = $filename;
        }
        $donor->phone = $request->phone;
        $donor->phone2 = $request->phone2;
        $donor->about_me = $request->about_me;
        $donor->status = 1;
        $donor->password = Hash::make($request->password);
        $donor->save();
        $notify[] = ['success', 'Donor has been Added'];
        return back()->withNotify($notify);
    }

    public function edit($id)
    {
        $pageTitle = "Donor Update";
        $data['divisions'] = Division::get(["name", "id"]);
        $divisions = Division::where('status', 1)->select('id', 'name')->get();
        $donor = Donor::findOrFail($id);
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $cities = City::where('status', 1)->select('id', 'name')->with('location')->get();
        return view('admin.donor.edit', compact('pageTitle', 'cities', 'divisions', 'bloods', 'donor'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:80',
            'gender' => 'required|in:1,2',
            'division' => 'required|exists:divisions,id',
            'city' => 'required|exists:cities,id',
            'location' => 'required|exists:locations,id',
            'religion' => 'required|max:40',
            'blood' => 'required|exists:bloods,id',
            'birth_date' => 'required',
        ]);

        $donor = Donor::findOrFail($id);
        $donor->name = $request->name;
        $donor->gender = $request->gender;
        $donor->division_id = $request->division;
        $donor->city_id = $request->city;
        $donor->location_id = $request->location;
        $donor->religion = $request->religion;
        $donor->blood_id = $request->blood;
        $donor->last_donate = $request->last_donate;
        $donor->birth_date =  $request->birth_date;
        $donor->email = $request->email;
        $donor->facebook = $request->facebook;

        $input = $request->all();

        $oldimage = $donor->image;
        $path = imagePath()['donor']['path'] . '/';

        if ($request->hasFile('imageUpload') && file_exists($path . $oldimage)) {
            unlink($path . $oldimage);
        }

        if ($request->hasFile('imageUpload')) {

            if ($input['base64image'] || $input['base64image'] != '0') {

                // Available alpha caracters
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                // generate a pin based on 2 * 7 digits + a random character
                $pin = mt_rand(1000000, 9999999)
                    . mt_rand(1000000, 9999999)
                    . $characters[rand(0, strlen($characters) - 1)];

                // shuffle the result
                $string = str_shuffle($pin);

                // $folderPath = public_path('images/');
                $path = imagePath()['donor']['path'] . '/';
                $image_parts = explode(";base64,", $input['base64image']);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                // $file = $folderPath . uniqid() . '.png';
                $filename = time() . '_' . $string . '.' . $image_type;
                $file = $path . $filename;
                file_put_contents($file, $image_base64);
                $donor->image = $filename;
            }
        } else {
            $donor->image = $oldimage;
        }

        $donor->phone = $request->phone;
        $donor->phone2 = $request->phone2;
        $donor->about_me = $request->about_me;
        $donor->referer_id = $request->referer_id;
        $donor->password = Hash::make($request->password);
        $donor->save();
        $notify[] = ['success', 'Donor has been updated.'];
        return back()->withNotify($notify);
    }
}
