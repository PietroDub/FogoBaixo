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
    <h2 class="text-white Gudea font-semibold text-2xl sr-only md:not-sr-only">Receitas das  mais simples ate as mais complexas!</h2>
    </div>
   </header>

    <form action="" method="post" enctype="multipart/form-data" class="w-10/12 flex flex-col justify-center items-center">
        <section class="flex h-150 p-5 items-start justify-center">
            
           <!-- INPUT FILE ESCONDIDO -->
            <input 
                type="file" 
                name="imagem" 
                id="imagemInput" 
                accept="image/*" 
                class="hidden w-1/3 h-full object-cover rounded-xl border-4 border-green-500"
            />

            <!-- IMAGEM PREVIEW / TEMPLATE -->
            <label for="imagemInput" class="cursor-pointer relative group">
                <img
                id="previewImagem"
                src="<?= BASE_URL ?>/assets/imgs/template.svg"
                alt="Imagem da receita"
                class="w-full h-full object-cover rounded-xl border-4 border-green-500"
                />
                <!-- Ícone de edição -->
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 
                            flex items-center justify-center transition">
                <i class="fa-solid fa-camera text-white text-4xl"></i>
                </div>
            </label>
                    
           <div class="w-2/4 lg:w-1/4 flex flex-col gap-y-5 justify-left pl-5">
            <h1 class="text-5xl border-l-15 pl-2 Caveat w-full green-dark">
            <label for="">Nome da receita:</label>
            <input class="w-full word-break: break-all;" type="text" name="nome"  name="nome" id="nome" maxlength="15" placeholder="Máximo 15">
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
            <h1 class="text-5xl border-l-15 pl-2 Caveat green-dark">
            Sobre o chef: 
            </h1>
            <textarea class="word-break: break-all; font-semibold w-full" type="text" name="descricao" id="descricao"
            maxlength="" placeholder="Descrição curta do criador(a)!"> </textarea>
           <div>
             <div class="hidden gap-y-5 m-10 lg:flex lg:flex-col">
                <div class="font-semibold text-white background p-5 text-2xl">
                salvar receita!
                <i class="fa-solid fa-bookmark"></i>
            </div>
            <div class="font-semibold text-white background p-5 text-2xl">
                Compartilhar!
                <i class="fa-solid fa-arrow-up-from-bracket"></i>
            </div>
             </div>
           </div>
        </section>

         
    </form>

 <footer class="bottom-0 left-0 w-full text-white p-4 text-centerd  green-light flex items-center justify-center mt-30">
    <img src="<?= BASE_URL ?>/assets/imgs/home_img/7 1.svg" class="w-2/12">
    <p class=" text-xl mt-5 hidden md:block">© 2025 Fogo-Baixo. Todos os direitos reservados.</p>
    <p class="block md:hidden">© 2025 Fogo-Baixo.</p>
    <img src="../imgs/github_white.svg" class="w=1/12 h-7 mt-5 ml-5" alt="">
  </footer>

  <script>
    document.getElementById('imagemInput').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (!file) return;

    document.getElementById('previewImagem').src =
        URL.createObjectURL(file);
    });
</script>
</body>

</html>