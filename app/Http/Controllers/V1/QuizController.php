<?php

namespace App\Http\Controllers\V1;

use App\Constants\ApiEndpoint;
use App\Constants\StatusApiConstant;
use App\DTO\ResponseApi;
use App\Http\Controllers\Controller;
use App\Service\Client;
use Illuminate\Http\Request;

class QuizController extends Controller
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
            $response = $this->client->get($this->apiEndpoint::$qna);
            $responseApi = new ResponseApi($response);
            
            if ($responseApi->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($responseApi->message == StatusApiConstant::$success) {
                $qna = $responseApi->getData();
                return view('quiz.index', compact('qna'));
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

   
}
