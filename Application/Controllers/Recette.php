<?php

namespace Application\Controllers;

/**
 *
 *
 */
class Recette extends \Library\Controller\Controller {
    
    /**
     *  Méthode __construct()
     *
     *  Constructeur par défaut appelant le constructeur de Library\Controller\Controller
     *
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     *  Méthode getrecettes($params)
     *
     *  Récupèrera un nombre donnée de recettes
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     * 
     */
    public function getrecettes() {      //  obtenir toutes les recettes
        
        
        $modelRecette   = new \Application\Models\Recette('mysql.hostinger.fr');
        $recettes       = $modelRecette->fetchAll();
        if( empty($recettes[0]) ){
            $this->message->addError("aucune recette !");
        }

        return $this->setApiResult($recettes);
    }

    /**
     *  Méthode post($params)
     *
     *  Crée une recette avec les paramètres de la requête POST
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function insertrecette($params) {         //ajouter une recette


        unset($params['method']);

        var_dump("Webservice insert",$params);
        $modelRecette  = new \Application\Models\Recette('mysql.hostinger.fr');

        if($modelRecette->insert($params) ) {
            return $this->setApiResult($modelRecette->getLast());
        }else{
            return $this->setApiResult(0, true, "erreur pendant l'ajout");
        }


    }
    
    /**
     *  Méthode post($params)
     *
     *  Crée une recette avec les paramètres de la requête POST
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function updaterecette($params) {         //ajouter une recette


        unset($params['method']);

        //var_dump();
        $modelRecette  = new \Application\Models\Recette('mysql.hostinger.fr');

        if($modelRecette->update(" `id_recette`='{$params['id_recette']}' ", $params) ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la mise a jour");
        }


    }
    


    /**
     *  Méthode post($params)
     *
     *  Crée une recette avec les paramètres de la requête POST
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function deleterecette($params) {         //delete une recette


        unset($params['method']);

        $modelLI  = new \Application\Models\ListIngredients('mysql.hostinger.fr');


        if($modelLI->delete(" `id_recette`='{$params['id_recette']}' ") ) {

            //si la suppression des ingredients c'est bien passée on tente de sup la recette
            $modelRecette  = new \Application\Models\Recette('mysql.hostinger.fr');
            if($modelRecette->delete(" `id_recette`='{$params['id_recette']}' ") ){
                return $this->setApiResult(true);
            }else{
                return $this->setApiResult(false, true, "erreur pendant la suppression de la recette");
            }

            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression des ingredients");
        }


    }
    



    public function getimagerecette($params) {

        unset($params['method']);

        $modelRecette  = new \Application\Models\Recette('mysql.hostinger.fr');
        echo "`id_recettre`='{$params['id_recette']}'";
        $res=$modelRecette->convEnTab($modelRecette->fetchAll("`id_recette`={$params['id_recette']}"));
            var_dump("getimagerecette",$res);
            
        if(  !empty($res)  ) {
            return $this->setApiResult($res[0]['img']);
        }else{
            return $this->setApiResult(false, true, "recette non trouvée");
        }


    }




}