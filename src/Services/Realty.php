<?php

namespace ElxDigital\Vista\Services;

use \ElxDigital\Vista\Vista;

class Realty extends Vista {

    private $params;
    private $filter;

    /**
     * Campos padrões que puxamos via API na listagem de imóveis
     *
     * @return type
     */
    private function getFilds() {
        $this->filds = [
            'Codigo',
            'ApresentacaoLocalizacao',
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
            'DescricaoEmpreendimento',
            'EEmpreendimento',
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
            'PrecoSobConsulta',
            'Latitude',
            'Longitude',
            'Mobiliado',
            'CodigoAgencia',
            'CodigoCorretor',
            'Caracteristicas',
            'InfraEstrutura',
            'ResponsavelReserva',
            'Proprietario',
            'Tag'
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
     * @param int $days int|null
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

        $this->setFilter('EEmpreendimento', ['!=', 'Sim']);

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

        if (!empty($this->getFilter())) {
            $this->params['filter'] = $this->getFilter();
        }

        $this->setParams($this->params);
        $return = $this->get();

        return $return;
    }

    /**
     * Busca todos os imóveis cadastrados na base que estão desativados
     *
     * Informa um valor caso queira trazer a listagem dos imóveis que foram
     * criados ou atualizados nos ultimos XX dias
     *
     * @param int $days int|null
     * @return type
     */
    public function getPropertiesByCode(int $code) {
        $this->setEndPoint('imoveis/listar');
        $this->setTerms('&showtotal=1&pesquisa=');
        $this->params['fields'] = $this->getFilds();

        if (!empty($this->getOrder())) {
            $this->params['order'] = $this->getOrder();
        }

        if (!empty($this->getPagination())) {
            $this->params['paginacao'] = $this->getPagination();
        }

        $this->setFilter('Codigo', [$code]);

        if (!empty($this->getFilter())) {
            $this->params['filter'] = $this->getFilter();
        }

        $this->setParams($this->params);
        $return = $this->get();

        return $return;
    }

    /**
     * Busca todos os imóveis cadastrados na base que estão desativados
     *
     * Informa um valor caso queira trazer a listagem dos imóveis que foram
     * criados ou atualizados nos ultimos XX dias
     *
     * @param int $days int|null
     * @return type
     */
    public function getPropertiesCheck(int $code) {
        $this->setEndPoint('imoveis/listar');
        $this->setTerms('&showtotal=1&pesquisa=');
        $this->params['fields'] = 'Codigo';

        if (!empty($this->getOrder())) {
            $this->params['order'] = $this->getOrder();
        }

        if (!empty($this->getPagination())) {
            $this->params['paginacao'] = $this->getPagination();
        }

        $this->setFilter('Codigo', [$code]);

        if (!empty($this->getFilter())) {
            $this->params['filter'] = $this->getFilter();
        }

        $this->setParams($this->params);
        $return = $this->get();

        return $return;
    }

    /**
     * Busca as fotos pelo código do imóvel
     *
     * @param string $code
     * @return type
     */
    public function getImages(string $code) {

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
                    "Destaque",
                    "ExibirNoSite",
                    "ExibirSite",
                    "Foto",
                    "FotoPequena",
                    "Tipo",
                    "Origem",
                ]
            ]
        ];

        $this->setParams($this->params);
        $return = $this->get();

        return $return;
    }

    /**
     * Busca os vídeos pelo código do imóvel
     *
     * @param string $code
     * @return type
     */
    public function getVideos(string $code) {

        $this->setEndPoint('imoveis/detalhes');
        $this->setTerms('&imovel=' . $code . '&pesquisa=');
        $this->params['fields'] = [
            'Codigo',
            [
                "Video" => [
                    "Codigo",
                    "VideoCodigo",
                    "Data",
                    "Descricao",
                    "DescricaoWeb",
                    "Destaque",
                    "ExibirNoSite",
                    "ExibirSite",
                    "Video",
                    "Tipo"
                ]
            ],
        ];

        $this->setParams($this->params);
        $return = $this->get();

        return $return;
    }

    /**
     * Busca os anexos pelo código do imóvel
     *
     * @param string $code
     * @return type
     */
    public function getFiles(string $code) {

        $this->setEndPoint('imoveis/detalhes');
        $this->setTerms('&imovel=' . $code . '&pesquisa=');
        $this->params['fields'] = [
            'Codigo',
            [
                "Anexo" => [
                    "Codigo",
                    "CodigoAnexo",
                    "Descricao",
                    "Anexo",
                    "Arquivo",
                    "ExibirNoSite",
                    "ExibirSite",
                    "Data"
                ]
            ],
        ];

        $this->setParams($this->params);
        $return = $this->get();

        return $return;
    }
}
