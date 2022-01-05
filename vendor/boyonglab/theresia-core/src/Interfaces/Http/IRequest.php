<?php
namespace Boyonglab\Theresia\Core\Interfaces\Http;

interface IRequest{

    public function getHost();

    public function getUri();

    public function getIp();

    public function getPort();

    public function getTime();
    
    public function getCookies();

    public function getUserAgent();

    public function getServerName();

    public function getPath();

    public function getQuery();

    public function getMethod();
}
