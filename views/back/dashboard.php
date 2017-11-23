<!-- CSS PAR PAGE -->
<?php ob_start(); ?>
<link rel="stylesheet" href="/assets/css/dashboard.css">
<?php $cssDashboard = ob_get_clean(); ?>

<?php ob_start() ; ?>

<?php include  __DIR__ . '/../partials/nav.php'; ?>

<section class="main dashboard">
    <section class="graph">
        	<div id="title_histo">
        		<h1>Histogramme des dépenses</h1>
        	</div>
    </section>

     <!-- Affichage de notre histogramme -->
    <section>
        <?php include  __DIR__ . '/../partials/histogramme.php'; ?>
    </section>

    <section class="spending container grid"> 
        <div>
        	<h2>Dernières dépenses</h2>
        	<ul>
                <!-- Check if $prepare not empty -->
                <?php if( count($datas) > 0 ) : ?>
                    <?php foreach ( $datas as $data ): ?>
                        <li>
                            <?php
                               echo $data["name"]. ' -- '
                               . 'dépense : '. $data["title"]. ' -- '
                               . $data["price"]. '€ -- ';

                               changeDate( $data["pay_date"] );
                            ?>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                <li>Pas de dépenses pour l'instant </li>
               <?php endif; ?>
        	</ul>
        </div>
    </section>
    
    <section class="AllDepenses">
        <div class="history">
            <a href="/history">Toutes les dépenses</a>
        </div>
    </section>

</section>
<?php $content = ob_get_clean() ; ?>

<?php include __DIR__ . '/../layouts/master.php' ?>


