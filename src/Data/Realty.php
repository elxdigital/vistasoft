<?php

namespace ElxDigital\Data\Realty;

class Realty {

    private $filds;
    private $pagination;

    public function __construct() {
        
    }

    public function getFilds() {
        $this->filds = [
            'Codigo',
            'DataHoraAtualizacao',
            'Categoria',
            'Finalidade',
            'FotoDestaque',
            'FotoDestaquePequena',
            'Status',
            'Caracteristicas',
            'InfraEstrutura',
            'Moeda',
            'Bairro',
            'Cidade',
            'Dormitorios',
            'Suites',
            'Vagas',
            'AreaTotal',
            'AreaPrivativa',
            'ValorVenda',
            'ValorLocacao',
            'Latitude',
            'Longitude',
            'Foto',
            'prontuarios',
            'Agencia',
            'Corretor',
        ];
    }

    private function setPagination(int $page, int $quantity) {
        $this->pagination = [
            'paginacao' => [
                'pagina' => $page,
                'quantidade' => $quantity
            ]
        ];
    }

    private function setOrder(string $fild, string $order) {
        $this->pagination = [
            'order' => [
                $fild => $order
            ]
        ];
    }

    public function getRealtyFull() {
        $this->url = $urldocliente . '.vistahost.com.br/';
    }

    /**
     * API setup for Sandbox
     */
    public function setIsSandbox() {
        $this->url = 'sandbox-rest.vistahost.com.br/ ';
    }

    /**
     * Set the value of params
     *
     * @return  self
     */
    protected function setParams($params) {
        $this->params = $params;
        return $this;
    }

    /**
     * Set the value of endPoint
     *
     * @return  self
     */
    protected function setEndPoint(string $endPoint) {
        $this->endPoint = (string) $endPoint;
        return $this;
    }

    /**
     * Get the value of callback
     */
    protected function getCallback() {
        return $this->callback;
    }

    /**
     * ########################
     * ### METODO PROTEGIDO ###
     * ########################
     */
    protected function get() {
        $url = 'https://' . $this->url . $this->endPoint . '?key=' . $this->apiKey . '&' . json_encode($this->params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            $this->callback = curl_error($ch);
        } else {
            $this->callback = json_decode($result, true);
        }
        curl_close($ch);
        return;
    }

    protected function post() {
        $url = 'https://' . $this->url . $this->endPoint . '?' . json_encode($this->params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            $this->callback = curl_error($ch);
        } else {
            $this->callback = json_decode($result, true);
        }
        curl_close($ch);
        return;
    }

}
