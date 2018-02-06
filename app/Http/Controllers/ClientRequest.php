<?php
/**
 * Created by PhpStorm.
 * User: bau
 * Date: 1/12/2018
 * Time: 4:18 PM
 */

namespace App\Http\Controllers;


class ClientRequest
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const PATCH = 'PATCH';
    const DELETE = 'DELETE';
    private $config;
    private $params;
    private $path_full;

    public function __construct($config = array())
    {
        if (!empty($config)) {
            $this->config['base_domain'] = $config['base_domain'];
        }
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $config
     * @return mixed
     */
    private function sendRequest($method, $url, $config = array())
    {
        $curl_setopt_array = array(
            CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        );

        $this->config['path'] = $url;

        $base_domain = isset($this->config['base_domain']) ? $this->config['base_domain'] : '';
        $this->path_full = !empty($base_domain) ? $base_domain . $this->config['path'] : $this->config['path'];

        switch ($method) {
            case static::GET:
                $curl_setopt_array += $this->handleMethodGET();
                break;
            case static::POST:
                $curl_setopt_array += $this->handleMethodPOST();
                break;
            case static::PUT:
                $curl_setopt_array += $this->handleMethodPUT();
                break;
            case static::PATCH:
                $curl_setopt_array += $this->handleMethodPATCH();
            default:
                $curl_setopt_array += $this->handleMethodDELETE();
                break;
        }

        $ch = curl_init();
        curl_setopt_array($ch, $curl_setopt_array);
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $response_data = json_decode($response, true);

        return array(
            'status_code' => $http_code,
            'data' => $response_data
        );
    }

    private function handleMethodGET()
    {
        return array(
            CURLOPT_URL => $this->path_full . (!empty($this->params) ? $this->params : ''),
        );
    }

    private function handleMethodPOST()
    {
        return array(
            CURLOPT_URL => $this->path_full,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $this->params
        );
    }

    public function handleMethodPUT()
    {
        return array(
            CURLOPT_URL => $this->path_full,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $this->params
        );
    }

    public function handleMethodPATCH()
    {
        return array(
            CURLOPT_URL => $this->path_full,
            CURLOPT_CUSTOMREQUEST => 'PATCH',
            CURLOPT_POSTFIELDS => $this->params
        );
    }

    public function handleMethodDELETE()
    {
        return array(
            CURLOPT_URL => $this->path_full,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_POSTFIELDS => $this->params
        );
    }

    /**
     * @param string $path
     * @param array $params
     * @return mixed
     */
    public function get($path, $params = array())
    {
        if (!empty($params)) {
            $this->params = http_build_query($params);
            $path .= '?';
        }

        return $this->sendRequest(self::GET, $path);
    }

    public function post($path, $params = array())
    {
        if (!empty($params)) {
            $this->params = http_build_query($params);
            $path .= '?';
        }

        return $this->sendRequest(self::POST, $path);
    }

    public function put($path, $params = array())
    {
        if (!empty($params)) {
            $this->params = http_build_query($params);
            $path .= '?';
        }

        return $this->sendRequest(self::PUT, $path);
    }

    public function patch($path, $params = array())
    {
        if (!empty($params)) {
            $this->params = http_build_query($params);
            $path .= '?';
        }

        return $this->sendRequest(self::PATCH, $path);
    }

    public function delete($path, $params = array())
    {
        if (!empty($params)) {
            $this->params = http_build_query($params);
            $path .= '?';
        }

        return $this->sendRequest(self::DELETE, $path);
    }
}