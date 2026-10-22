<?php
namespace App\Http\Controllers;
use App\Models\{Enquiry,Setting};
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
class EnquiryController extends Controller {
 public function store(Request $request){
  $data=$request->validate([
   'name'=>['required','string','min:2','max:120'],
   'phone'=>['required','string','regex:/^[+0-9()\-\s]{8,22}$/'],
   'email'=>['nullable','email','max:200'],
   'trip_id'=>['nullable','integer','exists:trips,id'],
   'preferred_dates'=>['nullable','string','max:120'],
   'group_size'=>['required','integer','between:1,100'],
   'message'=>['nullable','string','max:3000'],
   'consent'=>['accepted'],
   'company_website'=>['nullable','max:0'], // honeypot
   'cf-turnstile-response'=>['nullable','string','max:4096'],
  ]);
  $secret=(string)config('services.turnstile.secret',env('TURNSTILE_SECRET_KEY',''));
  if(app()->environment('production')&&!$secret){return back()->withErrors(['form'=>'Anti-spam verification is not configured. Please contact us by phone.'])->withInput();}
  if($secret){
   $verify=Http::asForm()->timeout(5)->post('https://challenges.cloudflare.com/turnstile/v0/siteverify',[ 'secret'=>$secret,'response'=>$request->input('cf-turnstile-response'),'remoteip'=>$request->ip() ]);
   if(!$verify->ok()||!$verify->json('success'))return back()->withErrors(['form'=>'Please complete the security check.'])->withInput();
  }
  $row=Enquiry::create([
   'name'=>$data['name'],'phone'=>$data['phone'],'email'=>$data['email']??null,'trip_id'=>$data['trip_id']??null,
   'preferred_dates'=>$data['preferred_dates']??null,'group_size'=>$data['group_size'],'message'=>$data['message']??null,
   'source'=>'form','status'=>'new','consent_at'=>now(),'ip_hash'=>hash_hmac('sha256',(string)$request->ip(),config('app.key','greenmiles')),
  ]);
  $email=env('ENQUIRY_TO_EMAIL')?:Setting::query()->first()?->email;
  if($email){try{Mail::raw("New enquiry #{$row->id}\nName: {$row->name}\nPhone: {$row->phone}\nTrip ID: {$row->trip_id}\nGroup: {$row->group_size}\nDates: {$row->preferred_dates}\nMessage: {$row->message}",fn($msg)=>$msg->to($email)->subject('New Green Miles enquiry #'.$row->id));}catch(\Throwable $e){report($e);}}
  return back()->with('enquiry_success','Thanks! Your enquiry has been saved. We will contact you soon.')->with('enquiry_trip',$row->trip?->title??'a trip');
 }
}
