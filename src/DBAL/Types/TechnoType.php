<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class TechnoType extends AbstractEnumType
{
    final public const BACK = 'back';
    final public const FRONT = 'front';

    protected static array $choices = [
        self::BACK => 'Back',
        self::FRONT => 'Front',
    ];
}
