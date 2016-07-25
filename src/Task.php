<?php
/**
 * Date: 7/15/16
 * Time: 1:47 PM
 */
namespace Main;

/**
 * Class Task
 */
class Task
{
    /**
     * @var TwitterServiceInterface
     */
    protected $twitterService;

    /**
     * @var KeywordServiceInterface
     */
    protected $keywordService;

    /**
     * Task constructor.
     * @param TwitterServiceInterface $twitterService
     * @param KeywordServiceInterface $keywordService
     */
    public function __construct(
        TwitterServiceInterface $twitterService,
        KeywordServiceInterface $keywordService
    ) {
        $this->keywordService = $keywordService;
        $this->twitterService = $twitterService;
    }

    /**
     * @param $name
     * @return string
     */
    public function run($name)
    {
        $twitts = $this->twitterService->get($name, 100);
        $statuses = $this->facebookService->get($name, 100);
        $keywords = $this->keywordService->extract(array_merge($statuses, $twitts));

        $response = $this->format($keywords);
        
        return $response;
    }

    /**
     * @param array $keywords
     * @return string
     */
    protected function format(array $keywords)
    {
        $output = "";
        foreach ($keywords as $keyword) {
            /**
             * @var Response $keyword
             */
            $output .= $keyword->getKeyword().','.$keyword->getCount()."\n";
        }

        return $output;
    }
}
