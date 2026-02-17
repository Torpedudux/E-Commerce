<?php
require_once __DIR__ . '/../includes/config.php'; 
require_once ROOT_PATH . 'includes/db.php'; 
include ROOT_PATH . 'includes/header.php';
?>
<div class="container mt-5">
    <h1>Foire Aux Questions</h1>
    <div class="accordion mt-4" id="faqTorpedux">
        <div class="accordion-item">
            <h2 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#q1">Délais de livraison ?</button></h2>
            <div id="q1" class="accordion-collapse collapse show"><div class="accordion-body">Nous livrons en 48h partout en France.</div></div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>