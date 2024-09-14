<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="TecnoMarket ">

    <meta name="description" content="TecnoMarket , líder en la venta de laptops, televisores, y productos tecnológicos en San Cristóbal, Madre Vieja Norte, República Dominicana. Encuentra laptops nuevas y usadas de marcas como DELL, LENOVO, HP, Acer y ThinkPad a precios económicos. Ofrecemos computadoras y tecnología accesible para todos, con ofertas especiales para estudiantes y empresas. ¡Visítanos para las mejores oportunidades en tecnología!">

    <meta name="keywords" content="Apple, Dell, HP, Lenovo, Acer, Asus, Microsoft, Samsung, MSI, Razer, Alienware, laptops, TVS, televisores, accesorios, impresoras, celulares, tablet, laptops nuevas, laptops usadas, laptops económicas, laptops con garantía, financiamiento de laptops, venta de laptops, comprar laptops, venta de laptops en San Cristóbal, laptops con financiamiento en República Dominicana, TecnoMarket SRL, productos tecnológicos San Cristóbal, ofertas de laptops, Madre Vieja Norte, computadoras económicas, tecnología accesible, venta de laptops con garantía, soluciones tecnológicas, servicio al cliente, laptops baratas, televisores económicos, computadoras, impresoras con financiamiento, celulares económicos, tablet económicas, accesorios de tecnología, smart TV San Cristóbal, impresoras con garantía, financiamiento disponible en República Dominicana, comprar laptops, reparar laptops, seguridad, barato, venta de computadoras, Windows laptops, laptops Windows nuevas, laptops Windows usadas, laptops seguras, laptops baratas, reparar computadoras">
    <meta http-equiv="Content-Language" content="es-DO">

    <meta name="robots" content="index, follow">





    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <!-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->

    <link rel="icon" href="{{ asset('images/TECNOMARKET SRL.ico') }}" type="image/x-icon">

    <meta property="og:title" content="Venta de Laptops Nuevas y Usadas en San Cristóbal | TecnoMarket ">
    <meta property="og:description" content="Encuentra laptops nuevas y usadas a precios económicos, financiamiento disponible y garantía. Ubicados en Madre Vieja Norte, San Cristóbal.">
    <meta property="og:image" content="{{ asset('images/tecnomarket-og-image.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Schema Markup -->
    <script type="application/ld+json">
        {
            "@type": "Store",
            "name": "TecnoMarket ",
            "description": "Venta de laptops nuevas y usadas, televisores, impresoras, celulares y más. Ubicados en Madre Vieja Norte, San Cristóbal, República Dominicana.",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Calle Acuario #7 Madre Vieja Norte",
                "addressLocality": "San Cristóbal",
                "addressRegion": "San Cristóbal",
                "postalCode": "91000",
                "addressCountry": "DO"
            },
            "telephone": "+1 (809)-871-9279",
            "openingHours": "Mo-Sa 09:00-18:00",
            "priceRange": "RD$12,000 - RD$60,000"
        }
    </script>

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body>
    @inertia







</body>

</html>