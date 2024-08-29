<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ContactMessages extends Model
{
  //
  protected $guarded = [];

  public function fromTime()
  {
    return Carbon::createFromDate($this->created_at)->timezone('Africa/Cairo')->format('d-m-Y H:i A');
  }
  public function countryDetails()
  {
    return $this->belongsTo(Countries::class, 'country');
  }
  public function messageStatus()
  {
    $text = '<span class="';
    if ($this->status == 0) {
      $text .= 'text-danger">';
      $text .= trans('common.unread');
    } else {
      $text .= 'text-muted">';
      $text .= trans('common.read');
    }
    $text .= '</span>';
    return $text;
  }

  public function subjectText()
  {
    $text = '';
    foreach (messageSubjects(session()->get('Lang')) as $key => $value) {
      if ($value['id'] == $this->subject) {
        $text = $value['name'];
      }
    }
    return $text;
  }

  public function userData()
  {
    $data = [
      'name' => $this->name,
      'phone' => $this->phone,
      'email' => $this->email,
      'content' => $this->content,
    ];

    return $data;
  }
}
