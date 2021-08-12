<?php

function testTask2(string $url, int $value)
{
    $parsedUrl = parse_url($url);
    parse_str($parsedUrl['query'], $query);

    $result = array_filter($query, function ($paramValue) use ($value) {
        return $paramValue !== (string)$value;
    });

    asort($result);

    $result['url'] = $parsedUrl['path'];
    $query = http_build_query($result, "", "&amp;");

    return "{$parsedUrl['scheme']}://{$parsedUrl['host']}/$query";
}


echo testTask2('https://www.somehost.com/TestTask2/index.html?param1=4&param2=3&param3=2&param4=1&param5=3', 3);
