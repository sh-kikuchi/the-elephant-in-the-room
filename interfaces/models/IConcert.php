<?php

namespace app\models;

use app\classes\ConcertRequest;

interface IConcert {

    public function show(): array;

    public function getConcert(int $id): array;

    public function create(ConcertRequest $concert_request): bool;

    public function update(ConcertRequest $concert_request): bool;

    public function delete(ConcertRequest $concert_request): bool;
}
