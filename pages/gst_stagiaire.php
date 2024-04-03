<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <script src="menu_horizontal/SpryMenuBar.js" type="text/javascript"></script>
    <link href="menu_horizontal/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" media="screen" type="text/css" href="formatage.css"/>

<?php
   function enregistrer_chauffeur(){
    global $code_chauffeur,$nom_chauffeur,$date_naissance,$type_permis;
    try
    {
       include("connexion_bd.php");
      $sql="INSERT INTO chauffeur(code_chauffeur,nom_chauffeur,date_naissance,type_permis) values(:code,:nom,:daten,:typep)";
      $sql= $db->prepare($sql);
      $sql->bindvalue(':code',$code_chauffeur);
      $sql->bindvalue(':nom',$nom_chauffeur);
      $sql->bindvalue(':daten',conversion_date_insertion($date_naissance));
      $sql->bindvalue(':typep',$type_permis);
      $sql->execute();

      if($sql){
        echo "<h4><font color=blue> insertion reussie</font></h4>";
      }else{
        echo "<h4><font color=red> Echec d'insertion</font></h4>";
      }
      $sql->closecursor();
    }
    catch(Exception $e)
    {
        die('Erreur:'.$e->getMessage());
    }
}

function modifier_chauffeur(){
    global $code_chauffeur,$nom_chauffeur,$date_naissance,$type_permis;
    try
    {
       include("connexion_bd.php");
      $sql="update chauffeur set nom_chauffeur=:nom,date_naissance=:daten,type_permis=:typep where code_chauffeur=:code";
      $sql= $db->prepare($sql);
      $sql->bindvalue(':code',$code_chauffeur);
      $sql->bindvalue(':nom',$nom_chauffeur);
      $sql->bindvalue(':daten',conversion_date_insertion($date_naissance));
      $sql->bindvalue(':typep',$type_permis);
      $sql->execute();

      if($sql){
        echo "<h4><font color=blue> modification reussie</font></h4>";
      }else{
        echo "<h4><font color=red> Echec de modification</font></h4>";
      }
      $sql->closecursor();
    }
    catch(Exception $e)
    {
        die('Erreur:'.$e->getMessage());
    }
}

function supprimer_chauffeur(){
    global $code_chauffeur,$nom_chauffeur,$date_naissance,$type_permis;
    try
    {
       include("connexion_bd.php");
      $sql="delete from chauffeur where code_chauffeur=:code";
      $sql= $db->prepare($sql);
      $sql->bindvalue(':code',$code_chauffeur);
     
      $sql->execute();

      if($sql){
        echo "<h4><font color=blue> suppression reussie</font></h4>";
      }else{
        echo "<h4><font color=red> Echec de suppression</font></h4>";
      }
      $sql->closecursor();
    }
    catch(Exception $e)
    {
        die('Erreur:'.$e->getMessage());
    }
}


function recuperer_un_chauffeur(){
    global $code_chauffeur,$nom_chauffeur,$date_naissance,$type_permis;
    try
    {
        include("connexion_bd.php");
        $sql="select nom_chauffeur,date_naissance,type_permis from chauffeur where code_chauffeur=:code";
        $sql=$db->prepare($sql);
        $sql->bindvalue(':code',$code_chauffeur);
        $sql->execute();
        while($donnees=$sql->fetch(PDO::FETCH_ASSOC)){
            $nom_chauffeur=$donnees['nom_chauffeur'];
            $date_naissance=$donnees['date_naissance'];
            $type_permis=$donnees['type_permis'];
        }
        $sql->closecursor();
    }
    catch(Exception $e){
        die('Erreur:'.$e->getMessage());
    }
}


function conversion_date_insertion($date_insertion){
    $a=explode("/",$date_insertion);
    return $a[2]."-".$a[1]."-".$a[0];
}


?>
</head>
<body>
    <?php
    include("menu_horizontal/texte_menu_horizontal_simple.txt");

    $code_chauffeur="";
    $nom_chauffeur="";
    $date_naissance="";
    $type_permis="";
    if(isset($_POST['code_chauffeur'])){
        $code_chauffeur=$_POST['code_chauffeur'];
     }
     if(isset($_POST['nom_chauffeur'])){
        $nom_chauffeur=$_POST['nom_chauffeur'];
     }
     if(isset($_POST['date_naissance'])){
        $date_naissance=$_POST['date_naissance'];
     }
     if(isset($_POST['type_permis'])){
        $type_permis=$_POST['type_permis'];
     }
     if(isset($_POST['btnenregistrer_chauffeur'])){
        enregistrer_chauffeur();
     }

     if(isset($_POST['btnmodifier_chauffeur'])){
        modifier_chauffeur();
     }

     if(isset($_POST['btnsupprimer_chauffeur'])){
        supprimer_chauffeur();
     }

     if(isset($_POST['btnrechercher'])){
        recuperer_un_chauffeur();
     }
     ?>
    <form action="#" method="POST">
        <table width="60%" border="0px" align="center">
            <caption> GESTION DES CHAUFFEURS </caption>
            <tr><td> code du chauffeur</td><td>
                <input type="text" name="code_chauffeur" size="20" value="<?php echo $code_chauffeur;?>">
                <input type="submit" name="btnrechercher" value="Rechercher">
            </td></tr> 
            <tr><td> nom </td><td>
                <input type="text" name="nom_chauffeur" size="20" value="<?php echo $nom_chauffeur;?>">
            </td></tr>
            <tr><td> date de naissance </td><td>
                <input type="text" name="date_naissance" size="20" value="<?php echo $date_naissance;?>">
            </td></tr>
            <tr><td> type de permis </td><td>
                <input type="text" name="type_permis" size="20" value="<?php echo $type_permis;?>">
            </td></tr>

            <tr><td colspan="2" align="center">
                <input type="submit" name="btnenregistrer_chauffeur" value="Enregistrer">
                &nbsp;&nbsp;
                <input type="submit" name="btnmodifier_chauffeur" value="Modifier">
                &nbsp;&nbsp;
                <input type="submit" name="btnsupprimer_chauffeur" value="Supprimer">
            </td></tr>
        </table>
    </form>  
</body>
</html>