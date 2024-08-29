<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use GuzzleHttp\Client;
use Prateekkathal\OtpVerification\Models\OtpVerification;

class OtpNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
    public function toSms($notifiable)
    {
      // $otp = rand(1000, 9999);

      // OtpVerification::create([
      //   'user_id' => $notifiable->id,
      //   'otp' => $otp,
      //   'expires_at' => now()->addMinutes(5)
      // ]);

      // $client = new Client();

      // $response = $client->post('https://api.mora-sa.com/v1/sendSMS', [
      //   'headers' => [
      //     'Authorization' => 'Bearer ' . env('MORA_SA_API_KEY'),
      //     'Content-Type' => 'application/json',
      //     'Accept' => 'application/json',
      //   ],
      //   'json' => [
      //     'to' => $notifiable->phone,
      //     'sender_id' => env('MORA_SA_SENDER_ID'),
      //     'message' => 'Your OTP is: ' . $otp,
      //   ],
      // ]);

      // return $response;
      return '';
    }
}
