<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('/search-reduce', name: 'search-reduce')]
    public function search() : JsonResponse
    {
        $products = $this->getProducts();
        $filter = $this->getFilter();

        //        $time_start = microtime(true);

        [$operator, $field, $searchParam] = $filter;

        $result = array_reduce($products, function ($carry, array $item) use ($operator, $field, $searchParam) {
            $data = match ($operator) {
                'lt'    => $item[$field] < $searchParam ? $item : null,
                'gt'    => $item[$field] > $searchParam ? $item : null,
                'eq'    => $item[$field] === $searchParam ? $item : null,
                'neq'   => $item[$field] !== $searchParam ? $item : null,
                default => null,
            };

            if (! is_null($data)) {
                $carry[] = $data;
            }

            return $carry;
        }, []);

        usort($result, fn ($a, $b) : int => $a[$field] <=> $b[$field]);

        //        $time_end = microtime(true);

        //        dd(($time_end - $time_start)/60);

        return new JsonResponse($result);
    }

    #[Route('/search-generator', name: 'search-generator')]
    public function searchGenerator() : JsonResponse
    {
        $products = $this->getProducts();
        $filter = $this->getFilter();

        //        $time_start = microtime(true);

        $generator = function ($values) {
            foreach ($values as $value) {
                yield $value;
            }
        };

        [$operator, $field, $searchParam] = $filter;

        $products = $generator($products);
        $result = [];
        while ($products->valid()) {
            $item = $products->current();
            $data = match ($operator) {
                'lt'    => $item[$field] < $searchParam ? $item : null,
                'gt'    => $item[$field] > $searchParam ? $item : null,
                'eq'    => $item[$field] === $searchParam ? $item : null,
                'neq'   => $item[$field] !== $searchParam ? $item : null,
                default => null,
            };

            if (! is_null($data)) {
                $result[] = $data;
            }

            $products->next();
        }

        usort($result, fn ($a, $b) : int => $a[$field] <=> $b[$field]);

        //        $time_end = microtime(true);

        //        dd(($time_end - $time_start)/60);

        return new JsonResponse($result);
    }

    /**
     * @return string[]
     */
    protected function getFilter() : array
    {
        //        $filter = ['gt', 'price', 200];
        $filter = ['gt', 'quantity', 4];
        //        $filter = ['eq', 'name', 'T-Shirt'];
        //        $filter = ['eq', 'quantity', 2];
        //        $filter = ['eq', 'quantity', 5];
        //        $filter = ['neq', 'price', 100];
        //        $filter = ['eq', 'price', 100];

        return $filter;
    }

    /**
     * @return string[][]
     */
    protected function getProducts() : array
    {
        return [
            ['name' => 'Trousers', 'price' => 2000, 'quantity' => 5],
            ['name' => 'Pollover', 'price' => 250, 'quantity' => 6],
            ['name' => 'T-Shirt', 'price' => 150, 'quantity' => 5],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 5],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 5],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 111', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 11', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1111', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
            ['name' => 'products 1', 'price' => 100, 'quantity' => 2],
        ];
    }
}
