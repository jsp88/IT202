CREATE TABLE Users(
    id: int not null unique,
    email: varchar(100),
    name: varchar(50),
    PRIMARY KEY (id)
    )