<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Helpers\LocalizationHelper;

class LocalizationCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'localization
                            {action : The action to perform (cache|clear|missing|list)}
                            {--locale= : Specific locale to work with}
                            {--force : Force the action without confirmation}';

    /**
     * The console command description.
     */
    protected $description = 'Manage application localization';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');
        $locale = $this->option('locale');
        $force = $this->option('force');

        switch ($action) {
            case 'cache':
                $this->cacheTranslations($locale, $force);
                break;
            case 'clear':
                $this->clearCache($locale, $force);
                break;
            case 'missing':
                $this->showMissingTranslations($locale);
                break;
            case 'list':
                $this->listLocales();
                break;
            default:
                $this->error("Unknown action: {$action}");
                $this->showHelp();
                return 1;
        }

        return 0;
    }

    /**
     * Cache translations
     */
    private function cacheTranslations(?string $locale, bool $force): void
    {
        $locales = $locale ? [$locale] : array_keys(LocalizationHelper::getAvailableLocales());
        
        if (!$force && !$this->confirm('This will cache translations for all locales. Continue?')) {
            $this->info('Operation cancelled.');
            return;
        }

        $this->info('Caching translations...');
        
        foreach ($locales as $localeCode) {
            LocalizationHelper::cacheTranslations($localeCode);
            $this->line("✓ Cached translations for: {$localeCode}");
        }
        
        $this->info('Translation caching completed!');
    }

    /**
     * Clear translation cache
     */
    private function clearCache(?string $locale, bool $force): void
    {
        if (!$force && !$this->confirm('This will clear translation cache. Continue?')) {
            $this->info('Operation cancelled.');
            return;
        }

        $this->info('Clearing translation cache...');
        
        LocalizationHelper::clearTranslationCache($locale);
        
        if ($locale) {
            $this->line("✓ Cleared cache for: {$locale}");
        } else {
            $this->line("✓ Cleared cache for all locales");
        }
        
        $this->info('Cache clearing completed!');
    }

    /**
     * Show missing translations
     */
    private function showMissingTranslations(?string $locale): void
    {
        $locales = $locale ? [$locale] : array_keys(LocalizationHelper::getAvailableLocales());
        
        $this->info('Checking for missing translations...');
        $this->newLine();
        
        foreach ($locales as $localeCode) {
            $missing = LocalizationHelper::getMissingTranslations($localeCode);
            
            if (empty($missing)) {
                $this->line("✓ {$localeCode}: No missing translations");
            } else {
                $this->warn("⚠ {$localeCode}: " . count($missing) . " missing translations");
                
                if ($this->option('verbose')) {
                    foreach ($missing as $key) {
                        $this->line("  - {$key}");
                    }
                }
            }
        }
    }

    /**
     * List available locales
     */
    private function listLocales(): void
    {
        $locales = LocalizationHelper::getAvailableLocales();
        $currentLocale = LocalizationHelper::getCurrentLocale();
        
        $this->info('Available locales:');
        $this->newLine();
        
        $headers = ['Code', 'Name', 'Native', 'Flag', 'Direction', 'Current'];
        $rows = [];
        
        foreach ($locales as $code => $info) {
            $rows[] = [
                $code,
                $info['name'],
                $info['native'],
                $info['flag'],
                $info['direction'],
                $code === $currentLocale ? '✓' : '',
            ];
        }
        
        $this->table($headers, $rows);
    }

    /**
     * Show help information
     */
    private function showHelp(): void
    {
        $this->info('Available actions:');
        $this->line('  cache   - Cache translations for better performance');
        $this->line('  clear   - Clear translation cache');
        $this->line('  missing - Show missing translations');
        $this->line('  list    - List all available locales');
        $this->newLine();
        $this->info('Options:');
        $this->line('  --locale=code  - Work with specific locale only');
        $this->line('  --force        - Skip confirmation prompts');
        $this->line('  --verbose      - Show detailed output');
    }
}

