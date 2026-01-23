<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Em Alta</title>
    <link rel="stylesheet" href="assets/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Gudea:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Piedra&display=swap" rel="stylesheet">
    <style>
        .Caveat {
            font-family: 'Caveat Brush', cursive;
        }

        .IBM {
            font-family: "IBM Plex Sans Thai", sans-serif;
        }

        .just-me {
            font-family: "Just Me Again Down Here", cursive;
            ;
            font-style: normal;
        }

        .Gudea {
            font-family: "Gudea", sans-serif;
            font-style: normal;
        }

        .piedra {
            font-family: "Piedra", serif;
            font-style: normal;
        }
    </style>

</head>

<body class="w-full flex flex-col items-center justify-center">
    <header class="w-full min-h-screen bg-[url('assets/imgs/home_img/bg_header.svg')] bg-no-repeat bg-cover bg-center text-green-600 flex flex-col items-center">
        <div class="head w-full flex p-5 items-center justify-center space-x-6">
            <a href="?ct=Main&mt=index" class="hidden md:block w-2/12 md:mr-10">
                <img src="<?= BASE_URL ?>/assets/imgs/home_img/7 1.svg" alt="logo_fogo_baixo" class="w-full">
            </a>
            <img src="<?= BASE_URL ?>/assets/imgs/home_img/logo_mobile.svg" class="w-3/12 md:sr-only " alt="">
            <!--<input type="search" class="bg-white w-4/12 h-10 rounded-full sr-only md:not-sr-only" name="searchHome" id="searchHome"> <!-->
            <input type="search" class="bg-white rounded-full md:w-3/12 sr-only md:not-sr-only md:h-10" name="" id="">
            <nav class="space-x-6 pl-5 md:flex">
                <?php if (empty($_SESSION['user'])): ?>
                    <a href="?ct=UserController&mt=login_form" class="border-l-5 pl-1 text-2xl">Login</a>
                    <a href="?ct=UserController&mt=cadastro_form" class="border-l-5 pl-1 text-2xl">Cadastre-se</a>
                <?php else: ?>
                    <a href="?ct=UserController&mt=logout" class="text-2xl">Logout</a>
                <?php endif; ?>
            </nav>
            <?php if (!empty($_SESSION['user'])): ?>
                <a href="?ct=PerfilController&mt=perfil"><img src="<?= BASE_URL ?>/assets/uploads/<?= $_SESSION['user']['foto'] ?>" alt="" class="w-20 rounded-full"></a>
            <?php endif; ?>
        </div>

        <div class="h-2 bg-black w-10/12 flex bg-green-600"></div>
        <nav class="text-white flex gap-x-10 my-5 IBM">
            <a href="../app/views/vegans.php" class="border-l-3 border-green-600 pl-2 text-2xl">Veganas</a>
            <a href="../app/views/Massas.php" class="border-l-3 border-green-600 pl-2 text-2xl hidden md:flex">Massas</a>
            <a href="../app/views/Doces.php" class="border-l-3 border-green-600 pl-2 text-2xl hidden md:flex">Doces</a>
            <a href="../app/views/Fitness.php" class="border-l-3 border-green-600 pl-2 text-2xl">Fitness</a>
            <a href="../app/views/região.php" class="border-l-3 border-green-600 pl-2 text-2xl hidden md:flex">Regionais</a>
            <a href="../app/views/Recomendados.php" class="border-l-3 border-green-600 pl-2 text-2xl">Outros..</a>
        </nav>
        <div class="gap-0 flex flex-col justify-center items-center">
            <h1 class="text-white just-me sub">Bateu a</h1>
            <h1 class="text-white piedra titulo_home"><b>FOME</b></h1>
            <h2 class="text-white Gudea font-semibold text-2xl sr-only md:not-sr-only">Receitas das mais simples ate as mais complexas!</h2>
        </div>
    </header>

    <form action="" method="post" enctype="multipart/form-data" class="w-10/12 flex flex-col justify-center items-center gap-y-25">
        <section class="flex h-150 p-5 items-start justify-center">

            <!-- INPUT FILE ESCONDIDO -->
            <input
                type="file"
                name="imagem"
                id="imagemInput"
                accept="image/*"
                class="hidden w-1/3 h-full object-cover rounded-xl border-4 border-green-500" />

            <!-- IMAGEM PREVIEW / TEMPLATE -->
            <label for="imagemInput" class="cursor-pointer relative group">
                <img
                    id="previewImagem"
                    src="<?= BASE_URL ?>/assets/imgs/template.svg"
                    alt="Imagem da receita"
                    class="w-full h-full object-cover rounded-xl border-4 border-green-500" />
                <!-- Ícone de edição -->
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 
                            flex items-center justify-center transition">
                    <i class="fa-solid fa-camera text-white text-4xl"></i>
                </div>
            </label>

            <div class="w-2/4 lg:w-1/4 flex flex-col gap-y-5 justify-left pl-5">
                <h1 class="text-5xl border-l-15 pl-2 Caveat w-full green-dark">
                    <label for="">Nome da receita:</label>
                    <input class="w-full word-break: break-all;" type="text" name="nome" name="nome" id="nome" maxlength="15" placeholder="Máximo 15">
                </h1>
                <div class="font-semibold text-white background w-full lg:w-2/3 text-center py-3 ">
                    compartilhe sua receita!
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                </div>
                <div class="flex items-center justify-left ">
                    <img src="<?= BASE_URL ?>/assets/uploads/<?= $_SESSION['user']['foto'] ?>" class="w-1/4" alt="">
                    <div class="flex flex-col pl-5">
                        <p class="text-3xl font-semibold word-break: break-all;"><?= $_SESSION['user']['nome'] ?></p>
                        <p class="word-break: break-all;"><?= $_SESSION['user']['email'] ?></p>
                    </div>
                </div>
                <h1 class="text-5xl  border-l-15 pl-2 Caveat green-dark">
                    Sobre o chef:
                </h1>
                <textarea class="rounded border word-break: break-all; font-semibold h-full w-full" type="text" name="descricao" id="descricao"
                    maxlength="" placeholder="Descrição curta do criador(a)!"> </textarea>
                <div class="hidden lg:flex gap-x-5">
                    <div class="gap-y-5 lg:flex xl:flex-col">
                        <div class="font-semibold text-white background p-3 text-2xl">
                            salvar receita!
                            <i class="fa-solid fa-bookmark"></i>
                        </div>
                        <div class="font-semibold text-white background p-3 text-2xl">
                            Compartilhar!
                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        </div>
                    </div>
                </div>
        </section>

        <section class="w-8/10 flex gap-x-5 justify-center">
            <div class="w-1/2">
                <h1 class="text-5xl border-l-15 pl-2 Caveat w-full green-dark">
                    Sobre a receita:
                </h1>
                <textarea class="mt-5 rounded border h-3/4 w-full" placeholder="Descrição da sua receita!" type="text" name="descricao_receita" id="descricao_receita"></textarea>
            </div>
            <div class="w-1/2">
                <h1 class="text-5xl border-l-15 pl-2 Caveat w-full brown hidden md:flex">
                    INGREDIENTES
                </h1>
                <h1 class="text-2xl border-l-15 pl-2 Caveat w-full brown flex md:hidden">
                    INGREDIENTES
                </h1>
                <ul id="listaIngredientes" class="flex flex-col gap-y-2 mt-5">
                    <li>
                        <input
                            type="text"
                            name="ingredientes[]"
                            placeholder="Ingrediente"
                            class="w-full p-2 rounded border">
                    </li>
                </ul>

                <button
                    type="button"
                    id="addIngrediente"
                    class="mt-3 background text-white px-4 py-2 rounded">
                    + Adicionar ingrediente
                </button>
            </div>
        </section>

        <section class="w-8/10 flex flex-col md:flex md:flex-col gap-y-5 mt-10 justify-center">
            <div class="flex h-1/2 w-1/2">
                <h1 class="text-5xl border-l-15 pl-2 Caveat w-full green-dark">
                    Passo a Passo:
                </h1>
                <h1 class="text-5xl Caveat w-full brown">Mantenha o Fogo Baixo!</h1>
            </div>

            <div class="flex items-start mt-10 h-full">
                <div class="flex p-5 items-center justify-center gap-x-3 text-3xl background text-white w-1/3 ">
                    <input class="font-semibold" type="time" placeholder="30:00 min"></input>
                    <!-- <i class="fa-solid fa-clock"></i> -->
                </div>
                <div class="flex flex-col w-3/4 items-center">
                    <div class="flex items-center justify-center w-2/3">
                        <h2 class="Caveat p-5 green-light text-5xl text-white w-1/6 text-center ">1</h2>
                        <input class="text-5xl  pl-5 Caveat green-dark" placeholder="PASSO 1: Colocar no pote!"></input>
                    </div>
                    <textarea class="flex items-center justify-center text-2xl w-2/3 h-full border rounded" placeholder="digite aqui o passo exemplo: Derreta a manteiga em 30 graus e coloque no pote deixando..."></textarea>
                </div>
            </div>

            <section class="w-full flex gap-x-5 justify-center">
                <div class="flex flex-col items-start w-full">
                    <div class="flex items-start justify-center mt-10 w-2/3 gap-x-5">
                         <h2 class="Caveat p-5 green-light text-5xl text-white w-1/6 text-center h-full">x</h2>
                        <input class="text-5xl  pl-5 Caveat green-dark h-full" placeholder="PASSO: Colocar no pote!"></input>
                    </div>
                    <div class="flex flex-col lg:flex lg:flex-row w-full gap-x-5 mt-10">
                        <textarea class="flex items-center justify-center text-2xl w-2/3 h-full border rounded" placeholder="digite aqui o passo exemplo: Derreta a manteiga em 30 graus e coloque no pote deixando..."></textarea>
                        <img src="<?= BASE_URL ?>/assets/imgs/comida/Hambúrguer.png" alt="">
                    </div>
                </div>
            </section>

            <button type="button" id="AddPasso" class="mt-3 background text-white px-4 py-2 rounded w-2/8 text-2xl">
                Inserir Passo +
            </button>
        </section>
    </form>

    <footer class="bottom-0 left-0 w-full text-white p-4 text-centerd  green-light flex items-center justify-center mt-30">
        <img src="<?= BASE_URL ?>/assets/imgs/home_img/7 1.svg" class="w-2/12">
        <p class=" text-xl mt-5 hidden md:block">© 2025 Fogo-Baixo. Todos os direitos reservados.</p>
        <p class="block md:hidden">© 2025 Fogo-Baixo.</p>
        <img src="../imgs/github_white.svg" class="w=1/12 h-7 mt-5 ml-5" alt="">
    </footer>

    <script>
        document.getElementById('imagemInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (!file) return;

            document.getElementById('previewImagem').src =
                URL.createObjectURL(file);
        });

        //Adicionar Ingrediente

        document.getElementById('addIngrediente').addEventListener('click', () => {
            const ul = document.getElementById('listaIngredientes');

            if (ul.children.length >= 6) {
                alert('Você pode adicionar no máximo 6 ingredientes.');
                return;
            }

            const li = document.createElement('li');
            li.innerHTML = `
        <input 
        type="text" 
        name="ingredientes[]" 
        placeholder="Ingrediente"
        class="w-full p-2 rounded border"
        >
    `;

            ul.appendChild(li);
        });

        //Adicionar Passo
        document.getElementById('AddPasso').addEventListener('click', () => {

        })
    </script>
</body>

</html>