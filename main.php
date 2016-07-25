<?php
/**
 * Date: 7/15/16
 * Time: 1:46 PM
 */
require_once __DIR__.'/vendor/autoload.php';

$config = require_once __DIR__.'/config.php';

$name = isset($argv[1]) ? $argv[1] : "";

if (!$name) {
    $output = "Please provide name of twitter account!\n";
    echo $output;
    exit();
}

$key = $config['key'];
$secret = $config['secret'];
$stopwords = $config['stopwords'];

$twitter = new \Abraham\TwitterOAuth\TwitterOAuth($key, $secret);
$twitterService = new Main\TwitterService($twitter);

$keywordService = new Main\KeywordService($stopwords);

$task = new Main\Task($twitterService, $keywordService);

try {
    $output = $task->run($name);
} catch (\Main\Exception\ResponseException $e) {
    $output = "There was a problem: " . $e->getMessage();
}

echo $output;
