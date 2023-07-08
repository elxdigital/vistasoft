<?php

namespace ElxDigital\Vista;

class Vista {

    private $url;
    private $apiKey;
    private $params;
    private $pagination;
    private $order;
    private $filter;
    private $endPoint;
    private $terms;
    private $callback;

    public function __construct(string $apiKey) {
        $this->apiKey = $apiKey;
    }

    /**
     * API setup for production
     * 
     * @param string $urldocliente
     */
    public function setIsProduction(string $urldocliente) {
        $this->url = trim($urldocliente) . '.vistahost.com.br/';
    }

    /**
     * API setup for Sandbox
     */
    public function setIsSandbox() {
        $this->url = 'sandbox-rest.vistahost.com.br/';
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
     * Set the value of endPoint
     *
     * @return  self
     */
    protected function setTerms(string $terms) {
        $this->terms = (string) $terms;
        return $this;
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

    public function setPagination(int $page, int $quantity) {
        $this->pagination = [
            'pagina' => $page,
            'quantidade' => $quantity
        ];
    }

    protected function getPagination() {
        return (!empty($this->pagination) ? $this->pagination : null);
    }

    public function setOrder(string $fild, string $order) {
        $this->order[] = [
            $fild => $order
        ];
    }

    protected function getOrder() {
        return (!empty($this->order) ? $this->order : null);
    }

    public function setFilter(string $fild, array $filter) {
        $this->filter[] = [
            $fild => $filter
        ];
        return;
    }

    protected function getFilter() {
        return (!empty($this->filter) ? $this->filter : null);
    }

    /**
     * Get the value of callback
     */
    public function getCallback() {
        return $this->callback;
    }

    /**
     * ########################
     * ### METODO PROTEGIDO ###
     * ########################
     */
    protected function get() {

        if (empty($this->url)) {
            $this->callback = 'Selecione modo PRODUÇÃO OU MODO SANDBOX';
        }

        $url = 'https://' . trim($this->url) . trim($this->endPoint) . '?key=' . trim($this->apiKey) . (!empty($this->terms) ? trim($this->terms) : null) . (!empty($this->params) ? json_encode($this->params) : null);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            $this->callback = curl_error($ch);
        } else {
            $this->callback = (object) json_decode($result);
        }

        curl_close($ch);

        return $this->callback;
    }

    protected function post() {

        if (empty($this->url)) {
            $this->callback = 'Selecione modo PRODUÇÃO OU MODO SANDBOX';
        }

        $url = 'https://' . trim($this->url) . trim($this->endPoint) . '?key=' . trim($this->apiKey);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'cadastro=' . json_encode($this->params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            $this->callback = curl_error($ch);
        } else {
            $this->callback = (object) json_decode($result);
        }
        curl_close($ch);
        return;
    }
}
