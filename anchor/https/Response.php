<?php

class Response {

    protected $content;
    protected $status_code = 200;
    protected $status_text = 'OK';
    protected $http_headers = array();
    protected $protocol_version;

    public function __construct($protocol_version = '1.1') {
        $this->protocol_version = $protocol_version;
        ob_start();
    }

    public function send() {
        header($this->protocol_version . ' ' . $this->status_code . ' ' . $this->status_text);

        foreach ($this->http_headers as $key => $val) {
            header($key . ': ' . $val);
        }

        echo $this->content;
    }

    public function setContent($content, $contentType = 'text/html') {
        $this->content = $content;
        $this->setHttpHeader('Content-Type', $contentType);
    }

    public function setStatusCode($status_code, $status_text = '') {
        $this->status_code = $status_code;
        $this->status_text = $status_text;
    }

    public function setHttpHeader($header, $val) {
        $this->http_headers[$header] = $val;
    }
}
