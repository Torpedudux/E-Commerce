<?php
require_once __DIR__ . '/../includes/config.php'; 
require_once ROOT_PATH . 'includes/db.php'; 
include ROOT_PATH . 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (nom, email, password, role) VALUES (?, ?, ?, 'user')");
        $stmt->execute([$nom, $email, $password]);
        header('Location: connexion.php?success=1');
        exit();
    } catch (PDOException $e) {
        $error = "Cet email est déjà utilisé.";
    }
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h3>Rejoindre Torpedux</h3>
            <?php if(isset($error)) echo "<p class='alert alert-danger'>$error</p>"; ?>
            <form method="POST">
                <input type="text" name="nom" class="form-control mb-2" placeholder="Nom complet" required>
                <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                <input type="password" name="password" class="form-control mb-2" placeholder="Mot de passe" required>
                <button type="submit" class="btn btn-success w-100">S'inscrire</button>
            </form>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>