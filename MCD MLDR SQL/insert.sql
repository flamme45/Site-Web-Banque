#---------------------------------------- EMPLOYE 



INSERT INTO `employe`( `LOGINEMPLOYE`, `MDPEMPLOYE`, `NOMEMPLOYE`, `TYPEEMPLOYE`) VALUES ('LogD','MdpD','NomDirecteur','Directeur');

INSERT INTO `employe`( `LOGINEMPLOYE`, `MDPEMPLOYE`, `NOMEMPLOYE`, `TYPEEMPLOYE`) VALUES ('LogC1','MdpC1','NomConseiller1','Conseiller');
INSERT INTO `employe`(`LOGINEMPLOYE`, `MDPEMPLOYE`, `NOMEMPLOYE`, `TYPEEMPLOYE`) VALUES ('LogC2','MdpC2','NomConseiller2','Conseiller');

INSERT INTO `employe`(`LOGINEMPLOYE`, `MDPEMPLOYE`, `NOMEMPLOYE`, `TYPEEMPLOYE`) VALUES ('LogA1','MdpA1','NomAgent1','Agent');
INSERT INTO `employe`(`LOGINEMPLOYE`, `MDPEMPLOYE`, `NOMEMPLOYE`, `TYPEEMPLOYE`) VALUES ('LogA2','MdpA2','NomAgent2','Agent');

#----------------------------------------- Motifs

INSERT INTO `motifs`(`NOMMOTIF`) VALUES ('Autre');
INSERT INTO `motifs`(`NOMMOTIF`) VALUES ('Ouvreture Assurance Auto');
INSERT INTO `motifs`(`NOMMOTIF`) VALUES ('Ouverture Compte CEL');


#----------------------------------------Pieces 

INSERT INTO `pieces`(`NOMPIECE`) VALUES ('Justificatif Domicile');
INSERT INTO `pieces`(`NOMPIECE`) VALUES ('Piece identite');
INSERT INTO `pieces`(`NOMPIECE`) VALUES ('Justificatif de revenus ');
INSERT INTO `pieces`(`NOMPIECE`) VALUES ('Attestation hebergeur ');
INSERT INTO `pieces`(`NOMPIECE`) VALUES ('Livret de famille');
INSERT INTO `pieces`(`NOMPIECE`) VALUES ('Carte etudiant');


#-------------------------------------- CIF_Pieces

INSERT INTO `cif_pieces`(`IDMOTIF`, `IDPIECE`) VALUES (1,2);
INSERT INTO `cif_pieces`(`IDMOTIF`, `IDPIECE`) VALUES (2,1);
INSERT INTO `cif_pieces`(`IDMOTIF`, `IDPIECE`) VALUES (2,2);
INSERT INTO `cif_pieces`(`IDMOTIF`, `IDPIECE`) VALUES (2,3);
INSERT INTO `cif_pieces`(`IDMOTIF`, `IDPIECE`) VALUES (2,4);
INSERT INTO `cif_pieces`(`IDMOTIF`, `IDPIECE`) VALUES (3,2);
INSERT INTO `cif_pieces`(`IDMOTIF`, `IDPIECE`) VALUES (3,6);

#---------------------------------------Client 
INSERT INTO `client`(`IDEMPLOYE`, `NOMCLI`, `PRENOMCLI`, `DATENAISSCLI`, `ADRESSE`, `NUMTEL`, `EMAIL`, `PROFESSION`, `SITUATION_FAMILIALE`)
VALUES (2,'NomCli1','PrenomCli1','1999-05-31','2 Rue quelquepart','0602223277','eMailCLi1@email.com','Etudiant','Celibataire');
INSERT INTO `client`(`IDEMPLOYE`, `NOMCLI`, `PRENOMCLI`, `DATENAISSCLI`, `ADRESSE`, `NUMTEL`, `EMAIL`, `PROFESSION`, `SITUATION_FAMILIALE`)
VALUES (2,'NomCli2','PrenomCli2','2000-12-28','9 route ici','0238588013','eMailCLi2@email.com','Prof','Marié');

INSERT INTO `client`(`IDEMPLOYE`, `NOMCLI`, `PRENOMCLI`, `DATENAISSCLI`, `ADRESSE`, `NUMTEL`, `EMAIL`, `PROFESSION`, `SITUATION_FAMILIALE`)
VALUES (3,'NomCli3','PrenomCli3','2001-04-18','102 bis orleans','0242326978','eMailCLi3@email.com','Musicien','Pacsé');
INSERT INTO `client`(`IDEMPLOYE`, `NOMCLI`, `PRENOMCLI`, `DATENAISSCLI`, `ADRESSE`, `NUMTEL`, `EMAIL`, `PROFESSION`, `SITUATION_FAMILIALE`)
VALUES (3,'NomCli3','PrenomCli3','1970-04-09','14 chemin fac','0278223698','eMailCLi3@email.com','Pilote','Celibataire');


#--------------------------------------------Compte
INSERT INTO `compte`(`IDCLIENT`, `NOMCOMPTE`, `DATEOUVERTURE`, `SOLDEACTUEL`, `MONTANTDECOUVERT`) 
VALUES (1,'PEL','2015-05-18',0,500);
INSERT INTO `compte`(`IDCLIENT`, `NOMCOMPTE`, `DATEOUVERTURE`, `SOLDEACTUEL`, `MONTANTDECOUVERT`) 
VALUES (1,'CEL','2016-07-25',2000,100);
INSERT INTO `compte`(`IDCLIENT`, `NOMCOMPTE`, `DATEOUVERTURE`, `SOLDEACTUEL`, `MONTANTDECOUVERT`) 
VALUES (1,'Livret A','2012-07-16',100,400);

INSERT INTO `compte`(`IDCLIENT`, `NOMCOMPTE`, `DATEOUVERTURE`, `SOLDEACTUEL`, `MONTANTDECOUVERT`) 
VALUES (2,'LDDS','2013-05-17',40000,500);
INSERT INTO `compte`(`IDCLIENT`, `NOMCOMPTE`, `DATEOUVERTURE`, `SOLDEACTUEL`, `MONTANTDECOUVERT`) 
VALUES (2,'Livret Jeune','2011-02-11',1000,200);
INSERT INTO `compte`(`IDCLIENT`, `NOMCOMPTE`, `DATEOUVERTURE`, `SOLDEACTUEL`, `MONTANTDECOUVERT`) 
VALUES (2,'Perp','2008-09-28',455,300);

INSERT INTO `compte`(`IDCLIENT`, `NOMCOMPTE`, `DATEOUVERTURE`, `SOLDEACTUEL`, `MONTANTDECOUVERT`) 
VALUES (3,'CEL','2014-01-01',4800,600);
INSERT INTO `compte`(`IDCLIENT`, `NOMCOMPTE`, `DATEOUVERTURE`, `SOLDEACTUEL`, `MONTANTDECOUVERT`) 
VALUES (3,'LDDS','2005-04-02',2500,150);
INSERT INTO `compte`(`IDCLIENT`, `NOMCOMPTE`, `DATEOUVERTURE`, `SOLDEACTUEL`, `MONTANTDECOUVERT`) 
VALUES (3,'Livret A','2004-09-07',1100,100);

INSERT INTO `compte`(`IDCLIENT`, `NOMCOMPTE`, `DATEOUVERTURE`, `SOLDEACTUEL`, `MONTANTDECOUVERT`) 
VALUES (4,'Livret Jeune','2005-04-08',4900,50);

#--------------------------------------------Contrat

INSERT INTO `contrat`(`IDCLIENT`, `NOMCONTRAT`, `TARIFMENSUEL`, `DATEOUVERTURE`) VALUES (1,'Assurance Vie',50,'2012-04-12');
INSERT INTO `contrat`(`IDCLIENT`, `NOMCONTRAT`, `TARIFMENSUEL`, `DATEOUVERTURE`) VALUES (1,'Crédit',100,'2014-08-19');
INSERT INTO `contrat`(`IDCLIENT`, `NOMCONTRAT`, `TARIFMENSUEL`, `DATEOUVERTURE`) VALUES (2,'Crédit',100,'2004-05-19');
INSERT INTO `contrat`(`IDCLIENT`, `NOMCONTRAT`, `TARIFMENSUEL`, `DATEOUVERTURE`) VALUES (3,'Crédit',150,'2008-08-07');
INSERT INTO `contrat`(`IDCLIENT`, `NOMCONTRAT`, `TARIFMENSUEL`, `DATEOUVERTURE`) VALUES (4,'Assurance Vie',20,'2009-12-12');

#----------------------------------------------Rendez-vous

INSERT INTO `rendez_vous`(`IDMOTIF`, `IDCLIENT`, `IDEMPLOYE`, `DATERDV`, `HEUREDEBUT`) VALUES (3,1,2,'2018-12-12','15:00:00');
INSERT INTO `rendez_vous`(`IDMOTIF`, `IDCLIENT`, `IDEMPLOYE`, `DATERDV`, `HEUREDEBUT`) VALUES (2,3,3,'2018-12-15','11:00:00');

INSERT INTO `rendez_vous`(`IDMOTIF`, `IDCLIENT`, `IDEMPLOYE`, `DATERDV`, `HEUREDEBUT`) VALUES (2,2,2,'2018-12-15','12:00:00');

#--------------------------------------------------Operation
INSERT INTO `operation`(`NOMCOMPTE`, `IDCLIENT`, `NOMOPERATION`, `MONTANT`) VALUES ('Livret A',1,'Debiter',40);

INSERT INTO `operation`(`NOMCOMPTE`, `IDCLIENT`, `NOMOPERATION`, `MONTANT`) VALUES ('Perp',2,'Debiter',120);







