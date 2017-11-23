<?php ob_start(); ?>
<link rel="stylesheet" href="/assets/css/history.css">
<?php $cssHistory = ob_get_clean(); ?>

<?php ob_start() ; ?>
<section class="container grid fadein"> 
    <div>
        <a href="/admin" class="Accueil">Accueil</a>
        <h2>Historique des dépenses ces vacances</h2>
        <!-- ****************************** Show Dep ****************************** -->
        <ul>
            <!-- Check if $prepare not empty -->
            <?php if( count($datas) > 0 ) : ?>

                <?php foreach ( $datas as $data ): ?>
                    <li>
                        <?php
                            $name  = htmlentities($data["name"]);
                            $title = htmlentities($data["title"]);
                            $price = intval($data["price"]);

                           echo $name. ' -- '
                           . 'Type : '. $title. ' -- Prix : '
                           . $price. '€ -- ';

                           changeDate( $data["pay_date"] );
                        ?>
                    </li>
                <?php endforeach; ?>

            <?php else : ?>
            <li>Pas de dépenses pour l'instant </li>
           <?php endif; ?>
        </ul>
        
        <div class="pagination">
            <!-- ****************************** PAGINATION ****************************** -->
            <?php
                for($i=1;$i<=$nbPage;$i++) {
                    if ($i == $cPage) {
                        echo  " ". $i ." /";
                    }else{
                        echo "<a href=\"history?page=$i\"> $i </a>/";
                    }
                }
            ?>
        </div>

        <!-- ****************************** Total ****************************** -->
        <hr>

        <div class="total">
            <h3>Total : <?php echo $total; ?> €</h3>
        </div>
    </div>
</section>


<?php $content = ob_get_clean() ; ?>

<?php include __DIR__ . '/../layouts/master.php' ?>