<?php

namespace App\Http\Controllers\V1;

use App\Constants\ApiEndpoint;
use App\Constants\StatusApiConstant;
use App\DTO\ResponseApi;
use App\Http\Controllers\Controller;
use App\Service\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QnaController extends Controller
{
    protected $apiEndpoint;
    protected $client;

    public function __construct()
    {
        $this->client = new Client;
        $this->apiEndpoint = new ApiEndpoint();
    }

    public function index() {
        if (Auth::guest()) {
            try {
                $response = $this->client->getWithAuth($this->apiEndpoint::$qna);
                $responseFilter = $this->client->getWithAuth($this->apiEndpoint::$qnafilter);
                
                $responseApi = new ResponseApi($response);
                $responseApiFilter = new ResponseApi($responseFilter);
                
                if ($responseApi->message == StatusApiConstant::$failed && $responseApiFilter->message == StatusApiConstant::$failed) {                
                    return redirect()->back()->withErrors($responseApi->getInfo().' '.$responseApiFilter->getInfo());
                } elseif ($responseApi->message == StatusApiConstant::$success && $responseApiFilter->message == StatusApiConstant::$success ) {
                    $qnaFilter = $responseApiFilter->getData();
                    $account = $responseApi->getAccount();
                    $qna = $responseApi->getData();
                    // dd(json_encode($qnaFilter));
                    return view('qna.index', compact('qna','account','qnaFilter'));
                }
           
            } catch (\Exception $th) {
                return redirect()->back()->withErrors($th->getMessage());
            }
        }else{
            
        }
        
    }

    public function theme($id) {
       
        try {
            $response = $this->client->getWithAuth($this->apiEndpoint::$qna);
            $responseApi = new ResponseApi($response);

            $responsetheme = $this->client->getWithAuth($this->apiEndpoint::$qnaPostByTheme);
            $responseApitheme = new ResponseApi($responsetheme);
            
            $responseuser = $this->client->getWithAuth($this->apiEndpoint::$qnauser);
            $responseApiuser = new ResponseApi($responseuser);
            
            if ($responseApi->message == StatusApiConstant::$failed) {                
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($responseApi->message == StatusApiConstant::$success ) {
                $qna = $responseApi->getData();
                $theme = $responseApitheme->getData();
                $user = $responseApiuser->getData();
                $account = $responseApi->getAccount();
                
                return view('qna.index', compact('qna','account','theme','user','id'));
            }
       
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }

    }
        public function create_post(Request $request)
        {
            //  dd($request->all());
            
            try {
                $clientService = new Client;
                $url = $this->apiEndpoint::$forumpost.'?token='.$request->theme;
                // dd(json_encode($request->all()));
               
                $response = $clientService->post($url, $request->all());
                $responseApi = new ResponseApi($response);
                
    
                if ($response->message == StatusApiConstant::$failed) {
                    return redirect()->back()->withErrors($responseApi->getInfo());
                } elseif ($response->message == StatusApiConstant::$success) {
                   
                    return redirect()->route('forum.index');
                }
            } catch (\Exception $th) {
                return redirect()->back()->withErrors($th->getMessage());
            }
        }        
        public function detail($id) {
            
            try {
                $response = $this->client->getWithAuth($this->apiEndpoint::$qnadetail.'?token='.$id);
                $responseApi = new ResponseApi($response);
    
               
                
                if ($responseApi->message == StatusApiConstant::$failed) {
                    return redirect()->back()->withErrors($responseApi->getInfo());
                } elseif ($responseApi->message == StatusApiConstant::$success) {
                    $qna = $responseApi->getData();
                    $account = $responseApi->getAccount();
                    return view('qna.detail', compact('qna','id','account'));
                }
            } catch (\Exception $th) {
                return redirect()->back()->withErrors($th->getMessage());
            }
        }
    
        public function delete($id) {
            
            try {
                $clientService = new Client;
                $url = $this->apiEndpoint::$qnapost.'?token='.$id;
                
               
                $response = $clientService->delete($url);
                $responseApi = new ResponseApi($response);
                
                    
                if ($response->message == StatusApiConstant::$failed) {
                    return redirect()->back()->withErrors($responseApi->getInfo());
                } elseif ($response->message == StatusApiConstant::$success) {
                   
                    return redirect()->route('qna.index');
                }
            } catch (\Exception $th) {
                return redirect()->back()->withErrors($th->getMessage());
            }
        }
    
        public function delete_comment(Request $request) {
            
            try {
                $clientService = new Client;
                $url = $this->apiEndpoint::$qnacomment.'?token='.$request->id;
                
               
                $response = $clientService->delete($url);
                $responseApi = new ResponseApi($response);
                
                    
                if ($response->message == StatusApiConstant::$failed) {
                    return redirect()->back()->withErrors($responseApi->getInfo());
                } elseif ($response->message == StatusApiConstant::$success) {
                   
                    return redirect()->route('qna.detail',$request->detail_id);
                }
            } catch (\Exception $th) {
                return redirect()->back()->withErrors($th->getMessage());
            }
        }
    
        public function create_comment(Request $request)
        {
            //  dd($request->all());
            
            try {
                $clientService = new Client;
                $url = $this->apiEndpoint::$qnacomment.'?token='.$request->id;
                // dd(json_encode($request->all()));
               
                $response = $clientService->post($url, $request->all());
                $responseApi = new ResponseApi($response);
                
    
                if ($response->message == StatusApiConstant::$failed) {
                    return redirect()->back()->withErrors($responseApi->getInfo());
                } elseif ($response->message == StatusApiConstant::$success) {
                   
                    return redirect()->route('qna.detail',$request->id);
                }
            } catch (\Exception $th) {
                return redirect()->back()->withErrors($th->getMessage());
            }
        }
    
        public function like_post($id)
        {
            // dd($request->all());
            
            try {
                $clientService = new Client;
                $url = $this->apiEndpoint::$qnalike.'?token='.$id;
                // dd(json_encode($request->all()));
                $response = $clientService->post_like($url);
                $responseApi = new ResponseApi($response);
            // dd($responseApi);
                if ($response->message == StatusApiConstant::$failed) {
                    return redirect()->back()->withErrors($responseApi->getInfo());
                } elseif ($response->message == StatusApiConstant::$success) {
                   
                    return redirect()->route('qna.index');
                }
            } catch (\Exception $th) {
                return redirect()->back()->withErrors($th->getMessage());
            }
        }
        public function like_comment($id)
        {
            // dd($request->all());
            
            try {
                $clientService = new Client;
                $url = $this->apiEndpoint::$qnalike.'?token='.$id;
                // dd(json_encode($request->all()));
                $response = $clientService->post_like($url);
                $responseApi = new ResponseApi($response);
            // dd($responseApi);
                if ($response->message == StatusApiConstant::$failed) {
                    return redirect()->back()->withErrors($responseApi->getInfo());
                } elseif ($response->message == StatusApiConstant::$success) {
                   
                    return redirect()->route('qna.detail', $id);
                }
            } catch (\Exception $th) {
                return redirect()->back()->withErrors($th->getMessage());
            }
        }
        public function unlike_post($id)
        {
            // dd($request->all());
            
            try {
                $clientService = new Client;
                $url = $this->apiEndpoint::$qnalike.'?token='.$id;
                $response = $clientService->delete($url);
                $responseApi = new ResponseApi($response);
    
                if ($response->message == StatusApiConstant::$failed) {
                    return redirect()->back()->withErrors($responseApi->getInfo());
                } elseif ($response->message == StatusApiConstant::$success) {
                   
                    return redirect()->route('qna.index');
                }
            } catch (\Exception $th) {
                return redirect()->back()->withErrors($th->getMessage());
            }
        }

        public function unlike_comment($id)
        {
            // dd($request->all());
            
            try {
                $clientService = new Client;
                $url = $this->apiEndpoint::$qnalike.'?token='.$id;
                $response = $clientService->delete($url);
                $responseApi = new ResponseApi($response);
    
                if ($response->message == StatusApiConstant::$failed) {
                    return redirect()->back()->withErrors($responseApi->getInfo());
                } elseif ($response->message == StatusApiConstant::$success) {
                   
                    return redirect()->route('qna.detail', $id);
                }
            } catch (\Exception $th) {
                return redirect()->back()->withErrors($th->getMessage());
            }
        }
}
   

