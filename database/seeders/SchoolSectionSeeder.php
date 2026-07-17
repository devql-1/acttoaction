<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolSection;
use App\Models\SchoolPartnerCategory;
use App\Models\SchoolPartner;

class SchoolSectionSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Create Sections ────────────────────────────────
        $curriculum = SchoolSection::firstOrCreate(
            ['slug' => 'curriculum'],
            [
                'name'        => 'Curriculum',
                'description' => 'Schools partnered with Threat Expert for our core curriculum programme.',
                'sort_order'  => 1,
                'status'      => true,
            ]
        );

        $dfd = SchoolSection::firstOrCreate(
            ['slug' => 'dfd'],
            [
                'name'        => 'DFD',
                'description' => 'Schools enrolled in the Design for Development (DFD) initiative.',
                'sort_order'  => 2,
                'status'      => true,
            ]
        );

        // ── 2. Assign existing categories to Curriculum ───────
        SchoolPartnerCategory::whereIn('slug', ['cbse-schools', 'icse-schools', 'international-schools'])
            ->update(['school_section_id' => $curriculum->id]);

        // ── 3. Create DFD-specific categories ─────────────────
        $dfdPrimary = SchoolPartnerCategory::firstOrCreate(
            ['slug' => 'dfd-primary'],
            [
                'school_section_id' => $dfd->id,
                'name'              => 'Primary Schools',
                'sort_order'        => 1,
                'status'            => true,
            ]
        );

        $dfdSecondary = SchoolPartnerCategory::firstOrCreate(
            ['slug' => 'dfd-secondary'],
            [
                'school_section_id' => $dfd->id,
                'name'              => 'Secondary Schools',
                'sort_order'        => 2,
                'status'            => true,
            ]
        );

        // ── 4. DFD dummy schools ───────────────────────────────
        $dfdSchools = [
            // Primary
            [
                'category_id' => $dfdPrimary->id,
                'name'        => 'Sunrise Primary School',
                'logo_path'   => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=400&q=60',
                'sort_order'  => 1,
            ],
            [
                'category_id' => $dfdPrimary->id,
                'name'        => 'Green Valley School',
                'logo_path'   => 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=400&q=60',
                'sort_order'  => 2,
            ],
            [
                'category_id' => $dfdPrimary->id,
                'name'        => 'Little Scholars',
                'logo_path'   => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=400&q=60',
                'sort_order'  => 3,
            ],
            [
                'category_id' => $dfdPrimary->id,
                'name'        => 'Rainbow Kids School',
                'logo_path'   => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=400&q=60',
                'sort_order'  => 4,
            ],

            // Secondary
            [
                'category_id' => $dfdSecondary->id,
                'name'        => 'Horizon High School',
                'logo_path'   => 'https://images.unsplash.com/photo-1571260899304-425eee4c7efc?w=400&q=60',
                'sort_order'  => 1,
            ],
            [
                'category_id' => $dfdSecondary->id,
                'name'        => 'Excel Academy',
                'logo_path'   => 'https://images.unsplash.com/photo-1562774053-701939374585?w=400&q=60',
                'sort_order'  => 2,
            ],
            [
                'category_id' => $dfdSecondary->id,
                'name'        => 'Vision Public School',
                'logo_path'   => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=400&q=60',
                'sort_order'  => 3,
            ],
            [
                'category_id' => $dfdSecondary->id,
                'name'        => 'National High School',
                'logo_path'   => 'https://images.unsplash.com/photo-1588072432836-e10032774350?w=400&q=60',
                'sort_order'  => 4,
            ],
        ];

        foreach ($dfdSchools as $school) {
            SchoolPartner::firstOrCreate(
                ['category_id' => $school['category_id'], 'name' => $school['name']],
                array_merge($school, ['status' => true])
            );
        }

        $this->command->info('Sections seeded:');
        $this->command->info('  → Curriculum (3 categories, ' . SchoolPartner::whereIn('category_id', SchoolPartnerCategory::where('school_section_id', $curriculum->id)->pluck('id'))->count() . ' schools)');
        $this->command->info('  → DFD        (2 categories, ' . SchoolPartner::whereIn('category_id', SchoolPartnerCategory::where('school_section_id', $dfd->id)->pluck('id'))->count() . ' schools)');
    }
}
