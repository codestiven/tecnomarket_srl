<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Carbon\Carbon;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an advanced sitemap with filters like categoria, marca, and oferta';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Obtener el dominio base de la aplicación desde el archivo .env
        $baseUrl = config('app.url'); // Asegúrate de que APP_URL esté correctamente configurado en tu .env

        // Create a sitemap index
        $sitemapIndex = SitemapIndex::create();

        // General site pages sitemap
        $generalSitemap = Sitemap::create()
            ->add(Url::create($baseUrl . '/')
                ->setPriority(1.0)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setLastModificationDate(Carbon::now()))
            ->add(Url::create($baseUrl . '/Nosotros')
                ->setPriority(0.8)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create($baseUrl . '/Contacto')
                ->setPriority(0.7)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY));

        // Save the general sitemap
        $generalSitemapFile = 'sitemap-general.xml';
        $generalSitemap->writeToFile(public_path($generalSitemapFile));
        $sitemapIndex->add($baseUrl . "/$generalSitemapFile");

        // Filtrando productos por categoría, marca y ofertas
        $productosSitemap = Sitemap::create();
        $categorias = Categoria::all();
        $marcas = Marca::all();

        // Filtro por categoría
        foreach ($categorias as $categoria) {
            $productosByCategoria = Producto::where('categoria_id', $categoria->id)->get();

            foreach ($productosByCategoria as $producto) {
                $productosSitemap->add(Url::create($baseUrl . "/Productos?categoria_id={$categoria->id}&producto={$producto->slug}")
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setLastModificationDate($producto->updated_at ?? Carbon::now()));
            }
        }

        // Filtro por marca
        foreach ($marcas as $marca) {
            $productosByMarca = Producto::where('marca_id', $marca->id)->get();

            foreach ($productosByMarca as $producto) {
                $productosSitemap->add(Url::create($baseUrl . "/Productos?marca_id={$marca->id}&producto={$producto->slug}")
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setLastModificationDate($producto->updated_at ?? Carbon::now()));
            }
        }

        // Filtro por ofertas
        $productosEnOferta = Producto::where('es_oferta', 1)->get();
        foreach ($productosEnOferta as $producto) {
            $productosSitemap->add(Url::create($baseUrl . "/Productos?en_oferta=solo_ofertas&producto={$producto->slug}")
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setLastModificationDate($producto->updated_at ?? Carbon::now()));
        }

        $productosSinOferta = Producto::where('es_oferta', 0)->get();
        foreach ($productosSinOferta as $producto) {
            $productosSitemap->add(Url::create($baseUrl . "/Productos?en_oferta=sin_ofertas&producto={$producto->slug}")
                ->setPriority(0.7)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setLastModificationDate($producto->updated_at ?? Carbon::now()));
        }

        // Save the productos sitemap
        $productosSitemapFile = 'sitemap-productos.xml';
        $productosSitemap->writeToFile(public_path($productosSitemapFile));
        $sitemapIndex->add($baseUrl . "/$productosSitemapFile");

        // Creación del sitemap de servicios
        $serviciosSitemap = Sitemap::create()
            ->add(Url::create($baseUrl . '/Financiamiento')
                ->setPriority(0.8)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create($baseUrl . '/Garantia')
                ->setPriority(0.8)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create($baseUrl . '/Soporte_tecnico')
                ->setPriority(0.8)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));

        // Guardar el sitemap de servicios
        $serviciosSitemapFile = 'sitemap-servicios.xml';
        $serviciosSitemap->writeToFile(public_path($serviciosSitemapFile));
        $sitemapIndex->add($baseUrl . "/$serviciosSitemapFile");

        // Save the sitemap index
        $sitemapIndexFile = 'sitemap.xml';
        $sitemapIndex->writeToFile(public_path($sitemapIndexFile));

        // Generate robots.txt
        $robotsContent = "User-agent: *\n";
        $robotsContent .= "Disallow: /profile\n";
        $robotsContent .= "Disallow: /guardados\n";
        $robotsContent .= "Disallow: /pedidos\n";
        $robotsContent .= "Disallow: /admin\n";
        $robotsContent .= "Disallow: /productos/create\n";
        $robotsContent .= "Disallow: /api/productos/\n";
        $robotsContent .= "Disallow: /Message/\n";
        $robotsContent .= "Disallow: /carousels/\n";
        $robotsContent .= "Disallow: /categorias/\n";
        $robotsContent .= "Disallow: /Marcas/\n";
        $robotsContent .= "Disallow: /guardados/\n";
        $robotsContent .= "Disallow: /Productoliked\n";
        $robotsContent .= "Disallow: /productos/filtrar\n";
        $robotsContent .= "Disallow: /productos/por-ids\n";
        $robotsContent .= "\n";
        $robotsContent .= "Allow: /\n";
        $robotsContent .= "Allow: /Nosotros\n";
        $robotsContent .= "Allow: /Contacto\n";
        $robotsContent .= "Allow: /Ofertas\n";
        $robotsContent .= "Allow: /Ayuda\n";
        $robotsContent .= "Allow: /Productos\n";
        $robotsContent .= "Allow: /Categorias\n";
        $robotsContent .= "Allow: /Marcas\n";
        $robotsContent .= "Allow: /carousels\n";
        $robotsContent .= "Allow: /suggestions\n";
        $robotsContent .= "Allow: /province\n";
        $robotsContent .= "\n";
        $robotsContent .= "# Permitir acceso a todas las categorías y marcas\n";
        $robotsContent .= "Allow: /categoria/*\n";
        $robotsContent .= "Allow: /marca/*\n";
        $robotsContent .= "\n";
        $robotsContent .= "Sitemap: $baseUrl/sitemap.xml\n"; // Añadir referencia al sitemap index

        file_put_contents(public_path('robots.txt'), $robotsContent);

        $this->info('Sitemap and robots.txt generated successfully with product and service filters.');
    }
}
