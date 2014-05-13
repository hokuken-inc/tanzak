<?php

use Illuminate\Support\MessageBag;

class SessionController extends BaseController {

    public function login()
    {
        $errors = new MessageBag();

        if (Auth::check())
        {
            return Redirect::intended('/');
        }

        if ($old = Input::old('errors'))
        {
            $errors = $old;
        }

        $data = array('errors' => $errors);

        if (Request::isMethod('post'))
        {
            $validator = Validator::make(Input::all(), array(
                'email'    => 'required',
                'password' => 'required'
            ));

            if ($validator->passes())
            {
                $credentials = array(
                    'email'    => Input::get('email'),
                    'password' => Input::get('password')
                );
                $credentials_name = array(
                    'name'    => Input::get('email'),
                    'password' => Input::get('password')
                );

                if (Auth::attempt($credentials))
                {
                    return Redirect::intended('/');
                }

                if (Auth::attempt($credentials_name))
                {
                    return Redirect::intended('/');
                }

            }
            else
            {
                $data['errors'] = new MessageBag(array(
                    'password' => array('ユーザー/パスワードが無効です。')
                ));

                $data['email'] = Input::get('email');

                return Redirect::route('login')->withInput($data);
            }
        }
        return View::make('session.login', $data);
    }
    
    public function logout()
    {
        Auth::logout();
        return Redirect::to('/');
    }
}
