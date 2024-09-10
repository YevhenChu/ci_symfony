<?php

declare(strict_types=1);

use Symfony\Bundle\MakerBundle\MakerBundle;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle;

return [
    FrameworkBundle::class          => ['all' => true],
    MakerBundle::class              => ['dev' => true],
    DoctrineBundle::class           => ['all' => true],
    DoctrineMigrationsBundle::class => ['all' => true],
];
