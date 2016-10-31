<?php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$products = [

			  'PRD001' => [
			  	 'name'        => 'Notebook',
			  	 'quantity'    => 10,
			  	 'description' => 'XXXX'
			  ],

			  'PRD002' => [
			  	 'name'        => 'Mouse',
			  	 'quantity'    => 20,
			  	 'description' => 'ABC'
			  ]
			];

$app->get('/', function() use($products){
	return json_encode($products);
});

$app->get('/{id}', function(\Silex\Application $app, $id) use($products) {
	if(!isset($products[$id])){
		$app->abort(404, 'PRODUTO $id INEXISTENTE!');
	}

	return json_encode($products);
});

$app->post('/', function(Silex\Application $app, Symfony\Component\HttpFoundation\Request $request){
	$name = $request->get('name');
	$quantity = $request->get('quantity');
	$description = $request->get('description');

	$product = [
					'name'        => $name,
					'quantity'    => $quantity,
					'description' => $description
			   ];

	return new Symfony\Component\HttpFoundation\Response(json_encode($product), 200);
});

$app->run();