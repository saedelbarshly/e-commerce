<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FAQs;
use App\Models\Settings;
use App\Currencies;
use App\Countries;
use App\Models\Pages;
use Response;

class StaticPagesController extends Controller
{
    public function getLocationInfo()
    {
        $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".$this->getRealIpAddr());
        $country = Countries::where('iso',$xml->geoplugin_countryCode)->first();
        //return $xml;
        $resArr = [
            'status' => 'success',
            'message' => '',
            'data' => [
                'countryCode' => $country != '' ? $country['iso'] : 'UA',
                'countryId' => $country != '' ? $country['id'] : 224
            ]
        ];
        return response()->json($resArr);
    }
    public function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    public function faqs(Request $request)
    {
        $lang = $request->header('lang');
        $count = $request->header('count');
        if ($lang == '') {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.pleaseSendLangCode'),
                'data' => []
            ];
            return response()->json($resArr);
        }

        $faqs = FAQs::where('type','user')->orderBy('ranking','asc')->orderBy('id','desc');
        if ($count == 'all') {
            $faqs = $faqs->get();
        } else {
            $faqs = $faqs->take($count)->get();
        }

        $list = [];
        foreach ($faqs as $key => $value) {
            $list[] = [
                'question' => $value['question_'.$lang],
                'answer' => $value['answer_'.$lang]
            ];
        }
        $resArr = [
            'status' => 'success',
            'message' => '',
            'data' => $list
        ];
        return response()->json($resArr);

    }
    public function generalSettings(Request $request)
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

        $list = [
            'SEO' => [
                'siteTitle' => getSettingValue('siteTitle_'.$lang),
                'siteDescription' => getSettingValue('siteDescription_'.$lang),
                'siteKeywords' => getSettingValue('siteKeywords_'.$lang),
            ],
            'social' => [
                'facebook' => getSettingValue('facebook'),
                'twitter' => getSettingValue('twitter'),
                'instagram' => getSettingValue('instagram'),
                'youtube' => getSettingValue('youtube')
            ],
            'images' => [
                'logo' => getSettingImageLink('logo'),
            ],
            'contact_data' => [
                'phone' => getSettingValue('phone'),
                'mobile' => getSettingValue('mobile'),
                'email' => getSettingValue('email'),
                'map' => getSettingValue('map'),
                'address' => getSettingValue('address')
            ]
        ];
        $resArr = [
            'status' => 'success',
            'message' => '',
            'data' => $list
        ];
        return response()->json($resArr);

    }

    public function getHomeSliderArr($lang)
    {
        $array = [];
        for ($i=0; $i < 5; $i++) {
            if (getSettingValue('home_slide'.$i.'title_'.$lang) != '') {
                $array[] = [
                    'image' => getSettingImageLink('home_slide'.$i.'img'),
                    'title' => getSettingValue('home_slide'.$i.'title_'.$lang),
                    'des' => getSettingValue('home_slide'.$i.'des_'.$lang),
                    'button_text' => getSettingValue('home_slide'.$i.'btnTxt_'.$lang),
                    'link' => getSettingValue('home_slide'.$i.'btnLink')
                ];
            }
        }
        return $array;
    }

    public function getCurrenciesArr($lang,$country = null)
    {
        $default = Currencies::where('primary','1')->first();
        $currencies = [$default->apiData($lang)];
        if ($country != null) {
            $countryData = Countries::find($country);
            $currencies[] = $countryData->currencyDetails->apiData($lang);
        }
        return $currencies;
    }

    public function countriesList($lang)
    {
        $countries = Countries::orderBy('name_'.$lang)->get();
        $list = [];
        foreach ($countries as $key => $country) {
            $list[] = [
                'id' => $country['id'],
                'name' => $country['name_'.$lang] != '' ? $country['name_'.$lang] : $country['name_en']
            ];
        }
        return $list;
    }

    public function pages(Request $request)
    {
      $lang = $request->header('lang');
      if ($lang == '') {
        $resArr = [
          'status' => 'faild',
          'message' => trans('api.pleaseSendLangCode'),
        ];
        return response()->json($resArr);
      }
      $pages = Pages::orderBy('id','desc')->get();
      $list = [];
      foreach ($pages as $page) {
        $list[] = $page->apiData($lang);
      }
      $resArr = [
        'status' => 'success',
        'data' => $list
      ];
      return response()->json($resArr);
    }

}
