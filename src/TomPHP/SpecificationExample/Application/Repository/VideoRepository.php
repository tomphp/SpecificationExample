<?php

namespace TomPHP\SpecificationExample\Application\Repository;

use TomPHP\SpecificationExample\Application\Video;
use TomPHP\SpecificationExample\Application\Specification\Specification;

interface VideoRepository
{
    public function save(Video $video);

    /** @returns Video[] */
    public function fetchAll();

    /** @returns Video[] */
    public function fetchBySpecifcation(Specification $specification);
}
