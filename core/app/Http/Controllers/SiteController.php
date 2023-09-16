<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Blood;
use App\Models\City;
use App\Models\Division;
use App\Models\Donor;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Location;
use App\Models\Page;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Hash;
use App\Models\SupportAttachment;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;



class SiteController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function index()
    {
        $count = Page::where('tempname', $this->activeTemplate)->where('slug', 'home')->count();
        if ($count == 0) {
            $page = new Page();
            $page->tempname = $this->activeTemplate;
            $page->name = 'HOME';
            $page->slug = 'home';
            $page->save();
        }
        $reference = @$_GET['reference'];
        if ($reference) {
            session()->put('reference', $reference);
        }
        $pageTitle = 'Home';
        $sections = Page::where('tempname', $this->activeTemplate)->where('slug', 'home')->first();
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $divisions = Division::where('status', 1)->select('id', 'name')->get();
        $cities = City::where('status', 1)->select('id', 'name')->get();

        return view($this->activeTemplate . 'home', compact('pageTitle', 'sections', 'divisions', 'cities', 'bloods'));
    }

    public function pages($slug)
    {
        $page = Page::where('tempname', $this->activeTemplate)->where('slug', $slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections = $page->secs;
        return view($this->activeTemplate . 'pages', compact('pageTitle', 'sections'));
    }

    public function donor()
    {
        $pageTitle = "All Donor";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $divisions = Division::where('status', 1)->select('id', 'name')->get();
        $cities = City::where('status', 1)->select('id', 'name')->with('location')->get();
        $donors = Donor::where('status', 1)->with('blood', 'city', 'location', 'division')->paginate(getPaginate());
        return view($this->activeTemplate . 'donor', compact('pageTitle', 'emptyMessage', 'donors', 'divisions', 'cities', 'bloods'));
    }

    public function donorDetails($slug, $id)
    {
        $pageTitle = "Donor Details";
        Donor::where('status', 1)->where('id', $id)->firstOrFail()->increment('click');
        $donor = Donor::where('status', 1)->where('id', $id)->firstOrFail();
        return view($this->activeTemplate . 'donor_details', compact('pageTitle', 'donor'));
    }

    public function donorSearch(Request $request)
    {
        $request->validate([
            'blood_id' => 'nullable|exists:bloods,id',
            'division_id' => 'nullable|exists:divisions,id',
            'city_id' => 'nullable|exists:cities,id',
            'localtion_id' => 'nullable|exists:locations,id',
        ]);
        $divisions = Division::where('status', 1)->select('id', 'name')->get();
        $locations = Location::where('status', 1)->select('id', 'name')->get();
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $cities = City::where('status', 1)->select('id', 'name')->get();
        $pageTitle = "Donor Search";
        $emptyMessage = "No data found";
        $divisionId = $request->division_id;
        $locationId = $request->location_id;
        $cityId = $request->city_id;
        $bloodId = $request->blood_id;
        $donors = Donor::where('status', 1);
        if ($request->blood_id) {
            $donors = $donors->where('blood_id', $request->blood_id);
        }
        if ($request->city_id) {
            $donors = $donors->where('city_id', $request->city_id);
        }
        if ($request->location_id) {
            $donors = $donors->where('location_id', $request->location_id);
        }
        if ($request->division_id) {
            $donors = $donors->where('division_id', $request->division_id);
        }
        $donors = $donors->with('blood', 'location')->paginate(getPaginate());
        return view($this->activeTemplate . 'donor', compact('pageTitle', 'emptyMessage', 'donors', 'divisions', 'cities', 'locations', 'bloods', 'locationId', 'cityId', 'divisionId',  'bloodId'));
    }

    public function contactWithDonor(Request $request)
    {
        $request->validate([
            'donor_id' => 'required|exists:donors,id',
            'name' => 'required|max:80',
            'email' => 'required|max:80',
            'message' => 'required|max:500'
        ]);
        $donor = Donor::findOrFail($request->donor_id);
        notify($donor, 'DONOR_CONTACT', [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);
        $notify[] = ['success', 'Request has been submitted'];
        return back()->withNotify($notify);
    }

    public function bloodGroup($slug, $id)
    {
        $blood = Blood::where('status', 1)->where('id', decrypt($id))->firstOrFail();
        $pageTitle = $blood->name . " Blood Group Donor";
        $emptyMessage = "No data found";
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        $cities = City::where('status', 1)->select('id', 'name')->get();
        $locations = Location::where('status', 1)->select('id', 'name')->get();
        $donors = Donor::where('status', 1)->where('blood_id', $blood->id)->with('blood', 'location')->paginate(getPaginate());
        return view($this->activeTemplate . 'donor', compact('pageTitle', 'emptyMessage', 'donors', 'bloods', 'cities', 'locations'));
    }

    public function contact()
    {
        $pageTitle = "Contact Us";
        $sections = Page::where('tempname', $this->activeTemplate)->where('slug', 'contact')->first();
        return view($this->activeTemplate . 'contact', compact('pageTitle', 'sections'));
    }

    public function contactSubmit(Request $request)
    {
        $attachments = $request->file('attachments');
        $allowedExts = array('jpg', 'png', 'jpeg', 'pdf');
        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);
        $random = getNumber();
        $ticket = new SupportTicket();
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = 2;

        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();

        $message = new SupportMessage();
        $message->supportticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $notify[] = ['success', 'ticket created successfully!'];
        return redirect()->route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return redirect()->back();
    }

    public function blog()
    {
        $pageTitle = "Blog";
        $blogs = Frontend::where('data_keys', 'blog.element')->paginate(9);
        $sections = Page::where('tempname', $this->activeTemplate)->where('slug', 'blog')->first();
        return view($this->activeTemplate . 'blog', compact('blogs', 'pageTitle', 'sections'));
    }

    public function blogDetails($id, $slug)
    {
        $blogs = Frontend::where('data_keys', 'blog.element')->latest()->limit(6)->get();
        $blog = Frontend::where('id', $id)->where('data_keys', 'blog.element')->firstOrFail();
        $pageTitle = "Blog Details";
        return view($this->activeTemplate . 'blog_details', compact('blog', 'pageTitle', 'blogs'));
    }

    public function footerMenu($slug, $id)
    {
        $data = Frontend::where('id', $id)->where('data_keys', 'policy_pages.element')->firstOrFail();
        $pageTitle =  $data->data_values->title;
        return view($this->activeTemplate . 'menu', compact('data', 'pageTitle'));
    }

    public function cookieAccept()
    {
        session()->put('cookie_accepted', true);
        $notify = 'Cookie accepted successfully';
        return response()->json($notify);
    }

    public function placeholderImage($size = null)
    {
        $imgWidth = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    public function applyDonor()
    {
        $pageTitle = "Apply as a Donor";
        $data['divisions'] = Division::get(["name", "id"]);
        $bloods = Blood::where('status', 1)->select('id', 'name')->get();
        return view($this->activeTemplate . 'apply_donor', $data, compact('pageTitle', 'bloods'));
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

    public function applyDonorstore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:80',
            'gender' => 'required|in:1,2',
            'division' => 'required|exists:divisions,id',
            'city' => 'required|exists:cities,id',
            'location' => 'required|exists:locations,id',
            'religion' => 'required|max:40',
            'blood' => 'required|exists:bloods,id',
            'last_donate' => 'date_format:d/m/Y',
            'birth_date' => 'required|date_format:d/m/Y',
            // 'email' => 'required|email|max:60|unique:donors,email',
            // 'facebook' => 'required',
            'imageUpload' => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            'phone' => 'required|max:40|unique:donors,phone',
            // 'phone2' => 'required|max:40|unique:donors,phone2',
            'password' => 'required|confirmed|min:6',
            'term' => 'accepted',
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

        // if ($request->hasFile('image')) {
        //     try {
        //         $filename = uploadImage($request->image, $path, $size);
        //     } catch (\Exception $exp) {
        //         $notify[] = ['error', 'Image could not be uploaded.'];
        //         return back()->withNotify($notify);
        //     }
        //     $donor->image = $filename;
        // }
        $donor->phone = $request->phone;
        $donor->phone2 = $request->phone2;
        $donor->password = Hash::make($request->password);
        $donor->save();
        $notify[] = ['success', 'Your Requested Submitted'];
        return back()->withNotify($notify);
    }

    public function adclicked($id)
    {
        $ads = Advertisement::where('id', decrypt($id))->firstOrFail();
        $ads->click += 1;
        $ads->save();
        return redirect($ads->redirect_url);
    }

    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $if_exist = Subscriber::where('email', $request->email)->first();
        if (!$if_exist) {
            Subscriber::create([
                'email' => $request->email
            ]);
            return response()->json(['success' => 'Subscribed Successfully']);
        } else {
            return response()->json(['error' => 'Already Subscribed']);
        }
    }
}
