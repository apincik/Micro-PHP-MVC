<?php

namespace Darkside\Http;


class Response
{


    public function sendResponse(array $requestResult)
    {
        return call_user_func_array(
            array(
                $requestResult['controller'],
                'render'. $requestResult['method']
            ),
            $requestResult['args']
        );
    }

}
