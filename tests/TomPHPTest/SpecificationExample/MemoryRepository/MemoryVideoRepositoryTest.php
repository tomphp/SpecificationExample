<?php

namespace TomPHPTest\SpecificationExample\MemoryRepository;

use TomPHPTest\SpecificationExample\Repository\VideoRepositoryTest;
use TomPHP\SpecificationExample\MemoryRepository\MemoryVideoRepository;

final class MemoryVideoRepositoryTest extends VideoRepositoryTest
{
    protected function setUp()
    {
        $this->repository = new MemoryVideoRepository();

        parent::setUp();
    }
}
