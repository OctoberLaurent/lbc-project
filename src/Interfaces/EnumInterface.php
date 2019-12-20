<?php

namespace App\Interfaces;

interface EnumInterface
{
    /**
     * Get one of enum
     *
     * @param string $item
     * @return sting
     */
    public static function get($item): string;
    
    /**
     * Get list of enum
     *
     * @return array
     */
    public static function getAll(bool $flip=false): array;
}