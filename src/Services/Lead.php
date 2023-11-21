<?php

namespace ElxDigital\Vista\Services;

use \ElxDigital\Vista\Vista;

class Lead extends Vista {

    // dados da api
    private $params;

    public function __construct(string $apiKey) {
        parent::__construct($apiKey);
        $this->params = new \stdClass();
    }

    public function setLeads(\ElxDigital\Vista\Data\Lead $lead) {
        $this->params->lead = new \stdClass();

        $this->params->lead->nome = (!empty($lead->getName()) ? $lead->getName() : null);
        $this->params->lead->fone = (!empty($lead->getPhone()) ? $lead->getPhone() : null);
        $this->params->lead->email = (!empty($lead->getEmail()) ? $lead->getEmail() : null);
        $this->params->lead->mensagem = (!empty($lead->getMensage()) ? $lead->getMensage() : null);
        $this->params->lead->veiculo = (!empty($lead->getChannel()) ? $lead->getChannel() : null);
        $this->params->lead->interesse = (!empty($lead->getFinality()) ? $lead->getFinality() : null);
        $this->params->lead->anuncio = (!empty($lead->getRealty()) ? $lead->getRealty() : null);
        $this->params->lead->corretor = (!empty($lead->getRealtor()) ? $lead->getRealtor() : null);
        $this->params->lead->agencia = (!empty($lead->getRealState()) ? $lead->getRealState() : null);
    }

    /**
     * Busca as fotos do empreendimento pelo c贸digo do im贸vel
     *
     * @param string $code
     * @return type
     */
    public function sendLead() {

        $this->setEndPoint('lead');
        $this->setParams($this->params);

        $this->post();

        return $this->getCallback();
    }
}
