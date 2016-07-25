<?php
/**
 * Date: 7/16/16
 * Time: 10:22 PM
 */
namespace Main\Test;

use Main\KeywordService;
use Main\Response;
use Main\Task;
use Main\TwitterService;

/**
 * Class TwitterServiceTest
 */
class TwitterServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testNormalScenario()
    {
        $twitterService = \Mockery::mock(TwitterService::class);
        $twitterService->shouldReceive("get")->andReturn(['test twitt1', ['test twitt2']]);
        $keywordService = \Mockery::mock(KeywordService::class);
        $keywordService->shouldReceive("extract")->andReturn([new Response('test', 2), new Response("twitt1", 1)]);
        $service = new Task($twitterService, $keywordService);
        $output = $service->run("secretsales");
        $this->assertEquals("test,2\ntwitt1,1\n", $output);
    }
}
