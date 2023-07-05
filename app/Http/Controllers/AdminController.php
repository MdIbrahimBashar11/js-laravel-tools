<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Setting;

class AdminController extends Controller

{
    public function redirect(){
        $usertype = Auth::user()->user_type;
        if($usertype == '1') {
          return view('site.admin.index');
        } else {
             return redirect('/');
        }
    }


  
        public function blog(){
            $products = Blog::all();;
            $usertype = Auth::User()->user_type;
            
            if($usertype == '1') {
              return view('site.admin.products' , compact('products')); 
            } else {
                 return redirect('/');
            }
    
          
        }
        public function addblogpage(){
            $usertype = Auth::User()->user_type;
            
            if($usertype == '1') {
                return view('site.admin.addproduct');
            } else {
                 return redirect('/');
            }
           
        }
    
        public function addblog (Request $req){

    
            $path = './product/img';
            $blog = new Blog;
            
            $blog->name = $req->name;
            $blog->description = $req->description;   
           
            $image= $req->image;
            // $imageName = time().'.'.$image->getClientOriginalExtension();
            $imageName = time().'123';
            $req->image->move($path, $imageName);
            $blog->image = $imageName;
            
            $blog->save();
            return redirect('/redirect');
        }
        public function delete_blog($id){
            $pd = Blog::find($id);
            $pd->delete();
            return redirect()->back();
        }
      

         
        public function update($id){
            $product = Blog::find($id);
            $usertype = Auth::User()->user_type;
            if($usertype == '1') {
                return view('site.admin.update', compact('product'));
            } else {
                 return redirect('/');
            }  
        }
         
      
        public function update_blog($id , Request $req){

            
            $path = './product/img';
            $blog =  Blog::find($id);
            
            $blog->name = $req->name;
            $blog->description = $req->description;   
           
            $image= $req->image;
            // $imageName = time().'.'.$image->getClientOriginalExtension();
            $imageName = time().'123';
            $req->image->move($path, $imageName);
            $blog->image = $imageName;
            
            $blog->save();
            return redirect('/blog');
        }

        public function settings(){
            $usertype = Auth::User()->user_type;
            
            if($usertype == '1') {
                $settings = Setting::all();
                return view('site.admin.addsettings' , compact('settings'));
            } else {
                 return redirect('/');
            }
           
        }

        public function addsettings (Request $req){

    
            $setting = new Setting;
            
            $setting->name = $req->name;
            $setting->description = $req->description;   
            
            $setting->save();
            return redirect('/settings');
        }

        public function updateset($id){
            $usertype = Auth::User()->user_type;
            $setting = Setting::find($id);
            if($usertype == '1') {
                return view('site.admin.setting_update' , compact('setting'));
            } else {
                 return redirect('/');
            }
           
        }

        public function updatesettings($id , Request $req){

            
            $setting =  Setting::find($id);
            
            $setting->name = $req->name;
            $setting->description = $req->description;   

            
            $setting->save();
            return redirect('/settings');
        }
}
