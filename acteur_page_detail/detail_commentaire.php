<?php
require '_db.php';

if (!isset($_SESSION['user_is_connected']) || !$_SESSION['user_is_connected'])
{
    header('Location: ./index.php');
}
//count nbr of coms
$req = $pdo->prepare("SELECT COUNT(acteur_id) FROM articles WHERE acteur_id = ?");
$req->execute([$_SESSION['id']]);
$nbr_total_comments = $req->fetch();
$req->closeCursor();

//count all like
$like = 1;
$req = $pdo->prepare("SELECT COUNT(vote) FROM votes WHERE vote = ? AND acteur_id = ?");
$req->execute([
    $like,
    $_SESSION['id']
    ]);
$nbr_like = $req->fetch();
$req->closeCursor();

//count all dislike
$dislike = 0;
$req = $pdo->prepare("SELECT COUNT(vote) FROM votes WHERE vote = ? AND acteur_id = ?");
$req->execute([
    $dislike,
    $_SESSION['id']
    ]);
$nbr_dislike = $req->fetch();
$req->closeCursor();

//print all coms
$req = $pdo->prepare("SELECT user_id, com, date FROM articles WHERE acteur_id = ? ORDER BY date DESC");
$req->execute([$_SESSION['id']]);
$comments_data = $req->fetchALL();
$req->closeCursor();
//print s or no for commentaire(s)
$commentaire = ($nbr_total_comments[0] <= 1) ? 'Commentaire' : 'Commentaires';
?>
<div class="row">
    <div class="offset-sm-1 col-sm-10">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h3><?=$nbr_total_comments[0] .' '. $commentaire?></h3> 
            <script type="text/javascript">

                
                async function submit(message) {
                    try {
                        let form = new FormData();

                        form.append("message", message);

                        const response = await fetch('/coursphp/gbaf/acteur_page_detail/commentaires.php', {
                            method: 'POST',
                            body: form 
                        })
                        
                        let data = await response.text()
                        let url = window.name;

                        if(response.status === 200) {
                            window.location = url;
                        }
                        
                    } catch (error) {
                        console.log(error);
                    }
                }
                
                function write_comment()
                {
                    var msg = prompt("Entrez votre commentaire");
                    if (!msg == ''){
                        message = htmlentities(msg.trim());
                        submit(message);
                    }
                }

            </script>
            <div class="btn-toolbar">
                <button onclick="write_comment();" class="btn btn-lg btn-outline-secondary mr-5">Nouveau commentaire</button>
                <script type="text/javascript">
                    async function submitLike() {
                        try {
                            let form = new FormData();
                            
                            form.append("vote", 1);
                            
                            const response = await fetch('/coursphp/gbaf/acteur_page_detail/vote.php', {
                                method: 'POST',
                                body: form 
                            })
                            
                            let data = await response.text()
                            let url = window.name;
                            
                            if(response.status === 200) {
                                window.location = url;
                            }
                            
                        } catch (error) {
                            console.log(error);
                        }
                    }
                    
                    
                    </script>
                <div class="btn-group">
                    <button onclick="submitLike();" class="btn btn-lg btn-outline-secondary"><?=$nbr_like[0]?> <i class="fas fa-thumbs-up"></i></button> 
                    <script type="text/javascript">
                        async function submitDislike() {
                            try {
                                let form = new FormData();

                                form.append("vote", 0);

                                const response = await fetch('/coursphp/gbaf/acteur_page_detail/vote.php', {
                                    method: 'POST',
                                    body: form 
                                })
                                
                                let data = await response.text()

                                let url = window.name;

                                if(response.status === 200) {
                                    window.location = url;
                                }
                                
                                
                            } catch (error) {
                                console.log(error);
                            }
                        }
                    </script>
                    <button onclick="submitDislike();" class="btn btn-lg btn-outline-secondary"><?=$nbr_dislike[0]?> <i class="fas fa-thumbs-down"></i></button>
                </div>
            </div>
        </div>    
    </div>
</div>
    
    <?php
    foreach($comments_data as $com)
    {
    $req = $pdo->prepare("SELECT prenom FROM users WHERE user_id = ?");
    $req->execute([$com['user_id']]);
    $user_name = $req->fetchALL();
    $req->closeCursor();
    ?>
    <?php
    foreach($user_name as $user)
    {
    ?>
    <div class="row">
        <div class="offset-sm-1 col-sm-10">
            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-1 shadow-sm h-sm-100 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="mb-0"><?=$user['prenom']?></h3>
    <?php
    }
    ?>
                    <p class="card-text mb-auto"><?=$com['date']?></p>
                    <p class="card-text mb-auto"><?=$com['com']?></p>
                </div>
            </div>
        </div>
    </div>

<?php
    }
?>