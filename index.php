<?php
require_once "generator.php";

$request_array = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI'])));

$file = "log.txt";
$current = file_get_contents($file);
$message['request'] = $request_array;

$response = "";
if (count($request_array) == 1 && $request_array[0] == 'user') {
    header("HTTP/1.1 200 OK");
    $response = $users->getAll();
} elseif (count($request_array) == 3 && $request_array[0] == 'transaction' && $request_array[1] == 'user') {
    $response = $transactions->getAllByField('customer_id', $request_array[2]);
    if (empty($response)) {
        header("HTTP/1.1 404 Not Found");
    }
} else {
    NotFound($response);
}

function NotFound(&$response)
{
    header("HTTP/1.1 404 Not Found");
    $response = ['message' => 'Unknown request resource'];
}

header('Content-Type: application/json');
$message['response'] = $response;
$current .= json_encode($message);
file_put_contents($file, $current);
echo json_encode($response);