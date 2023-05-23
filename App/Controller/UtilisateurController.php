<?php
    namespace App\Controller;
    use App\Utils\Fonctions;
    use App\Model\Utilisateur;
    class UtilisateurController extends Utilisateur{
        public function insertUser(){
            $msg = "";
            //Test si le formulaire à été submit
            if(isset($_POST['submit'])){
                //nettoyage des datas du formulaire
                $nom = Fonctions::cleanInput($_POST['nom']);
                $prenom = Fonctions::cleanInput($_POST['prenom']);
                $mail = Fonctions::cleanInput($_POST['mail']);
                $mdp = Fonctions::cleanInput($_POST['mdp']);
                //Test si tous les champs du formulaire sont remplis
                if(!empty($nom) AND !empty($prenom) AND !empty($mail) AND !empty($mdp)){
                    $this->setMail($mail);
                    //Récupération du compte
                    $user = $this->getUserByMail();
                    //Test si le compte n'existe pas en BDD
                    if(!$user){
                        //Set des valeurs et hash du mot de passe
                        $this->setNom($nom);
                        $this->setPrenom($prenom);
                        $this->setPassword(password_hash($mdp, PASSWORD_DEFAULT));
                        //Ajout du compte en BDD
                        $this->addUser();
                        $msg = "Le compte a été ajouté en BDD";
                    }
                    //Test sinon affiche une erreur
                    else{
                        $msg = "Les informations sont incorrectes";
                    }
                }
                else{
                    $msg = "Veuillez remplir tous les champs du formulaire";
                }
            }
            //Import de la vue
            include './App/Vue/vueAddUser.php';
        }
        public function connexionUser(){
            $msg = "";
            //Test si le formulaire est submit
            if(isset($_POST['submit'])){
                //Nettoyage des datas du formulaire
                $mail = Fonctions::cleanInput($_POST['mail']);
                $mdp = Fonctions::cleanInput($_POST['mdp']);
                //Test si tous les champs du formulaire sont remplis
                if(!empty($mail) AND !empty($mdp)){
                    //Set du mail
                    $this->setMail($mail);
                    //Récupération du compte
                    $user = $this->getUserByMail();
                    //Test si le compte existe
                    if($user){
                        //Test si le password est valide
                        if(password_verify($mdp,$user[0]->mdp)){
                            //Création super globale SESSION
                            $_SESSION['connected'] = true;
                            $_SESSION['id'] = $user[0]->id;
                            $_SESSION['nom'] = $user[0]->nom;
                            $_SESSION['prenom'] = $user[0]->prenom;
                            $_SESSION['mail'] = $user[0]->mail;
                            $msg = "Connecté";
                        }
                        //Test sinon le password est invalide
                        else{
                            $msg = "Erreur mail ou password incorrect";
                        }
                    }
                    //Test sinon le compte n'existe pas
                    else{
                        $msg = "Erreur mail ou password incorrect";
                    }
                }
                //Test sinon les champs ne sont pas remplis
                else{
                    $msg = "Veuillez remplir les champs du formulaire";
                }
            }
            //Import de la vue
            include './App/Vue/vueConnexion.php';
        }
        public function deconnexionUser(){
            session_destroy();
        }
    }
?>