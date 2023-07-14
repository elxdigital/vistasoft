<?php

namespace ElxDigital\Vista\Data;

class Lead {

    private $name;
    private $phone;
    private $email;
    private $mensage;
    private $channel;
    private $finality;
    private $realty;
    private $realtor;
    private $realState;

    public function setName(string $name) {
        $this->name = (!empty($name) ? ucwords(mb_strtolower(trim($name), 'UTF-8')) : null);
    }

    public function setFone(string $phone) {
        $this->phone = $this->str_phone($phone);
    }

    public function setEmail(string $email) {
        $this->email = (!empty($email) ? mb_strtolower(trim($email)) : null);
    }

    public function setMensage(string $mensage) {
        $this->mensage = $mensage;
    }

    public function setChannel(string $channel) {
        $this->channel = $channel;
    }

    public function setFinalityRent() {
        $this->finality = 'Aluguel';
    }

    public function setFinalityBuy() {
        $this->finality = 'Venda';
    }

    public function setFinalityBuyAndRent() {
        $this->finality = 'Venda e Aluguel';
    }

    public function setRealty(string $realty) {
        $this->realty = preg_replace("/[^0-9]/", "", $realty);
    }

    public function setRealtor(int $realtor) {
        $this->realtor = preg_replace("/[^0-9]/", "", $realtor);
    }

    public function setRealState(int $realState) {
        $this->realState = preg_replace("/[^0-9]/", "", $realState);
    }

    public function getName() {
        return $this->name;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMensage() {
        return $this->mensage;
    }

    public function getChannel() {
        return $this->channel;
    }

    public function getFinality() {
        return $this->finality;
    }

    public function getRealty() {
        return $this->realty;
    }

    public function getRealtor() {
        return $this->realtor;
    }

    public function getRealState() {
        return $this->realState;
    }

    private function str_phone(string $phone) {
        $tel = preg_replace("/[^0-9]/", "", $phone);

        if (!strlen($tel) == '10' || !strlen($tel) == '11') {
            return null;
        }

        if (!empty($tel)) {
            $zero = substr($tel, 0, 1);
            if ($zero == '0') {
                $tel = substr($tel, 1);
            }

            $ddd = substr($tel, 0, 2);
            $numero = substr($tel, 2);

            $primeiroNumero = substr($numero, 0, 1);
            if ($primeiroNumero == '9' || $primeiroNumero == '8') {
                if (strlen($numero) == '8') {
                    $numero = '9' . $numero;
                }
            }

            $tel = $ddd . $numero;

            if (strlen($tel) == '10') {
                return $this->str_mask($tel, '(##) ####-####');
            } else if (strlen($tel) == '11') {
                return $this->str_mask($tel, '(##) #####-####');
            } else {
                return null;
            }
        }
    }

    private function str_mask(string $val, string $mask): string {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i < (strlen($mask)); $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $maskared .= $val[$k];
                    $k++;
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }
        return $maskared;
    }
}
