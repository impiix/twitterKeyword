<?php
/**
 * Date: 7/15/16
 * Time: 1:56 PM
 */
namespace Main;

use Abraham\TwitterOAuth\TwitterOAuth;
use Main\Exception\ResponseException;

/**
 * Class TwitterService
 */
class TwitterService implements TwitterServiceInterface
{
    /**
     * @var TwitterOAuth
     */
    protected $twitter;
    
    public function __construct($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * {@inheritdoc}
     */
    public function get($name, $number)
    {
        $twitts = [];
        $response = $this->twitter->get(
            "statuses/user_timeline",
            [
                'count'         => $number,
                'screen_name'   => $name
            ]
        );
        
        if (isset($response->errors)) {
            throw new ResponseException($response->errors[0]->message);
        }

        foreach ($response as $item) {
            $twitt = $item->text;
            $twitts[] = $twitt;
        }
        
        return $twitts;
    }
}
