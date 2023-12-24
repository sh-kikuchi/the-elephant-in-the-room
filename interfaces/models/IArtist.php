<?php
namespace app\models;

use app\classes\ArtistRequest;

interface IArtist {

    public function show(): array;

    public function getArtist($id): object;

    public function create(ArtistRequest $artist_request): bool;

    public function update(ArtistRequest $artist_request): bool;

    public function delete(ArtistRequest $artist_request): bool;
}
