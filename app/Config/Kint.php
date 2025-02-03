<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use Kint\Parser\ConstructablePluginInterface;
use Kint\Renderer\AbstractRenderer;
use Kint\Renderer\Rich\TabPluginInterface;
use Kint\Renderer\Rich\ValuePluginInterface;
use Kint\Kint as KintDebugger;

/**
 * --------------------------------------------------------------------------
 * Kint
 * --------------------------------------------------------------------------
 *
 * We use Kint's `RichRenderer` and `CLIRenderer`. This area contains options
 * that you can set to customize how Kint works for you.
 *
 * @see https://kint-php.github.io/kint/ for details on these settings.
 */
class Kint extends BaseConfig
{
    /*
    |--------------------------------------------------------------------------
    | Global Settings
    |--------------------------------------------------------------------------
    */

    /**
     * @var list<class-string<ConstructablePluginInterface>|ConstructablePluginInterface>|null
     */
    public $plugins;

    public $maxDepth = 6;
    public $displayCalledFrom = true;
    public $expanded = false;

    /*
    |--------------------------------------------------------------------------
    | RichRenderer Settings
    |--------------------------------------------------------------------------
    */
    public string $richTheme = 'aante-light.css';
    public bool $richFolder  = false;
    public int $richSort     = 0;

    /**
     * @var array<string, class-string<ValuePluginInterface>>|null
     */
    public $richObjectPlugins;

    /**
     * @var array<string, class-string<TabPluginInterface>>|null
     */
    public $richTabPlugins;

    /*
    |--------------------------------------------------------------------------
    | CLI Settings
    |--------------------------------------------------------------------------
    */
    public bool $cliColors      = true;
    public bool $cliForceUTF8   = false;
    public bool $cliDetectWidth = true;
    public int $cliMinWidth     = 40;

    public function __construct()
    {
        parent::__construct();

        // Disable Kint in production
        if (ENVIRONMENT === 'production') {
            KintDebugger::$enabled_mode = false;
        }

        KintDebugger::$depth_limit = $this->maxDepth;

        if (! $this->displayCalledFrom) {
            KintDebugger::$display_called_from = false;
        }

        if ($this->expanded) {
            KintDebugger::$expanded = true;
        }
    }
}
