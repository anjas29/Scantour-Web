<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Carbon\Carbon;
use Session;
use File;

use App\News;
use App\Tour;
use App\Promotions;
use App\User;
use App\VideoAr;
use App;

class AdminController extends Controller
{
    public function __construct(){
    	$sites = array();

    	$this->middleware('auth')->except($sites);
    }

    public function getLogout(){
        auth()->logout();
        return redirect('/login');
    }

    public function getHome(){
        $news = News::with('author')->orderBy('created_at', 'DESC')->take(5)->get();
        $data = array(
                    'news' => News::count(),
                    'videos' => VideoAr::count(),
                    'promotions' => Promotions::count(),
                    'users' => User::count(),
                    'tours' => Tour::count()
                    );
    	return view('admin.index')->withNews($news)->withData($data);
    }

    public function getNews(){
    	$data = News::orderBy('created_at', 'DESC')->with('author')->get();

    	return view('admin.news')->withData($data);
    }

    public function postCreateNews(Request $request){
    	$file = array('image' => $request->file('image'));
        $rules = array('image' => 'required');

        $validator = Validator::make($file, $rules);
        
        if($validator->fails()) {
            $data = new News;
	    	$data->title = $request->input('title');
	    	$data->content = $request->input('content');
	    	$data->author_id = auth()->user()->id;
	    	$data->image = 'default.jpg';
	    	$data->save();

            $pusher = App::make('pusher');

            $pusher->trigger( 'scantour_event_channel',
                              'data_event', $data);

            Session::flash('message', 'Success');
            return redirect('/administrator/news');
        } else {
            if($request->file('image')->isValid()){
                $path = storage_path().'/app/news/';
                $extension = strtolower($request->file('image')->getClientOriginalExtension());

                if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                    $fileName = Carbon::now()->format('YmdHis').rand(1,99).'.'.$extension;
                    $request->file('image')->move($path, $fileName);

                    $data = new News;
			    	$data->title = $request->input('title');
			    	$data->content = $request->input('content');
			    	$data->author_id = auth()->user()->id;
			    	$data->image = $fileName;
			    	$data->save();
                    
                    $pusher = App::make('pusher');
                    
                    $pusher->trigger( 'scantour_event_channel',
                              'data_event', $data);
                   
                }else{
                    Session::flash('messageError', 'Invalid Image');
                    return redirect('/administrator/news');
                }
            }else{
                Session::flash('messageError', 'Invalid Image');
                return redirect('/administrator/news');
            }
        }

        Session::flash('message', 'Success');
    	return redirect('/administrator/news');
    }

    public function postUpdateNews(Request $request){
        $id = $request->input('id');

        $file = array('image' => $request->file('image'));
        $rules = array('image' => 'required');

        $validator = Validator::make($file, $rules);
        $data = News::where('id', $id)->first();

        if($data == null){
            Session::flash('messageError', 'Invalid Data');
            return redirect('/administrator/news');
        }

        if($validator->fails()) {

            $data->title = $request->input('title');
            $data->content = $request->input('content');
            $data->save();

            Session::flash('message', 'Success');
            return redirect('/administrator/news');
        } else {
            if($request->file('image')->isValid()){
                $path = storage_path().'/app/news/';
                $extension = strtolower($request->file('image')->getClientOriginalExtension());

                if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                    $fileName = $data->image;

                    if($fileName == 'default.jpg')
                        $fileName = Carbon::now()->format('YmdHis').rand(1,99).'.'.$extension;

                    $request->file('image')->move($path, $fileName);

                    $data->title = $request->input('title');
                    $data->content = $request->input('content');
                    $data->author_id = auth()->user()->id;
                    $data->image = $fileName;
                    $data->save();
                   
                }else{
                    Session::flash('messageError', 'Invalid Image');
                    return redirect('/administrator/news');
                }
            }else{
                Session::flash('messageError', 'Invalid Image');
                return redirect('/administrator/news');
            }
        }

        Session::flash('message', 'Success');
        return redirect('/administrator/news');
    }

    public function postDeleteNews(Request $request){
    	$id = $request->input('id');

    	$data = News::where('id', $id)->first();

    	if($data != null){
    		$fileName = $data->image;
			if(File::exists(storage_path() . '/app/news/' . $fileName) && $fileName != 'default.jpg'){
				File::delete(storage_path() . '/app/news/' . $fileName);	
			}
    		
    		$data->delete();

    		Session::flash('message', 'Success');
    		return redirect('/administrator/news');
    	}else{
    		Session::flash('messageError', 'Invalid Input');
    		return redirect('/administrator/news');
    	}

    	Session::flash('messageError', 'Invalid Input');
		return redirect('/administrator/news');

    }

    public function getPromotions(){
        $data = Promotions::orderBy('created_at', 'DESC')->get();

        return view('admin.promotions')->withData($data);
    }

    public function postCreatePromotions(Request $request){
        $file = array('image' => $request->file('image'));
        $rules = array('image' => 'required');

        $validator = Validator::make($file, $rules);
        
        if($validator->fails()) {
            Session::flash('messageError', 'Invalid Image');
            return redirect('/administrator/promotions');
        } else {
            if($request->file('image')->isValid()){
                $path = storage_path().'/app/promotions/';
                $extension = strtolower($request->file('image')->getClientOriginalExtension());

                if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                    $fileName = Carbon::now()->format('YmdHis').rand(1,99).'.'.$extension;
                    $request->file('image')->move($path, $fileName);

                    $data = new Promotions;
                    $data->title = $request->input('title');
                    $data->author_id = auth()->user()->id;
                    $data->image = $fileName;
                    $data->save();
                   
                }else{
                    Session::flash('messageError', 'Invalid Image');
                    return redirect('/administrator/promotions');
                }
            }else{
                Session::flash('messageError', 'Invalid Image');
                    return redirect('/administrator/promotions');
            }
        }

        Session::flash('message', 'Success');
        return redirect('/administrator/promotions');
    }

    public function postUpdatePromotions(Request $request){
        $id = $request->input('id');

        $file = array('image' => $request->file('image'));
        $rules = array('image' => 'required');

        $validator = Validator::make($file, $rules);
        $data = Promotions::where('id', $id)->first();

        if($data == null){
            Session::flash('messageError', 'Invalid Data');
            return redirect('/administrator/promotions');
        }

        if($validator->fails()) {

            $data->title = $request->input('title');
            $data->save();

            Session::flash('message', 'Success');
            return redirect('/administrator/promotions');
        } else {
            if($request->file('image')->isValid()){
                $path = storage_path().'/app/promotions/';
                $extension = strtolower($request->file('image')->getClientOriginalExtension());

                if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                    $fileName = $data->image;

                    if($fileName == 'default.jpg')
                        $fileName = Carbon::now()->format('YmdHis').rand(1,99).'.'.$extension;

                    $request->file('image')->move($path, $fileName);

                    $data->title = $request->input('title');
                    $data->author_id = auth()->user()->id;
                    $data->image = $fileName;
                    $data->save();
                   
                }else{
                    Session::flash('messageError', 'Invalid Image');
                    return redirect('/administrator/promotions');
                }
            }else{
                Session::flash('messageError', 'Invalid Image');
                return redirect('/administrator/promotions');
            }
        }

        Session::flash('message', 'Success');
        return redirect('/administrator/promotions');
    }

    public function postDeletePromotions(Request $request){
        $id = $request->input('id');

        $data = Promotions::where('id', $id)->first();

        if($data != null){
            $fileName = $data->image;
            if(File::exists(storage_path() . '/app/promotions/' . $fileName) && $fileName != 'default.jpg'){
                File::delete(storage_path() . '/app/promotions/' . $fileName);    
            }
            
            $data->delete();

            Session::flash('message', 'Success');
            return redirect('/administrator/promotions');
        }else{
            Session::flash('messageError', 'Invalid Input');
            return redirect('/administrator/promotions');
        }

        Session::flash('messageError', 'Invalid Input');
        return redirect('/administrator/promotions');

    }

    public function getTours(){
        $data = Tour::orderBy('name', 'asc')->get();

        return view('admin.tours')->withData($data);
    }

    public function getToursJson(){
        $data = Tour::orderBy('name', 'asc')->get();
        return $data;
    }

    public function postCreateTours(Request $request){
        $file = array('image' => $request->file('image'));
        $rules = array('image' => 'required');

        $validator = Validator::make($file, $rules);
        
        if($validator->fails()) {
            $data = new Tour;
            $data->name = $request->input('name');
            $data->latitude = $request->input('lat');
            $data->longitude = $request->input('long');

            $data->city = $request->input('city');
            $data->address = $request->input('address');
            $data->price = $request->input('price');
            $data->description = $request->input('description');

            $data->owner_id = auth()->user()->id;
            $data->photo = 'default.jpg';
            $data->save();

            Session::flash('message', 'Success');
            return redirect('/administrator/tours');
        } else {
            if($request->file('image')->isValid()){
                $path = storage_path().'/app/tours/';
                $extension = strtolower($request->file('image')->getClientOriginalExtension());

                if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                    $fileName = Carbon::now()->format('YmdHis').rand(1,99).'.'.$extension;
                    $request->file('image')->move($path, $fileName);

                    $data = new Tour;
                    $data->name = $request->input('name');
                    $data->latitude = $request->input('lat');
                    $data->longitude = $request->input('long');

                    $data->city = $request->input('city');
                    $data->address = $request->input('address');
                    $data->price = $request->input('price');
                    $data->description = $request->input('description');

                    $data->owner_id = auth()->user()->id;
                    $data->photo = $fileName;
                    $data->save();
                    
                   
                }else{
                    Session::flash('messageError', 'Invalid Image');
                    return redirect('/administrator/tours');
                }
            }else{
                Session::flash('messageError', 'Invalid Image');
                return redirect('/administrator/tours');
            }
        }

        Session::flash('message', 'Success');
        return redirect('/administrator/tours');
    }

    public function postUpdateTours(Request $request){
        $id = $request->input('id');

        $file = array('image' => $request->file('image'));
        $rules = array('image' => 'required');

        $validator = Validator::make($file, $rules);
        $data = Tour::where('id', $id)->first();

        if($data == null){
            Session::flash('messageError', 'Invalid Data');
            return redirect('/administrator/tours');
        }

        if($validator->fails()) {

            $data->name = $request->input('name');

            $data->city = $request->input('city');
            $data->address = $request->input('address');
            $data->price = $request->input('price');
            $data->description = $request->input('description');
            $data->save();

            Session::flash('message', 'Success');
            return redirect('/administrator/tours');
        } else {
            if($request->file('image')->isValid()){
                $path = storage_path().'/app/tours/';
                $extension = strtolower($request->file('image')->getClientOriginalExtension());

                if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                    $fileName = $data->photo;

                    if($fileName == 'default.jpg')
                        $fileName = Carbon::now()->format('YmdHis').rand(1,99).'.'.$extension;

                    $request->file('image')->move($path, $fileName);

                    $data->name = $request->input('name');

                    $data->city = $request->input('city');
                    $data->address = $request->input('address');
                    $data->price = $request->input('price');
                    $data->description = $request->input('description');
                    $data->photo = $fileName;
                    $data->save();
                   
                }else{
                    Session::flash('messageError', 'Invalid Image');
                    return redirect('/administrator/tours');
                }
            }else{
                Session::flash('messageError', 'Invalid Image');
                return redirect('/administrator/tours');
            }
        }

        Session::flash('message', 'Success');
        return redirect('/administrator/tours');
    }

    public function postDeleteTours(Request $request){
        $id = $request->input('id');

        $data = Tour::where('id', $id)->first();

        if($data != null){
            $fileName = $data->photo;
            if(File::exists(storage_path() . '/app/tours/' . $fileName) && $fileName != 'default.jpg'){
                File::delete(storage_path() . '/app/tours/' . $fileName);    
            }
            
            $data->delete();

            Session::flash('message', 'Success');
            return redirect('/administrator/tours');
        }else{
            Session::flash('messageError', 'Invalid Input');
            return redirect('/administrator/tours');
        }

        Session::flash('messageError', 'Invalid Input');
        return redirect('/administrator/tours');
    }

    public function getUsers(){
        $data = User::where('role', 'Visitor')->get();

        return view('admin.users')->withData($data);
    }

    public function getAdmin(){
        $data = User::where('role', 'Admin')->get();

        return view('admin.admin')->withData($data);
    }

    public function getVideo(){
        $data = VideoAr::all();

        return view('admin.video')->withData($data);
    }

    public function postCreateVideo(Request $request){
        $file = array('image' => $request->file('image'));
        $rules = array('image' => 'required');

        $validator = Validator::make($file, $rules);
        
        if($validator->fails()) {
            Session::flash('messageError', 'Invalid Image');
            return redirect('/administrator/video');
        } else {
            if($request->file('image')->isValid()){
                $path = storage_path().'/app/marker/';
                $pathVideo = storage_path().'/app/video/';
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $extensionVideo = strtolower($request->file('video')->getClientOriginalExtension());

                if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                    $fileName = Carbon::now()->format('YmdHis').rand(1,99).'.'.$extension;
                    $request->file('image')->move($path, $fileName);

                    $videoName = Carbon::now()->format('YmdHis').rand(1,99).'.'.$extensionVideo;
                    $request->file('video')->move($pathVideo, $videoName);

                    $data = new VideoAr;
                    $data->title = $request->input('title');
                    $data->marker = $fileName;
                    $data->video = $videoName;
                    $data->save();
                   
                }else{
                    Session::flash('messageError', 'Invalid Image');
                    return redirect('/administrator/video');
                }
            }else{
                Session::flash('messageError', 'Invalid Image');
                    return redirect('/administrator/video');
            }
        }

        Session::flash('message', 'Success');
        return redirect('/administrator/promotions');
    }
}
