<?php

namespace ElxDigital\Vista\Services;

use \ElxDigital\Vista\Vista;

class Realty extends Vista {

    private $filds;
    private $params;

    /**
     * Campos padrões que puxamos via API na listagem de imóveis
     *
     * @return type
     */
    private function getFilds() {
        $this->filds = [
            'Codigo',
            'CodigoEmpreendimento',
            'DataAtualizacao',
            'DataHoraAtualizacao',
            'DataCadastro',
            'DataHoraAtualizacao',
            'DestaqueWeb',
            'SuperDestaqueWeb',
            'Exclusivo',
            'Lancamento',
            'AceitaPermuta',
            'ExibirNoSite',
            'TituloSite',
            'DescricaoWeb',
            'CodigoCategoria',
            'Categoria',
            'CategoriaGrupo',
            'Finalidade',
            'FotoDestaque',
            'FotoDestaquePequena',
            'Status',
            'CEP',
            'Pais',
            'UF',
            'Cidade',
            'Bairro',
            'Endereco',
            'Numero',
            'Complemento',
            'Construtora',
            'Dormitorios',
            'Suites',
            'TotalBanheiros',
            'Vagas',
            'AreaConstruida',
            'AreaTerreno',
            'AreaTotal',
            'AreaPrivativa',
            'ValorVenda',
            'ValorLocacao',
            'ValorIptu',
            'ValorCondominio',
            'URLVideo',
            'Latitude',
            'Longitude',
            'Mobiliado',
            'CodigoAgencia',
            'CodigoCorretor',
            'Caracteristicas',
            'InfraEstrutura',
        ];
        return $this->filds;
    }

    /**
     * Busca todo os campos disponíveis de um imóvel para usar vindo da API
     *
     * @return type
     */
    public function getListFields() {
        $this->setEndPoint('imoveis/listarcampos');

        $return = $this->get();

        return $return;
    }

    /**
     * Busca todos os imóveis cadastrados na base
     *
     * Informa um valor caso queira trazer a listagem dos imóveis que foram
     * criados ou atualizados nos ultimos XX dias
     *
     * @param int $days |null
     * @return type
     */
    public function getProperties(int $days = null) {
        $this->setEndPoint('imoveis/listar');
        $this->setTerms('&showtotal=1&pesquisa=');
        $this->params['fields'] = $this->getFilds();

        if (!empty($this->getOrder())) {
            $this->params['order'] = $this->getOrder();
        }

        if (!empty($this->getPagination())) {
            $this->params['paginacao'] = $this->getPagination();
        }

        if (!empty($days)) {
            $lastDay = date('Y-m-d', strtotime('-' . $days . ' days'));
            $day = date('Y-m-d');
            $this->setFilter('DataAtualizacao',
                [
                    $lastDay,
                    $day
                ]
            );
        }

        $this->setParams($this->params);
        $return = $this->get();

        return $return;
    }

    /**
     * Busca as fotos do imóvel pelo código do imóvel
     *
     * @param string $code
     * @return type
     */
    public function getImagesRealty(string $code) {

        $this->setEndPoint('imoveis/detalhes');
        $this->setTerms('&imovel=' . $code . '&pesquisa=');
        $this->params['fields'] = [
            'Codigo',
            [
                "Foto" => [
                    "Ordem",
                    "Codigo",
                    "ImagemCodigo",
                    "Data",
                    "Descricao",
                    "Foto",
                    "FotoOriginal",
                    "FotoPequena",
                    "Tipo",
                    "Destaque"
                ]
            ]
        ];

        $this->setParams($this->params);
        $return = $this->get();

        return $return;
    }

    /**
     * Busca as fotos do empreendimento pelo código do imóvel
     *
     * @param string $code
     * @return type
     */
    public function getImagesRealEstateDevelopment(string $code) {

        $this->setEndPoint('imoveis/detalhes');
        $this->setTerms('&imovel=' . $code . '&pesquisa=');
        $this->params['fields'] = [
            'Codigo',
            [
                "FotoEmpreendimento" => [
                    "FotoEmpreendimento",
                    "FotoPequena",
                    "Codigo",
                    "Ordem",
                    "Data",
                    "Descricao",
                    "Destaque",
                    "Tipo",
                ]
            ],
        ];

        $this->setParams($this->params);
        $return = $this->get();

        return $return;
    }
}
