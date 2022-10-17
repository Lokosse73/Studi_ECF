<?php

class CLIENTS{
    public $client_id;
    public $client_name;
    public $active;
    public $short_description;
    public $full_description;
    public $logo_url;
    public $url;
    public $dpo;
    public $technical_contact;
    public $commercial_contact;
    public $accountMail;

    public function __construct(string $client_id, string $client_name, string $active,
                                string $short_description, string $full_description, string $logo_url, string $url,
                                string $dpo, string $technical_contact, string $commercial_contact, string $accountMail)
    {
        $this->client_id = $client_id;
        $this->client_name = $client_name;
        $this->active = $active;
        $this->short_description = $short_description;
        $this->full_description = $full_description;
        $this->logo_url = $logo_url;
        $this->url = $url;
        $this->dpo = $dpo;
        $this->technical_contact = $technical_contact;
        $this->commercial_contact = $commercial_contact;
        $this->accountMail = $accountMail;
    }

    public function loadClientsCard()
    {
        if($this->active == "Actif"){
            $activeValue = 'ON';
        }else{
            $activeValue = 'OFF';
        }
        $token = $_SESSION['token'];
        echo
            "<div class='card visible card-client'>
                <div>
                    <div style='display: flex'>
                        <div class='card-img'>
                            <a href='$this->url' target='_blank' ><img src='$this->logo_url'></a>
                        </div>
                        <div class='card-info'>
                            <p class='ClientId'>$this->client_id</p>
                            <p class='ClientName'>$this->client_name</p>
                            <p>$this->short_description</p>
                            <a href='$this->url' target='_blank'>$this->url</a>
                        </div>
                    </div>
                    <div class='card-active'>
                        <form action='#' method='post'>
                            <input type='hidden' class='ClientActive' value='$this->active'>
                            <input type='hidden' name='PostType' value='1597'>
                            <input type='hidden' value='$token' name='token'>
                            <input type='hidden' name='client_id' value='$this->client_id'>
                            <div onclick=ChowElement('clientActiveConfirmation$this->client_id')>
                                <input type='button' value='$activeValue'>
                                <span></span>
                            </div>
                            <div id='clientActiveConfirmation$this->client_id' class='hidden form-comp'>
                                <div class='form-Panel'>
                                    <p>Êtes-vous sûr de vouloir changer les permissions de $this->client_name ?</p>
                                    <div class='flexMobile' style='margin-bottom: 20px'>
                                        <input type='text' value='$this->accountMail' id='mailcopy$this->client_id'>
                                        <input type='button' onclick=Copy('mailcopy$this->client_id') value='Copy' class='button'>
                                    </div>
                                    <div>
                                        <input type='submit' value='Valider' class='greenButton'>
                                        <input style='float:right' type='button' value='Annuler' class='redButton' onclick=HiddeElement('clientActiveConfirmation$this->client_id')>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p style='margin-left: 15px'>$this->active</p>
                    </div>
                </div>
                <div class='card-button'>
                    <input type='submit' value='' class='goButton' onclick=runStructure('$this->client_id')>
                    <form action='#' method='post'>
                        <input type='hidden' name='PostType' value='7951'>
                        <input type='hidden' value='$token' name='token'>
                        <input type='hidden' name='client_id' value='$this->client_id'>
                        <input type='button' class='binButton' onclick=ChowElement('clientDeleteConfirmation$this->client_id')>
                        <div id='clientDeleteConfirmation$this->client_id' class='hidden form-comp'>
                            <div class='form-Panel'>
                                <p>Êtes-vous sûr de vouloir supprimer $this->client_name de la liste de clients ainsi que toutes les structures associées ?</p>
                                <div class='flexMobile' style='margin-bottom: 20px'>
                                    <input type='text' value='$this->accountMail' id='mailcopydelete$this->client_id'>
                                    <input type='button' onclick=Copy('mailcopydelete$this->client_id') value='Copy' class='button'>
                                </div>
                                <div>
                                    <input type='submit' value='Valider' class='greenButton'>
                                    <input style='float:right' type='button' value='Annuler' class='redButton' onclick=HiddeElement('clientDeleteConfirmation$this->client_id')>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>";
    }
    public function loadClientsCardInStructure()
    {
        if($this->active == "Actif"){
            $activeValue = 'ON';
        }else{
            $activeValue = 'OFF';
        }
        $token = $_SESSION['token'];
        echo
            "<div class='card visible'>
                    <div>
                        <div class='flex'>
                            <div class='flexMobile'>
                                <div class='card-img'>
                                    <a href='$this->url' target='_blank' ><img src='$this->logo_url'></a>
                                </div>
                                <div class='card-info'>
                                    <p class='ClientIdInStructure'>$this->client_id</p>
                                    <p>$this->client_name</p>
                                    <p>$this->full_description</p>
                                </div>
                            </div>
                            <div class='card-info card-info-2'>
                                url : <a href='$this->url' target='_blank'>$this->url</a></br>
                                dpo : <a href='mailto: $this->dpo'>$this->dpo</a></br>
                                contact technique : <a href='mailto: $this->technical_contact'>$this->technical_contact</a></br>
                                contact commercial : <a href='mailto: $this->commercial_contact'>$this->commercial_contact</a>
                            </div>
                        </div>
                        <div class='card-active'>
                            <form action='#' method='post'>
                                <input type='hidden' class='ClientActive' value='$this->active'>
                                <input type='hidden' name='PostType' value='1597'>
                                <input type='hidden' value='$token' name='token'>
                                <input type='hidden' name='client_id' value='$this->client_id'>
                                <div onclick=ChowElement('clientActiveConfirmationInStruct$this->client_id')>
                                    <input type='button' value='$activeValue'>
                                    <span></span>
                                </div>
                                <div id='clientActiveConfirmationInStruct$this->client_id' class='hidden form-comp'>
                                    <div class='form-Panel'>
                                        <p>Êtes-vous sûr de vouloir changer les permissions de $this->client_name ?</p>
                                        <div class='flexMobile' style='margin-bottom: 20px'>
                                            <input type='text' value='$this->accountMail' id='mailcopyInStruct$this->client_id'>
                                            <input type='button' onclick=Copy('mailcopyInStruct$this->client_id') value='Copy' class='button'>
                                        </div>
                                        <div>
                                            <input type='submit' value='Valider' class='greenButton'>
                                            <input style='float:right' type='button' value='Annuler' class='redButton' onclick=HiddeElement('clientActiveConfirmationInStruct$this->client_id')>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <p style='margin-left: 15px'>$this->active</p>
                        </div>
                    </div>
                </div>";
    }
    public function loadClientsCardInPartnerSide()
    {
        if($this->active == "Actif"){
            $activeValue = 'ON';
        }else{
            $activeValue = 'OFF';
        }
        echo
        "<div class='card'>
                    <div>
                        <div style='display: flex'>
                            <div class='card-img'>
                                <a href='$this->url' target='_blank' ><img src='$this->logo_url'></a>
                            </div>
                            <div class='card-info'>
                                <p>$this->client_id</p>
                                <p>$this->client_name</p>
                                <p>$this->full_description</p>
                            </div>
                            <div class='card-info'>
                                url : <a href='$this->url' target='_blank'>$this->url</a></br>
                                dpo : <a href='mailto: $this->dpo'>$this->dpo</a></br>
                                contact technique : <a href='mailto: $this->technical_contact'>$this->technical_contact</a></br>
                                contact commercial : <a href='mailto: $this->commercial_contact'>$this->commercial_contact</a>
                            </div>
                        </div>
                        <div class='card-active'>
                            <div onclick=ChowElement('clientActiveConfirmationInStruct$this->client_id')>
                                <input type='button' value='$activeValue'>
                                <span></span>
                            </div>
                            <p style='margin-left: 15px'>$this->active</p>
                        </div>
                    </div>
                </div>";
    }
}