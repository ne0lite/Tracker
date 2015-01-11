<?php

class AuthController extends BaseController
{
    public function getRegister()
    {
        return View::make('auth/register');
    }

    public function postRegister()
    {
        $data = Input::all();

        $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed',
        );

        $validator = Validator::make($data, $rules);

        if ($validator->passes())
        {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->save();

            Auth::login($user);

            return Redirect::to('/');
        }

        return Redirect::to('register')->withInput()->withErrors($validator);
    }

    public function getLogin()
    {
        if (!Auth::check())
        {
            return View::make('auth/login');
        }
        return Redirect::to('/');
    }

    public function postLogin()
    {
        $remember_auth = !empty(Input::get('remember_me'));

        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), $remember_auth))
        {
            return Redirect::to('/');
        }

        return Redirect::to('login')->withErrors(array('loginfailed' => 'Login failed!'));
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/');
    }
}
?>
