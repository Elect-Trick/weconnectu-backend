<?php

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$raw = file_get_contents('php://input');
$data = [];

if ($raw !== false && $raw !== '') {

    try {
        $data = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);

    } catch (Exception $ex)
    {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Invalid JSON data']);
        exit(1);
    }

}
return [
    "data" => $data,
    "method" => $method,
    "path" => $path,
    "raw" => $raw
];



