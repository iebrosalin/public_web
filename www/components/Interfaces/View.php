<?php
declare(strict_types=1);


namespace Components\Interfaces;

/**
 * Interface View
 *
 * @package Components\Interfaces
 */
interface View
{
    /**
     * @param  string $path
     * @param  array  $options
     * @return mixed
     */
    public static function render(string $path, array $options);
}
