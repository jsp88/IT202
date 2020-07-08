CREATE TABLE Survey(
    id: int not null,
    user_id: int,
    surveytime: datetime,
    cached_taken_count: int,
    FOREIGN KEY (user_id) REFERENCES Users(`id`)
    )