<?php
/**
 * Date: 7/15/16
 * Time: 1:50 PM
 */
namespace Main;

/**
 * Class KeywordService
 */
interface KeywordServiceInterface
{
    /**
     * @param array $twitts
     *
     * @return Response[]
     */
    public function extract(array $twitts);
}
