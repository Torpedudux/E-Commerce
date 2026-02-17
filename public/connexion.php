<?php
require_once __DIR__ . '/../includes/config.php'; 
require_once ROOT_PATH . 'includes/db.php'; 
include ROOT_PATH . 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_nom'] = $user['nom'];
        header('Location: index.php');
        exit();
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h3>Connexion Torpedux</h3>
            <?php if(isset($error)) echo "<p class='alert alert-danger'>$error</p>"; ?>
            <form method="POST">
                <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                <input type="password" name="password" class="form-control mb-2" placeholder="Mot de passe" required>
                <button type="submit" class="btn btn-primary w-100">Se connecter</button>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>