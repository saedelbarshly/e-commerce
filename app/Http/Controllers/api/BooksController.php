<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sections;
use App\Books;
use App\User;
use App\Writers;
use App\BookReviews;
use Response;

class BooksController extends Controller
{
    public function sections(Request $request)
    {
        $lang = $request->header('lang');
        $main_section = $request->header('section');
        if ($lang == '') {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.pleaseSendLangCode'),
                'data' => []
            ];
            return response()->json($resArr);
        }

        $sections = Sections::where('main_section',$main_section)
                                ->orderBy('name_'.$lang)
                                ->get();
        $list = [];
        foreach ($sections as $key => $value) {
            $list[] = $value->apiData($lang);
        }
        $resArr = [
            'status' => 'success',
            'message' => '',
            'data' => $list
        ];
        return response()->json($resArr);

    }
    public function sectionDetails(Request $request,$sectionId)
    {
        $lang = $request->header('lang');
        $main_section = $request->header('section');
        if ($lang == '') {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.pleaseSendLangCode'),
                'data' => []
            ];
            return response()->json($resArr);
        }

        $section = Sections::find($sectionId);
        $resArr = [
            'status' => 'success',
            'message' => '',
            'data' => $section != '' ? $section->apiData($lang) : ''
        ];
        return response()->json($resArr);

    }
    public function books(Request $request)
    {
        $lang = $request->header('lang');
        $user_id = $request->header('user');
        $currency = $request->header('currency');
        $section = $request->section;
        $publisher = $request->publisher;
        $writer = $request->writer;
        $name = $request->name;
        $language = $request->language;
        $type = $request->type;
        $rate = $request->rate;
        if ($lang == '') {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.pleaseSendLangCode'),
                'data' => []
            ];
            return response()->json($resArr);
        }

        if ($user_id != '') {
            $user = User::find($user_id);
        } else {
            $user = '';
        }

        //select from books
        $books = Books::where('available',1)->orderBy('id','desc');

        //if selected section
        if ($section != '') {
            $sectionIds = [];
            $sectionData = Sections::find($section);
            if ($sectionData != '') {
                $sectionIds[] = $section;
                if ($sectionData->subSections != '') {
                    foreach ($sectionData->subSections as $key => $subSection) {
                        $sectionIds[] = $subSection->id;
                    }
                }
            }
            $books = $books->whereIn('section_id',$sectionIds);
        }

        //if selected writer
        if ($writer != '') {
            $writerData = Writers::find($writer);
            if ($writerData != '') {
                $books = $books->where('writer_id',$writer);
            }
        }

        //if selected publisher
        if ($publisher != '') {
            $publisherData = User::find($publisher);
            if ($publisherData != '') {
                $books = $books->where('publisher_id',$publisher);
            }
        }

        //if selected publisher
        if ($rate != '') {
            $books = $books->where('review_sum','>=',$rate);
        }


        //if selected publisher
        if ($language != '') {
            $books = $books->where('language',$language);
        }

        if ($name != '') {
            $books = $books->where('name_ar', 'LIKE', "%".$name."%");
        }
        $books = $books->paginate(12);

        $list = [];
        foreach ($books as $key => $value) {
            if ($value->publisher != '') {
                $data = $value->apiData($lang,null,$currency);
                $data['isLiked'] = 0;
                $data['favOrder'] = 0;
                if ($user != '') {
                    if ($user->favorites()->where('book_id',$value->id)->first() != '') {
                        $data['isLiked'] = 1;
                        $data['favOrder'] = $user->favorites()->where('book_id',$value->id)->first()->id;
                    }
                }
                $list[] = $data;
            }
        }
        $resArr = [
            'status' => 'success',
            'message' => '',
            'data' => $list,
            'paginationData' => $books
        ];
        return response()->json($resArr);

    }
    public function bookDetails(Request $request, $id)
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
        if ($user_id != '') {
            $user = User::find($user_id);
        } else {
            $user = '';
        }

        //select from books
        $bookDetails = Books::find($id);
        $list = $bookDetails->apiData($lang,'1');
        $list['isLiked'] = 0;
        $list['favOrder'] = 0;
        if ($user != '') {
            if ($user->favorites()->where('book_id',$bookDetails->id)->first() != '') {
                $list['isLiked'] = 1;
                $list['favOrder'] = $user->favorites()->where('book_id',$bookDetails->id)->first()->id;
            }
        }
        $resArr = [
            'status' => 'success',
            'message' => '',
            'data' => $list
        ];
        return response()->json($resArr);

    }
    public function bookSubmitReview(Request $request, $id)
    {
        $lang = $request->header('lang');
        if ($lang == '') {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.pleaseSendLangCode'),
                'data' => []
            ];
            return response()->json($resArr);
        }
        $user_id = $request->header('user');

        $rules = [
            'rate' => 'required'
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

        $book = Books::find($id);
        $user = User::find($user_id);

        if ($book == '') {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.productNotFound'),
                'data' => []
            ];
            return $resArr;
        }

        $oldReview = BookReviews::where('user_id',$user_id)->where('book_id',$id)->first();
        if ($oldReview != '') {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.youHaveEnteredReviewBefore'),
                'data' => []
            ];
            return $resArr;
        }
        $data = $request->except(['_token']);
        $data['status'] = 0;
        $data['book_id'] = $id;
        $data['user_id'] = $user_id;
        $BookReviews = BookReviews::create($data);
        if ($BookReviews) {
            $notificationText = notificationTextTranslate([
                                            'name' => $user['name'],
                                            'type' => 'newBookReview'
                                        ],
                                        'ar');
            $notificationData = [
                'type' => 'newBookReview',
                'linked_id' => $id,
                'text' => $notificationText,
                'date' => date('Y-m-d'),
                'time' => date('H:i')
            ];
            notifyManagers('newBookReview',$notificationData);
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

}
