<?php

namespace App\Http\Controllers\V1;

use App\Constants\ApiEndpoint;
use App\Constants\StatusApiConstant;
use App\DTO\ForgetDTO;
use App\DTO\LoginDTO;
use App\DTO\RegisterDTO;
use App\DTO\ResponseApi;
use App\Http\Controllers\Controller;
use App\Service\Client;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $apiEndpoint;

    public function __construct()
    {
        $this->apiEndpoint = new ApiEndpoint();
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
        try {
            $clientService = new Client;
            $url = $this->apiEndpoint::$loginProcess;

            $loginDTO = new LoginDTO;
            $loginDTO->email = $request->email;
            $loginDTO->password = $request->password;
            $loginDTO->device_id = 'web';
            $loginDTO->lokasi = '-7.889006,110.296746';
                    
            $response = $clientService->post($url, $loginDTO->getArray());
            
            $responseApi = new ResponseApi($response);
            if ($response->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($response->message == StatusApiConstant::$success) {
                session()->put('bearer_token', $response->data->bearer_token);
                session()->put('login', [
                    "jenis_pengguna" => $response->data->jenis_pengguna,
                    "jenis_akun" => $response->data->jenis_akun,
                ]);
                return redirect()->route('dashboard.index');
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function register()
    {
        return view('auth.register');
    }
    public function register_2()
    {
        return view('auth.register-2');
    }
    public function register_3()
    {
        return view('auth.register-3');
    }
    public function change_success()
    {
        return view('auth.change-success');
    }
    public function change_password()
    {
        $token='';
        return view('auth.change-password',compact('token'));
    }
    public function forgot()
    {
        return view('auth.forgot');
    }

    public function forgotProcess(Request $request)
    {
        try {
            $clientService = new Client;
            $url = $this->apiEndpoint::$forgetPassword;       

            $response = $clientService->post($url, $request->all());
            
            $responseApi = new ResponseApi($response);

            if ($response->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($response->message == StatusApiConstant::$success) {               
                return redirect()->route('auth.forgot');
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
    public function change_password_process(Request $request)
    {
        try {
            $clientService = new Client;
            $url = $this->apiEndpoint::$changePassword.'?token='.$request->token;
            $response = $clientService->put($url, $request->all());
            $responseApi = new ResponseApi($response);
            // dd($response);
            if ($response->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($response->message == StatusApiConstant::$success) {               
                return redirect()->route('change-success.index');
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function registerProcess(Request $request)
    {
        try {
            $clientService = new Client;
            $url = $this->apiEndpoint::$registerProcess;

            $registerDTO = new RegisterDTO;
            $registerDTO->email = $request->email;
            $registerDTO->password = $request->password;
            $registerDTO->password_confirmation = $request->password_confirmation;

            $response = $clientService->post($url, $registerDTO->getArray());

            $responseApi = new ResponseApi($response);
            if ($response->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($response->message == StatusApiConstant::$success) {
                return redirect()->route('register.register-2')
                ->with('email', $request->email)
                ->withErrors($responseApi->getInfo());
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
}
