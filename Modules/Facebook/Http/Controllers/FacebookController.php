<?php

namespace Modules\Facebook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Facebook\Entities\FacebookPosts;
use Modules\Facebook\Entities\FacebookImagePosts;
use Modules\Facebook\Entities\FacebookVideoPosts;
use App\Http\Controllers\HelperController;
use Toolkito\Larasap\SendTo;
use Session;
use File;

class FacebookController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    
    public function getCreateFacebookPosts()
    {
        return view('facebook::create-fb-link-post');
    }

    public function postCreateFacebookPostswithLinks(Request $request)
    {        
        $input = request()->all();
        $request->validate([
            'message' => 'required',             
            ]);

        try {

            SendTo::Facebook(
                'link',
                [
                    'link' => $input['link'],
                    'message' => $input['message']
                ]
            );

            $controller = new HelperController;
            $input['created_by'] = $controller->getCreatedBy();
            FacebookPosts::create($input);
        }
        catch(Exception $e){
            return redirect()->back()
                            ->with('error-msg', $e->getMessage());
        }

        Session::flash('success-msg', 'Posted Successfully');
        return redirect()->back();
    }

    public function getCreateFacebookPostswithImage()
    {
        return view('facebook::create-fb-post-with-image');
    }

    public function postCreateFacebookPostswithImages(Request $request)
    {
        $request->validate([
            'message' => 'required', 
            'image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            ]);
        try
        {
            $input = request()->all();
            if($request->hasFile('image')) 
            {
                $name = uniqid() . $request->image->getClientOriginalName();
                $ext = $request->image->getClientOriginalExtension();
                $request->image->move(public_path().'/images/fb_post_images',$name,$ext);
                $input['image'] = $name;
            }
            $controller = new HelperController;
            $input['created_by'] = $controller->getCreatedBy();
            $fb_post = FacebookImagePosts::create($input);

            SendTo::Facebook(
            'photo',
            [
                'photo' => public_path().'/images/fb_post_images/'.$fb_post->image,
                'message' => $fb_post->message
            ]
            );
            Session::flash('success-msg', 'Posted Successfully');
            return redirect()->back();
        }
        catch(Exception $e)
        {
            return redirect()->back()
                             ->with('error-msg', $e->getMessage());
        }    
    }

    public function getListFacebookPosts(Request $request)
    {
        $fb_posts = '';
        if($request->has('post_type'))
        {
            if($request->post_type == 'fb_post_link')
            {
                $fb_posts = FacebookPosts::orderBy('created_at', 'DESC')
                                        ->paginate(4);
                                                    
            }
            elseif($request->post_type == 'fb_post_image')
            {
                $fb_posts = FacebookImagePosts::orderBy('created_at','DESC')
                                        ->paginate(4);
                                                        
            }
            else
            {
                $fb_posts = '';

            }
        }

        return view('facebook::list-facebook-post')->with('fb_posts', $fb_posts)
                                                   ->with('post_type', $request->post_type);
                                                   
    }

    public function getViewFacebookPosts($id , $post_type)
    {
        if($post_type == 'fb_post_image')
        {
            $fb_post = FacebookImagePosts::where('id', $id)
                                            ->first();
        }
        else
        {
            $fb_post = FacebookPosts::where('id', $id)
                                        ->first();
        }   

        return view('facebook::view-fb-post')->with('fb_post', $fb_post)
                                             ->with('post_type', $post_type);
    }

    public function getDeleteFacebookPost($id, $post_type)
    {
                
        if($post_type == 'fb_post_image')
        {
            $fb_post = FacebookImagePosts::findorfail($id);
            $image_path = public_path().'/images/fb_post_images/'.$fb_post->image;

            if(File::exists($image_path))
            {
                File::delete($image_path);
            }
            $fb_post->delete();

        }
        else
        {
            FacebookPosts::where('id', $id)->delete();
        }

        Session::flash('success-msg', 'Deleted Successfully');
        
        $url = route('list-fb-post');
        
        $url .= '?post_type='.$post_type.'&page=1';
        return redirect()->to($url);
    }
}
