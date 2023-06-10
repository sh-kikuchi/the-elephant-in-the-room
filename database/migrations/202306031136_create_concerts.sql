CREATE TABLE if not exists `concerts`(
  id int not null primary key AUTO_INCREMENT
  , user_id int not null
  , artist_id int not null
  , name varchar(100)
  , date date
  , place varchar(100)
  , created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  , updated_at DATETIME  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  , FOREIGN KEY(user_id)   REFERENCES users(id)
  , FOREIGN KEY(artist_id) REFERENCES artists(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;