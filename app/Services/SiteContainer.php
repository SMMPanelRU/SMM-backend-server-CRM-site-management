<?php

namespace App\Services;

use App\Models\Site;

class SiteContainer
{
    private ?Site $site = null;

    public function getSite(): ?Site
    {
        return $this->site;
    }

    public function setSite(Site $site): static
    {
        $this->site = $site;

        return $this;
    }
}
