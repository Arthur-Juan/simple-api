<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: *');
require_once '../vendor/autoload.php';

    if($_GET['url']) {
        //api/user/1  <----endpoint ou /api/user
        $url = explode('/', $_GET['url']);

        if ($url[0] === 'api') {
            //elimina a primeira casa do array
            array_shift($url);

            //esse é o nosso controller
            $controller = 'App\Http\Controllers\\' . ucfirst($url[0]) . 'Controller';
            array_shift($url);

            //metodo de acesso do controller, que também é a nossa ação
            $method = strtolower($_SERVER['REQUEST_METHOD']);

            try {
                //monta o qual objeto, método e parametros serão chamados
                $response = call_user_func_array(array(new $controller, $method), $url);
                if($response===null){
                    $response = 'Usuário não encontrado';
                }
                echo json_encode(array('stauts'=>'success', 'data' => $response));
            } catch (Exception $e) {
                echo json_encode(array("data"=>$e->getMessage()));
            }
        }

    }
