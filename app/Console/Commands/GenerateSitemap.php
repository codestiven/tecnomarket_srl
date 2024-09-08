<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Producto;

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
    protected $description = 'Generate the sitemap for the website including productos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Crear un nuevo sitemap
        $sitemap = Sitemap::create()
            ->add(Url::create('/')
                ->setPriority(1.0))
            ->add(Url::create('/MiCarrito')
                ->setPriority(0.8))
            ->add(Url::create('/Nosotros')
                ->setPriority(0.8))
            ->add(Url::create('/Contacto')
                ->setPriority(0.7))
            ->add(Url::create('/Ofertas')
                ->setPriority(0.7))
            ->add(Url::create('/Ayuda')
                ->setPriority(0.6))
            ->add(Url::create('/Productos')
                ->setPriority(0.9));

        // Obtener los productos desde la base de datos usando el modelo Producto
        $productos = Producto::all();

        // Agregar cada producto al sitemap
        foreach ($productos as $producto) {
            $sitemap->add(Url::create("/Productos/{$producto->id}") // Usar el slug o id según lo que tengas disponible
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)); // Opcional: frecuencia de cambio
        }

        // Guardar el sitemap en un archivo
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generado con éxito, incluyendo productos.');
    }
}
