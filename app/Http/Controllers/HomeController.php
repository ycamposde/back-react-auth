<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    public function token(){

        $http = new Client;

        $response = $http->post('http://react-back.test/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'g6bawGfdf1QFzYQYl0cSVCC1AoK5UFUH4RRUoMFt',
                'username' => 'ycamposde@gmail.com',
                'password' => 'Yer24CD98',
                'scope' => '',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }
}
