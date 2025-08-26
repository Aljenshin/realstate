<?php

namespace App\Console\Commands;

use App\Models\Property;
use Illuminate\Console\Command;

class FixFeaturedImages extends Command
{
    protected $signature = 'fix:featured-images';
    protected $description = 'Fix featured images for all properties';

    public function handle()
    {
        $properties = Property::all();
        $updated = 0;

        foreach ($properties as $property) {
            if (empty($property->featured_image) && $property->images()->count() > 0) {
                $property->update(['featured_image' => $property->images()->first()->path]);
                $updated++;
                $this->info("Updated property: {$property->title}");
            }
        }

        $this->info("Updated {$updated} properties with featured images.");
    }
}
