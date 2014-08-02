<?php

namespace TomPHP\SpecificationExample\MemoryRepository;

use TomPHP\SpecificationExample\Application\Video;
use TomPHP\SpecificationExample\Application\Repository\VideoRepository;
use TomPHP\SpecificationExample\Application\Specification\Specification;

final class MemoryVideoRepository implements VideoRepository
{
    /** @var Video[] */
    private $videos = [];

    public function save(Video $video)
    {
        $this->videos[] = $video;
    }

    public function fetchAll()
    {
        return $this->videos;
    }

    /** @returns Video[] */
    public function fetchBySpecifcation(Specification $specification)
    {
        return array_filter(
            $this->fetchAll(),
            function (Video $video) use ($specification) {
                return $specification->isSatisfiedBy($video);
            }
        );
    }
}
