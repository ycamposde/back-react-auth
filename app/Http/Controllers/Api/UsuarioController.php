<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsuario;
use App\Services\Usuario as UsuarioService;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use DB;
use Hash;
use App\User;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class UsuarioController extends Controller{
    protected $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function index(){
        return $this->usuarioService->all();
    }

    public function store(StoreUsuario $request){

        $data = $request->all();
        $user = [
            "name" => isset($data['nombres']) ? $data['nombres'] : '',
            "email" => isset($data['email']) ? $data['email'] : '',
            "password" => Hash::make($request->password),
        ];
        
        $usuario = new User();
        $usuario->name = $user['name'];
        $usuario->email = $user['email'];
        $usuario->password = $user['password'];
        $usuario->save();

        //return $this->usuarioService->store($user);
    }

    public function update(StoreUsuario $request, $usuario){
        return $this->usuarioService->update($request-> all(), $usuario->id);
    }

    public function destroy($usuario){
        return $this->usuarioService->delete($usuario->id);
    }

    public function show($usuario){
        return $usuario;
    }
    
    public function login(Request $request){

        $http = new Client;
        $response = $http->post('http://react-back.test/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => '6eXttdVLtwLmmqehy0gZVcPaZSccoS9dCYD0vETn',
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ],
        ]);
        
        return json_decode((string) $response->getBody(), true);
        
    }

    public function auth(Request $request){

        $password=$request->password;
        $users = DB::table('users')->where('email',$request->email)->get();

        if (count($users) > 0) {
            $encriptado=$users[0]->password;
            if (Hash::check($password,$encriptado)) {
                return $users;
                return "Bienvenido al sistema!";
            } else {
                return "No se peude aceder al sistema!";
            }
        } else {
            return "Correo no existe!";
        }
    }
}