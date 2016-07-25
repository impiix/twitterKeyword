<?php
/**
 * Date: 7/15/16
 * Time: 1:56 PM
 */
namespace Main;

/**
 * Class KeywordService
 */
class KeywordService implements KeywordServiceInterface
{
    /**
     * @var array
     */
    protected $stopwords;

    /**
     * KeywordService constructor.
     * @param $stopwords
     */
    public function __construct($stopwords)
    {
        $this->stopwords = $stopwords;
    }

    /**
     * {@inheritdoc}
     */
    public function extract(array $twitts)
    {
        $whole = implode(" ", $twitts);
        $whole = strtolower($whole);
        $whole = preg_replace("/\w*@\w+(.com)*/i", "", $whole);
        $whole = preg_replace("/https\:\/\/[\w.\/]+/i", "", $whole);
        
        preg_match_all("/\w+/i", $whole, $words);
        $words = array_diff($words[0], $this->stopwords);
        $words = array_filter($words, function ($item) {
            return strlen($item) > 2;
        });
        
        $data = array_count_values($words);
        arsort($data);
        $keywords = [];
        foreach ($data as $keyword => $count) {
            $keywords[] = new Response($keyword, $count);
        }

        return $keywords;
    }
}
