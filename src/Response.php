<?php
/**
 * Date: 7/15/16
 * Time: 1:59 PM
 */
namespace Main;

/**
 * Class Response
 */
class Response
{
    /**
     * @var
     */
    protected $keyword;

    /**
     * @var
     */
    protected $count;

    /**
     * Response constructor.
     * @param $keyword
     * @param $count
     */
    public function __construct($keyword, $count)
    {
        $this->keyword = $keyword;
        $this->count = $count;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }
}
