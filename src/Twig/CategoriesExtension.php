<?php

namespace App\Twig;

use App\Repository\CategoriesRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class CategoriesExtension extends AbstractExtension
{

    private $repo;

    public function __construct(CategoriesRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('Categories', [$this, 'getCategories']),
        ];
    }

    public function getCategories()
    {
        return $this->repo->findAll();
    }
}
