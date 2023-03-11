<?php

class DAO {
    public $bdd;
    
    public function __construct(){}
	public function connexion(){
		$pdo = new PDO('mysql:host=127.0.0.1;dbname=ensa','root','');
		return $pdo;
	}

    public function CheckIfEmailExists($email) {
        $sql = "SELECT COUNT(*) FROM student WHERE email=?";
        try {
            $stmt = $this->connexion()->prepare($sql);
            $stmt->execute([$email]);
            $count = $stmt->fetchColumn();
            return $count > 0;
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    
    public function AddStudent($CodeMassar,$nom, $prenom, $email, $adresse, $numero, $cycle, $filiere, $photo, $sexe, $nationalite, $date,$password) {
        $sql = "INSERT INTO student(CodeMassar,nom,prenom,email,adresse,numero,cycle,filiere,photo,sexe,nationalite,date,password) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        try {
            $stmt = $this->connexion()->prepare($sql);
            $stmt->execute([$CodeMassar,$nom,$prenom,$email,$adresse,$numero,$cycle,$filiere,$photo,$sexe,$nationalite,$date,$password]);
            return true;
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function authentificationUser($email,$password){
		$bdd=$this->connexion();
		$reponse=$bdd->prepare("SELECT * from student where email= ? and password = ?");
   		$reponse->execute([$email,$password]);
   		if ($ligne=$reponse->fetch()) return true;
   		else return false;
	}

    public function authentificationProf($matricule,$password){
		$bdd=$this->connexion();
		$reponse=$bdd->prepare("SELECT * from chef_filiere where matricule= ? and password = ?");
   		$reponse->execute([$matricule,$password]);
   		if ($ligne=$reponse->fetch()) return true;
   		else return false;
	}

    public function name_dept_Prof($matricule){
		$bdd=$this->connexion();
		$reponse=$bdd->prepare("SELECT nom,departement from chef_filiere where matricule= ? ");
   		$reponse->execute([$matricule]);
           $lst=[];
           while($ligne=$reponse->fetch()){
                $lst[]=[$ligne[0],$ligne[1]];
                
          }
           $reponse->closeCursor();  
           return $lst;
	}



    public function User($email){
		$bdd=$this->connexion();
		$reponse=$bdd->prepare("SELECT cne from student where email= ?");
		$reponse->execute([$email]);
		$lst=[];
		while($ligne=$reponse->fetch()){
			 $lst[]=[$ligne[0]];
	   }
		$reponse->closeCursor();  
		return $lst;
	}


    public function Prof($matricule){
		$bdd=$this->connexion();
		$reponse=$bdd->prepare("SELECT nom,departement,matricule from chef_filiere where matricule= ?");
		$reponse->execute([$matricule]);
		$lst=[];
		while($ligne=$reponse->fetch()){
			 $lst[]=[$ligne[0],$ligne[1],$ligne[2]];
	   }
		$reponse->closeCursor();  
		return $lst;
	}


    public function createUser($email,$password,$nom,$prenom){
        $bdd=$this->connexion();
		$reponse=$bdd->prepare("INSERT INTO studentlist (FirstName,LastName,email,password) values(?,?,?,?)");
		$reponse->execute([$prenom,$nom,$email,$password]);
        if ($ligne=$reponse->fetch()) return true;
        else return false;


    }

    public function DataUser($cne){

        $bdd=$this->connexion();
        $reponse = $bdd->prepare("SELECT cne,nom,prenom,email,adresse,numero,cycle,filiere,sexe,nationalite,date,photo,CodeMassar FROM student WHERE cne=:cne");
        $reponse->execute([':cne' => $cne]);
        $lst=[];
        while($ligne=$reponse->fetch()){
            $lst[]=[$ligne['cne'],$ligne['nom'],$ligne['prenom'],$ligne['email'],$ligne['adresse'],$ligne['numero'],$ligne['cycle'],$ligne['filiere'],$ligne['sexe'],$ligne['nationalite'],$ligne['date'],$ligne['photo'],$ligne['CodeMassar']];
        }
        $reponse->closeCursor();  
        return $lst;
    }


    public function DataProf($matricule){

        $bdd=$this->connexion();
        $reponse = $bdd->prepare("SELECT matricule,nom,prenom,email,adresse,telephone,departement,sexe,nationnalite,dateN FROM chef_filiere WHERE matricule=:matricule");
        $reponse->execute([':matricule' => $matricule]);
        $lst=[];
        while($ligne=$reponse->fetch()){
            $lst[]=[$ligne['matricule'],$ligne['nom'],$ligne['prenom'],$ligne['email'],$ligne['adresse'],$ligne['telephone'],$ligne['departement'],$ligne['sexe'],$ligne['nationnalite'],$ligne['dateN']];
        }
        $reponse->closeCursor();  
        return $lst;
    }

    public function deleteUser($idUser){
        $bdd=$this->connexion();
        $reponse=$bdd->prepare("DELETE from student where cne=?");
        $reponse->execute([$idUser]); 
        if ($reponse->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function DataUserProf($dept){

        $bdd=$this->connexion();
        $reponse = $bdd->prepare("SELECT cne,nom,prenom,email,adresse,numero,cycle,filiere,sexe,nationalite,date,photo,CodeMassar FROM student WHERE filiere=?");
        $reponse->execute([$dept]);
        $lst=[];
        while($ligne=$reponse->fetch()){
            $lst[]=[$ligne['cne'],$ligne['nom'],$ligne['prenom'],$ligne['email'],$ligne['adresse'],$ligne['numero'],$ligne['cycle'],$ligne['filiere'],$ligne['sexe'],$ligne['nationalite'],$ligne['date'],$ligne['photo'],$ligne['CodeMassar']];
        }
        $reponse->closeCursor();  
        return $lst;
    }
    

    public function EditUser($idUser,$nom,$prenom,$email,$adresse,$numero,$cycle,$filiere,$sexe,$nationalite,$date,$CodeMassar){
        $bdd=$this->connexion();
		$reponse=$bdd->prepare("UPDATE student set nom=?,prenom=?,email=?,adresse=? ,numero=?,cycle=?,filiere=?,sexe=? ,nationalite=?,date=?,CodeMassar=? where cne=?");
   		$reponse->execute([$nom,$prenom,$email,$adresse,$numero,$cycle,$filiere,$sexe,$nationalite,$date,$CodeMassar,$idUser]); 
		   if ($ligne=$reponse->fetch()) return true;
   		else return false;
    }

    public function EditChef($matricule, $nom, $prenom, $email, $adresse, $numero, $filiere, $sexe, $nationalite, $date) {
        $bdd = $this->connexion();
        $reponse = $bdd->prepare("UPDATE chef_filiere SET nom=?, prenom=?, email=?, adresse=?, telephone=?, departement=?, sexe=?, nationnalite=?, dateN=? WHERE matricule=?");
        $result = $reponse->execute([$nom, $prenom, $email, $adresse, $numero, $filiere, $sexe, $nationalite, $date, $matricule]); 
        return $result;
    }
    

    
    
    public function __destruct() {
        // Close the database connection
        $this->bdd = null;
    }
}


?>