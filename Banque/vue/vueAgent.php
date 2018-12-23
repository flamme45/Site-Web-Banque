<?php


function afficherAgent(){
    $contenu=afficherMenuAgent().'<form id=monForm2 action="site.php" method="post"> <fieldset><legend>Selection opperation</legend><p><select name="opeAgent"><option value="c1">Modifier informations client</option><option value="c2">Synthese client</option><option value="c3">Opération sur le compte</option><option value="c4">Rendez-vous</option><option value="c5">Retrouver identifiant client</option></select><input type="submit" value="Selectionner" name="operaAgent"></p></fieldset></form>';
    require_once('gabarit.php');
}


function afficherLogAgent(){
    $contenu ='<form id="monForm1" action="site.php" method="post"><fieldset><legend>Se connecter</legend><p><label>  Login  : </label><input type="text" name="Login"  /></p><p><label>  Mot de passe  : </label><input type="password" name="Mdp"  /></p><p><input type="submit" value="Se Connecter" name="Connecter"><input type="reset" value="Effacer"></p></fieldset></form>';
    require_once('gabarit.php');
}


function afficherClient(){

    $contenu=afficherMenuAgent().'<form id="monForm1" action="site.php" method="post"><fieldset><legend>Modification Informations Client</legend><p>Entrez identifiant du client recherché : <input type="text"  name="SelectClientModif"> <input type="submit" name="RechercherClientModif" value="Rechercher ce Client" /></fieldset></form>';
    require_once('gabarit.php');
}


function afficherModif($mod){
    $c='';
    $c=$c.'<p><input type="checkbox" checked name="idClient[]" value="' . $mod->IDCLIENT .'">'.$mod->NOMCLI.'  Adresse : <input name="'. $mod->IDCLIENT  .'[]" type="text" value="' . $mod->ADRESSE .'" />  Numéro : <input name="'. $mod->IDCLIENT  .'[]" type="text" value="' . $mod->NUMTEL .'" />  eMail : <input name="'. $mod->IDCLIENT  .'[]" type="text" value="' . $mod->EMAIL .'" />  Profession : <input name="'. $mod->IDCLIENT  .'[]" type="text" value="' . $mod->PROFESSION .'" />  Situation Familiale : <input name="'. $mod->IDCLIENT  .'[]" type="text" value="' . $mod->SITUATION_FAMILIALE .'" /></p>';

    $contenu=afficherMenuAgent().'<form id="formModifs" action="site.php" method="post"><fieldset><legend>Recherche client </legend>'.$c.'<p><input type="submit" value="Modifier Client" name="modClient"/></p></fieldset></form>';
    require_once ('gabarit.php');
}


function afficherClientSynthese(){

    $contenu=afficherMenuAgent().'<form id="monForm2" action="site.php" method="post"><fieldset><legend>Synthese Client</legend><p>Entrez identifiant du client recherché : <input type="text"  name="SelectClientSynthese"> <input type="submit" name="RechercherClientSynthese" value="Afficher Synthese" /></fieldset></form>';
    require_once('gabarit.php');
}


function afficherSynthese($synthese,$mod,$con,$contrat){
    $c='';
    $co='';
    $contrats='';
    $c=$c.'<p><label>Nom du client : <input name="'. $mod->NOMCLI  .'[]" type="text" value="' . $mod->NOMCLI .'" readonly="readonly" /></label></p><p><label>Adresse : <input name="'. $mod->NOMCLI  .'[]" type="text" value="' . $mod->ADRESSE .'" readonly="readonly" /> </label></p><p><label> Numéro : <input name="'. $mod->NOMCLI  .'[]" type="text" value="' . $mod->NUMTEL .'" readonly="readonly" /></label></p><p><label>eMail : <input name="'. $mod->NOMCLI  .'[]" type="text" value="' . $mod->EMAIL .'" readonly="readonly" /></label></p><p><label>Profession : <input name="'. $mod->NOMCLI  .'[]" type="text" value="' . $mod->PROFESSION .'" readonly="readonly"/></label></p><p><label>Situation Familiale : <input name="'. $mod->NOMCLI  .'[]" type="text" value="' . $mod->SITUATION_FAMILIALE .'" readonly="readonly"/></label></p>';

    $contenu='<p><fieldset><legend>Liste informations client</legend>'.$c.'<p>Nom du conseiller : <input name="'. $con->NOMEMPLOYE .'[]" type="text" value="' . $con->NOMEMPLOYE .'" readonly="readonly"/></p></fieldset>';

    foreach ($synthese as $syn){
        $co=$co.'<p>Nom du compte : <input name="'. $syn->NOMCOMPTE  .'[]" type="text" value="' . $syn->NOMCOMPTE .'" readonly="readonly" />  Date ouverture : <input name="'. $syn->NOMCOMPTE  .'[]" type="text" value="' . $syn->DATEOUVERTURE .'" readonly="readonly"/>  Solde : <input name="'. $syn->NOMCOMPTE  .'[]" type="text" value="' . $syn->SOLDE .'" readonly="readonly"/>  Montant du decouvert autorisé : <input name="'. $syn->NOMCOMPTE  .'[]" type="text" value="' . $syn->MONTANTDECOUVERT .'" readonly="readonly"/></p>';
    }
    foreach ($contrat as $ctr){
        $contrats=$contrats.'<p>Nom du contrat : <input name="'. $ctr->NOMCONTRAT  .'[]" type="text" value="' . $ctr->NOMCONTRAT .'" readonly="readonly" />  Date ouverture : <input name="'. $ctr->NOMCONTRAT  .'[]" type="text" value="' . $ctr->DATEOUVERTURECONTRAT .'" readonly="readonly"/>  Tarif mensuel : <input name="'. $ctr->NOMCONTRAT  .'[]" type="text" value="' . $ctr->TARIFMENSUEL .'" readonly="readonly"/></p>';
    }
    $contenu=afficherMenuAgent().'<fieldset><legend>Synthese client </legend>'.$contenu.'<p><fieldset><legend>Liste des comptes du client</legend>'.$co.'</fieldset><p><fieldset><legend>Liste des contrat du client</legend>'.$contrats.'</fieldset></fieldset>';
    require_once ('gabarit.php');
}


function afficherClientOperation(){

    $contenu=afficherMenuAgent().'<form id="monForm2" action="site.php" method="post"><fieldset><legend>Opération sur un compte</legend><p>Entrez identifiant du client : <input type="text"  name="SelectClientOperation"> <input type="submit" name="RechercherClientOperation" value="Afficher les comptes" /></fieldset></form>';
    require_once('gabarit.php');
}

function afficherOperation($operation,$idClient){
    $c='';
    /* $contenu=afficherMenuAgent().'<form id=monForm2 action="site.php" method="post"> <fieldset><legend>Selection opperation</legend><p><select name="opeAgent"><option value="c1">Modifier informations client</option><option value="c2">Synthese client</option><option value="c3">Opération sur le compte</option><option value="c4">Rendez-vous</option><option value="c5">Retrouver identifiant client</option></select><input type="submit" value="Selectionner" name="operaAgent"></p></fieldset></form>';
     */

    foreach ($operation as $ope){
        $c=$c.'<option value="'.$ope->NOMCOMPTE.'">'.$ope->NOMCOMPTE.'</option>';
    }
    $contenu=afficherMenuAgent().'<form id="formOpe" action="site.php" method="post"><fieldset><legend>Opération sur un compte </legend><p><label>Id du Client </label><input type="text" name="idduClient" value="'.$idClient.'" readonly="readonly"></p><p>Nom du compte : <select name="opeClient">'.$c.'</select></p> <p>Montant opération : <input type="text" name="montantOpe"/></p><p><input type="submit" value="Dépot" name="DepotClient"/><input type="submit" value="Retrait" name="RetraitClient"/></p></fieldset></form>';
    require_once ('gabarit.php');
}


function afficherClientRechercheID(){

    $contenu=afficherMenuAgent().'<form id="monForm3" action="site.php" method="post"><fieldset><legend>Recherce identifiant client</legend><p>Entrez nom du client recherché : <input type="text"  name="SelectClientNom"> Date de naissance du client recherché : <input type="date"  name="SelectClientDateN"> <input type="submit" name="RechercherClientID" value="Afficher id client" /></fieldset></form>';
    require_once('gabarit.php');
}

function afficherIDCli($cli) {
    $contenu =afficherMenuAgent().'<p><fieldset><legend>Recherche identifiant client</legend><p>Identifiant du client : <input name="IDCLIENT" type="text" value="' . $cli->IDCLIENT .'" /></p></legend></p';

    require_once ('gabarit.php');
}



function afficherMenuAgent(){
    $contenu='<form id="formMenu" method="post" action="site.php"><nav><ul><li><input type="submit" value="Aller à la selection des operation" name="retourAgent"></li><li><input type="submit" value="Deconnexion" name="Deco"></li></ul></nav></form>';
    return $contenu;
}
//--------------------------------------------------------------------
function afficherdemandeIdrdv(){
    $contenu =afficherMenuAgent().
        '<form id="formRdv" action="site.php" method="post"><fieldset><legend>Planning</legend><label>Entrez l\'id d\'un client</label><input type="text" name="idCli"><input type="submit" name="afficherSemaine" value="Rechercher"></fieldset>';

    require_once ('gabarit.php');
}




function afficherCalendrier($idcli,$dateSemaine,$rdvemploye,$motif){
    $tab= array();
    foreach ($rdvemploye as $rdv){
        array_push($tab,$rdv);
    }
    $x=new DateTime($dateSemaine);
    $jourd=$x->format("w");// numéro du $x actuel 0 dimanche, 6 samedi
    $nom_moisd = $x->format("F"); // nom du mois $x  DECEMBER
    $anneed= $x->format("Y"); // année  de $x 2018
    $num_weekd = $x->format("W"); // numéro de la semaine $x 51

    $dateDebSemaineFrd = date("d/m/Y",mktime(0,0,0,$x->format("n"),($x->format("d"))-$jourd+1,$x->format("y")));
    $dateFinSemaineFrd = date("d/m/Y",mktime(0,0,0,$x->format("n"),($x->format("d"))-$jourd+7,$x->format("y")));

    switch($nom_moisd) {
        case 'January' : $nom_moisd = 'Janvier'; break;
        case 'February' : $nom_moisd = 'Février'; break;
        case 'March' : $nom_moisd = 'Mars'; break;
        case 'April' : $nom_moisd = 'Avril'; break;
        case 'May' : $nom_moisd = 'Mai'; break;
        case 'June' : $nom_moisd = 'Juin'; break;
        case 'July' : $nom_moisd = 'Juillet'; break;
        case 'August' : $nom_moisd = 'Août'; break;
        case 'September' : $nom_moisd = 'Septembre'; break;
        case 'October' : $nom_moisd = 'Otober'; break;
        case 'November' : $nom_moisd = 'Novembre'; break;
        case 'December' : $nom_moisd = 'Décembre'; break;
    }
    $jourTexte = array(1=>'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
    $plageH = array('',1=>'08:00','09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00');

    $contenu=afficherMenuAgent().'<form action="site.php" method="post"><p><label>Id du client</label><input type="text" name="idCli" value="'.$idcli.'" readonly="readonly"></p><label>Selectionnez une date </label><input name="nouvelledate" type="date"><input type="submit" name="changerDate" value="aller à"><p> Semaine '.$num_weekd.' </p>';
    $contenu = $contenu . '<p> du '.$dateDebSemaineFrd.' au '.$dateFinSemaineFrd.'</p>';
    $contenu = $contenu . '<h2>'.$nom_moisd.' '.$anneed.'</h2>';
    $contenu = $contenu . '<table border="1">';
    for ($h = 0; $h <= 11; $h++) {
        $contenu = $contenu . '<tr><th>' . $plageH[$h] . '</th>';
        for ($j = 1; $j < 7; $j++) {
            if (!empty($tab)) {
                $datetest = new DateTime($tab[0]->DATERDV);
                $jour = $datetest->format("d");
                $heure = $datetest->format("G:i");
            }
            if ($h == 0) {
                $contenu = $contenu . '<th>' . $jourTexte[$j] . ' ' . date("d", mktime(0, 0, 0, $x->format("n"), ($x->format("d")) - $jourd + $j, $x->format("y"))) . '</th>';
            } else {
                if (!empty($tab) && $jour==date("d", mktime(0, 0, 0, $x->format("n"), ($x->format("d")) - $jourd + $j, $x->format("y"))) && $heure==($h+7) ) {
                    $contenu = $contenu . '<td align="center" style="background-color: red; color : black">Pas dispo</td>';
                    array_shift($tab);
                }else
                    $contenu = $contenu . '<td align="center"><input type="radio"  checked name="dateTimeBouttonRadio" value="' . date("Y-m-d H:i", mktime($h + 7, 0, 0, $x->format("n"), ($x->format("d")) - $jourd + $j, $x->format("y"))) . '"></td>';
            }
        }
        $contenu = $contenu . '</tr>';
    }
    $contenu=$contenu.'</table>';
    $optionsMotifs='';
    foreach ($motif as $m){
        $optionsMotifs=$optionsMotifs.'<option value="'.$m->NOMMOTIF.'">'.$m->NOMMOTIF.'</option>';
    }
    $contenu=$contenu.'<label>Selectionnez le motf </label><select name="choixmotif" >'.$optionsMotifs.'</select><input type="submit" name="prendreRDV" value="Valider"></form>';

    require_once ('gabarit.php');

}

function afficherPiecesAApporter($listePieces){
    $contenu=afficherMenuAgent().'<p>Votre Reservation a été enregistrée </p><p>N\'oubliez pas d\'apporter : '.$listePieces.'</p>';
    require_once ('gabarit.php');

}


function afficherErreurAgent($erreur){
    $contenu='<p>'.$erreur.'</p> <p><a href="site.php"/>Revenir au site </p>';
    require_once ('gabarit.php');
}
