CREATE TABLE Answers(
    id: int not null,
    question_id: int,
    answer: text,
    foreign key (question_id)
)