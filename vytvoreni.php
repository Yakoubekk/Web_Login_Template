<?php
try {
    $db = new PDO('mysql:host= server ;dbname= database name', 'Database username', 'Database Password');
    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $spous = $db->query('SELECT MAX(ID) AS posledni FROM udaje');
    $jop = $spous->fetch(PDO::FETCH_ASSOC);
    $posledni = $jop['posledni'];

    $noveid = $posledni + 1;
    
    $jmeno = $_POST['jmeno'];
    $email = $_POST['email'];
    $heslo = $_POST['heslo'];
    if(!empty($_POST['jmeno']) && !empty($_POST['email']) && !empty($_POST['heslo'])){
        $spous = $db->prepare('INSERT INTO udaje (ID, jmeno, email, heslo) VALUES (:id, :jmeno, :email, :heslo)');
        $spous->bindParam(':id', $noveid);
        $spous->bindParam(':jmeno', $jmeno);
        $spous->bindParam(':email', $email);
        $spous->bindParam(':heslo', $heslo);
        $spous->execute();
    
        echo "Registrace proběhla úspěšně.";
        
        header("Location: register.html");
    
        $db = null;
    }else{
        header("Location: register.html");
    }

} catch(PDOException $e) {
    echo 'Chyba: ' . $e->getMessage();
    header("Location: register.html");
}

?>
?>
