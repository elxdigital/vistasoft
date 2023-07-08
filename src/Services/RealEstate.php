<?php

namespace ElxDigital\Vista\Services;

use \ElxDigital\Vista\Vista;

class RealEstate extends Vista {

    private $filds;
    private $params;

    /**
     * Campos padrões que puxamos via API na listagem das imobiliárias
     * 
     * @return type
     */
    private function getFilds() {
        $this->filds = [
            'Codigo',
            'Nome',
            'Cnpj',
            'Celular',
            'Fone',
            'E-mail',
            'Pais',
            'Uf',
            'Cidade',
            'Bairro',
            'Endereco',
            'Numero',
            'Complemento',
            'Creci',
        ];
        return $this->filds;
    }

    /**
     * Busca todos os imóveis cadastrados na base
     * 
     * @return type
     */
    public function getRealEstate() {
        $this->setEndPoint('agencias/listar');
        $this->setTerms('&pesquisa=');
        $this->params['fields'] = $this->getFilds();

        $this->setParams($this->params);
        $return = $this->get();

        return $return;
    }

}
