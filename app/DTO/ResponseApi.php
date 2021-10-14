<?php

namespace App\DTO;

class ResponseApi
{
    public $message;
    public $info;

    public function __construct($response)
    {
        $this->message = $response->message ?? null;
        $this->info = $response->info ?? null;
        $this->data = $response->data ?? null;
        $this->account = $response->account ?? null;
        $this->error = $response->error ?? null;
        $this->forum_pagination = $response->forum_pagination ?? null;
        $this->max_page = $response->max_page ?? null;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getInfo()
    {
        return $this->info;
    }

    public function getData() {
        return $this->data;
    }
    public function getAccount() {
        return $this->account;
    }
    public function getError()
    {
        return $this->error;
    }
    public function getForumPagination()
    {
        return $this->forum_pagination;
    }
    public function getMaxPage()
    {
        return $this->max_page;
    }
    public function getDataArray() {
        return json_decode(json_encode($this->data), true);
    }
}
