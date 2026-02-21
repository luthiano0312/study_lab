<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Scroll Sobreposto</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      margin: 0;
    }

    section {
      position: sticky;
      top: 0;
    }
  </style>
</head>

<body class="overflow-x-hidden">


  <section class="h-screen flex items-center justify-center bg-red-500 z-10">
    <h1 class="text-5xl font-bold text-white">
      Seção 1
    </h1>
  </section>


  <section class="h-screen flex items-center justify-center bg-blue-600 z-20">
    <h1 class="text-5xl font-bold text-white">
      Seção 2
    </h1>
  </section>

  <section class="h-screen flex items-center justify-center bg-green-600 z-30">
    <h1 class="text-5xl font-bold text-white">
      Seção 3
    </h1>
  </section>

</body>
</html>