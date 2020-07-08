CREATE TABLE Responses(
    id: int not null,
    survey_id: int,
    question_id: int,
    answer_id: int,
    surveytime: datetime,
    user_id: int,
    foreign key(survey_id)  REFERENCES Survey(`id`),
    foreign key(user_id) REFERENCES Users(`id`)
)