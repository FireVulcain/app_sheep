<div class="svg">
    <svg xml:lang="fr" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <?php
            $i=0;
            foreach($depenses as $depUser):
                $pourcentage = ($depUser["price"]/$total)*1000;
                $i++;
        ?> 
                <rect rx="5" x="<?=$diffX;?>" y="-300" width="50" height="<?=$pourcentage;?>" transform="scale(1-1)" 
                    class="hist<?=$i;?>">
                <animate attributeName='height' attributeType='XML' fill='freeze' from='0' to='<?=$pourcentage;?>' begin="0s" dur='1s'/>
                </rect>
                <?php $diffX += 80;?> <!-- Variable dans le back-controller.php pour séparer les rect -->
        <?php endforeach; ?>
    </svg>
</div>
<hr>
<?php foreach ($depenses as $valueName): ?>
    <p class="nameUser">
        <?= $valueName["name"];?>
    </p>
<?php endforeach ?>