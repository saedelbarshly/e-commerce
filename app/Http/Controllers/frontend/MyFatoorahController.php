<?php

namespace App\Http\Controllers\frontend;
use Exception;
use App\Models\Orders;
use App\Models\Product;
use App\Models\OrderItems;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\orderAddress;
use App\Repositories\Cart\CartRepository;
use Egulias\EmailValidator\Result\Reason\UnclosedQuotedString;
use MyFatoorah\Library\PaymentMyfatoorahApiV2;

class MyFatoorahController extends Controller {

    public $mfObj;

//-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * create MyFatoorah object
     */
    public function __construct() {
        $this->mfObj = new PaymentMyfatoorahApiV2(config('myfatoorah.api_key'), config('myfatoorah.country_iso'), config('myfatoorah.test_mode'));
    }

//-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * Create MyFatoorah invoice
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try {
            $paymentMethodId = 0; // 0 for MyFatoorah invoice or 1 for Knet in test mode

            $curlData = $this->getPayLoadData();
            $data     = $this->mfObj->getInvoiceURL($curlData, $paymentMethodId);
            return redirect()->to($data['invoiceURL']);
            $response = ['IsSuccess' => 'true', 'Message' => 'Invoice created successfully.', 'Data' => $data];
        } catch (\Exception $e) {
            $response = ['IsSuccess' => 'false', 'Message' => $e->getMessage()];
        }
        return response()->json($response);
    }

//-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     *
     * @param int|string $orderId
     * @return array
     */
    private function getPayLoadData($orderId = null) {
        $callbackURL = route('myfatoorah.callback');
		$user = Auth::user();
        $data = $user->addresses()->latest()->first();
      	$order = $user->myOrders()->latest()->first();
   
        return [
        'CustomerName'       => $data->first_name ." ". $data->last_name,
        'InvoiceValue'       => $order->total,
        'DisplayCurrencyIso' => 'SAR',
        'CustomerEmail'      => $data->email,
        'CallBackUrl'        => $callbackURL,
        'ErrorUrl'           => $callbackURL,
        'MobileCountryCode'  => '+965',
        'CustomerMobile'     => $data->phone,
        'Language'           => app()->getLocale(),
        'CustomerReference'  => $orderId,
        'SourceInfo'         => 'Laravel ' . app()::VERSION . ' - MyFatoorah Package ' . MYFATOORAH_LARAVEL_PACKAGE_VERSION
    ];
      
    }

//-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * Get MyFatoorah payment information
     *
     * @return \Illuminate\Http\Response
     */
  public function callback() {
    try {
      $user = Auth::user();
        $order = $user->myOrders()->latest()->first();
        $data = $this->mfObj->getPaymentStatus(request('paymentId'), 'PaymentId');

        if ($data->InvoiceStatus == 'Paid') {
            $msg = 'Invoice is paid.';
            $order->update([
              'payment_status' => 'paid',
              'status' => 'new'
            ]);
            return redirect()->route('orders.success', ['order' => $order->id]);
        } else if ($data->InvoiceStatus == 'Failed') {
            $msg = 'Invoice is not paid due to ' . $data->InvoiceError;
        } else if ($data->InvoiceStatus == 'Expired') {
            $msg = 'Invoice is expired.';
        }

        return response()->json(['IsSuccess' => 'true', 'Message' => $msg, 'Data' => $data]);
    } catch (\Exception $e) {
        return response()->json(['IsSuccess' => 'false', 'Message' => $e->getMessage()]);
    }
}
  
}
