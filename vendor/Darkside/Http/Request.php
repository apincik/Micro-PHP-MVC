<?php

namespace Darkside\Http;


class Request
{

    private $url;
    private $post;
    private $file;


    public function __construct($urlParam = NULL)
    {
        $param = NULL;
        if($urlParam != NULL ) {
            $param = $urlParam;
        } else {
            $param = isset($_GET['url']) ? $_GET['url'] : "";
        }

        @$this->url = $this->buildUrl($param);
        $this->post = $this->buildPost();
        $this->file = $this->buildFile();
	}


    /**
     * @param string $urlParam
     * @return array
     */
    public function buildUrl($urlParam)
    {

        $url = array();
		$urlParam = rtrim($urlParam, "/");
			
        if($urlParam == NULL) {
            return array(0 => DEFAULT_CONTROLLER, 1 => DEFAULT_METHOD);
        }

        $explode = explode("/", $urlParam);
		
        if(count($explode) == 1) {
				return array(0 => $explode[0], 1 => DEFAULT_METHOD);
		}
		else if(count($explode) == 2) {
			return array(0 => $explode[0], 1 => $explode[1]);
		}
		else {
			$args = array();
			for($i=2; $i < count($explode); $i++) {
				array_push($args, $explode[$i]);
			}
			return array(0 => $explode[0], 1 => $explode[1], 2 => $args);
		}

    }


    private function buildPost()
    {
        return $_POST;
    }


    private function buildFile()
    {
        return $_FILES;
    }


    public function getUrl()
    {
        return $this->url;
    }


    public function getPost()
    {
        return $this->post;
    }

}
