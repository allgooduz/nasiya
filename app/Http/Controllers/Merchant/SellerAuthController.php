<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\SellerCompany;
use App\Models\SellerCompanyOwner;
use App\Models\Sellerphone;
use App\Models\User;
use App\SellerCompany as AppSellerCompany;
use App\SellerCompanyOwner as AppSellerCompanyOwner;
use App\Sellerphone as AppSellerphone;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use function Ramsey\Uuid\v1;

class SellerAuthController extends Controller
{
    public function index()
    {
        return view('auth.myregister');
    }

    public function register_form_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            // 'fathername' => 'required',
            // 'birthday' => 'required',
            'phone_number' => 'required',
            'company_name' => 'required',
            // 'company_inn' => 'required',
            // 'company_oked' => 'required',
            // 'company_identification' => 'required',
            // 'company_official_name' => 'required',
            // 'bank_code_mfo' => 'required',
            // 'company_checking_account' => 'required',
            // 'bank_name' => 'required',
            'password' => 'required',
            'password_again' => 'required'
        ]);

        $check = AppSellerphone::where('phone_number', $request->phone_number)->first();
        $check_owner = AppSellerCompanyOwner::where('phone_number', $request->phone_number)->first();

        $newPhone = preg_replace("/[^0-9]/", "", $request->phone_number);

        if (empty($check) && empty($check_owner)) {
            if ($request->password === $request->password_again) {

                /*
                $seller_owner = SellerCompanyOwner::create([
                    'name' => $request->name,
                    'last_name' => $request->lastname,
                    'father_name' => $request->fathername,
                    'birthday' => $request->birthday,
                    'phone_number' => $request->phone_number
                ]);
                */

                $seller_owner = User::create([
                    'role_id' => "3",
                    'name' => $request->name,
                    'last_name' => $request->lastname,
                    // 'father_name' => $request->fathername,
                    'email' => "sellerallgood@gmail.com",
                    'birthday' => "2021-12-12",
                    'password' => Hash::make($request->password),
                    'phone_number' => $newPhone
                ]);

                if (!empty($request->company_identification)) {
                    $image = Helper::storeImage($request->company_identification, 'avatar', 'sellers');
                    $company_identification = $image;
                }else{
                    $company_identification = '';
                }

                $seller_company = AppSellerCompany::create([
                    'owner_id' => $seller_owner->id,
                    'company_name' => $request->company_name,
                    // 'company_inn' => $request->company_inn,
                    // 'company_oked' => $request->company_oked,
                    // 'company_identification_file' => $company_identification,
                    // 'company_official_name' => $request->company_official_name,
                    // 'company_checking_account' => $request->company_checking_account,
                    // 'bank_code_mfo' => $request->bank_code_mfo,
                    // 'bank_name' => $request->bank_name,
                    'password' => Hash::make($request->password),
                    'phone_number' => $newPhone
                ]);

                /*
                SellerCompanyOwner::where('id', $seller_owner->id)->update([
                    'company_id' => $seller_company->id
                ]);*/

                $updatedPerson = User::where('phone_number', $newPhone)->first();
                if (!empty($updatedPerson)) {
                    User::where('phone_number', $newPhone)->update([
                        'role_id' => "3",
                        'company_id' => $seller_company->id
                    ]);
                }

                User::where('id', $seller_owner->id)->update([
                    'role_id' => "3",
                    'company_id' => $seller_company->id
                ]);

                AppSellerphone::create([
                    'phone_number' => $newPhone
                ]);

                // return redirect()->back()->with('success', "Muvaffaqiyatli qabul qilindi!");
                return redirect()->to('http://merchant.allgood.uz');
            }else{
                return redirect()->back()->with('danger', "Parollar bir-biriga mos emas!");
            }
        }else{
            return redirect()->back()->with('danger', "Bu telefon raqam oldin ro'yxatdan o'tgan!");
        }
    }
}
