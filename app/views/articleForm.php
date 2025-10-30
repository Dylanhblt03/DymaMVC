<?php
include 'includes/header.inc.php';
?>


    <h1>Nouvel Article</h1>
    <!-- Section avec le formulaire pour ajouter un nouvel article -->
    <!--
        `method="POST"`: les données du formulaire seront envoyées dans le corps de la requête HTTP, de manière non visible.
        `action="/add"`: lorsque le formulaire est soumis, le navigateur enverra la requête à l'URL "/add".
        Le routeur (dans index.php) interceptera cette URL et appellera la méthode `addArticle` du contrôleur.
    -->
    <form method="POST" action="/add" class="mt-4" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="articleTitre" class="form-label">Titre de l'article</label>
            <input type="text" class="form-control" id="articleTitre" name="articleTitre" placeholder="Titre du nouvel article" required />
        </div>
        <div class="mb-3">
            <label for="articleContenu" class="form-label">Contenu</label>
            <textarea class="form-control" id="articleContenu" name="articleContenu" placeholder="Contenu du nouvel article" rows="5" required></textarea>
            <div class="mt-3 d-flex align-items-center">
                <input type="file" id="photo_intro" name="photo_intro" class="d-none"/>
                <label for="photo_intro" class="btn btn-sm btn-outline-primary">Ajouter une photo</label>
                <div class="thumbnail ms-3">
                    <img src="" class="img-fluid"/>
                    <div id="img-name">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Publier l'article</button>
    </form>

<?php
include 'includes/footer.inc.php';
?>

<script>
    $(function() {
        $('#photo_intro').on('change', function() {
            if (this.files && this.files[0]) {
                //Ici, on sait qu'on a un fichier
                // Donc on creer un lecteur
                var lecteur = new FileReader();
                //On prepare un evenement sur notre lecteur pour lui dire de changer l'attribut src de notre image
                lecteur.onload = function(e) {
                    $('.thumbnail img').attr('src', event.target.result);
                };
                //Puis on declenche notre evenement 
                lecteur.readAsDataURL(this.files[0]);

                var filename = this.files[0].name;
                if (filename.length > 10) {
                    var extention = filename.split('.').pop();
                    var nomSeul = filename.split('.').slice(0, -1).join('.');
                    var nomAAfficher = nomSeul.substring(0, 10) + "..." + extention;
                } else {
                    var nomAAfficher = filename;
                }
                $('#img-name').html(nomAAfficher);
            }
        });
    });
</script>