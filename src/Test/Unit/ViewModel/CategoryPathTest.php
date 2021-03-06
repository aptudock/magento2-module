<?php

declare(strict_types=1);

namespace Omikron\Factfinder\ViewModel;

use Magento\Catalog\Model\Category;
use Magento\Framework\Registry;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CategoryPathTest extends TestCase
{
    /** @var CategoryPath */
    private $categoryPath;

    /** @var MockObject|Category */
    private $currentCategory;

    public function test_category_path_is_correctly_sorted()
    {
        $this->currentCategory->method('getParentCategories')
            ->willReturn([$this->category('C', 3), $this->category('A', 1), $this->category('B', 2)]);

        $value = 'filterCategoryPathROOT=A,filterCategoryPathROOT%2FA=B,filterCategoryPathROOT%2FA%2FB=C';
        $this->assertSame($value, $this->categoryPath->getValue());
    }

    protected function setUp()
    {
        $this->currentCategory = $this->createMock(Category::class);
        $registry              = new Registry();
        $this->categoryPath    = new CategoryPath($registry);
        $registry->register('current_category', $this->currentCategory);
    }

    private function category(string $name, int $level): Category
    {
        return $this->createConfiguredMock(Category::class, ['getName' => $name, 'getLevel' => $level]);
    }
}
