<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Criar Receita - FogoBaixo</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="min-h-screen  flex flex-col items-center justify-center m-0 p-0 relative overflow-hidden">

  <!-- Imagem de fundo (acima do body, abaixo do conteúdo) -->
  <div class="absolute inset-0 z-1 pointer-events-none">
    <img src="<?= BASE_URL ?>/assets/imgs/triangulo.png" class="absolute bottom-0 right-0 w-1/2" alt="">
  </div>

  <!-- Conteúdo principal -->
  <main class="w-full max-w-4xl flex shadow-md relative flex-col md:flex md:flex-row ">

    <!-- Lado Esquerdo -->
    <div class="hidden md:flex w-1/2 p-8 flex-col justify-center gap-y-5 background items-center">
      <div class="flex items-center flex-col">
        <img src="<?= BASE_URL ?>/assets/imgs/home_img/7 1.svg" class="w-3/4" alt="">
        <p class="text-xl text-white font-semibold text-center">
          Crie sua própria receita e dê a sua cara para a nossa comunidade!
        </p>
      </div>
      <div class="flex mt-6 w-full items-center justify-center">
        <form action="?ct=ReceitasController&mt=Image_submit" method="post" enctype="multipart/form-data">
          <input type="file" name="imagem" accept="image/*" class="form-control" />
          <button type="submit" class="btn Caveat border-l-8 border-green-500 green-dark pl-2">
              Enviar imagem
          </button>
        </form>
      </div>
    </div>

    <!-- Lado Direito (Formulário) -->
    <div class="w-full md:w-1/2 p-8 bg-white text-center">
      <h2 class="green-dark font-bold mb-6 text-center text-3xl">Cadastro</h2>

      <form action="?ct=UserController&mt=cadastro_submit"  method="post" class="space-y-4 flex flex-col">
        <input type="text" placeholder="Nome" name="nome" id="nome"  class="w-full p-2 border border-gray-300 rounded" />
        <textarea name="descricao" id=""></textarea>
        <textarea name="sobre" id=""></textarea>

        <h1>INGREDIENTES</h1>

        <input type="button" value="" type="submit">
        <a href="">voltar</a>
      </form>
    </div>
    
  </main>
  <?php if(!empty($validation_errors)): ?>
    <?php foreach($validation_errors as $error): ?>
      <div class="text-red-600 bg-red-200 p-5 m-1 z-0 rounded-lg"><?= $error ?></div>
    <?php endforeach; ?>
  <?php endif; ?>

</body>
</html>
