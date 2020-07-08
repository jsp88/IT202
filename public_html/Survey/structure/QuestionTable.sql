CREATE TABLE Questions(
    id: int not null,
    survey_id: int not null,
    question: text,
    FOREIGN KEY(survey_id) REFERENCES Survey(`id`)
    )