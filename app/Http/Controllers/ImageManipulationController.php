<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Setting;

class ImageManipulationController extends Controller
{




    
    public function resizer()
    {
        $setting = Setting::find(1);
        return view('site.home.image_manipulation', compact('setting'));
    }

            
    public function compressor()
    {
        $setting = Setting::find(2);
        return view('site.home.compressor', compact('setting'));
    }
    public function coverter()
    {
        $setting = Setting::find(3);
        return view('site.home.coverter', compact('setting'));
    }
    
    public function userblog()
    {
        $blogs = Blog::all();;
        return view('site.home.blog' , compact('blogs'));
    }

    public function blog_details($id)
    {
        $blog = Blog::find($id);;
        if ($id) {
            return view('site.home.blog_details' , compact('blog'));
          } else{
              return redirect('/');
          }
        
    }
    
    public function base64()
    {
        $setting = Setting::find(4);
        return view('site.home.base64', compact('setting'));
    }

    public function editor()
    {
        $setting = Setting::find(5);
        return view('site.home.edit', compact('setting'));
    }

    public function crop()
    {
        $setting = Setting::find(6);
        return view('site.home.crop', compact('setting'));
    }
    public function rotet()
    {
        $setting = Setting::find(7);
        return view('site.home.rotet', compact('setting'));
    }
    public function filp()
    {
        $setting = Setting::find(8);
        return view('site.home.filp', compact('setting'));
    }
    public function gamma()
    {
        $setting = Setting::find(9);
        return view('site.home.gamma', compact('setting'));
    }

    public function invert()
    {
        $setting = Setting::find(10);
        return view('site.home.invertes', compact('setting'));
    }
    public function vibrance()
    {
        $setting = Setting::find(11);
        return view('site.home.vibrance', compact('setting'));
    }
 
}