<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserPaymentMethods;
use App\Models\UserFavorites;
use App\Models\UserAddress;
use App\Models\User;
use Auth;
use Response;

class UserController extends Controller
{
    //
    public function deleteAccount(Request $request)
    {
        $lang = $request->header('lang');
        $user_id = $request->header('user');
        if ($lang == '') {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.pleaseSendLangCode'),
                'data' => []
            ];
            return response()->json($resArr);
        }

        $user = User::find($user_id);
        if ($user == '') {
            return response()->json([
                'status' => 'faild',
                'message' => trans('api.thisUserDoesNotExist'),
                'data' => []
            ]);
        }
        $user->delete();
        $user->bookReviews()->delete();
        $resArr = [
            'status' => 'success',
            'message' => trans('api.yourAccountHasBeenDeleted'),
            'data' => []
        ];
        return response()->json($resArr);
    }
    public function myProfile(Request $request)
    {
        $lang = $request->header('lang');
        $user_id = $request->header('user');
        if ($lang == '') {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.pleaseSendLangCode'),
                'data' => []
            ];
            return response()->json($resArr);
        }

        $user = User::find($user_id);
        if ($user == '') {
            return response()->json([
                'status' => 'faild',
                'message' => trans('api.thisUserDoesNotExist'),
                'data' => []
            ]);
        }
        $resArr = [
            'status' => 'success',
            'message' => '',
            'data' => $user->apiData($lang)
        ];
        return response()->json($resArr);
    }
    public function UpdateMyProfile(Request $request)
    {
        $lang = $request->header('lang');
        $user_id = $request->header('user');

        if (checkUserForApi($lang, $user_id) !== true) {
            return checkUserForApi($lang, $user_id);
        }

        $rules = [
                    'name' => 'nullable',
                    'email' => 'nullable|email|unique:users,email,'.$user_id,
                    'phone' => 'nullable|unique:users,phone,'.$user_id,
                    'country' => 'nullable',
                    // 'governorate' => 'nullable',
                    'city' => 'nullable',
                    'password' => 'nullable',
                    'userName' => 'nullable',
                    'photo' => 'nullable|image'
                ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            foreach ((array)$validator->errors() as $error) {
                return response()->json([
                    'status' => 'faild',
                    'message' => trans('api.pleaseRecheckYourDetails'),
                    'data' => $error
                ]);
            }
        }

        $data = $request->except(['_token','password','photo']);
        // $data['country'] = getCountryByIso($request->country)['id'];
        if ($request['password'] != '') {
            $data['password'] = bcrypt($request['password']);
        }
        $user = User::find($user_id);

        if ($request->photo != '') {
            if ($user->photo != '') {
                delete_image('users/'.$user->id , $user->photo);
            }
            $data['photo'] = upload_image_without_resize('users/'.$user->id , $request->photo );
        }

        if ($user->update($data)) {
            $resArr = [
                'status' => 'success',
                'message' => trans('api.yourDataHasBeenSavedSuccessfully'),
                'data' => $user->apiData($lang)
            ];
        } else {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.someThingWentWrong'),
                'data' => []
            ];
        }
        return response()->json($resArr);

    }

    public function myNotification(Request $request)
    {
        $lang = $request->header('lang');
        $user_id = $request->header('user');
        if ($lang == '') {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.pleaseSendLangCode'),
                'data' => []
            ];
            return response()->json($resArr);
        }

        $user = User::find($user_id);
        if ($user == '') {
            return response()->json([
                'status' => 'faild',
                'message' => trans('api.thisUserDoesNotExist'),
                'data' => []
            ]);
        }
        $resArr = [
            'status' => 'success',
            'message' => '',
            'data' => $user->notifications()->paginate(20)
        ];
        return response()->json($resArr);
    }

    public function markNotificationsAsRead(Request $request)
    {
        $lang = $request->header('lang');
        $user_id = $request->header('user');
        if ($lang == '') {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.pleaseSendLangCode'),
                'data' => []
            ];
            return response()->json($resArr);
        }

        $user = User::find($user_id);
        $user->notifications()->unreadNotifications->markAsRead();
        if ($user == '') {
            return response()->json([
                'status' => 'faild',
                'message' => trans('api.thisUserDoesNotExist'),
                'data' => []
            ]);
        }
        $resArr = [
            'status' => 'success',
            'message' => trans('api.allYourNotificationsHasMarkedAsRead'),
            'data' => []
        ];
        return response()->json($resArr);
    }



    public function createAddress(Request $request)
    {
        $lang = $request->header('lang');
        $user_id = $request->header('user');

        if (checkUserForApi($lang, $user_id) !== true) {
            return checkUserForApi($lang, $user_id);
        }

        $rules = [
                    'postal_code' => 'nullable',
                    'country' => 'required',
                    // 'governorate' => 'required',
                    'city' => 'required',
                    'address' => 'required',
                    'phone' => 'required'
                ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            foreach ((array)$validator->errors() as $error) {
                return response()->json([
                    'status' => 'faild',
                    'message' => trans('api.pleaseRecheckYourDetails'),
                    'data' => $error
                ]);
            }
        }

        $data = $request->except(['_token']);
        $data['user_id'] = $user_id;
        $address = UserAddress::create($data);
        if ($address->update($data)) {
            $resArr = [
                'status' => 'success',
                'message' => trans('api.yourDataHasBeenSavedSuccessfully'),
                'data' => $address->apiData($lang)
            ];
        } else {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.someThingWentWrong'),
                'data' => []
            ];
        }
        return response()->json($resArr);

    }
    public function myAddressList(Request $request)
    {
        $lang = $request->header('lang');
        $user_id = $request->header('user');

        if (checkUserForApi($lang, $user_id) !== true) {
            return checkUserForApi($lang, $user_id);
        }

        $addressList = UserAddress::where('user_id',$user_id)->orderBy('id','desc')->get();
        $list = [];
        foreach ($addressList as $key => $value) {
            $list[] = [
                'id' => $value['id'],
                'country' => $value->countryData(),
                'city' => $value->cityData(),
                // 'country' => [
                //     'id' => $value->countryData->id,
                //     'name' => $value->countryData['name_'.$lang]
                // ],
                // 'governorate' => [
                //     'id' => $value->governorateData->id,
                //     'name' => $value->governorateData['name_'.$lang]
                // ],
                // 'city' => [
                //     'id' => $value->cityData()['id'],
                //     'name' => $value->cityData()['name']
                // ],
                'address' => $value['address'],
                'phone' => $value['phone'],
                'postal_code' => $value['postal_code']
            ];
        }
        $resArr = [
            'status' => 'success',
            'message' => '',
            'data' => $list
        ];
        return response()->json($resArr);

    }
    public function AddressDetails(Request $request, $id)
    {
        $lang = $request->header('lang');
        $user_id = $request->header('user');

        if (checkUserForApi($lang, $user_id) !== true) {
            return checkUserForApi($lang, $user_id);
        }

        $address = UserAddress::find($id);
        if ($address != '') {
            $resArr = [
                'status' => 'success',
                'message' => '',
                'data' => $address
            ];
        } else {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.someThingWentWrong'),
                'data' => []
            ];
        }
        return response()->json($resArr);

    }

    public function UpdateAddress(Request $request, $id)
    {
        $lang = $request->header('lang');
        $user_id = $request->header('user');

        if (checkUserForApi($lang, $user_id) !== true) {
            return checkUserForApi($lang, $user_id);
        }

        $rules = [
            'postal_code' => 'nullable',
            'country' => 'required',
            // 'governorate' => 'required',
            'city' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            foreach ((array)$validator->errors() as $error) {
                return response()->json([
                    'status' => 'faild',
                    'message' => trans('api.pleaseRecheckYourDetails'),
                    'data' => $error
                ]);
            }
        }

        $data = $request->except(['_token']);
        $address = UserAddress::find($id);
        if ($address->update($data)) {
            $resArr = [
                'status' => 'success',
                'message' => trans('api.yourDataHasBeenSavedSuccessfully'),
                'data' => $address
            ];
        } else {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.someThingWentWrong'),
                'data' => []
            ];
        }
        return response()->json($resArr);

    }
    public function DeleteAddress(Request $request, $id)
    {
        $lang = $request->header('lang');
        $user_id = $request->header('user');

        if (checkUserForApi($lang, $user_id) !== true) {
            return checkUserForApi($lang, $user_id);
        }

        $address = UserAddress::find($id);
        if ($address->delete()) {
            $resArr = [
                'status' => 'success',
                'message' => trans('api.yourDataHasBeenSavedSuccessfully'),
                'data' => []
            ];
        } else {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.someThingWentWrong'),
                'data' => []
            ];
        }
        return response()->json($resArr);

    }

    public function createFavorite(Request $request)
    {
        $lang = $request->header('lang');
        $user_id = $request->header('user');

        if (checkUserForApi($lang, $user_id) !== true) {
            return checkUserForApi($lang, $user_id);
        }

        $rules = [
                    'book_id' => 'required',
                ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            foreach ((array)$validator->errors() as $error) {
                return response()->json([
                    'status' => 'faild',
                    'message' => trans('api.pleaseRecheckYourDetails'),
                    'data' => $error
                ]);
            }
        }

        $data = $request->except(['_token']);
        $data['user_id'] = $user_id;
        $checkOldFav = UserFavorites::where('book_id',$request->book_id)->where('user_id',$user_id)->first();
        if ($checkOldFav != '') {
            $resArr = [
                'status' => 'success',
                'message' => trans('api.yourDataHasBeenSavedSuccessfully'),
                'data' => $checkOldFav
            ];
            return $resArr;
        }
        $Favorite = UserFavorites::create($data);
        if ($Favorite->update($data)) {
            $resArr = [
                'status' => 'success',
                'message' => trans('api.yourDataHasBeenSavedSuccessfully'),
                'data' => $Favorite
            ];
        } else {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.someThingWentWrong'),
                'data' => []
            ];
        }
        return response()->json($resArr);

    }
    public function myFavoriteList(Request $request)
    {
        $lang = $request->header('lang');
        $user_id = $request->header('user');

        if (checkUserForApi($lang, $user_id) !== true) {
            return checkUserForApi($lang, $user_id);
        }

        $fav = UserFavorites::where('user_id',$user_id)->orderBy('id','desc')->get();
        $list = [];
        foreach ($fav as $key => $value) {
            if ($value->apiData($lang)['book'] == '') {
                $favSingle = UserFavorites::find($value->id)->delete();
            } else {
                $list[] = $value->apiData($lang);
            }
        }
        $resArr = [
            'status' => 'success',
            'message' => '',
            'data' => $list
        ];
        return response()->json($resArr);

    }

    public function DeleteFavorite(Request $request, $id)
    {
        $lang = $request->header('lang');
        $user_id = $request->header('user');

        if (checkUserForApi($lang, $user_id) !== true) {
            return checkUserForApi($lang, $user_id);
        }

        $Favorite = UserFavorites::find($id);
        if ($Favorite->delete()) {
            $resArr = [
                'status' => 'success',
                'message' => trans('api.yourDataHasBeenSavedSuccessfully'),
                'data' => []
            ];
        } else {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.someThingWentWrong'),
                'data' => []
            ];
        }
        return response()->json($resArr);

    }


    public function sendResetCode(Request $request)
    {
        $lang = $request->header('lang');

        $rules = [
            'email' => 'required|email'
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            foreach ((array)$validator->errors() as $error) {
                return response()->json([
                    'status' => 'faild',
                    'message' => trans('api.pleaseRecheckYourDetails'),
                    'data' => $error
                ]);
            }
        }

        $data = $request->except(['_token']);
        $checkUser = user::where('email',$request->email)->first();
        if ($checkUser == '') {
            return [
                'status' => 'faild',
                'message' => trans('api.thisUserDoesNotExist'),
                'data' => []
            ];
        }
        $randCode = rand(100000,999999);
        $checkUser->update(['resetCode'=>$randCode]);

        $notificationData = [
            'resetCode' => $randCode
        ];
        $checkUser->notify(new \App\Notifications\UserResetPasswordCodeEmail($notificationData));
        $notificationData = [
            'type' => 'resetPasswordCode',
            'linked_id' => $checkUser->id,
            'text' => trans('api.weHaveSentYouAresetCode'),
            'date' => date('Y-m-d'),
            'time' => date('H:i')
        ];
        $checkUser->notify(new \App\Notifications\AdminNotifications($notificationData));

        $resArr = [
            'status' => 'success',
            'message' => trans('api.weHaveSentYouAresetCode'),
            'data' => []
        ];
        return response()->json($resArr);

    }

    public function resetMyPassword(Request $request)
    {
        $lang = $request->header('lang');
        $rules = [
            'email' => 'required|email',
            'resetCode' => 'required',
            'password' => 'required'
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            foreach ((array)$validator->errors() as $error) {
                return response()->json([
                    'status' => 'faild',
                    'message' => trans('api.pleaseRecheckYourDetails'),
                    'data' => $error
                ]);
            }
        }

        $data = $request->except(['_token']);
        $checkUser = user::where('email',$request->email)->first();
        if ($checkUser == '') {
            return [
                'status' => 'faild',
                'message' => trans('api.thisUserDoesNotExist'),
                'data' => []
            ];
        }
        if ($checkUser->resetCode != $request['resetCode']) {
            return [
                'status' => 'faild',
                'message' => trans('api.yourCodeIsWrong'),
                'data' => []
            ];
        }
        $checkUser->update(['password'=> bcrypt($request['password'])]);
        $notificationData = [];
        $checkUser->notify(new \App\Notifications\UserResetPasswordSuccessEmail($notificationData));
        $notificationData = [
            'type' => 'ResetPasswordSuccess',
            'linked_id' => $checkUser->id,
            'text' => trans('api.yourPasswordHaveBeenResetSuccessfuly'),
            'date' => date('Y-m-d'),
            'time' => date('H:i')
        ];
        $checkUser->notify(new \App\Notifications\AdminNotifications($notificationData));

        $resArr = [
            'status' => 'success',
            'message' => trans('api.yourPasswordHaveBeenResetSuccessfuly'),
            'data' => []
        ];
        return response()->json($resArr);

    }
}
