<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models440\Product;


class MailConsulta extends Mailable
{
    use Queueable, SerializesModels;

    public $toMail;
    public $fromMail;
    public $product;
    public $textArea;
    public $view;
    public $other_country;
    public $city;
    public $country;
    public $reply;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($toMail, $fromMail, $product=null, $textArea=null, $view, $other_country=null, $city=null, $country=null, $reply=null)
    {
        $this->view = $view;
        $this->toMail = $toMail;
        $this->fromMail = $fromMail;
        if ($other_country) $this->other_country = $other_country;
        if ($city) $this->city = $city;
        if($reply) $this->reply = $reply;
        if ($product) {
          $this->product = $product;
        }
        if ($textArea) {
          $this->textArea = $textArea;
        }
        if($country){
          $this->country = $country;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      if ($this->view == 'user') {
        $v= 'mails.userMail';
      }
      if ($this->view == 'micro') {
        $v= 'mails.microMail';
      }
      return $this->from($this->fromMail, 'MICRO')
          ->subject('MICRO-WEB')
          ->markdown($v)
          ->with([
              'toMail' => $this->toMail,
              'fromMail' => $this->fromMail,
              'product'=>$this->product,
              'text_area'=>$this->textArea,
              'other_country'=>$this->other_country,
              'city'=>$this->city,
              'reply'=>$this->reply
              // 'link' => 'micro.com'
          ]);
    }
}
