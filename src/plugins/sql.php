<?php

	$SQL_host = 'localhost'; // path of your SQL server
	$SQL_port = '3306';
	$SQL_database_name = 'test'; // your database name
	$SQL_user_name = 'root'; // username used to connect to your database
	$SQL_user_password = 'IceTea0nline'; // username password
	
	$SQL = new PDO('mysql:host='.SQL_host.';port='.$SQL_port.';dbname='.$SQL_database_name, $SQL_user_name, $SQL_password);
	
	
	
	
	
	
	
	
/***
 *	insert des données dans la table en paramètre
 *	@datas	tableau des données à insérer dont la clé et le nom du champs dans la table
 *	@table	table dans laquelle insérer les données
 */
 
function add($datas, $table){
	$bdd = db(); //on ouvre la connexion à la base de données

	foreach($datas as $key => $value){
		$keys[] = $key;
		$values[] = $value;
	}

	$strSQL = "INSERT INTO ".$table." (";
	foreach($keys as $ky => $k){ $strSQL .= $k . ","; }

	$strSQL = substr($strSQL,0,-1) . ") VALUES(";
	foreach($values as $vl => $v){ $strSQL .= "?,"; }

	$strSQL = substr($strSQL,0,-1) . ")";

	$query = $bdd->prepare($strSQL);
	if($query->execute($values)) return $bdd->lastInsertId();
	else return false;
}
	
	
	/*
	
	$datas = array(
	'nom' => $nom,
	'email' => $email,
	'commentaire' => $commentaire
);

if(add($datas,'comments')) {
	return "cool";
} else return "pas cool";


*/


/***
 *	met à jour les données de l'ID dans la table en paramètre
 *	@id	identifiant de la ligne à modifier
 *	@datas 	tableau des données à insérer dont la clé et le nom du champs dans la table
 *	@table 	table dans laquelle insérer les données
 */
function update($id, $datas, $table){
	$bdd = db();
	foreach($datas as $key => $value){
		$keys[] = $key;
		$values[] = $value;
	}

	$strSQL = "UPDATE ".$table." SET ";
	foreach($datas as $key => $value){
		$strSQL .= $key . " = ?,";
	} $strSQL = substr($strSQL,0,-1) . " WHERE id = ?";
	$values[] = $id;
	$query = $bdd->prepare($strSQL);
	if($query->execute($values)) return true;
	else return false;
}



/***
 *	supprime les données correspondant à l'ID dans la table en paramètre
 *	@id		identifiant de la ligne à supprimer
 *	@table	table sur laquelle on applique la suppression
 */
function delete($id, $table){
	$bdd = db();
	$strSQL = "DELETE FROM ".$table." WHERE id = ?";
	$query = $bdd->prepare($strSQL);
	//print_r(array($id));

	if($query->execute(array($id))) return true;
	else return false;
}


/***
 * 	retourne le resultat d'un select
 *	@columns 	colonnes à selectionner pour la requête (ex: array('champ1','champ2') ou '*')
 *	@table 		nom de la table sur laquelle faire la requête
 *	@where 		champs sur lequels appliquer des conditions ( ex: array( 'champ1 =' => 'valeur', 'champ2 LIKE' => 'valeur%') )
 *	@concats 	[ AND | OR ]
 *	@order 		champs sur lequels appliquer le tri, et l'ordre pour chaque champs (ex: array('champ1' => 'ASC','champ2' => 'DESC') )
 *	@limit 		limit[0] => debut de la liste, limit[1] => nombre d'éléments dans la liste retournée (ex: array('0','20') )
 *
 *	return @retour	: tableau contenant la requête executée, les éventuelles erreurs et le resultat de la requête
 */
function get($columns = null, $table = null, $where = null, $concats = "AND", $order = null, $limit = null){
	$bdd = db();
	$retour = array(); //variable de type tableau, retournée par la fonction
	$rows = "";
	$clause = "";
	$sort = "";
	$limitStr = "";

	if(!is_null($columns) && !is_null($table)){

		// si $rows est un tableau ou égale à * tout va bien.
		if(is_array($columns)){
			foreach($columns as $column) { $rows .= $column .', '; }
			$rows = substr($rows,0,-2);
		} elseif($columns == '*'){
			$rows = '*';
		} else {
			$retour['erreur'] = "Les champs selectionné doivent être appelé depuis une variable Tableau";
		}

		if(!in_array(strtolower($concats),array('and','or'))){
			$retour['erreur'] = "<strong>".$concats."</strong> n'est pas une valeur autorisée pour concaténer des conditions. Utilisez 'OR' ou 'AND'.";
		}

		/*
		si @where est renseigné, on filtre les résultats grâce au tableau @where construit comme suit :
			array ('colname operateur' => 'valeur');
			ex: array('page_id =' => 5);
		sinon, on ne filtre pas les résultats
		*/
		if(!is_null($where) && is_array($where)){
			foreach($where as $k => $v){
				$clause .= $k." ? ".$concats." ";
				$values[] = $v;
			}
			$clause = " WHERE ".substr($clause,0,(-(strlen($concats)+2)));
		} elseif(!is_null($where) && !is_array($where)){
			$retour['erreur'] = "La clause WHERE doit être construite via une variable Tableau";
		} else {
			$clause = "";
		}

		//si $order est un tableau et n'est pas null
		if(!is_null($order) && is_array($order)){
			foreach($order as $k => $v){ $sort .= $k." ".$v.", "; }
			$sort = " ORDER BY ".substr($sort,0,-2);
		} elseif(!is_null($order) && !is_array($order)) {
			$retour['erreur'] = "ORDER BY doit être construit via une variable Tableau";
		} else {
			$sort = "";
		}

		if(!is_null($limit) && is_array($limit) && is_numeric($limit[0]) && is_numeric($limit[1])){
			$debut = $limit[0];
			$nbRows = $limit[1];
			$limitStr = " LIMIT " . $debut . "," . $nbRows;
		} elseif(!is_null($limit) && !is_array($limit)){
			$retour['erreur'] = "LIMIT doit être construit via un tableau de deux entiers";
		} else {
			$limitStr = "";
		}

		// on construit la requête
		$strSQL = "SELECT ".$rows." FROM ".$table.$clause.$sort.$limitStr;
		if(empty($retour['erreur'])){
			$query = $bdd->prepare($strSQL);
			$query->execute(@$values);
			$retour['requete'] = $strSQL;
			$retour['reponse'] = $query->fetchAll(PDO::FETCH_ASSOC);

			$sqlTotal = "SELECT COUNT(*) as total FROM ".$table.$clause.$sort;
			$q = $bdd->prepare($sqlTotal);
			$q->execute(@$values);
			$tot = $q->fetchAll(PDO::FETCH_ASSOC);
			$retour['total'] = $tot[0]['total'];
		}

	} else {
		$retour['erreur'] = "Impossible de créer la requete, les champs à selectionner et la table sont vide";
	}

	return $retour;
}

/*

$champs = array('id','titre','nom','contenu');
$conditions = array(
	'nom =' => 'nighcrawl',
	'date < =' => date('Y-m-d H:i:s'),
	'titre LIKE' => '%framework%'
);
$trier = array('date' => 'DESC');
$limite = array(0, 5);

$resultat = get($champs,'articles',$conditions,"AND",$trier,$limite);
if(isset($resultat['reponse'])){
	foreach($resultat['reponse'] as $row){
		echo "<article>
		<header>
			<h1>".$row['titre']."</h1>
		</header>
		<div>".$row['contenu']."</div>
		<footer>Auteur : ".$row['nom']."</footer>
		</article>";
	}
}
else echo $resultat['erreur'];

*/


?>