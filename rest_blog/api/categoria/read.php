<?php
 	if(!isset($_SERVER['PHP_AUTH_USER'])){
 		header('WWW-Authenitcate: Basic realm="Página Restrita"');

 		header('HTTP/1.0 401 Unauthorized');

 		echo json_encode(["mensagem" => "Autenticação necessária"
 			]);

 		exit;
 	}elseif (!($_SERVER['PHP_AUTH_USER'] == 'admin'
 			 && $_SERVER['PHP_AUTH_PW']	== 'admin')){
 				header('HTTP/1.0 401 Unauthorized');
				echo json_encode(["mensagem" => "Usuário Inválido"]);
 	}else{
 			

		header('Acess-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		
		require_once '../../config/Conexao.php';
		require_once '../../models/Categoria.php';

		$db = new Conexao();
		$con = $db->getConexao();

	    $categoria = new Categoria($con);

	    $resultado = $categoria->read();

	    $qtde_cats = sizeof($resultado);

	    if($qtde_cats>0){
	        // $arr_categorias = array();
	        // $arr_categorias['data'] = array();

	        echo json_encode($resultado);
	    }else{
	        echo json_encode(array('mensagem' => 'nenhuma categoria encontrada'));
	    }

   	}
