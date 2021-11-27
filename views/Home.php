<?php
include(HEADER);
?>

<section>
    <div class="container-fluid text-white">
        <div class="row bg-dark">
            <div class="col-lg-7 p-0">
                <div id="carousel-pets" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-pets" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-pets" data-slide-to="1"></li>
                        <li data-target="#carousel-pets" data-slide-to="2"></li>
                        <li data-target="#carousel-pets" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="./public/img/carousel/cachorroegato.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="./public/img/carousel/racao.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="./public/img/carousel/cachorro.jpg" alt="Third slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="./public/img/carousel/gato.jpg" alt="fourth slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel-pets" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-pets" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-5 p-3">
                <h1 class="display-4 m-2">Você não deve ser o único a comer de forma saudável</h1>
                <h4 class="lead">Como você, amamos nossos animais de estimação e nos preocupamos com sua saúde </h4>
            </div>
        </div>
    </div>
</section>
<section class="py-5 bg-light text-center">
    <div class="container">
        <div class="mb-5">
            <samp class="h5 d-block">TUDO DE MELHOR PARA O SEU PET</samp>
            <h2 class="display-4 text-secund">Conheça as vantagens dos nossos produtos</h2>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-6 p-4">
                <img class="p-2" src="./public/img/icon/iconracao.png" alt="">
                <h3>Ração</h3>
                <h5>Nossass rações são 100% naturais feitas com frutas, vegetais e legumes de alta qualidade</h5>
            </div>
            <div class="col-xl-4 col-md-6 p-4">
                <img class="p-2" src="./public/img/icon/iconremedio.png" alt="">
                <h3>Remédio</h3>
                <h5>Temos todos os tipos que o seu cachorro pode precisar</h5>
            </div>
            <div class="col-xl-4 col-md-6 p-4">
                <img class="p-2" src="./public/img/icon/iconcoleira.png" alt="">
                <h3>Acessórios</h3>
                <h5>Venha conhecer nossa linha de coleiras e peitorais de alta qualidade para todos os tamahos</h5>
            </div>
            <div class="col-xl-4 col-md-6 ">
                <img class="p-2" src="./public/img/icon/iconbrinquedo.png" alt="">
                <img src="./public/img/icon/icon.png" alt="">
                <h3>Brinquedos</h3>
                <h5>Venha conhecer nossa linha de brinquedos de alta qualidade para todos os tamahos</h5>
            </div>
            <div class="col-xl-4 col-md-6 ">
                <img class="p-2" src="./public/img/icon/iconshampoo.png" alt="">
                <h3>Higiene</h3>
                <h5>Venha conhecer nossa linha de produtos de higiene veganos de alta qualidade</h5>
            </div>
            <div class="col-xl-4 col-md-6 ">
                <img class="p-2" src="./public/img/icon/iconshampoo.png" alt="">
                <h3>Vacinas</h3>
                <h5>Não deixe de vacinar o seu amiguinho, as vaancinas são feitas para protege-los</h5>
            </div>
        </div>
        <div class="mt-5">
            <a href="<?php echo SITE_URL; ?>/produtos/" class="info-btn btn-lg">Comprar produtos</a>
        </div>
    </div>

</section>
<?php
include(FOOTER);
?>