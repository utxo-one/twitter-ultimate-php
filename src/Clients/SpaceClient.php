<?php

namespace UtxoOne\TwitterUltimatePhp\Clients;

use UtxoOne\TwitterUltimatePhp\Models\Space;
use UtxoOne\TwitterUltimatePhp\Models\Spaces;

class SpaceClient extends BaseClient
{
    public function getSpace(string $id): Space
    {
        $response = $this->get('spaces/' . $id, [
            'space.fields' => $this->spaceFields,
        ]);

        return new Space($response->getData());
    }

    public function getSpaces(array $ids): Spaces
    {
        $response = $this->get('spaces', [
            'space.fields' => $this->spaceFields,
            'ids' => implode(',', $ids),
        ]);

        return new Spaces($response->getData());
    }
}
