<?php


function inscription()
{
    if (!isset($_SESSION['login'])) 
    {
        if (isset($_POST['inscription'])) 
        {
            if(!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['confirmPass']) && !empty($_POST['mail']) && !empty($_POST['adresse']) && !empty($_POST['rank']) )
            {
                if($_POST['password']==$_POST['confirmPass'])
                {
                    $connexion = mysqli_connect("localhost", "root", "", "boutique") ;

                    $requeteUser =" SELECT * FROM utilisateurs  WHERE login = '".$_POST['login']."'";
                    $queryUser = mysqli_query($connexion,$requeteUser);
                    $resultUser = mysqli_fetch_row($queryUser);
                    

                    if(empty($resultUser))
                    {

                        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost' => 12));

                        $requeteInscription ="INSERT INTO utilisateurs (login, password, mail, adresse, rank) VALUES ('".$_POST['login']."', '$password', '".$_POST['mail']."', '".$_POST['adresse']."', '".$_POST['rank']."')";

                        $queryInscription = mysqli_query($connexion,$requeteInscription);
                        
                        echo $requeteInscription;
                        //header('location:connexion.php');
                    }
                    else
                    {
                        echo "Login deja utilisé";
                    }
                }
                else
                {
                    echo "MDP ne correspondent pas";
                }
            }
            else
            {
                echo "AUCUNE DONNEES";
            };

        }
    }
    else
    {
        header('location:index.php');
    }    
}

function connexion($login,$password)
{
    $connexion = mysqli_connect("localhost", "root", "", "boutique") ;

    $requeteUser = "SELECT * FROM utilisateurs WHERE login = '$login'";
    $queryUser = mysqli_query($connexion,$requeteUser);
    $resultUser = mysqli_fetch_assoc($queryUser);


    if(!empty($resultUser))
    {
        if($login == $resultUser["login"])
        {
            if(password_verify($password,$resultUser["password"]))
            {
                $_SESSION['id'] = $resultUser["id"];
                $_SESSION['login'] = $resultUser["login"];
                $_SESSION['mail'] = $resultUser["mail"];
                $_SESSION['adresse'] = $resultUser['adresse'];
                $_SESSION['rank'] = $resultUser["rank"];





            }
            else
            {                  
                return "MDP INCORRECT";
            }
        }
        else
        {
            return "MAUVAIS LOGIN";
        }
    }
    else
    {    
        return "AUCUN UTILISATEUR TROUVER";
    }
}


?>