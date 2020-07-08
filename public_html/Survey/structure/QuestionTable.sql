CREATE TABLE Questions(
    id: int not null,
    survey_id: int not null,
    question: text,
    foreign key(survey_id)
)