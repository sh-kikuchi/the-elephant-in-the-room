<?php

namespace app\models;

use app\classes\ArtistConcertRequest;

interface IArtistConcert {

    public function show(): array;

    public function create(ArtistConcertRequest $artist_concert_request): bool;

    public function delete(ArtistConcertRequest $artist_concert_request): bool;
}
