<?php

class FacebookController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */




    public function show()
    {
        $data = array();

        if (Auth::check()) {
            $data = Auth::user();
        }
        return View::make('user', array('data'=>$data));
    }





    public function login(){
        $facebook = new Facebook(Config::get('facebook'));
        $params = array(
            'redirect_uri' => url('/login/fb/callback'),
            'scope' => 'email',
        );
        return Redirect::to($facebook->getLoginUrl($params));
    }





    public function doLogin(){
        $code = Input::get('code');
        if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');

        $facebook = new Facebook(Config::get('facebook'));
           $uid = $facebook->getUser();

        if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');


          $me = $facebook->api('/me',['fields' => [
            'id',
            'first_name',
            'last_name',
            'picture',
            'email',
              'gender'

        ]]);

         $profile = Profile::whereUid($uid)->first();


          if (empty($profile)) {

            $user = new User;
            $user->name = $me['first_name'].' '.$me['last_name'];
            $user->email = $me['email'];
            $user->photo = 'https://graph.facebook.com/'.$me['id'].'/picture?type=large';

            $user->save();

            $profile = new Profile();
            $profile->uid = $uid;
            $profile->username = $me['id'];
            $profile->gender = $me['gender'];
            $profile = $user->profiles()->save($profile);
        }

        $profile->access_token = $facebook->getAccessToken();
        $profile->save();

        $user = $profile->user;

        Auth::login($user);

        return Redirect::to('/')->with('message', 'Logged in with Facebook');
    }






    public function logout(){
        Auth::logout();
        return Redirect::route('user');
    }
}
