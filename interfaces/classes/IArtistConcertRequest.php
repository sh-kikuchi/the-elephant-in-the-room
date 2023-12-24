<?php

namespace app\classes;

interface IArtistConcertRequest {
    public function setId($id);
    public function setArtistId($artist_id);
    public function setConcertId($concert_id);

    public function getId();
    public function getArtistId();
    public function getConcertId();

    public function getArrayData();

    public function postValidation();
    public function searchArtistConcertData();
}
