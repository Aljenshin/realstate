<?php

namespace App\Console\Commands;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Console\Command;

class TestImages extends Command
{
    protected $signature = 'test:images';
    protected $description = 'Test image paths and URLs';

    public function handle()
    {
        $this->info('Testing Property Images...');
        
        $properties = Property::with('images')->take(3)->get();
        
        foreach ($properties as $property) {
            $this->info("Property: {$property->title}");
            $this->info("Featured Image: " . ($property->featured_image ?? 'NULL'));
            $this->info("Featured Image URL: " . ($property->featured_image_url ?? 'NULL'));
            $this->info("Images count: " . $property->images->count());
            
            if ($property->images->count() > 0) {
                $this->info("First image path: " . $property->images->first()->path);
            }
            $this->info('---');
        }
    }
}
