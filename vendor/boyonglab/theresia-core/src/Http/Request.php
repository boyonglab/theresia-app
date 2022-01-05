<?php
namespace Boyonglab\Theresia\Core\Http;

class Request {

    public function __construct()
    {
       
    }

    public function getHost(): string
    {
        return $_SERVER['HTTP_HOST'];
    }

    public function getUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getPath(): string
    {   $uri = $_SERVER['REQUEST_URI'];
        $params = explode('?', $uri);
        return $params[0] == '/' ? $params[0] : rtrim($params[0], '/');
    }

    public function getQuery($key = null): string | array
    {
        $params = [];
        $queryString = $_SERVER['QUERY_STRING'] ?? '';
        $items = explode('&', $queryString);

        foreach($items as $item) {
          $pair = explode('=', $item);
          $params[$pair[0]] = $pair[1] ?? '';
        }

        if (!$key) {
          return $params;
        }

        return $params[$key] ?? '';
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getIp(): string
    {
       return $_SERVER['REMOTE_ADDR'];
    }

    public function getPort(): string
    {
       return $_SERVER['REMOTE_PORT'];
    }

    public function getTime(): string
    {
       return $_SERVER['REQUEST_TIME'];
    }

    public function getCookie(): string
    {
       return $_SERVER['HTTP_COOKIE'];
    }

    public function getUserAgent(): string
    {
       return $_SERVER['HTTP_USER_AGENT'];
    }

    public function getServerName(): string
    {
       return $_SERVER['SERVER_NAME'];
    }

    public function getHeaders(): array|false
    {
       return getallheaders();
    }
    
    public function getJson(): array
    {
        return json_decode(file_get_contents('php://input'), true) ?? [];
    }

    public function getPost(): array
    {
        return $_POST;
    }

    public function getUrl(): string
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    }

}
