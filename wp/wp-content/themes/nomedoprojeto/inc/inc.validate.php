<?php

function checkDoc($document_name) {
	$document = explode('.', $document_name);
	$extension = $document[1];
	$alloweds = ['docx', 'doc', 'pdf', 'ppt'];

	return in_array($extension, $alloweds);
}

function check_length($value = "", $min, $max)
{
	// $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
	// $result = ($len < $min || $len > $max);
	// return !$result;

	$len = strlen($value);
	return $len >= $min && $len <= $max;
}

function cleanField($value = "")
{
	$value = trim($value);
	$value = stripslashes($value);
	$value = strip_tags($value);
	$value = htmlspecialchars($value);

	return $value;
}

function checkEmail($v)
{
	// /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ ---- js

	return preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $v);
}

function checkNome($v, $min, $max)
{
	return preg_match('/\S+(?:\s+\S+)+/', $v) && check_length($v, $min, $max);
}

function checkBoth($v)
{
	return preg_match('/^\([0-9]{2}\) [0-9]{4,5}-[0-9]{4}$/', $v);// ? true : wp_die('checkPhone');
}

function checkInput($input, $lmin, $lmax)
{
    $f = strlen($input);

	// ? true : wp_die('checkInput');

    return (($f >= $lmin) and ($f <= $lmax));
}

function checkUf($uf)
{
    return in_array($uf, [
        "AC", "ac", "Acre",
        "AL", "al", "Alagoas",
        "AP", "ap", "Amapá",
        "AM", "am", "Amazonas",
        "BA", "ba", "Bahia",
        "CE", "ce", "Ceará",
        "DF", "df", "Distrito Federal",
        "ES", "es", "Espírito Santo",
        "GO", "go", "Goiás",
        "MA", "ma", "Maranhão",
        "MT", "mt", "Mato Grosso",
        "MS", "ms", "Mato Grosso do Sul",
        "MG", "mg", "Minas Gerais",
        "PA", "pa", "Pará",
        "PB", "pb", "Paraíba",
        "PR", "pr", "Paraná",
        "PE", "pe", "Pernambuco",
        "PI", "pi", "Piauí",
        "RJ", "rj", "Rio de Janeiro",
        "RN", "rn", "Rio Grande do Norte",
        "RS", "rs", "Rio Grande do Sul",
        "RO", "ro", "Rondônia",
        "RR", "rr", "Roraima",
        "SC", "sc", "Santa Catarina",
        "SP", "sp", "São Paulo",
        "SE", "se", "Sergipe",
        "TO", "to", "Tocantins",
    ]);
}


function checkTipoImovel($uf)
{
    return in_array($uf, ["residencial", "comercial", "industrial", "rural"]);
}


function checkCpf($cpf = null)
{
	// Verifica se um número foi informado
	if(empty($cpf)) {
		return false;
	}

	// Elimina possivel mascara
	$cpf = preg_replace("/[^0-9]/", "", $cpf);
	$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
	
	// Verifica se o numero de digitos informados é igual a 11 
	if (strlen($cpf) != 11) {
		return false;
	}
	// Verifica se nenhuma das sequências invalidas abaixo 
	// foi digitada. Caso afirmativo, retorna falso
	else if ($cpf == '00000000000' || 
		$cpf == '11111111111' || 
		$cpf == '22222222222' || 
		$cpf == '33333333333' || 
		$cpf == '44444444444' || 
		$cpf == '55555555555' || 
		$cpf == '66666666666' || 
		$cpf == '77777777777' || 
		$cpf == '88888888888' || 
		$cpf == '99999999999') {
		return false;
	 // Calcula os digitos verificadores para verificar se o
	 // CPF é válido
	 } else {   
		
		for ($t = 9; $t < 11; $t++) {
			
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf[$c] * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf[$c] != $d) {
				return false;
			}
		}

		return true;
	}
}


function checkCnpj($cnpj)
{
	$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
	// Valida tamanho
	if (strlen($cnpj) != 14)
		return false;
	// Valida primeiro dígito verificador
	for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
	{
		$soma += $cnpj[$i] * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
		return false;
	// Valida segundo dígito verificador
	for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
	{
		$soma += $cnpj[$i] * $j;
		$j = ($j == 2) ? 9 : $j - 1;
	}
	$resto = $soma % 11;
	return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
}
