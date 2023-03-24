<?php require_once "class/Message.php" ;
require_once "class/GuestBook.php";
$errors = null ;
$success = false ;
$guestbook = new GuestBook(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'message' );
if(isset($_POST["submit"])) {
    if(isset($_POST["username"] , $_POST["message"])){
        $message = new Message($_POST["username"] , $_POST["message"]);
        if($message->Isvalid()){
           
            $guestbook -> addMessage($message);
            $success = true ;
            $_POST["username"]="" ;  
            $_POST["message"]="";
        }else{
            $errors = $message ->getErrors() ;
           
        }
    }
}

$message = $guestbook -> getMessages();



?>
<?php $title = "Mon livre d'or " ;
        require "<elements/header.php" ;
?>

<div class="container">
    <h1>Livre d'or</h1>
     <?php if(!empty($errors)):  ?>
    <div class=" alert alert-danger">
        Formulaire invalide
    </div>
    <?php endif ; ?>


    <?php if($success):  ?>
    <div class=" alert alert-success">
        Merci pour votre message !
    </div>
    <?php endif ; ?>
    <form action="" method="post">
        <div class="form-group">
            <?php if(isset($errors["username"])) echo "<span class='text-danger'>". $errors["username"] . "</span>"; ?>
            <input type="text"  name="username" class="form-control <?= isset($errors['username'])? 'is-invalid' : 'is-valid' ?>" placeholder="Votre pseudo">
        </div>
        
        <div class="form-group"> <?php if(isset($errors["message"])) echo "<span class='text-danger'>". $errors["message"] . "</span>"; ?>
             <?php if(isset($errors["message"])) echo "<span class='text-danger'>". $errors["message"] . "</span>"; ?>
            <textarea   name="message" class="form-control" placeholder="Votre Messages"></textarea>
        </div>
        <button class=" btn btn-primary md" name="submit">Envoyer</button>
    </form>
</div>

<?php if(!empty($message)): ?>
<h2 class="mt-5 "> Vos Messages</h2>
<?php foreach($message as $messages) :  ?>
<?= $messages ->toHTML(); ?>
<?php endforeach; ?>
<?php endif ; ?>











<?php  require "<elements/footer.php" ; ?>