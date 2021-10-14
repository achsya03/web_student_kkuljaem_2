<?php

namespace App\Http\Controllers\V1;

use App\Constants\ApiEndpoint;
use App\Constants\StatusApiConstant;
use App\DTO\ResponseApi;
use App\Http\Controllers\Controller;
use App\Service\Client;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClassController extends Controller
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
            $response = $this->client->getWithAuth($this->apiEndpoint::$class);
            $responseApi = new ResponseApi($response);

            $responseHistory = $this->client->getWithAuth($this->apiEndpoint::$classHistory);
            $responseApiHistory = new ResponseApi($responseHistory);
            
            
            if ($responseApi->message == StatusApiConstant::$failed && $responseApiHistory->message == StatusApiConstant::$failed ) {                
                return redirect()->back()->withErrors($responseApi->getInfo().' '. $responseApiHistory->getInfo());
            } elseif ($responseApi->message == StatusApiConstant::$success && $responseApiHistory->message == StatusApiConstant::$success) {
                $class = $responseApi->getData();
                $history = $responseApiHistory->getData();
                $account = $responseApi->getAccount();
                // dd($class);
                return view('class.index', compact('class', 'history','account'));
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    
    }

    public function kategori($id) {
        try {
            $response = $this->client->getWithAuth($this->apiEndpoint::$classByCategory.'?token='.$id);
            $responseApi = new ResponseApi($response);

            $responselainnya = $this->client->getWithAuth($this->apiEndpoint::$class);
            $responseApilainnya = new ResponseApi($responselainnya);
            
            if ($responseApi->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($responseApi->message == StatusApiConstant::$success) {
                $class = $responseApi->getData();
                $lain = $responseApilainnya->getData();
                // dd($class);
                return view('class.kategori', compact('class','lain'));
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    
    }

    public function detail($id) {
        
        try {
            $response = $this->client->getWithAuth($this->apiEndpoint::$classDetail.'?token='.$id);
            $responseApi = new ResponseApi($response);

            $responselainnya = $this->client->getWithAuth($this->apiEndpoint::$class);
            $responseApilainnya = new ResponseApi($responselainnya);
            
            if ($responseApi->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($responseApi->message == StatusApiConstant::$success) {
                $class = $responseApi->getData();
                $lain = $responseApilainnya->getData();
                $account = $responseApi->getAccount();

                // dd($class);

                return view('class.detail', compact('class','lain','account'));
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function mentor($id) {
        
        try {
            $response = $this->client->getWithAuth($this->apiEndpoint::$classDetailMentor.'?token='.$id);
            $responseApi = new ResponseApi($response);
            
            if ($responseApi->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($responseApi->message == StatusApiConstant::$success) {
                $class = $responseApi->getData();
                // dd($class);
                return view('class.mentor', compact('class'));
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
    public function video($id) {
        try {
            $response = $this->client->getWithAuth($this->apiEndpoint::$classDetailVideo.'?token='.$id);
            $responseApi = new ResponseApi($response);

            $responseQna = $this->client->getWithAuth($this->apiEndpoint::$qnaByVideo.'?token='.$id);
            $responseApiQna = new ResponseApi($responseQna);
            
            if ($responseApi->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($responseApi->message == StatusApiConstant::$success) {
                $class = $responseApi->getData();
                $qna = $responseApiQna->getData();
                $account = $responseApi->getAccount();
                // dd($class);
                return view('class.video', compact('class','account','qna'));
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function qnaPostByVideo(Request $request)
    {
        //  dd($request->all());
        
        try {
            $clientService = new Client;
            $url = $this->apiEndpoint::$qnaPostByVideo.'?token='.$request->video_uuid;
            // dd(json_encode($request->all()));
            $response = $clientService->post($url, $request->all());
            $responseApi = new ResponseApi($response);

            if ($response->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($response->message == StatusApiConstant::$success) {
               
                return redirect()->route('class.video',$request->video_uuid);
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function qnaLikeByVideo(Request $request)
    {
        // dd($request->all());
        
        try {
            $clientService = new Client;
            $url = $this->apiEndpoint::$classLikeQna.'?token='.$request->post_uuid;
            // dd(json_encode($request->all()));
            $response = $clientService->post($url, $request->all());
            $responseApi = new ResponseApi($response);

            if ($response->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($response->message == StatusApiConstant::$success) {
               
                return redirect()->route('class.video',$request->post_uuid);
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }


    public function quiz($id) {
        try {
            // $response = $this->client->getWithAuth($this->apiEndpoint::$classDetailQuiz .'?token='.$id);
            $response = $this->client->getWithAuth($this->apiEndpoint::$classDetailQuiz .'?token='.$id);
            $responseApi = new ResponseApi($response);
            
            if ($responseApi->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($responseApi->message == StatusApiConstant::$success) {
                $quiz = $responseApi->getData();
                return view('class.quiz', compact('quiz'));
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function quizEnding(Request $request) {
        try {
            $clientService = new Client;
            $url = $this->apiEndpoint::$classQuizEnding.'?token='.$request->class_uuid;
            // dd(json_encode($request->all()));
            Log::debug($request->all());
            $response = $clientService->post($url, $request->all());
            
            return $response->message;
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    public function latihan($id) {
        try {
            // $response = $this->client->getWithAuth($this->apiEndpoint::$classDetailQuiz .'?token='.$id);
            $response = $this->client->getWithAuth($this->apiEndpoint::$classDetailVideoTask .'?token='.$id);
            $responseApi = new ResponseApi($response);
            if ($responseApi->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($responseApi->message == StatusApiConstant::$success) {
                $quiz = $responseApi->getData();
                return view('class.latihan', compact('quiz', 'id'));
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function shadowing($id) {
        try {
            $response = $this->client->getWithAuth($this->apiEndpoint::$classShadowing.'?token='.$id);
            $responseApi = new ResponseApi($response);
            
            if ($responseApi->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($responseApi->message == StatusApiConstant::$success) {
                $shadowing = $responseApi->getData();
                $account = $responseApi->getAccount();
                
                return view('class.shadowing', compact('shadowing','account'));
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
}
