<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<main class="content">
    @foreach ($produto as $produto)
    @endforeach
    <div class="card">
        <div class="card-header-template">
            <div>Visualizar Produto</div>
            <div>
                <a href="#" class="btn btn-sm btn-primary">
                    <i class="icofont-cart icofont-2x"></i>
                    Meu carrinho
                </a>
            </div>
        </div>
        <div class="card-body">
            <!--  div dos fotos-->
            <div class="carousel-container">
                <div class="carousel-images">
                    <img src="/img/produtos/{{ $produto->image}}" alt="Imagem 1">
                    <img src="/img/produtos/{{ $produto->image2}}" alt="Imagem 2">
                    <img src="/img/produtos/{{ $produto->image3}}" alt="Imagem 3">
                    <!-- Adicione mais imagens conforme necessário -->
                </div>
                <div class="carousel-preview">
                    <img src="/img/produtos/{{ $produto->image}}" alt="imagem" class="preview-image">
                    <img src="/img/produtos/{{ $produto->image2}}" alt="imagem" class="preview-image">
                    <img src="/img/produtos/{{ $produto->image3}}" alt="imagem" class="preview-image">
                    <!-- Adicione mais imagens conforme necessário -->
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const carouselImages = document.querySelector('.carousel-images');
                    const previewImages = document.querySelectorAll('.preview-image');

                    previewImages.forEach((preview, index) => {
                        preview.addEventListener('click', () => {
                            carouselImages.style.transform = `translateX(-${index * 100}%)`;
                        });
                    });
                });
            </script>
            <style>
                .carousel-container {
                    max-width: 600px;
                    margin: 0 auto;
                    overflow: hidden;
                    float: left;
                    margin-left: 100px;
                }

                .carousel-images {
                    display: flex;
                    transition: transform 0.5s ease;
                }

                .carousel-images img {
                    width: 100%;
                    height: auto;
                    object-fit: cover;
                }

                .carousel-preview {
                    display: flex;
                    justify-content: center;
                    margin-top: 10px;
                }

                .preview-image {
                    width: 70px;
                    height: 70px;
                    object-fit: cover;
                    margin: 0 5px;
                    cursor: pointer;
                }

                .preview-image:hover {
                    border: 2px solid blue;
                }

                .card-body {
                    background-color: rgb(220, 220, 220);
                }
            </style>
            <!--  div dos dados do produto-->
            <style>
                #dados-tec {
                    height: 500px;
                    width: 500px;
                    float: right;

                    margin-right: 100px;
                }
            </style>
            <div id="dados-tec">
                <h1>{{ $produto->nome }}-código:</h1>
                <h1>R$: 1000,00</h1>
                <h6>Descrição:</h6>{{ $produto->descricao }}
                <h6>Marca:</h6>{{ $produto->marca->nome }}
                <hr>
                ESTOQUE:{{ $produto->estoque_minimo }},{{ $produto->estoque_maximo}},{{ $produto->local_estoque}}
                <hr>
                <h6>local:</h6>{{ $produto->local_estoque}}
                <h6>Categoria</h6>{{ $produto->categoria->nome}}
                <hr>
            </div>

        </div>
    </div>


</main>

</html>