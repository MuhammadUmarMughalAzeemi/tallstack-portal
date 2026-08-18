<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearLookupCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear-lookups {step? : Specific step to clear (programs, personal, qualifications, preferences, all)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear and regenerate lookup data caches by step or all at once';

    /**
     * Step-wise cache keys mapping
     *
     * @var array
     */
    protected $stepCaches = [
        'programs' => [
            'lookup_seat_categories',
            'lookup_programs',
        ],
        'personal' => [
            'lookup_genders',
            'lookup_residence_areas',
            'lookup_nationalities',
            'lookup_districts',
            'lookup_cnic_passports',
        ],
        'qualifications' => [
            'lookup_ssc_exams',
            'lookup_hssc_exams',
            'lookup_mbbs_exams',
            'lookup_mphil_exams',
            'lookup_boards',
            'lookup_institution_types',
        ],
        'preferences' => [
            'lookup_colleges_cat_1',
            'lookup_colleges_cat_2',
            'lookup_colleges_cat_3',
        ],
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $step = $this->argument('step') ?? 'all';

        // Validate step argument
        if ($step !== 'all' && !isset($this->stepCaches[$step])) {
            $this->error("❌ Invalid step: {$step}");
            $this->info('Valid options: programs, personal, qualifications, preferences, all');
            return Command::FAILURE;
        }

        $this->info("🗑️  Clearing lookup caches for: " . strtoupper($step));
        $this->newLine();

        $cleared = 0;

        // Clear specific step or all
        if ($step === 'all') {
            foreach ($this->stepCaches as $stepName => $cacheKeys) {
                $this->line("  📌 Step: " . ucfirst($stepName));
                $cleared += $this->clearCaches($cacheKeys);
                $this->newLine();
            }
        } else {
            $cleared = $this->clearCaches($this->stepCaches[$step]);
        }

        $this->info("✅ Successfully cleared {$cleared} lookup cache(s)!");
        $this->comment('💡 Cache will be regenerated automatically on next page load.');
        $this->newLine();

        return Command::SUCCESS;
    }

    /**
     * Clear given cache keys
     *
     * @param array $cacheKeys
     * @return int Number of caches cleared
     */
    protected function clearCaches(array $cacheKeys): int
    {
        $cleared = 0;
        foreach ($cacheKeys as $key) {
            if (Cache::forget($key)) {
                $cleared++;
                $this->line("    ✓ Cleared: {$key}");
            }
        }
        return $cleared;
    }
}
