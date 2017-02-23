<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Hash;
use DB;
use Carbon\Carbon;
use App\User;
use App\News;
use App\Rate;
use App\Comment;
use App\Tour;
use App\Promotions;
use App\VideoAr;
use App\Ticket;

class ApiController extends Controller
{
    public  function __construct(){
        $sites = array('postRegister', 'postLogin', 'getTours');

        $this->middleware('auth:api', ['except' => $sites]);
    }

    public function postLogin(Request $request){
    	$email = $request->input('email');
        $password = $request->input('password');

        if(Auth::attempt(array('email' => $email, 'password' => $password))){
            $data = Auth::user();
            return array(
                'success'=>true,
                'data'=>$data,
                'api_token'=>$data->api_token
            );
        }else{
            return array(
                'success'=>false,
                'description'=>'Login gagal'
            );
        }
    }

    public function postRegister(Request $request){
    	$user = new User();
    	$user->name = $request->input('name');
    	$user->email = $request->input('email');
    	$user->password = Hash::make($request->input('password'));
    	$user->phone = $request->input('phone');
    	$user->api_token = str_random(60);
    	$user->level = 'Visitor';
    	$user->money = 0;
    	$user->address = '';
    	$user->photo = 'default_visitor.jpg';
    	$user->username = 'user_lk';

    	try{
            $success = $user->save(); 
        }catch (\Illuminate\Database\QueryException $e) {
            return array(
                    'success'=>false,
                    'description'=>'Regisrasi Gagal',
                    "error"=> $e,
                );
        }

        return array(
                    'success'=>true,
                    'description'=>'Register Berhasil',
                    'data'=>$user,
                    'api_token'=>$user->api_token
                );
    }

    public function getUser(){
    	if(!Auth::check()){
    		return array(
    				'success'=>false,
    				'description'=>'Akses ditolak'
    			);
    	}
    	$user = Auth::user();
    	return array(
                    'success'=>true,
                    'data'=>$user,
                    'api_token'=>$user->api_token
                );
    }

    public function getNews(){
    	$data = News::with('author')->orderBy('created_at','desc')->get();

    	return array(
                    'success'=>true,
                    'data'=>$data,
                );
    }

    public function getPromotions(){
    	$data = Promotions::with('author')->orderBy('created_at','desc')->take(5)->get();

    	return array(
                    'success'=>true,
                    'data'=>$data,
                );
    }

    public function getVideoAr(){
    	$data = VideoAr::select('id', 'code', 'object')->get();

    	return array(
                    'success'=>true,
                    'data'=>$data,
                );
    }

    public function postBuyMoney(Request $request){
    	$user = Auth::user();
        $data = MoneyCode::where('code', $request->input('code'))->first();

        if($data->count() == 0){
            return array(
                    'success'=>false,
                    'money'=>0,
                );
        }
        
    	$user->money = $user->money + $data->money;
    	$user->save();

    	return array(
                    'success'=>true,
                    'money'=>$user->money,
                );
    }

    public function postVerifyCode(Request $request){
    	$user = Auth::user();
    	$code = $request->input('code');

    	$data = Ticket::where('code', $code)->with('tour')->first();

    	if($data->count() > 0){
    		return array(
                    'success'=>true,
                    'data'=>$data,
                );		
    	}

    	return array(
                    'success'=>false,
                    'description'=>'Kode tiket tidak valid'
                );
    }

    public function getHistory(){
    	$user = Auth::user();
        
    	$data = Ticket::where('user_id',$user->id)->with('tour')->orderBy('ticket_date','desc')->get();

    	return array(
                    'success'=>true,
                    'data'=>$data,
                );		
    }

    public function postListTours(Request $request){
    	$data = Tour::select('id','name','photo','city','address','description','latitude','longitude','rates', 'price',
    					DB::raw("round(6371 * acos(cos(radians(".$request->input('user_latitude').")) * cos(radians(latitude)) * cos(radians(longitude) - radians(".$request->input('user_longitude').")) + sin(radians(".$request->input('user_latitude').")) * sin(radians(latitude)))) as distance"))
    				->orderBy('distance', 'asc')->get();

    	return array(
    			'success'=>true,
    			'data'=>$data
    			);
    }

    public function getTours(){
        $data = Tour::select('id','name','photo','city','address','description','latitude','longitude','rates', 'price')
                    ->orderBy('name', 'asc')
                    ->get();

        return array(
                'success'=>true,
                'data'=>$data
                );
    }

    public function postBuyTickets(Request $request){
    	$tour_id = $request->input('tour_id');
    	$user = Auth::user();

    	$tour = Tour::where('id', $tour_id)->first();
    	
        $total_price = $tour->price * $request->input('quantity');

        if($total_price <= $user->money){
            $ticket = new Ticket;
            $ticket->user_id = $user->id;
            $ticket->tour_id = $tour->id;
            $ticket->confirmed = 0;
            $ticket->code = str_random(60);
            $ticket->type = 'Standard';
            $ticket->quantity = $request->input('quantity');
            $ticket->total_price = $total_price;
            $ticket->staff_id = null;
            $ticket->ticket_date = $request->input('date');
            $ticket->save();

            $user->money = $user->money-$total_price;
            $user->save();
            return array(
                    'success'=>true,
                    'description'=>'Pembelian Berhasil',
                    'data'=>$ticket
                );
        }else{
            return array(
                    'success'=>false,
                    'description'=>'Saldo tidak mencukupi'
                );
        }
    }

    public function postDetailTicket(Request $request){
    	$data = Ticket::where('id', $request->input('id'))->with('tour')->first();

    	return array(
    			'success'=>true,
    			'data'=>$data
    			);	
    }

    public function postComment(Request $request){
    	$tour_id = $request->input('tour_id');
    	$user = Auth::user();
    	$comment_value = $request->input('comment');

    	$comment = new Comment;
    	$comment->user_id = $user->id;
    	$comment->comment = $comment_value;
    	$comment->tour_id = $tour_id;
    	$comment->save();

    	return array(
    			'success'=>true,
    			'data'=>$comment
    			);
    }

    public function postRate(Request $request){
    	$tour_id = $request->input('tour_id');
    	$user = Auth::user();
    	$rate_value = $request->input('rates');

    	$rates = new Comment;
    	$rates->user_id = $user->id;
    	$rates->rate = $rate_value;
    	$rates->tour_id = $tour_id;
    	$rates->save();

    	return array(
    			'success'=>true,
    			'data'=>$rates
    			);
    }
}
