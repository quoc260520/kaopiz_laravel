<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Throwable;
use App\Http\Controllers\UpdateMessageTrait;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use UpdateMessageTrait;
    const PAGINATE = 10;
    public function login(){
        return view('login')->with([
            'title' => 'Login',
        ]);
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
    public function postLogin(Request $request){
        $request->validate(
            [
                'email' => 'required|email|min:6|max:255',
                'password' => 'required|string|min:8|max:255',
            ],
        );

        $data = $request->only('email', 'password');

        $token = Auth::attempt(['email' => $data['email'], 'password' => $data['password']]);
        if ($token) {
            $account = Auth::user();
            $request->session()->regenerate();
            if( $account->role != 0 ){
                $request->session()->put('admin', $account);
            }else{
                $request->session()->put('user', $account);
            }
            return redirect(route('home'));
        }
        $this->updateFailMessage($request,'Tài khoản hoặc mật khẩu không chính xác');
        return back();
    }
    public function register(){
        return view('register');
    }
    public function postRegister(Request $request){
        $request->validate(
            [
                'email' => 'required|email|min:6|max:255|unique:users',
                'password' => 'required|string|min:8|max:255',
            ],
        );

        $data = $request->only('email', 'password');
        try{
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => $data['email'],
                'password' =>  Hash::make($data['password'])
            ]);  
            return response()->view('login', [
                "message" => 'Đăng ký thành công',
                "messageType" => "success",
            ]);
            
        }catch(Throwable $e){
            $this->updateFailMessage($request,'Đã có lỗi xảy ra');
            return back();
        }
        
    }
    public function getCreatePost(){
        return view('posts.create_post');
    }
    public function postCreatePost(Request $request){
        $request->validate(
            [
                'title' => 'required|min:10|max:255',
                'content' => 'required|string|min:20',
            ],
        );

        $data = $request->only('title', 'content');
        try{
            DB::table('posts')->insert([
                'title' => $data['title'],
                'content' => $data['content'],
            ]);  
            $this->updateSuccessMessage($request,'Thêm thành công');
            return back();
            
        }catch(Throwable $e){
            $this->updateFailMessage($request,'Đã có lỗi xảy ra');
            return back();
        }
       
    }
    public function getListPost(){
       $posts = DB::table('posts')
       ->get();
        return view('posts.list_post')->with(compact('posts'));
    }
    public function getEditPost($id){
        $post = DB::table('posts')->find($id);
        return view('posts.edit_post')->with(compact('post'));
    }
    public function postEditPost(Request $request){
        $request->validate(
            [
                'title' => 'required|min:10|max:255',
                'content' => 'required|string|min:20',
            ],
        );

        $data = $request->only('title', 'content','id');
        try{
            DB::table('posts')->where('id',$data['id'])->update([
                'title' => $data['title'],
                'content' => $data['content'],
            ]);  
            $this->updateSuccessMessage($request,'Cập nhật thành công');
            return back();
            
        }catch(Throwable $e){
            $this->updateFailMessage($request,'Đã có lỗi xảy ra');
            return back();
        }
       
    }

    public function deletePost(Request $request, $id){
        try{
            DB::table('comments')->where('post_id', $id)->delete();
            DB::table('posts')->delete($id);  
            $this->updateSuccessMessage($request,'Xóa thành công');
            return back();
        }catch(Throwable $e){
            dd($e->getMessage());
            $this->updateFailMessage($request,'Đã có lỗi xảy ra');
            return back();
        }
       
    }
    public function showDetail(Request $request,$id){
    }

    public function index(){
        $posts = DB::table('posts')->paginate(self::PAGINATE);
        return view('index')->with(compact('posts'));
    }

    public function detail(Request $request,$id){
        $post = DB::table('posts')->find($id);
        $comments = DB::table('comments')->where('post_id',$id)->get();
        return view('posts.detail')->with(compact('post','comments'));
    }
    public function comment(Request $request,$id){
        $request->validate(
            [
                'comment' => 'required|string|min:3|max:255',
            ],
        );

        $comment = $request->comment;
        $today = now();
        if($comment){
            try{
                DB::table('comments')->insert([
                    'content_comment' => $comment,
                    'post_id' => $id,
                    'created_at' => $today,
                ]); 
                return back();
                
            }catch(Throwable $e){
                dd($e->getMessage());
                $this->updateFailMessage($request,'Đã có lỗi xảy ra');
                return back();
            }
        }

        return back();
       
    }
    
}
