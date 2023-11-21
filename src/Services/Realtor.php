<?php

namespace ElxDigital\Vista\Services;

use \ElxDigital\Vista\Vista;

class Realtor extends Vista {

    private $filds;
    private $params;

    /**
     * Campos padões que puxamos via API na listagem de corretores
     *
     * @return type
     */
    private function getFilds() {
        $this->filds = [
            'Corretor',
            'Nascimento',
            'Celular',
            'Fax',
            'Email',
            'Nome',
            'Codigo',
            'Celular1',
            'Celular2',
            'Grupoacesso',
            'Nomecompleto',
            'Exibirnosite',
            'Inativo',
            'CRECI',
            'Foto',
            'CodigoAgencia',
        ];

        return $this->filds;
    }

    /**
     * Busca todo os campos disponíveis de um usuário para usar vindo da API
     *
     * @return type
     */
    public function getListFields() {
        $this->setEndPoint('usuarios/listarcampos ');

        $return = $this->get();

        return $return;
    }

    /**
     * Busca todos os corretores cadastrados na base
     *
     * @return type
     */
    public function getRealtor() {
        $this->setEndPoint('usuarios/listar');
        $this->setTerms('&pesquisa=');
        $this->params['fields'] = $this->getFilds();

        if (!empty($this->getOrder())) {
            $this->params['order'] = $this->getOrder();
        }

        $this->params['paginacao'] = $this->getPagination();

        $this->setParams($this->params);
        $return = $this->get();

        return $return;
    }
}
