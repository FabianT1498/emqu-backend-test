<?php
namespace App\Http\Traits;

use ErrorException;

trait PingTrait {
    
    public function ping($ip_address, $count = 1)
    {   
        $protocol = 'icmp';
        $protocolNumber = getprotobyname($protocol);
        $socket = \socket_create(AF_INET, SOCK_RAW, $protocolNumber);
        socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
        
        $response_time = [];

        try {
            socket_connect($socket, $ip_address, 0);
        } catch(ErrorException $e){
            return config('constants.UNREACHABLE_SERVER');
        }

        try {
            for ($i = 0; $i < $count; $i++) {
                $startTime = microtime(true);

                $package  = "\x08\x00\x19\x2f\x00\x00\x00\x00\x70\x69\x6e\x67";
                socket_send($socket, $package, strlen($package), 0);

                    if (socket_read($socket, 255)) {
                        $response_time[] = $this->getTime($startTime);
                    } else {
                        $response_time[] = config('constants.SERVER_RESPONSE_TIMEOUT');
                    }
            }
        } catch(ErrorException $e){
            $response_time[] = config('constants.SERVER_RESPONSE_TIMEOUT');;
        }

        socket_close($socket);

        return $response_time;
    }

    private function getTime($startTime)
    {
        $time = microtime(true) - $startTime;
        return $this->formatTime($time);
    }

    function formatTime($time)
    {
        return sprintf('%.3f', round($time * 1000, 3));
    }
}