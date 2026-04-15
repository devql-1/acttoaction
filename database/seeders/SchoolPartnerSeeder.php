<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolPartnerCategory;
use App\Models\SchoolPartner;

class SchoolPartnerSeeder extends Seeder
{
    public function run(): void
    {
        // ── Categories ────────────────────────────────────────────
        $categories = [
            ['name' => 'CBSE Schools',          'slug' => 'cbse-schools',          'sort_order' => 1],
            ['name' => 'ICSE Schools',           'slug' => 'icse-schools',          'sort_order' => 2],
            ['name' => 'International Schools',  'slug' => 'international-schools', 'sort_order' => 3],
        ];

        foreach ($categories as $cat) {
            SchoolPartnerCategory::firstOrCreate(
                ['slug' => $cat['slug']],
                array_merge($cat, ['status' => true])
            );
        }

        $cbse  = SchoolPartnerCategory::where('slug', 'cbse-schools')->first();
        $icse  = SchoolPartnerCategory::where('slug', 'icse-schools')->first();
        $intl  = SchoolPartnerCategory::where('slug', 'international-schools')->first();

        // ── School partners with Unsplash education images ────────
        $schools = [
            // CBSE Schools
            [
                'category_id' => $cbse->id,
                'name'        => 'Delhi Public School',
                'logo_path'   => 'https://images.unsplash.com/photo-1562774053-701939374585?w=400&q=60',
                'sort_order'  => 1,
            ],
            [
                'category_id' => $cbse->id,
                'name'        => 'Maharaja School',
                'logo_path'   => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=400&q=60',
                'sort_order'  => 2,
            ],
            [
                'category_id' => $cbse->id,
                'name'        => 'Ryan International',
                'logo_path'   => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=400&q=60',
                'sort_order'  => 3,
            ],
            [
                'category_id' => $cbse->id,
                'name'        => 'Tagore Public School',
                'logo_path'   => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=400&q=60',
                'sort_order'  => 4,
            ],
            [
                'category_id' => $cbse->id,
                'name'        => 'Modern School',
                'logo_path'   => 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=400&q=60',
                'sort_order'  => 5,
            ],

            // ICSE Schools
            [
                'category_id' => $icse->id,
                'name'        => "St. Xavier's School",
                'logo_path'   => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=400&q=60',
                'sort_order'  => 1,
            ],
            [
                'category_id' => $icse->id,
                'name'        => 'Bal Bharati School',
                'logo_path'   => 'https://images.unsplash.com/photo-1571260899304-425eee4c7efc?w=400&q=60',
                'sort_order'  => 2,
            ],
            [
                'category_id' => $icse->id,
                'name'        => 'Vidyashram School',
                'logo_path'   => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=400&q=60',
                'sort_order'  => 3,
            ],
            [
                'category_id' => $icse->id,
                'name'        => 'Seedling School',
                'logo_path'   => 'https://images.unsplash.com/photo-1588072432836-e10032774350?w=400&q=60',
                'sort_order'  => 4,
            ],

            // International Schools
            [
                'category_id' => $intl->id,
                'name'        => 'Podar World School',
                'logo_path'   => 'https://images.unsplash.com/photo-1540553016722-983e48a2cd10?w=400&q=60',
                'sort_order'  => 1,
            ],
            [
                'category_id' => $intl->id,
                'name'        => 'Cambridge School',
                'logo_path'   => 'https://images.unsplash.com/photo-1598618443855-232ee0f819f6?w=400&q=60',
                'sort_order'  => 2,
            ],
            [
                'category_id' => $intl->id,
                'name'        => 'Apex Academy',
                'logo_path'   => 'https://images.unsplash.com/photo-1584697964358-3e14ca57658b?w=400&q=60',
                'sort_order'  => 3,
            ],
            [
                'category_id' => $intl->id,
                'name'        => 'Heritage School',
                'logo_path'   => 'https://images.unsplash.com/photo-1567168544813-cc03465b4fa8?w=400&q=60',
                'sort_order'  => 4,
            ],
        ];

        foreach ($schools as $school) {
            SchoolPartner::firstOrCreate(
                ['category_id' => $school['category_id'], 'name' => $school['name']],
                array_merge($school, ['status' => true])
            );
        }

        $this->command->info('School partners seeded: 3 categories, 13 schools.');
    }
}
