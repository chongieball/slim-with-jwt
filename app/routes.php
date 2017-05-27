<?php 

use Firebase\JWT\JWT;

$app->get('/api/token', function ($req, $res, $args) {
	$jti = base64_encode(getenv("JWT_SECRET"));

    $now = new DateTime();
    $future = new DateTime("now +2 hours");

	$payload = [
        "iat" => $now->getTimeStamp(),
        "exp" => $future->getTimeStamp(),
        "jti" => $jti,
        'data'=> [
            'id' => 1,
            'name' => 'Muhammad Iqbal',
        ],
    ];


    $secret = getenv("JWT_SECRET");
    $token = JWT::encode($payload, $secret);

    $data["token"] = $token;
    $data["expires"] = $payload['exp'];

    return $res->withJson($data, 201);
});

$app->get("/api/test", function ($request, $response, $arguments) {
    return $response->write('works!');
});

$app->get('/api/{id}', function ($request, $response, $arguments) {
    $token = $request->getAttribute("token");

    if ($token->data->id == $arguments['id']) {
        return $response->write('Authorized');
    } else {
        return $response->withJson('Not Authorized', 401);
    }
});