<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\AdminSetting;
use App\Models\Instructor;
use App\Models\Student;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LicenseBoxAPI;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
		$instr = $request->all();
		
        $request->validate([
            'email' => 'bail|required|unique:instructors',
            'name' => 'bail|required|min:4|max:50',
            'password' => 'bail|required|min:6|max:50',
			'g-recaptcha-response' => 'required|recaptchav3:register,0.5'
		]);
		
		$instr['slug'] = \Str::slug(strtolower($instr['name']));
		$slrow = Instructor::where('slug',$instr['slug'])->get();
		if(count($slrow)>0) $instr['slug'] .= count($slrow);
        $user = Instructor::create($instr);
        $as = AdminSetting::find(11);

        Auth::guard('author')->loginUsingId($user->id);
        if ($as->value == 1) {
            $user->sendEmailVerificationNotification();
            return redirect('author/email/verify');
        } else {
            $user->markEmailAsVerified();
            return redirect('author/login')->withStatus(__('Thanks to register with us'));
        }
    }

    public function registerView()
    {
        $seo = AdminSetting::whereIn('id', [28, 29, 30, 31, 32])->get();

        JsonLdMulti::setTitle('Sign-up with ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::twitter()->setTitle('Sign-up with ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOMeta::setTitle('Sign-up with ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::setTitle('Sign-up with ' . env('APP_NAME') ?? env('APP_NAME'));

        JsonLdMulti::setDescription($seo[1]['value'] ?? null);
        SEOMeta::setDescription($seo[1]['value'] ?? null);
        SEOTools::setDescription($seo[1]['value'] ?? null);

        SEOMeta::addKeyword($seo[2]['value'] ?? null);
        SEOTools::opengraph()->addProperty('keywords', $seo[2]['value'] ?? null);

        JsonLdMulti::addImage(static_asset('frontend/images/seoimage.png'));
        SEOTools::opengraph()->addProperty('image', static_asset('frontend/images/logo.svg'));
        SEOTools::jsonLd()->addImage(static_asset('frontend/images/seoimage.png'));
        return view('frontend.instructor.auth.register');
    }

    public function LoginView()
    {
        $seo = AdminSetting::whereIn('id', [28, 29, 30, 31, 32])->get();

        JsonLdMulti::setTitle('Sign-in with ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::twitter()->setTitle('Sign-in with ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOMeta::setTitle('Sign-in with ' . env('APP_NAME') ?? env('APP_NAME'));
        SEOTools::setTitle('Sign-in with ' . env('APP_NAME') ?? env('APP_NAME'));

        JsonLdMulti::setDescription($seo[1]['value'] ?? null);
        SEOMeta::setDescription($seo[1]['value'] ?? null);
        SEOTools::setDescription($seo[1]['value'] ?? null);

        SEOMeta::addKeyword($seo[2]['value'] ?? null);
        SEOTools::opengraph()->addProperty('keywords', $seo[2]['value'] ?? null);

        JsonLdMulti::addImage(static_asset('frontend/images/seoimage.png'));
        SEOTools::opengraph()->addProperty('image', static_asset('frontend/images/logo.svg'));
        SEOTools::jsonLd()->addImage(static_asset('frontend/images/seoimage.png'));
        return view('frontend.instructor.auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::guard('author')->attempt(['email' => $request->email, 'provider' => 'LOCAL', 'password' => $request->password], $request->get('remember'))) {
            $api = new LicenseBoxAPI();
            $res = $api->verify_license();

            if ($res['status'] !== true) {
                AdminSetting::find(42)->update(['value' => 0]);
                return redirect('activeLicence');
            } else {
                AdminSetting::find(42)->update(['value' => 1]);
               
            }
            $user = Auth::guard('author')->user();

            if ($user->status != 1) {

                Auth::guard('author')->logout();
                return back()->withInput($request->only('email', 'remember'))->withStatus(__('You are block by admin.'));
            }

            if ($user->hasVerifiedEmail()) {

                return redirect('author/home')->withStatus(__('We Happy to see you.'));
            } else {
                return redirect('author/email/verify');
            }

            return redirect('author/home')->withStatus(__('We Happy to see you.'));
        }
        return back()->withInput($request->only('email', 'remember'))->withStatus(__('Your credentials does not match with our record'));
    }
    public function studentRegister(Request $request)
    {

        $request->validate([
            'email' => 'bail|required|unique:students',
            'name' => 'bail|required|min:4|max:50',
            'password' => 'bail|required|min:6|max:50',
			'g-recaptcha-response' => 'required|recaptchav3:register,0.5'
		]);
		
        $user = Student::create($request->all());

        $as = AdminSetting::find(12);

        Auth::guard('customer')->loginUsingId($user->id);
        if ($as->value == 1) {
            $user->sendEmailVerificationNotification();
            return redirect('email/verify');
        } else {
            $user->markEmailAsVerified();
            return redirect('login')->withStatus(__('Thanks to register with us'));
        }
    }
    public function studentLogin(Request $request)
    {
        if (Auth::guard('customer')->attempt(['email' => $request->email, 'provider' => 'LOCAL', 'password' => $request->password], $request->get('remember'))) {
            $api = new LicenseBoxAPI();
            $res = $api->verify_license();

            if ($res['status'] !== true) {
                AdminSetting::find(42)->update(['value' => 0]);
                return redirect('activeLicence');
            } else {
                AdminSetting::find(42)->update(['value' => 1]);
               
            }
            $user = Auth::guard('customer')->user();
            if ($user->status != 1) {
                Auth::guard('customer')->logout();
                return back()->withInput($request->only('email', 'remember'))->withStatus(__('You are block by admin.'));
            }

            if ($user->hasVerifiedEmail()) {

                return redirect('/')->withStatus(__('We Happy to see you.'));
            } else {
                return redirect('email/verify');
            }
        }
        return back()->withInput($request->only('email', 'remember'))->withStatus(__('Your credentials does not match with our record'));
    }
}
