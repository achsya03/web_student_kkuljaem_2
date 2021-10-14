<?php

namespace App\Http\Controllers\V1;

use App\Constants\ApiEndpoint;
use App\Constants\StatusApiConstant;
use App\DTO\ResponseApi;
use App\Http\Controllers\Controller;
use App\Service\Client;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    protected $apiEndpoint;
    protected $client;

    public function __construct()
    {
        $this->client = new Client;
        $this->apiEndpoint = new ApiEndpoint();
    }

    public function index() {
        try {
            $response = $this->client->getWithAuth($this->apiEndpoint::$packet);
            $responseApi = new ResponseApi($response);
            
            if ($responseApi->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($responseApi->message == StatusApiConstant::$success) {
                $packets = $responseApi->getData();
                return view('pembayaran.index', compact('packets'));
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function langganan(Request $request)
    {
        //   dd($request->all());
        
        try {
            $clientService = new Client;
            $url = $this->apiEndpoint::$subsdetail.'?token='.$request->token;
            // dd(json_encode($request->all()));
           
            $response = $clientService->getWithAuth($url);
            $responseApi = new ResponseApi($response);
            //  dd($response);
            if ($response->message == StatusApiConstant::$failed) {
                return redirect()->route('pembayaran.index')->with('failed', $response->error);
            } elseif ($response->message == StatusApiConstant::$success) { 
                $packets = $responseApi->getData();  
                $token=    $request->token;        
                $referal=    $request->referal;        
                return view('pembayaran.pesan', compact('packets','token','referal'));
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
    public function pesan_packet(Request $request)
    {
        //   dd($request->all());
        
        try {
            $clientService = new Client;
            $url = $this->apiEndpoint::$subs.'?token='.$request->token;
            // dd(json_encode($request->all()));
           
            $response = $clientService->post($url, $request->all());
            $responseApi = new ResponseApi($response);
            // dd($response);
            if ($response->message == StatusApiConstant::$failed) {
                return redirect()->route('pembayaran.langganan')->with('failed', $response->error);
                
            } elseif ($response->message == StatusApiConstant::$success) {                 
                $subs = $responseApi->getData()->payment->payment_url;      
                $packets = $responseApi->getData();  
                $info = $responseApi->getInfo();  
                $token=    $request->token;        
                $referal=    $request->referal;        
                return view('pembayaran.sukses', compact('packets','token','referal','subs','info'));
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

   
}
// ->with('success', 'Data berhasil ditambahkan!');