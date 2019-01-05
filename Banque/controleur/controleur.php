<?php
require_once ('modele/modele.php');
require_once ('vue/vueDirecteur.php');
require_once ('vue/vueAgent.php');
require_once ('vue/vueDirecteur.php');
require_once ('vue/vueConseiller.php');



function ctlSeConnecter($logi,$mdp){
    
    if (verifEmploye($logi,$mdp)) {
		$type=LoginEmploye($logi,$mdp);
        if ($type== 'Directeur') {
            CtlDirecteur();
        } elseif ($type== 'Conseiller') {
            CtlConseiller();
        } elseif ($type == 'Agent') {
            CtlAgent();
        } else {
           // throw new Exception("Type employe incorecte");
    }
    }else{
        //throw new Exception("Un des champs est vide");
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
	if (is_numeric($numTel)){
		modifClient($idClient,$adresse,$numTel,$eMail,$profession,$situation_familiale);
		echo '<script>alert("Modification effectué.");</script>';
		afficherAgent();
	}
	else {
		echo '<script>alert("Saisie non valide, veuillez réessayer.");</script>';
		$mod=getModif($idClient);
		afficherModif($mod);
	}
}

function CtlafficherClient(){
	afficherClient();
}

function CtlModifier($id){
	if (is_numeric($id) && verifClient($id)){
		$mod=getModif($id);
		afficherModif($mod);
	}else {
		echo '<script>alert("ID client non valide, veuillez réessayer.");</script>';
		afficherClient();
	}
}

function CtlafficherClientSynthese(){
	afficherClientSynthese();
}

function CtlSynthese($id){
	if (is_numeric($id) && verifClient($id)){	
		$syn=getSynthese($id);
		$mod=getModif($id);
		$con=getConseiller($id);
		$cont=getContratClient($id);
		afficherSynthese($syn,$mod,$con,$cont);
	}else{
		echo '<script>alert("ID client non valide, veuillez réessayer.");</script>';
		afficherClientSynthese();
	}		
}

function CtlAfficherOperation(){	
    afficherClientOperation();
}

function CtlOperationClient($id){
	if (is_numeric($id) && verifClient($id)){
		$ope=getOperation($id);
		afficherOperation($ope,$id);
	}
	else{
		echo '<script>alert("ID client non valide, veuillez réessayer.");</script>';
		afficherClientOperation();
	}	
}

function CtlOperation($idClient,$nomCompte,$montant,$nomOperation){
    $faireOpe=true;
	if (is_numeric($montant)){
		if ($nomOperation=="Debiter") {
			$faireOpe = CtlOperationPossible($idClient, $nomCompte, $montant);
		}
		if ($faireOpe) {
			$soldeDuCompte = getSolde($idClient, $nomCompte)->SOLDE;
			if ($nomOperation=="Debiter") {
				$nouveauSolde = $soldeDuCompte - $montant;
				modifSolde($idClient, $nomCompte, $nouveauSolde);
				ajouterOperation($idClient, $nomCompte, $nomOperation, $montant);
				echo '<script>alert("Opération effectué.");</script>';
				afficherAgent();
			}
			else {				
			$nouveauSolde = $soldeDuCompte + $montant;
			modifSolde($idClient, $nomCompte, $nouveauSolde);
			ajouterOperation($idClient, $nomCompte, $nomOperation, $montant);
			echo '<script>alert("Opération effectué.");</script>';
			afficherAgent();
			}
		}
		else {
		    echo '<script>alert("Operation Impossible, decouvert dépassé");</script>';

			//echo '<p class="opeImpossible">Operation Impossible, decouvert dépassé</p>';
		}
	}	
	CtlOperationClient($idClient);
}

function CtlOperationPossible($idClient,$nomCompte,$montantSouhaitantEtreRetirer){

	$getsolde=getSolde($idClient,$nomCompte);
	$montantDecouvert=-$getsolde->MONTANTDECOUVERT;
	$soldeActuel=$getsolde->SOLDE;
	$soldeApresRetrait=$soldeActuel-$montantSouhaitantEtreRetirer;
	if ($soldeApresRetrait<$montantDecouvert)
		return false;
	return true;
}

function CtlAfficherIDClient(){
    afficherClientRechercheID();
}

function CtlTrouverIDClient($nom,$dateN){
	if (verifRechercheClient($nom,$dateN)){
		$cli=getIDcli($nom,$dateN);
		afficherIDCli($cli);
		
	}
	else{
		echo '<script>alert("Client inexistant, veuillez réessayer.");</script>';
		afficherClientRechercheID();
	}		
}
//---------------------------------------------------------------------------------------------------------------------
function CtldemanderIdCliRDV(){
    afficherdemandeIdrdv();
}

function CtlCalendrierRDV($idClient,$dateSemaine){
	if (is_numeric($idClient) && verifClient($idClient)){
		$idConseiller=trouverConseillerDeClient($idClient)->idemploye;
		$x=new DateTime($dateSemaine);
		$jourd=$x->format("w");// numéro du $x actuel 0 dimanche, 6 samedi
		$dateDebSemaineFrd = date("Y-m-d",mktime(0,0,0,$x->format("n"),($x->format("d"))-$jourd+1,$x->format("y")));
		$dateFinSemaineFrd = date("Y-m-d",mktime(0,0,0,$x->format("n"),($x->format("d"))-$jourd+7,$x->format("y")));
		$rdvDuConseiller=getrdvEmploye($idConseiller,$dateDebSemaineFrd,$dateFinSemaineFrd);
		$motif=getMotif();
		afficherCalendrier($idClient,$dateSemaine,$rdvDuConseiller,$motif);
	}else{
		echo '<script>alert("ID cient non valide, veuillez réessayer.");</script>';
        afficherdemandeIdrdv();
	}		
}

function CtlListePieces($motif){
    $listePieces=getListePieces($motif);
    afficherPiecesAApporter($listePieces->LISTEPIECES);
}

function CtlEnregisterRdv($date,$motif,$idClient){
    $idMotif =getidMotif($motif);
    $idEmploye=trouverConseillerDeClient($idClient);
    enregisterRdv($date,$idMotif->IDMOTIF,$idClient,$idEmploye->idemploye);
}

/*-----------------------------------------------------FONCTION CONSEILLER-------------------------------------*/

function CtlConseiller(){
    afficherConseiller();

}

function CtlAfficherInscrireCli(){
    afficherInscrireCli();
}

function CtlInscrireCli($idconseiller,$nom,$prenom,$datN,$adresse,$numT,$email,$profession,$situation){
    if (verifConseiller($idconseiller) && verifConseiller($idconseiller)->TYPEEMPLOYE=="Conseiller" && is_numeric($numT)) {
        addClient($idconseiller, $nom, $prenom, $datN, $adresse, $numT, $email, $profession, $situation);
		echo '<script>alert("Inscription réalisé.");</script>';
        afficherConseiller();
    }else {
		echo '<script>alert("Erreur de saisie, veuillez réessayer.");</script>';
        afficherInscrireCli();
	}
}

function CtlAfficherVendreContrat($cli){
    if (is_numeric($cli) && verifClient($cli))
        afficherVendreContrat($cli,cherchenonContrat($cli));
    else {
		echo '<script>alert("ID client invalide, veuillez réessayer.");</script>';
        afficherChoixClient4();
	}

}

function CtlVendreContrat($idclient,$contrat,$tarif){
    $x=verifContratClient($idclient,$contrat);
    $y=$tarif;
    if (is_numeric($y) && $y>=0 && verifClient($idclient) && !$x) {
        vendreContrat($idclient, $contrat, $tarif);
		echo '<script>alert("Contrat vendu.");</script>';
        afficherConseiller();
    }else {
		echo '<script>alert("Erreur de saisie, veuillez réessayer.");</script>';
        CtlAfficherVendreContrat($idclient);
	}
}

function CtlAfficherOuvrirCompte($cli){
    if (is_numeric($cli) && verifClient($cli))
        afficherOuvrirCompte($cli,cherchenonCompte($cli));
    else {
		echo '<script>alert("ID client invalide, veuillez réessayer.");</script>';
        afficherChoixClient5();
	}
}

function CtlOuvrirCompte($id,$compte,$solde,$decouvert){
    $x=verifcompteClient($id,$compte);

    if (is_numeric($solde) && $solde>=0 && $decouvert >=0 && is_numeric($decouvert) && verifClient($id) && !$x){
        ouvrirCompte($id,$compte,$solde,$decouvert);
		echo '<script>alert("Compte ouvert.");</script>';
        afficherConseiller();
    }else {
		echo '<script>alert("Erreur de saisie, veuillez réessayer.");</script>';
        CtlafficherOuvrirCompte($id);
	}
}

function CtlAfficherMenuDecouvert($id){
    $x=CtlChercheCompte($id);
    if (is_numeric($id) && verifClient($id))
        afficherMenuDecouvert($id,$x);
    else {
		echo '<script>alert("ID client invalide, veuillez réessayer.");</script>';
		afficherChoixClient();
	}
	
}


function CtlModifDecouvert($id,$compte,$valeur){
    if (is_numeric($valeur)&& $valeur>=0) {
        modifDecouvert($id, $compte, $valeur);
		echo '<script>alert("Découvert modifié.");</script>';
        afficherConseiller();
    }
    else {
		echo '<script>alert("Erreur de saisie, veuillez réessayer.");</script>';
        CtlAfficherMenuDecouvert($id);
	}
    

}

function CtlAfficherMenuResContrat($id,$contrat){
    if (is_numeric($id) && verifClient($id))
        afficherMenuResContrat($id,$contrat);
    else {
		echo '<script>alert("ID client invalide, veuillez réessayer.");</script>';
        afficherChoixClient2();
	}
}

function CtlResContrat($id,$contrat){
    resContrat($id,$contrat);
	echo '<script>alert("Contrat résilié.");</script>';
    afficherConseiller();
}


function CtlAfficherMenuResCompte($id,$compte){
    if (is_numeric($id) && verifClient($id))
        afficherMenuResCompte($id,$compte);
    else {
		echo '<script>alert("ID client invalide, veuillez réessayer.");</script>';
        afficherChoixClient3();
	}
}

function CtlResCompte($id,$compte){
    resCompte($id,$compte);
	echo '<script>alert("Compte résilié.");</script>';
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

function CtlAfficherChoixClient4(){
    afficherChoixClient4();
}

function CtlAfficherChoixClient5(){
    afficherChoixClient5();
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

function CtlListeConseiller(){
	$cons=getConseillerRDV();
	afficherChoixConseiller($cons);
}

function CtlCalendrierRDVEmploye($idConseiller,$dateSemaine){
    
    $x=new DateTime($dateSemaine);
    $jourd=$x->format("w");// numéro du $x actuel 0 dimanche, 6 samedi
    $dateDebSemaineFrd = date("Y-m-d",mktime(0,0,0,$x->format("n"),($x->format("d"))-$jourd+1,$x->format("y")));
    $dateFinSemaineFrd = date("Y-m-d",mktime(0,0,0,$x->format("n"),($x->format("d"))-$jourd+7,$x->format("y")));
    $rdvDuConseiller=getrdvEmploye($idConseiller,$dateDebSemaineFrd,$dateFinSemaineFrd);
    $rdvSansClient=getrdvEmployeSansClient($idConseiller,$dateDebSemaineFrd,$dateFinSemaineFrd);
	
    afficherCalendrierConseiller($idConseiller,$dateSemaine,$rdvDuConseiller,$rdvSansClient);
}

function CtlEnregisterIndispo($date,$idEmploye){
    $x= date("Y-m-d H:i");
    $y=strtotime($date);
    $x=strtotime($x);

    if ($y>=$x) {
        enregisterIndispo($date, $idEmploye);
		echo '<script>alert("Plage horaire rendu indisponible.");</script>';
        CtlCalendrierRDVEmploye($idEmploye,$date);
    }else
        CtlCalendrierRDVEmploye($idEmploye,$date);
}

function CtlSyntheseRDV($dateRDV,$idemploye){
    if (isset($dateRDV)) {
        $id = getClientRDV($dateRDV)->IDCLIENT;
        $idmot = getClientRDV($dateRDV)->IDMOTIF;
        $mot = getMotifRDV($idmot);
        $syn = getSynthese($id);
        $mod = getModif($id);
        $con = getConseiller($id);
        $cont = getContratClient($id);
        afficherDetailsRDV($syn, $mod, $con, $cont, $mot, $id);
    }else
        CtlCalendrierRDVEmploye($idemploye,date("Y-m-d H:i"));
}

function CtlIDClientEstNull($idEmploye,$tab){
    $x=IDClientEstNull($idEmploye,$tab->DATERDV);
    if ($x==null){
        return true;
    }
    return false;
}

function CtlestNouveauClient($idClient){
    $x=estNewClient($idClient);
    if ($x==null){
        return false;
    }
    return true;
}
