<?php

namespace App\Http\Controllers\API\Page;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Business\Page;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Models\Business\Businesssetting;
use stdClass;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($authid, $authroleid)
    {
        if(auth()->guard('api')){
            $pages = Page::get();
            return response()->json([
                'pages' => $pages,
            ], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    public function autoupdate(Request $request, string $authid, string $authroleid)
    {
        // dd($request);
        if(auth()->guard('api')){
            $routes = $request->routes;
            $settingsarrays = [
                'header_menu_links',
                'header_menu_labels',
            ];
            $menulinksarray= [];
            $menulabelsarray= [];
            // dd(gettype( $settingsarrays) == 'array',  $settingsarrays);

            foreach($routes as $route){
                $title                = $route['name'];
                $path                 = $route['path'];
                $meta_info            = $route['meta_info'];
                $meta_title           = $route['meta_title'];
                $meta_description     = $route['meta_description'];
                $meta_keywords        = $route['meta_keywords'];
                $meta_image           = $route['meta_image'];
                $meta_authentication  = $route['meta_authentication'];
                $settings_page        = null;
                $settings_params      = null;
                $slug = Str::slug($title);
                $type = str_replace(' ', '_', $title . ' '. 'page');

                $previouspage = Page::where('type', $type)->first();
                if($previouspage !== null){
                    //exists update else create new
                    $previouspage->type                  = $type;
                    // $page->title                      = $title;
                    $previouspage->path                  = $path;
                    $previouspage->slug                  = $slug;
                    // $previouspage->content            = $route[''];
                    $previouspage->meta_info             = $meta_info;
                    $previouspage->meta_title            = $meta_title;
                    $previouspage->meta_description      = $meta_description;
                    $previouspage->keywords              = $meta_keywords;
                    $previouspage->meta_image            = $meta_image;
                    $previouspage->meta_authentication   = $meta_authentication;
                    $previouspage->settings_page         = $settings_page;
                    $previouspage->settings_params       = $settings_params;
                    $previouspage->save();
                }else{
                    // new pages
                    $page                        = new Page();
                    $page->type                  = $type;
                    $page->title                 = $title;
                    $page->path                  = $path;
                    $page->slug                  = $slug;
                    // $page->content            = $route[''];
                    $page->meta_info             = $meta_info;
                    $page->meta_title            = $meta_title;
                    $page->meta_description      = $meta_description;
                    $page->keywords              = $meta_keywords;
                    $page->meta_image            = $meta_image;
                    $page->meta_authentication   = $meta_authentication;
                    $page->settings_page         = $settings_page;
                    $page->settings_params       = $settings_params;
                    $page->save();
                }
                    $menulinksarray[]            = $path;
                    $menulabelsarray[]           = $title;
            }
            foreach($settingsarrays as $settingsarray){
                if($settingsarray === 'header_menu_links'){
                    $businesssetting   = Businesssetting::where('type', $settingsarray)->first();
                    $businesssetting->value = json_encode($menulinksarray);
                    $businesssetting->save();
                }else{
                    $businesssetting   = Businesssetting::where('type', $settingsarray)->first();
                    $businesssetting->value = json_encode($menulabelsarray);
                    $businesssetting->save();
                }
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $authid, string $authroleid, string $id)
    {

        $meta_title       = $request->meta_title;
        $meta_image       = $request->meta_image;
        $meta_keywords    = $request->keywords;
        $meta_description = $request->meta_description;
        $inputs           = $request->inputs;
        $page = Page::where('slug',  $id)->first();
        // $page->meta_info             = $meta_info;
        $page->meta_title            = $meta_title;
        $page->meta_description      = $meta_description;
        $page->keywords              = $meta_keywords;

        $previous_meta_image         = $page->meta_image;
        $image_name                  = null;

        $page->meta_image            = $this->imageservice($meta_image, $previous_meta_image, $image_name, 'meta_image');
        $page->save();

        $businesssetting   = Businesssetting::where('type',  'home_slider_images')->first();
        $slidedataarray = [];
        foreach($inputs as $key => $input){
            $bannerarray = json_decode($businesssetting->value);
            $currentbanner = $bannerarray[$key]->banner;
            $banner      = $input['banner'];
            $description = $input['description'];
            $url         = $input['url'];
            $slidedata              = new stdClass();
            $slidedata->banner      = $this->imageservice($banner, $currentbanner, $image_name = $key, 'home_slider_images');
            $slidedata->description = $description;
            $slidedata->url         = $url;

            $slidedataarray[]       = $slidedata;
        }
        $businesssetting->value     = json_encode($slidedataarray);
        $businesssetting->save();

            return response()->json([
                'pages'            => Page::get(),
                'businesssettings' => Businesssetting::get(),
            ], 200);
    }
    public function imageservice($newimage, $previousimage, $image_name, $column)
    {
        if($newimage != $previousimage){
            $Path = public_path() . "/assets/images/";
            $currentphoto = $Path . $previousimage;
            if (file_exists($currentphoto)) {
                @unlink($currentphoto);
            }
            $strpos = strpos($newimage, ';');
            $sub = substr($newimage, 0, $strpos);
            $ex = explode('/', $sub)[1];
            $name = $column.'_'. $image_name . "." . $ex;
            $img = Image::make($newimage);
            $img->save($Path . '/' . $name);
            return $name;
        }else{
            return $previousimage;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
