<?php

namespace App\Http\Controllers\V1;

use App\Constants\ApiEndpoint;
use App\Constants\StatusApiConstant;
use App\DTO\ResponseApi;
use App\Http\Controllers\Controller;
use App\Service\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ForumController extends Controller
{
    protected $apiEndpoint;
    protected $client;

    public function __construct()
    {
        $this->client = new Client;
        $this->apiEndpoint = new ApiEndpoint();
    }

    public function index(Request $request)
    {
        if (Auth::guest()) {
            $limit = 5;
            $page = $request->input('page');
            if ($page == null) {
                $page = 1;
            }
            $pageUser = $request->input('page_user');
            if ($pageUser == null) {
                $pageUser = 1;
            }
            try {
                $response = $this->client->getWithAuth($this->apiEndpoint::$forum . "?limit=" . $limit . "&page=" . $page);
                $responseuser = $this->client->getWithAuth($this->apiEndpoint::$forumuser."?limit=" . $limit . "&page=" . $pageUser);
                $responseApi = new ResponseApi($response);
                $responseApiUser = new ResponseApi($responseuser);

                if ($responseApi->message == StatusApiConstant::$failed && $responseApiUser->message == StatusApiConstant::$failed) {
                    dd($responseApiUser->getInfo());
                    return redirect()->back()->withErrors($responseApi->getInfo() . ' ' . $responseApiUser->getInfo());
                } elseif ($responseApi->message == StatusApiConstant::$success && $responseApiUser->message == StatusApiConstant::$success) {
                    $forum_user = $responseApiUser->getForumPagination();
                    $forum_user_count = count($responseApiUser->getData());
                    $forums = $responseApi->getData()->forum_pagination;
                    $total_page_forum = $responseApi->getData()->max_page;
                    $total_page_user = $responseApiUser->getMaxPage();
                    $themes = $responseApi->getData()->theme;
                    $account = $responseApi->getAccount();
                    //array for page number
                    $startPage = $page - 2;
                    $endPage = $page + 2;
                    if ($startPage <= 0) {
                        $endPage -= ($startPage - 1);
                        $startPage = 1;
                        $pageNumber = array(1);
                    } else {
                        $pageNumber = array(1,"...");
                    }
                    if ($endPage > $total_page_forum) $endPage = $total_page_forum;
                    for ($i=$startPage; $i <= $endPage; $i++) {
                        if ($i > 1 && $i <= $endPage) {
                            if ($i >= $total_page_forum) continue;
                            array_push($pageNumber,$i);
                        }
                    }
                    if ($endPage+2 > $total_page_forum) array_push($pageNumber,$total_page_forum);
                    else array_push($pageNumber,"...",$total_page_forum);

                    //array for page number
                    $startPageUser = $pageUser - 2;
                    $endPageUser = $pageUser + 2;
                    if ($startPageUser <= 0) {
                        $endPageUser -= ($startPageUser - 1);
                        $startPageUser = 1;
                        $pageNumberUser = array(1);
                    } else {
                        $pageNumberUser = array(1,"...");
                    }
                    if ($endPageUser > $total_page_user) $endPageUser = $total_page_user;
                    for ($i=$startPageUser; $i <= $endPageUser; $i++) {
                        if ($i > 1 && $i <= $endPageUser) {
                            if ($i >= $total_page_user) continue;
                            array_push($pageNumberUser,$i);
                        }
                    }
                    if ($endPageUser+2 > $total_page_user) array_push($pageNumberUser,$total_page_user);
                    else array_push($pageNumberUser,"...",$total_page_user);

                    //check for ajax request
                    if ($request->ajax()) {
                        if ($request->input('parent') == 'comments') {
                            return view('forum._comments', ['forums' => $forums, 'total_page_forum' => $total_page_forum, 'account' => $account, 'pageNumber' => $pageNumber, 'page' => $page])->render();
                        } elseif ($request->input('parent') == 'posts') {
                            return view('forum._postings', ['forum_user' => $forum_user, 'total_page_user' => $total_page_user, 'account' => $account, 'pageNumberUser' => $pageNumberUser, 'pageUser' => $pageUser])->render();
                        }
                    }
                    // dd($forums);
                    return view('forum.index', compact('forums', 'total_page_forum', 'themes', 'forum_user', 'account', 'pageNumber', 'page', 'pageNumberUser', 'pageUser', 'total_page_user', 'forum_user_count'));
                }
            } catch (\Exception $th) {
                dd($th->getMessage());
                return redirect()->back()->withErrors($th->getMessage());
            }
        } else {
            $limit = 5;
            $page = $request->input('page');
            if ($page == null) {
                $page = 1;
            }
            try {
                $response = $this->client->get($this->apiEndpoint::$forum);
                $responseApi = new ResponseApi($response);

                if ($responseApi->message == StatusApiConstant::$failed) {
                    return redirect()->back()->withErrors($responseApi->getInfo());
                } elseif ($responseApi->message == StatusApiConstant::$success) {
                    $forums = $responseApi->getData()->forum_pagination;
                    $total_page_forum = $responseApi->getData()->max_page;
                    $themes = $responseApi->getData()->theme;
                    $account = $responseApi->getAccount();
                    // dd($forum);
                    //array for page number
                    $startPage = $page - 2;
                    $endPage = $page + 2;
                    if ($startPage <= 0) {
                        $endPage -= ($startPage - 1);
                        $startPage = 1;
                        $pageNumber = array(1);
                    } else {
                        $pageNumber = array(1,"...");
                    }
                    if ($endPage > $total_page_forum) $endPage = $total_page_forum;
                    for ($i=$startPage; $i <= $endPage; $i++) {
                        if ($i > 1 && $i <= $endPage) {
                            if ($i >= $total_page_forum) continue;
                            array_push($pageNumber,$i);
                        }
                    }
                    if ($endPage+2 > $total_page_forum) array_push($pageNumber,$total_page_forum);
                    else array_push($pageNumber,"...",$total_page_forum);
                    //check for ajax request
                    if ($request->ajax()) {
                        return view('forum._comments', ['forums' => $forums, 'total_page_forum' => $total_page_forum, 'account' => $account, 'pageNumber' => $pageNumber, 'page' => $page])->render();
                    }
                    return view('forum.index', compact('forums', 'total_page_forum', 'themes', 'account', 'pageNumber', 'page'));
                }
            } catch (\Exception $th) {
                return redirect()->back()->withErrors($th->getMessage());
            }
        }
    }
    public function create_post(Request $request)
    {
        //  dd($request->all());

        try {
            $clientService = new Client;
            $url = $this->apiEndpoint::$forumpost . '?token=' . $request->theme;
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
    public function topik($id)
    {

        try {
            $responsetheme = $this->client->getWithAuth($this->apiEndpoint::$forum);
            $response = $this->client->getWithAuth($this->apiEndpoint::$forumtopik . '?token=' . $id);
            $responseApi = new ResponseApi($response);
            $responseApitheme = new ResponseApi($responsetheme);

            if ($responseApi->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($responseApi->message == StatusApiConstant::$success) {
                $data = $responseApi->getData();
                $account = $responseApi->getAccount();
                $themes = $responseApitheme->getData()->theme;
                return view('forum.topik', compact('data', 'id', 'themes', 'account'));
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
    public function detail($id)
    {

        try {
            $response = $this->client->getWithAuth($this->apiEndpoint::$forumdetail . '?token=' . $id);
            $responseApi = new ResponseApi($response);



            if ($responseApi->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($responseApi->message == StatusApiConstant::$success) {
                $forum = $responseApi->getData();
                $account = $responseApi->getAccount();
                return view('forum.detail', compact('forum', 'id', 'account'));
            }
        } catch (\Exception $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function delete($id)
    {

        try {
            $clientService = new Client;
            $url = $this->apiEndpoint::$forumpost . '?token=' . $id;


            $response = $clientService->delete($url);
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

    public function delete_comment(Request $request)
    {

        try {
            $clientService = new Client;
            $url = $this->apiEndpoint::$forumcomment . '?token=' . $request->id;


            $response = $clientService->delete($url);
            $responseApi = new ResponseApi($response);


            if ($response->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($response->message == StatusApiConstant::$success) {

                return redirect()->route('forum.detail', $request->detail_id);
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
            $url = $this->apiEndpoint::$forumcomment . '?token=' . $request->id;
            // dd(json_encode($request->all()));

            $response = $clientService->post($url, $request->all());
            $responseApi = new ResponseApi($response);


            if ($response->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($response->message == StatusApiConstant::$success) {

                return redirect()->route('forum.detail', $request->id);
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
            $url = $this->apiEndpoint::$forumlike . '?token=' . $id;
            // dd(json_encode($request->all()));
            $response = $clientService->post_like($url);
            $responseApi = new ResponseApi($response);
            // dd($responseApi);
            if ($response->message == StatusApiConstant::$failed) {
                return redirect()->back()->withErrors($responseApi->getInfo());
            } elseif ($response->message == StatusApiConstant::$success) {

                return redirect()->route('forum.index');
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
            $url = $this->apiEndpoint::$forumlike . '?token=' . $id;
            $response = $clientService->delete($url);
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
}
