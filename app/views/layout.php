<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($title ?? 'My App') ?></title>

  <!-- Tailwind (CDN) -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">
  <header class="border-b bg-white">
    <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
      <a href="/" class="font-semibold text-lg">MVC</a>
      <nav class="space-x-4">
        <a class="hover:underline" href="/">Home</a>
        <a class="hover:underline" href="/about">About</a>
      </nav>
    </div>
  </header>

  <main class="max-w-5xl mx-auto px-4 py-8">
    <?= $content /* the view’s HTML goes here */ ?>
  </main>

  <footer class="max-w-5xl mx-auto px-4 py-8 text-sm text-gray-500">
    &copy; <?= date('Y') ?> My App
  </footer>
</body>
</html>
