<?php
/**
 * Date: 7/15/16
 * Time: 1:50 PM
 */
namespace Main;

/**
 * Class TwitterService
 */
interface TwitterServiceInterface
{
    /**
     * @param $name
     * @param $number
     * @return array
     * @throws Exception\ResponseException
     */
    public function get($name, $number);
}
