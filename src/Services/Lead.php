<?php

namespace ElxDigital\Vista\Services;

use \ElxDigital\Vista\Vista;

class Lead extends Vista {

    // dados da api
    private $params;

    public function setLeads(\ElxDigital\Vista\Data\Lead $params) {
        $this->params->lead->nome = $params->getName();
        $this->params->lead->fone = $params->getPhone();
        $this->params->lead->email = $params->getEmail();
        $this->params->lead->mensagem = $params->getMensage();
        $this->params->lead->veiculo = $params->getChannel();
        $this->params->lead->interesse = $params->getFinality();
        $this->params->lead->anuncio = $params->getRealty();
        $this->params->lead->corretor = $params->getRealtor();
        $this->params->lead->agencia = $params->getRealState();
    }
    
    /**
     * Busca as fotos do empreendimento pelo código do imóvel
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
