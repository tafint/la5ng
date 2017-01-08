<?php namespace App\Http\Controllers;

use Chaos\Common\AbstractLaravelRestController;

/**
 * Class Controller
 * @author ntd1712
 */
abstract class Controller extends AbstractLaravelRestController
{
    /** {@inheritdoc} */
    public function __construct()
    {
        $config = glob(($basePath = base_path()) . '/modules/*/settings.yml', GLOB_NOSORT);
        array_unshift($config, $basePath . '/modules/settings.yml');

        $config['__options__'] = [
            'cache_path' => $basePath . '/storage/framework/cache',
            'replacements' => [
                'base_path' => $basePath,
                'base_url' => config('app.url')
            ]
        ];

        parent::__construct($config, glob($basePath . '/modules/*/services.yml', GLOB_NOSORT));
    }
}