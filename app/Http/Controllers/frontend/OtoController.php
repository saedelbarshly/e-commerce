<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class OtoController extends Controller
{
  public function refreshToken()
  {
    $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.tryoto.com/rest/v2/refreshToken',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
      "refresh_token":"AMf-vBz8vGx_dp0JyTHHN4zEwbf61X_068cGsD4MqjCQq9xdQNvopiUw_lOOx8bztiMqSSoMWa78XFVVAsFsDiAnkuibpzAySeaTIu2YuaQTwvhSjY2RENejqPLeVO9W2I4Atu6v09DmNQh1cUbayyLzjXOAy9_k5HkeLwkZpS6uJTRB1N4jFP-FkOSU8MhSV8YhYF5_0aPw7mcdilpMU_M-lq79I8GNuQ"
  }',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json'
    ),
));

$response = curl_exec($curl);

curl_close($curl);
  return response()->json(compact('response'));
  }

  public function test()
  {
    $response = Http::get('https://jsonplaceholder.typicode.com/posts');
    return response()->json(compact('response'));
  }
}
