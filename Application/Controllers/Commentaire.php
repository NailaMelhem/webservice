<?php

namespace Application\Controllers;

/**
 *
 *
 */
class Commentaire extends \Library\Controller\Controller {
    
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
     *  Méthode getcommentaires($params)
     *
     *  Récupèrera tout les commentaires associés a une recette
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     * 
     */
    public function getcommentaires($params) {      //  obtenir tout les commentaires
        
        
        $modelCommentaire   = new \Application\Models\Commentaire('localhost');
        $commentaires       = $modelCommentaire->convEnTab( $modelCommentaire->fetchAll(" `id_recette`='{$params['id_recette']}' " ) );

        if( empty($commentaires) ){
            return $this->setApiResult(false, true, "Erreur ou aucun commentaire pour cette recette");
        }

        return $this->setApiResult($commentaires);
    }

    /**
     *  Méthode post($params)
     *
     *  Crée un commentaire avec les paramètres de la requête POST
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function insertcommentaire($params) {         //ajouter un commentaire


        unset($params['method']);

        $modelCommentaire  = new \Application\Models\Commentaire('localhost');

        if($modelCommentaire->insert($params) ) {
            return $this->setApiResult($modelCommentaire->getLast());   //retourne l'id du comm
        }else{
            return $this->setApiResult(0, true, "erreur pendant l'ajout");
        }


    }
    
    /**
     *  Méthode post($params)
     *
     *  Crée un commentaire avec les paramètres de la requête POST
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function updatecommentaire($params) {         //ajouter un commentaire


        unset($params['method']);

        
        $modelCommentaire  = new \Application\Models\Commentaire('localhost');

        if($modelCommentaire->update(" `id_commentaire`='{$params['id_commentaire']}' ", $params) ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la mise a jour");
        }


    }
    


    /**
     *  Méthode post($params)
     *
     *  Crée une commentaire avec les paramètres de la requête POST
     *       
     *  @param      array       $params     [données de requête]
     *  @return     array
     *
     */
    public function deletecommentaire($params) {         //delete une commentaire


        unset($params['method']);

        $modelComm  = new \Application\Models\Commentaire('localhost');


        if($modelLI->delete(" `id_commentaire`='{$params['id_commentaire']}' ") ) {
            return $this->setApiResult(true);
        }else{
            return $this->setApiResult(false, true, "erreur pendant la suppression du commentaire");
        }


    }
    




}