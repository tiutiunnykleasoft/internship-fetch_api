<?php
require_once "generator.php";


$request_array = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI'])));

$file = "log.txt";
$current = json_decode(file_get_contents($file));
$message = [];
$message['count'] = $current->count ?? 0;
$message['success'] = $current->success ?? 0;
$message['failed'] = $current->failed ?? 0;

$response = "";
if (count($request_array) == 1 && $request_array[0] == 'user') {
    header("HTTP/1.1 200 OK");
    $message['success'] += 1;
    $users_not_converted = $users->getAll();
    $response = [];

    foreach ($users_not_converted as $key => $item) {
        $item->setId($key);
        $response[] = $item;
    }
} elseif (count($request_array) == 3 && $request_array[0] == 'transaction' && $request_array[1] == 'user') {
    $response = $transactions->getAllByField('customer_id', $request_array[2]);
    if (empty($response)) {
        $message['failed'] += 1;
        header("HTTP/1.1 404 Not Found");
    } else {
        $message['success'] += 1;
    }
} elseif (count($request_array) == 1 && $request_array[0] == 'log') {
    $message['success'] += 1;
    header("HTTP/1.1 200 OK");
    $response = $current;
} else {
    $message['failed'] += 1;
    NotFound($response);
}

function NotFound(&$response)
{
    header("HTTP/1.1 404 Not Found");
    $response = ['message' => 'Unknown request resource'];
}

header('Content-Type: application/json');

$message['count'] += 1;
$current = json_encode($message);
file_put_contents($file, $current);
echo json_encode($response);