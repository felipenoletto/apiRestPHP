<?php

    if(!array_key_exists('path', $_GET)) {
        echo "Path missing";
        exit;
    }

    $path = explode("/", $_GET['path']);
    
    if(count($path) == 0 || $path[0] == '') {
        echo "Error. Path missing";
    }

    $param1 = "";
    if(count($path)>1) {
        $param1 = $path[1];
    }

    $contents = file_get_contents('server.json');

    $json = json_decode($contents, true);

    $method = $_SERVER['REQUEST_METHOD'];
    header('Content-type: application/json');
    $body = file_get_contents('php://input');

    function findById($vetor, $param1) {
        $encontrado = -1;
                
        foreach($vetor as $key => $obj) {
            if($obj['id'] == $param1){
                $encontrado = $key;
                break;
            }
        }

        return $encontrado;
    }

    // Busca todos os registros
    if($method === 'GET') {
        
        if($json[$path[0]]) {
            if($param1 == '') {
                echo json_encode($json[$path[0]]);

            } else {
                $encontrado = findById($json[$path[0]], $param1);

                if($encontrado >= 0){
                    echo json_encode($json[$path[0]][$encontrado]);

                } else {
                    echo "ERROR.";
                    exit;

                }

            }
            
        } else {
            echo '[]';
        }
    }

    // Busca um registro por ID


    // Insere um registro no servidor
    if($method === 'POST') {
        
        $jsonBody = json_decode($body, true);

        if(!$json[$path[0]]) {
            $json[$path[0]] = [];
        }
        $json[$path[0]][] = $jsonBody;
        echo json_encode($jsonBody);
        file_put_contents('server.json', json_encode($json));
    }

    // Altera um registro
    if($method === 'PUT') {
        
        if($json[$path[0]]) {
            if($param1 == '') {
                echo "ERROR.";

            } else {
                $encontrado = findById($json[$path[0]], $param1);

                if($encontrado >= 0){
                    $jsonBody = json_decode($body, true);
                    $jsonBody['id'] = $param1;
                    $json[$path[0]][$encontrado] = $jsonBody;
                    file_put_contents('server.json', json_encode($json));

                } else {
                    echo "ERROR.";
                    exit;

                }

            }
            
        } else {
            echo 'ERROR.';
        }

    }

    // Deleta um registro
    if($method === 'DELETE') {
        
        if($json[$path[0]]) {
            if($param1 == '') {
                echo "ERROR.";

            } else {
                $encontrado = findById($json[$path[0]], $param1);

                if($encontrado >= 0){
                    unset($json[$path[0]][$encontrado]);
                    file_put_contents('server.json', json_encode($json));

                } else {
                    echo "ERROR.";
                    exit;

                }

            }
            
        } else {
            echo 'ERROR.';
        }

    }

?>