<?php
include(HEADER);
?>

<section>
    <div class="container">
        <h1>My Product:</h1>
        <ul>
            <li><?php echo $Cliente->getNome(); ?></li>
            <li><?php echo $Cliente->getEndereco(); ?></li>
            <li><?php echo $Cliente->getTelefone(); ?></li>
            <li><?php echo $Cliente->getCelular(); ?></li>
            <li><?php echo $Cliente->getCpf(); ?></li>
        </ul>
        <a href="<?php echo $routes->get('homepage')->getPath(); ?>">Back to homepage</a>
    </div>
</section>

<?php
include(FOOTER);
?>
