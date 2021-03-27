<?php 
	
	namespace LeonardoFerreira;

	abstract class SimpleViaCep {

		public static function search($cep = '') {
			$data = [];
			
			$cep = preg_replace('/\D/', '', $cep);

			if(preg_match('/(\d{8})/', $cep)) {
				$url = "https://viacep.com.br/ws/{$cep}/json/";
				$request = curl_init($url);
				
				curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($request, CURLOPT_HEADER, true);
				
				$response = curl_exec($request);
				
				if(curl_getinfo($request, CURLINFO_HTTP_CODE) == 200) {
					$data = json_decode(substr($response, curl_getinfo($request, CURLINFO_HEADER_SIZE)), true);
				}		
            }
            
            $data = [
                'cep' => empty($data['cep']) ? '' : $data['cep'],
                'logradouro' => empty($data['logradouro']) ? '' : $data['logradouro'],
                'complemento' =>empty($data['complemento']) ? '' : $data['complemento'],
                'bairro' => empty($data['bairro']) ? '' : $data['bairro'],
                'localidade' => empty($data['localidade']) ? '' : $data['localidade'],
                'uf' => empty($data['uf']) ? '' : $data['uf'],
                'ibge' => empty($data['ibge']) ? '' : $data['ibge'],
                'gia' =>empty($data['gia']) ? '' : $data['gia'],
                'ddd' => empty($data['ddd']) ? '' : $data['ddd'],
                'siafi' => empty($data['siafi']) ? '' : $data['siafi']
            ];
		
			return $data;
		}

	}