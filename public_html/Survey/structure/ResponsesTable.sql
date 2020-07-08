CREATE TABLE Responses(
    id: int not null,
    survey_id: int,
    question_id: int,
    answer_id: int,
    surveytime: datetime,
    user_id: int,
    FOREIGN KEY(survey_id) REFERENCES Survey(`id`),
    FOREIGN KEY(user_id) REFERENCES Users(`id`)
    )