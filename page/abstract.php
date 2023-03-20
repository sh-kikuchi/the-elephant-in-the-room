  <?php
  abstract class Artist {
    public abstract function likeArtist(): string;
  }

  class Idol extends Artist {
    public final function likeArtist(): string {
      return 'ExWHYZ';
    }
  }
  class RockBand extends Artist {
    public final function likeArtist(): string {
      return 'GLAY';
    }
  }
  class ElectroMusicGroup extends Artist {
    public final function likeArtist(): string {
      return 'minus(-)';
    }
  }

  $idol = new Idol();
  print $idol->likeArtist() . '<br />';
  $rockBand = new RockBand();
  print $rockBand->likeArtist() . '<br />';
  $electroMusicGroup = new ElectroMusicGroup();
  print $electroMusicGroup->likeArtist() . '<br />';
