<?php

class STRUCTURE{
    public $client_id;
    public $struct_id;
    public $owner_name;
    public $active;
    public $address;
    public $contact;
    public $perms;
    public $accountMail;

    public function __construct(int $client_id, int $struct_id, string $owner_name, string $active, string $address, string $contact, string $perms, string $accountMail)
    {
        $this->client_id = $client_id;
        $this->struct_id = $struct_id;
        $this->owner_name = $owner_name;
        $this->active = $active;
        $this->address = $address;
        $this->contact = $contact;
        $this->perms = $perms;
        $this->accountMail = $accountMail;
    }

    public function loadStructureCard()
    {
        if($this->active == "Actif"){
            $activeValue = 'ON';
        }else{
            $activeValue = 'OFF';
        }
        $permsOnValue = explode(',', $this->perms);
        $i = 0;
        $permsCheckedValue = array();
        while($i <= 5){
            if(!empty($permsOnValue[$i])){
                $permsCheckedValue[$i] = 'checked';
            }
            else{
                $permsCheckedValue[$i] = '';
            }
            $i++;
        }
        $token = $_SESSION['token'];
        echo
            "<div class='card visible'>
                <div>
                    <div class='flex' style='height: 190px'>
                        <div class='card-info' style='margin-left: 20px'>
                            <input type='hidden' value='$this->client_id' class='client_idForStruct'>
                            <p class='StructureId'>$this->struct_id</p>
                            <p class='OwnerName'>$this->owner_name</p>
                            <p>$this->address</p>
                            <a href='mailto:$this->contact' target='_blank'>$this->contact</a>
                            <div class='card-activeStruct'>
                                <form action='#' method='post'>
                                    <input type='hidden' class='ClientActive' value='$this->active'>
                                    <input type='hidden' name='PostType' value='2864'>
                                    <input type='hidden' value='$token' name='token'>
                                    <input type='hidden' name='struct_id' value='$this->struct_id'>
                                    <div onclick=ChowElement('structActiveConfirmation$this->struct_id')>
                                        <input type='button' value='$activeValue'>
                                        <span></span>
                                    </div>
                                    <div id='structActiveConfirmation$this->struct_id' class='hidden form-comp'>
                                        <div class='form-Panel'>
                                            <p>Êtes-vous sûr de vouloir changer les permissions globale de $this->owner_name ?</p>
                                            <div class='flexMobile' style='margin-bottom: 20px'>
                                                <input type='text' value='$this->accountMail' id='mailcopyStr$this->struct_id'>
                                                <input type='button' onclick=Copy('mailcopyStr$this->struct_id') value='Copy' class='button'>
                                            </div>
                                            <div>
                                                <input type='submit' value='Valider' class='greenButton'>
                                                <input style='float:right' type='button' value='Annuler' class='redButton' onclick=HiddeElement('structActiveConfirmation$this->struct_id')>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <p style='margin-left: 15px'>$this->active</p>
                            </div>
                        </div>
                        <form action='#' method='post'>
                            <input type='hidden' name='PostType' value='5896'>
                            <input type='hidden' value='$token' name='token'>
                            <input type='hidden' name='struct_id' value='$this->struct_id'>
                            <input type='button' class='binButton' onclick=ChowElement('structDeleteConfirmation$this->struct_id')>
                            <div id='structDeleteConfirmation$this->struct_id' class='hidden form-comp'>
                                <div class='form-Panel'>
                                    <p>Êtes-vous sûr de vouloir supprimer $this->owner_name de la liste des structures ?</p>
                                    <div class='flexMobile' style='margin-bottom: 20px'>
                                        <input type='text' value='$this->accountMail' id='mailcopyStrDelete$this->struct_id'>
                                        <input type='button' onclick=Copy('mailcopyStrDelete$this->struct_id') value='Copy' class='button'>
                                    </div>
                                    <div>
                                        <input type='submit' value='Valider' class='greenButton'>
                                        <input style='float:right' type='button' value='Annuler' class='redButton' onclick=HiddeElement('structDeleteConfirmation$this->struct_id')>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <h3>Permisions</h3>
                <form action='#' method='post'>
                <div class='flex'>
                    <div>
                        <div class='flexMobile'>
                            <label class='checkboxText'>
                                <input type='hidden' name='perms_0' value='0'>
                                <input type='checkbox' name='perms_0' $permsCheckedValue[0] onclick='this.previousSibling.value=1-this.previousSibling.value'>
                                <span class='spantext'></span>
                            </label>
                            <p>Vendre des boissons</p>
                        </div>
                        <div class='flexMobile'>
                            <label class='checkboxText'>
                                <input type='hidden' name='perms_1' value='0'>
                                <input type='checkbox' name='perms_1' $permsCheckedValue[1] onclick='this.previousSibling.value=1-this.previousSibling.value'>
                                <span class='spantext'></span>
                            </label>
                            <p>Vendre des vêtements</p>
                        </div>
                        <div class='flexMobile'>
                            <label class='checkboxText'>
                                <input type='hidden' name='perms_2' value='0'>
                                <input type='checkbox' name='perms_2' $permsCheckedValue[2] onclick='this.previousSibling.value=1-this.previousSibling.value'>
                                <span class='spantext'></span>
                            </label>
                            <p>Envoyer newsletter</p>
                        </div>
                    </div>
                    
                    <div>
                        <div class='flexMobile'>
                            <label class='checkboxText'>
                                <input type='hidden' name='perms_3' value='0'>
                                <input type='checkbox' name='perms_3' $permsCheckedValue[3] onclick='this.previousSibling.value=1-this.previousSibling.value'>
                                <span class='spantext'></span>
                            </label>
                            <p>Carte de membres</p>
                        </div>
                        <div class='flexMobile'>
                            <label class='checkboxText'>
                                <input type='hidden' name='perms_4' value='0'>
                                <input type='checkbox' name='perms_4' $permsCheckedValue[4] onclick='this.previousSibling.value=1-this.previousSibling.value'>
                                <span class='spantext'></span>
                            </label>
                            <p>Planning de coach</p>
                        </div>
                        <div class='flexMobile'>
                            <label class='checkboxText'>
                                <input type='hidden' name='perms_5' value='0'>
                                <input type='checkbox' name='perms_5' $permsCheckedValue[5] onclick='this.previousSibling.value=1-this.previousSibling.value'>
                                <span class='spantext'></span>
                            </label>
                            <p>Programme personnalisé</p>
                        </div>
                    </div>
                </div>
                <div style='margin-left: 20px'>
                    <input type='button' value='Valider' class='greenButton' onclick=ChowElement('structPermsConform$this->struct_id')>
                    <input type='reset' value='Annuler' class='redButton'>
                </div>
                <div id='structPermsConform$this->struct_id' class='hidden form-comp'>
                    <div class='form-Panel'>
                        <p>Êtes-vous sûr de vouloir changer les permissions de $this->owner_name</p>
                        <div>
                            <div class='flexMobile' style='margin-bottom: 20px'>
                                <input type='text' value='$this->accountMail' id='mailcopyStrPerms$this->struct_id'>
                                <input type='button' onclick=Copy('mailcopyStrPerms$this->struct_id') value='Copy' class='button'>
                            </div>
                            <input type='hidden' name='PostType' value='4682'>
                            <input type='hidden' value='$token' name='token'>
                            <input type='hidden' name='struct_id' value='$this->struct_id'>
                            <input type='submit' value='Valider' class='greenButton'>
                            <input style='float:right' type='button' value='Annuler' class='redButton' onclick=HiddeElement('structPermsConform$this->struct_id')>
                        </div>
                    </div>
                </div>
                </form>
            </div>";
    }
    public function loadStructureCardInStructSide()
    {
        if($this->active == "Actif"){
            $activeValue = 'ON';
        }else{
            $activeValue = 'OFF';
        }
        $permsOnValue = explode(',', $this->perms);
        $i = 0;
        $permsCheckedValue = array();
        while($i <= 5){
            if(!empty($permsOnValue[$i])){
                $permsCheckedValue[$i] = 'checked';
            }
            else{
                $permsCheckedValue[$i] = '';
            }
            $i++;
        }
        echo
        "<div class='card'>
                <div>
                    <div class='flex' style='height: 190px'>
                        <div class='card-info' style='margin-left: 20px'>
                            <p>$this->struct_id</p>
                            <p>$this->owner_name</p>
                            <p>$this->address</p>
                            <a href='mailto:$this->contact' target='_blank'>$this->contact</a>
                            <div class='card-activeStruct'>
                                <div>
                                    <input type='button' value='$activeValue'>
                                    <span></span>
                                </div>
                                <p style='margin-left: 15px'>$this->active</p>
                            </div>
                        </div>
                    </div>
                </div>
                <h3>Permisions</h3>
                <div>
                    <div class='flex'>
                        <div>
                            <div class='flexMobile'>
                                <label class='checkboxText'>
                                    <input type='checkbox' name='perms_0' $permsCheckedValue[0] onclick='return false;'>
                                    <span class='spantext'></span>
                                </label>
                                <p>Vendre des boissons</p>
                            </div>
                            <div class='flexMobile'>
                                <label class='checkboxText'>
                                    <input type='checkbox' name='perms_1' $permsCheckedValue[1] onclick='return false;'>
                                    <span class='spantext'></span>
                                </label>
                                <p>Vendre des vêtements</p>
                            </div>
                            <div class='flexMobile'>
                                <label class='checkboxText'>
                                    <input type='checkbox' name='perms_2' $permsCheckedValue[2] onclick='return false;'>
                                    <span class='spantext'></span>
                                </label>
                                <p>Envoyer newsletter</p>
                            </div>
                        </div>
                        
                        <div>
                            <div class='flexMobile'>
                                <label class='checkboxText'>
                                    <input type='checkbox' name='perms_3' $permsCheckedValue[3] onclick='return false;'>
                                    <span class='spantext'></span>
                                </label>
                                <p>Carte de membres</p>
                            </div>
                            <div class='flexMobile'>
                                <label class='checkboxText'>
                                    <input type='checkbox' name='perms_4' $permsCheckedValue[4] onclick='return false;'>
                                    <span class='spantext'></span>
                                </label>
                                <p>Planning de coach</p>
                            </div>
                            <div class='flexMobile'>
                                <label class='checkboxText'>
                                    <input type='checkbox' name='perms_5' $permsCheckedValue[5] onclick='return false;'>
                                    <span class='spantext'></span>
                                </label>
                                <p>Programme personnalisé</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
    }
}