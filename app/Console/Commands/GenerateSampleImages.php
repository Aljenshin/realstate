<?php

namespace App\Console\Commands;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateSampleImages extends Command
{
    protected $signature = 'generate:sample-images {--per=3 : Number of images per property}';
    protected $description = 'Generate sample SVG images in storage and attach them to properties';

    public function handle(): int
    {
        $per = (int) $this->option('per') ?: 3;

        Storage::disk('public')->makeDirectory('sample-images');

        $properties = Property::all();
        if ($properties->isEmpty()) {
            $this->warn('No properties found.');
            return Command::SUCCESS;
        }

        foreach ($properties as $property) {
            // Featured image
            $featuredPath = "sample-images/property-{$property->id}.svg";
            Storage::disk('public')->put($featuredPath, $this->buildSvg("{$property->title}", $property->location ?? 'Location'));
            $property->update(['featured_image' => $featuredPath]);

            // Ensure property has images
            $existing = $property->images()->count();
            if ($existing < $per) {
                for ($i = $existing; $i < $per; $i++) {
                    $imgPath = "sample-images/property-{$property->id}-image-" . ($i + 1) . ".svg";
                    Storage::disk('public')->put($imgPath, $this->buildSvg("Photo " . ($i + 1), $property->location ?? ''));
                    PropertyImage::create([
                        'property_id' => $property->id,
                        'path' => $imgPath,
                        'position' => $i,
                    ]);
                }
            } else {
                // Rewrite paths/files for existing images
                $idx = 0;
                foreach ($property->images as $img) {
                    $imgPath = "sample-images/property-{$property->id}-image-" . (++$idx) . ".svg";
                    Storage::disk('public')->put($imgPath, $this->buildSvg("Photo {$idx}", $property->location ?? ''));
                    $img->update(['path' => $imgPath, 'position' => $idx - 1]);
                }
            }
        }

        $this->info('Sample images generated and linked.');
        $this->line('If images still do not show, ensure the storage symlink exists: php artisan storage:link');
        return Command::SUCCESS;
    }

    private function buildSvg(string $title, string $subtitle = ''): string
    {
        $title = htmlspecialchars($title, ENT_QUOTES);
        $subtitle = htmlspecialchars($subtitle, ENT_QUOTES);
        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="800">
  <defs>
    <linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0%" stop-color="#dbeafe"/>
      <stop offset="100%" stop-color="#ede9fe"/>
    </linearGradient>
  </defs>
  <rect width="100%" height="100%" fill="url(#g)"/>
  <g fill="#475569" font-family="Inter,Arial" text-anchor="middle">
    <text x="600" y="360" font-size="36" font-weight="700">{$title}</text>
    <text x="600" y="410" font-size="20">{$subtitle}</text>
  </g>
</svg>
SVG;
    }
}
