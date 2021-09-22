<?php

namespace App\Http\Controllers\mailer;
use App\Mail\MailConsulta;
use Illuminate\Support\Facades\Mail;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Admin;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Models440\User_Title;
use DB;
// use App;
/*
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=4fc46782081b25
MAIL_PASSWORD=d74af13f388551
MAIL_ENCRYPTION=tls

MAIL_MAILER=sendmail
MAIL_HOST=smtp.hostinger.com.ar
MAIL_PORT=587
MAIL_USERNAME=info@catalogo-micro.com
MAIL_PASSWORD=Micro1234
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@catalogo-micro.com
MAIL_FROM_NAME="${APP_NAME}"

*/
class MailerController extends Controller
{
  // protected $redirectTo = '/home';
  //
  // public function __construct()
  // {
  //     $this->middleware('auth');
  // }

  public function sendMail(Request $request)
  {
    // return response()->json([
    //   'status' => 'ok',
    //   'data' => $request->all()
    // ]);

    $country = session('country');
    $other_country = $request->country;
    $city = $request->city;
    $to = $request->to;
    $from = $request->from;
    $product = $request->product;
    $text = $request->textArea;
    $defaultEmail = 'info@catalogo-micro.com';
    $title=0;

    switch ($to) {//titles
      case 'Comercial':
        $title = 1;
        break;
        case 'Ingenieria':
        $title = 2;
        break;
      default:
        break;
    }

    $titles = User_Title::where('country_id', "=", $country->id)->where('title_id', '=', $title)->pluck('user_id');
    $users = DB::table('users')->whereIn('id', $titles)->get();

    $validator = Validator::make($request->all(), [
      'from' => 'required',
    ]);

    if (!$validator->fails()) {
      Mail::to($users)
      ->send(new MailConsulta($users, $defaultEmail, $product, $text, 'micro', $other_country, $city, $country, $from));//para micro

      Mail::to($from)
      ->send(new MailConsulta($from, $defaultEmail, $product, $text, 'user'));//para usuario


      // $request->locale
      return response()->json([
        'status' => $request,
        'message'=> \Lang::get('messages.email_sent')
      ]);
    }
    else {
      return response()->json([
        'status' => 'error',
        'errors' => $validator->messages()
      ]);
    }

  }



}
