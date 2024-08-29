<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    protected $guarded = [];
    public function arabicStatus(){
          $message = '';
        if (strtotime($this->max_date) >= strtotime(date('Y-m-d'))) {
            if ($this->invoices_count <= $this->max_clients || $this->max_clients == 0) {
                $message = '<span class="btn btn-sm btn-success">صالح للإستخدام</span>';
                $status = 1;
            } else {
                $message = '<span class="btn btn-sm btn-warning">تم الوصول للحد الأقصى من العملاء</span>';
                $status = 0;
            }
        } else {
            $message = '<span class="btn btn-sm btn-danger">لم يعد صالح للإستخدام</span>';
            $status = 0;
        }
        return [
            'message' => $message,
            'status' => $status
        ];
    }

    public function invoices()
    {
      return $this->hasMany(Orders::class, 'coupun_id');
    }

    public function value()
    {
        $value = '';
        if ($this->percentage != '') {
            $value = $this->percentage.'%';
        } else {
            $value = $this->amount;
        }
        return $value;
    }
    public function affiliateData()
    {
        if ($this->affiliate_id == '0') {
            return '<span class="btn btn-info btn-sm">بدون مسوق إلكتروني</span>';
        } else {
            if ($this->affiliate == '') {
                return '<span class="btn btn-warning btn-sm">تم حذف المسوق الإلكتروني</span>';
            } else {
                return '<span class="btn btn-success btn-sm">'.$this->affiliate->name.'</span>';
            }
        }
    }
    public function max_invoices()
    {
        if ($this->max_clients == 0) {
            return 'لا يوجد حد أقصى';
        } else {
            return $this->max_clients .' ' . trans('common.client');
        }
    }


    public function canUse($order_id = null)
    {
        $canUse = '0';
        $discount = 0;
        if ($this->max_clients > 0) {
            $countInvoices = $this->invoices()->count();
            if ($countInvoices >= $this->max_clients) {
                return '0';
            }
        }

        if ($this->max_date != '') {
            if (strtotime($this->max_date) < strtotime(date('Y-m-d'))) {
                return '0';
            }
        }

        if ($order_id != null) {
            $order = $this->invoices()->where('id',$order_id)->first();
            if ($order != '') {

                $totalOrder = $order->totals()['total'];

                if ($this->percentage > 0) {
                    $discount = $totalOrder/$this->percentage;
                } else {
                    $discount = $this->amount;
                }
            }
        } else {
            return '0';
        }

        $canUse = [
            'status' => 1,
            'discount' => $discount ?? 0
        ];

        return $canUse;
    }
    public function apiData($lang){
        $data = [
            'id' => $this->id,
            'coupon' => $this->coupon,
            'value' => $this->value(),
            'max_invoices' => $this->max_invoices(),
            'max_date' => $this->max_date,
            'status' => $this->arabicStatus(),
        ];
        return $data;
    }
}
