<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\Advertisement;
use App\Models\Blood;
use App\Models\City;
use App\Models\Division;
use App\Models\Donor;
use App\Models\Location;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Storage;

class DonorController extends Controller
{

    public function dashboard()
    {
        $pageTitle = 'Donor Dashboard';
        $blood = Blood::count();
        $city = City::count();
        $divisions = Division::where('status', 1)->select('id', 'name')->get();
        $locations = Location::count();
        $ads = Advertisement::count();
        $don['all'] = Donor::count();
        $don['pending'] = Donor::where('status', 0)->count();
        $don['approved'] = Donor::where('status', 1)->count();
        $don['banned'] = Donor::where('status', 0)->count();
        $donors = Donor::orderBy('id', 'DESC')->with('blood', 'location')->limit(8)->get();
        $donor = Auth::guard('donor')->user();
        return view('donor.dashboard', compact('pageTitle', 'don', 'blood', 'divisions', 'city', 'locations', 'ads', 'donors', 'donor'));
    }

    public function profile()
    {
        $pageTitle = 'Profile';
        $data['divisions'] = Division::get(["name", "id"]);
        $divisions = Division::where('status', 1)->select('id', 'name')->get();
        $donor = Auth::guard('donor')->user();
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        return view('donor.profile', compact('pageTitle', 'donor', 'divisions', 'bloods'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:80',
            'gender' => 'required|in:1,2',
            'division' => 'required|exists:divisions,id',
            'city' => 'required|exists:cities,id',
            'location' => 'required|exists:locations,id',
            'religion' => 'required|max:40',
            'blood' => 'required|exists:bloods,id',
            'last_donate' => 'date_format:d/m/Y',
            'birth_date' => 'required|date_format:d/m/Y',
        ]);

        $donor = Auth::guard('donor')->user();
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

        $oldimage = Auth::guard('donor')->user()->image;
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
        $donor->password = Hash::make($request->password);
        $donor->save();
        $notify[] = ['success', 'Your profile has been updated.'];
        return redirect()->route('donor.profile')->withNotify($notify);
    }


    public function password()
    {
        $pageTitle = 'Password Setting';
        $donor = Auth::guard('donor')->user();
        return view('donor.password', compact('pageTitle', 'donor'));
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = Auth::guard('donor')->user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notify[] = ['error', 'Password do not match !!'];
            return back()->withNotify($notify);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $notify[] = ['success', 'Password changed successfully.'];
        return redirect()->route('donor.password')->withNotify($notify);
    }

    public function requestReport()
    {
        $pageTitle = 'Your Listed Report & Request';
        $arr['app_name'] = systemDetails()['name'];
        $arr['app_url'] = env('APP_URL');
        $arr['purchase_code'] = env('PURCHASE_CODE');
        $url = "https://license.viserlab.com/issue/get?" . http_build_query($arr);
        $response = json_decode(curlContent($url));
        if ($response->status == 'error') {
            return redirect()->route('donor.dashboard')->withErrors($response->message);
        }
        $reports = $response->message[0];
        return view('donor.reports', compact('reports', 'pageTitle'));
    }

    public function reportSubmit(Request $request)
    {
        $request->validate([
            'type' => 'required|in:bug,feature',
            'message' => 'required',
        ]);
        $url = 'https://license.viserlab.com/issue/add';

        $arr['app_name'] = systemDetails()['name'];
        $arr['app_url'] = env('APP_URL');
        $arr['purchase_code'] = env('PURCHASE_CODE');
        $arr['req_type'] = $request->type;
        $arr['message'] = $request->message;
        $response = json_decode(curlPostContent($url, $arr));
        if ($response->status == 'error') {
            return back()->withErrors($response->message);
        }
        $notify[] = ['success', $response->message];
        return back()->withNotify($notify);
    }

    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("division_id", $request->division_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }

    public function fetchLocation(Request $request)
    {
        $data['locations'] = Location::where("city_id", $request->city_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }

    public function systemInfo()
    {
        $laravelVersion = app()->version();
        $serverDetails = $_SERVER;
        $currentPHP = phpversion();
        $timeZone = config('app.timezone');
        $pageTitle = 'System Information';
        return view('donor.info', compact('pageTitle', 'currentPHP', 'laravelVersion', 'serverDetails', 'timeZone'));
    }
}
