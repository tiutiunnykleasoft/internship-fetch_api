<?php
require_once "generator.php";

$request_array = array_values(array_filter(explode('/', $_SERVER['REQUEST_URI'])));

$response = "";
if ($request_array[0] == 'user') {
    if (count($request_array) == 2) {
        $user = $users->get($request_array[1]);
        if (gettype($user) == 'object') {
            header("HTTP/1.1 200 OK");
        } else {
            header("HTTP/1.1 400 Bad Request");
        }
        $response = $user;
    } elseif (count($request_array) == 1) {
        $response = ['ids' => $users->getKeys()];
    } else {
        NotFound($response);
    }
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
echo json_encode($response);