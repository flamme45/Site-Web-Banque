<?php
require_once ('modele/modele.php');
require_once ('vue/vueDirecteur.php');
require_once ('vue/vueAgent.php');
require_once ('vue/vueDirecteur.php');
require_once ('vue/vueConseiller.php');



function ctlSeConnecter($logi,$mdp){
    $type=LoginEmploye($logi,$mdp);
    if ($logi!=null && $mdp!=null) {
        if ($type== 'Directeur') {
            CtlDirecteur();
        } elseif ($type== 'Conseiller') {
            CtlConseiller();
        } elseif ($type == 'Agent') {
            CtlAgent();
        } else {
            throw new Exception("Type employe incorecte");
    }
    }else{
        throw new Exception("Un des champs est vide");
    }
}


/*-------------------------------------------------*/

function CtladdContrat($contrat){
    addContrat($contrat);
}
function CtldelContrats($cont){
    delcontrat($cont);
}
function CtlModifierContrat($nomcontrat,$modif){
    modifcontrat($nomcontrat,$modif);
}
function CtlContrats(){
    $con=getContrats();
    afficherContrat($con);
}
function CtlVerifContrats($contrat){
    $con=verifContrat($contrat);
    return $con;
}


/*-------------------------------------------------*/


function CtladdCompte($compte){
    addCompte($compte);
}
function CtldelCompte($compte){
    delcomptes($compte);
}
function CtlModifierCompte($nomcompte,$modif){
    modifcompte($nomcompte,$modif);
}
function CtlCompte(){
    $com=getCompte();
    afficherComptes($com);
}
function CtlVerifCompte($compte){
    $com=verifCompte($compte);
    return $com;
}


/*-------------------------------------------------*/


function CtladdMotif($motif,$pieces){
    addMotif($motif,$pieces);
}
function CtldelMotif($idmotif){
    delMotif($idmotif);
}
function CtlModifierMotif($idMotif,$modif){
    modifMotif($idMotif,$modif);
}
function CtlMotifs(){
    $mot=getMotif();
    afficherMotif($mot);
}
function CtlVerifMotif($motif){
    $mot=verifMotif($motif);
    return $mot;
}



/*-------------------------------------------------*/


function CtladdEmploye($nom,$login,$mdp,$type){
    addEmploye($nom,$login,$mdp,$type);
}
function CtlModifierEmploye($idEmploye,$modifLogin,$modifMDP){
    modifEmploye($idEmploye,$modifLogin,$modifMDP);
}
function CtlEmploye(){
    $em=getEmployer();
    afficherEmployer($em);
}


/*-------------------------------------------------*/


function CtlStats($date1,$date2){
    $con=getStatsContrats($date1,$date2);
    $red=getStatsRDV($date1,$date2);
    $nbCli=getNbClients($date2);
    $montanttot=getmontant();
    afficherStats($con,$red,$nbCli,$montanttot);
}
/*-------------------------------------------------*/
function CtlDirecteur(){
    afficherDirecteur();
}
/*-------------------------------------------------*/

function CtlAgent(){
	afficherAgent();

}


function CtlErreur($erreur){
    afficherErreur($erreur);
}


/*-----------------------------------------------------FONCTION AGENT-------------------------------------*/

function CtlModifierClient($idClient,$adresse,$numTel,$eMail,$profession,$situation_familiale){
    modifClient($idClient,$adresse,$numTel,$eMail,$profession,$situation_familiale);
}
function CtlafficherClient(){
	afficherClient();
}
function CtlModifier($id){
	$mod=getModif($id);
    afficherModif($mod);
}

function CtlafficherClientSynthese(){
	afficherClientSynthese();
}

function CtlSynthese($id){	
	$syn=getSynthese($id);
	$mod=getModif($id);
	$con=getConseiller($id);
	$cont=getContratClient($id);
    afficherSynthese($syn,$mod,$con,$cont);
}

function CtlAfficherOperation(){	
    afficherClientOperation();
}

function CtlOperationClient($id){
	$ope=getOperation($id);
	afficherOperation($ope,$id);
}

function CtlOperation($idClient,$nomCompte,$montant,$nomOperation){
    $faireOpe=true;
	if ($nomOperation=="Debiter") {
        $faireOpe = CtlOperationPossible($idClient, $nomCompte, $montant);
    }
    if ($faireOpe) {
        $soldeDuCompte = getSolde($idClient, $nomCompte)->SOLDE;
        $nouveauSolde = $soldeDuCompte + $montant;
        modifSolde($idClient, $nomCompte, $nouveauSolde);
        ajouterOperation($idClient, $nomCompte, $nomOperation, $montant);
    }
    else
        echo '<p>Operation Impossible, decouvert dépassé</p>';

    CtlOperationClient($idClient);
}

function CtlOperationPossible($idClient,$nomCompte,$montantSouhaitantEtreRetirer){
    $getsolde=getSolde($idClient,$nomCompte);
    $montantDecouvert=-$getsolde->MONTANTDECOUVERT;
    $soldeActuel=$getsolde->SOLDE;
    $soldeApresRetrait=$soldeActuel+$montantSouhaitantEtreRetirer;
    if ($soldeApresRetrait<$montantDecouvert)
        return false;
    return true;
}

function CtlAfficherIDClient(){
    afficherClientRechercheID();
}

function CtlTrouverIDClient($nom,$dateN){
    $cli=getIDcli($nom,$dateN);
    afficherIDCli($cli);
}
//---------------------------------------------------------------------------------------------------------------------
function CtldemanderIdCliRDV(){
    afficherdemandeIdrdv();
}

function CtlCalendrierRDV($idClient,$dateSemaine){
    $idConseiller=trouverConseillerDeClient($idClient)->idemploye;
    $rdvDuConseiller=getrdvEmploye($idConseiller);
    $motif=getMotif();
    afficherCalendrier($idClient,$dateSemaine,$rdvDuConseiller,$motif);
}

/*-----------------------------------------------------FONCTION CONSEILLER-------------------------------------*/

function CtlConseiller(){
    afficherConseiller();

}

function CtlAfficherInscrireCli(){
    afficherInscrireCli();
}

function CtlInscrireCli($id,$nom,$prenom,$datN,$adresse,$numT,$email,$profession,$situation){
    addClient($id,$nom,$prenom,$datN,$adresse,$numT,$email,$profession,$situation);
    afficherConseiller();
}

function CtlAfficherVendreContrat(){
    afficherVendreContrat(listeContrat());
}

function CtlVendreContrat($id,$compte,$tarif){
    vendreContrat($id,$compte,$tarif);
    afficherConseiller();
}

function CtlAfficherOuvrirCompte(){
    afficherOuvrirCompte(listeCompte());
}

function CtlOuvrirCompte($id,$compte,$solde,$decouvert){
    ouvrirCompte($id,$compte,$solde,$decouvert);
    afficherConseiller();
}

function CtlAfficherMenuDecouvert($id,$compte){
    afficherMenuDecouvert($id,$compte);
}


function CtlModifDecouvert($id,$compte,$valeur){
    modifDecouvert($id,$compte,$valeur);
    afficherConseiller();
}

function CtlAfficherMenuResContrat($id,$contrat){
    afficherMenuResContrat($id,$contrat);
}

function CtlResContrat($id,$contrat){
    resContrat($id,$contrat);
    afficherConseiller();
}


function CtlAfficherMenuResCompte($id,$compte){
    afficherMenuResCompte($id,$compte);
}

function CtlResCompte($id,$compte){
    resCompte($id,$compte);
    afficherConseiller();
}

function CtlAfficherChoixClient(){
    afficherChoixClient();
}

function CtlAfficherChoixClient2(){
    afficherChoixClient2();
}

function CtlAfficherChoixClient3(){
    afficherChoixClient3();
}

function CtlCercheContrat($id){
    $x=chercheContrat($id);
    return $x;
}

function CtlChercheCompte($id){
    return chercheCompte($id);
}

function CtlChercheContrat($id){
    return chercheContrat($id);
}
