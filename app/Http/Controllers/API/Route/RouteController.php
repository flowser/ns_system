<?php

namespace App\Http\Controllers\API\Route;

use Illuminate\Http\Request;
use App\Models\Business\Page;
use App\Http\Controllers\Controller;
use App\Models\Business\Businesssetting;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    /**
     * Update the specified resource in storage.
     */
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
                $title = $route['name'];
                $path = $route['path'];
                $slug = Str::slug($title);
                $type = str_replace(' ', '_', $title . ' '. 'page');

                $previouspage = Page::where('title', $title)->first();
                if(!empty($checkpage)){
                    //exists update else create new
                    $previouspage->type                  = $type;
                    // $page->title                      = $title;
                    $previouspage->slug                  = $slug;
                    // $previouspage->content            = $route[''];
                    $previouspage->meta_info             = $route['meta_info'];
                    $previouspage->meta_title            = $route['meta_title'];
                    $previouspage->meta_description      = $route['meta_description'];
                    $previouspage->keywords              = $route['meta_keywords'];
                    $previouspage->meta_image            = $route['meta_image'];
                    $previouspage->meta_authentication   = $route['meta_authentication'];
                    $previouspage->save();
                }else{
                    // new pages
                    $page                        = new Page();
                    $page->type                  = $type;
                    $page->title                 = $title;
                    $page->slug                  = $slug;
                    // $page->content            = $route[''];
                    $page->meta_info             = $route['meta_info'];
                    $page->meta_title            = $route['meta_title'];
                    $page->meta_description      = $route['meta_description'];
                    $page->keywords              = $route['meta_keywords'];
                    $page->meta_image            = $route['meta_image'];
                    $page->meta_authentication   = $route['meta_authentication'];
                    $page->save();
                }
                    $menulinksarray[]            = $path;
                    $menulabelsarray[]           = $page->title;
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
