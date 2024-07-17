<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
        <style>
          body {
            font-family: 'Poppins', sans-serif;
            margin: 20px;
          }
        </style>
        @livewireStyles
    </head>
    <body>
        <div class="flex flex-row mb-5">
          <h1 class="text-gray-500 text-[16px] font-bold">PENERIMAAN BARANG</h1>
        </div>
        <div class="">
          <livewire:form-barang />
        </div>
        @livewireScripts
        @stack('scripts')
    </body>
</html>
