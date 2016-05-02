<?php
$app->get('/expenses', function ($request, $response, $args) {
    $this->logger->info("Expenses '/expenses' get");
	$result = $this->Modules->Expenses->findAll();
    if($result) {
	    return $response->withStatus(200)
	        ->withHeader('Content-Type', 'application/json')
	        ->write(json_encode($result));

	} else {
		return $response->withStatus(404)
	        ->withHeader('Content-Type', 'application/json')
	        ->write(json_encode(array("code"=>404,"msg"=>"No records found")));
	}
});

$app->get('/expenses/{id:[0-9]+}', function ($request, $response, $args) {
	$this->logger->info("Expenses '/expenses/{id}' get");
	$result = $this->Modules->Expenses->findOne($args['id']);
    if($result) {
	    return $response->withStatus(200)
	        ->withHeader('Content-Type', 'application/json')
	        ->write(json_encode($result));

	} else {
		return $response->withStatus(404)
	        ->withHeader('Content-Type', 'application/json')
	        ->write(json_encode(array("code"=>404,"msg"=>"Invalid ID")));
	}
});

$app->post('/expenses', function ($request, $response, $args) {
    $this->logger->info("Expenses '/expenses' post");
    $parsedBody = $request->getParsedBody();
    $result = $this->Modules->Expenses->store($parsedBody);
    if($result) {
	    return $response->withStatus(200)
	        ->withHeader('Content-Type', 'application/json')
	        ->write(json_encode($result));

	} else {
		return $response->withStatus(404)
	        ->withHeader('Content-Type', 'application/json')
	        ->write(json_encode(array("code"=>404,"msg"=>"Invalid ID")));
	}
});

$app->put('/expenses/{id:[0-9]+}', function ($request, $response, $args) {
    $this->logger->info("Expenses '/expenses' put");
    $parsedBody = $request->getParsedBody();
    $result = $this->Modules->Expenses->update($args['id'],$parsedBody);
    if($result) {
	    return $response->withStatus(200)
	        ->withHeader('Content-Type', 'application/json')
	        ->write(json_encode($result));

	} else {
		return $response->withStatus(404)
	        ->withHeader('Content-Type', 'application/json')
	        ->write(json_encode(array("code"=>404,"msg"=>"Invalid ID")));
	}
});

$app->delete('/expenses/{id:[0-9]+}', function ($request, $response, $args) {
    $this->logger->info("Expenses '/expenses' delete");
    $result = $this->Modules->Expenses->delete($args['id']);
    if($result) {
	    return $response->withStatus(200)
	        ->withHeader('Content-Type', 'application/json')
	        ->write(json_encode(array("code"=>200,"msg"=>"Record deleted")));

	} else {
		return $response->withStatus(404)
	        ->withHeader('Content-Type', 'application/json')
	        ->write(json_encode(array("code"=>404,"msg"=>"Invalid ID")));
	}
});


$app->get('/expenses/test', function ($request, $response, $args) {
    $this->logger->info("Expenses '/expenses/test' get");
});

$app->get('/expenses/{name}', function ($request, $response, $args) {
    $this->logger->info("Expenses '/expenses/view' get");
	echo $this->Modules->Expenses->testView($args);
});
