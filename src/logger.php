<?php

class Logger
{
    public $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    // オブジェクトの参照が終わると共に、ログに書き込む
    public function __destruct()
    {
        file_put_contents('Logs/sample.log', $this->content . "\n", FILE_APPEND);
    }

}