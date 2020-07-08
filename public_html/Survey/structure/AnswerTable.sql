CREATE TABLE Answers(
    id: int not null,
    question_id: int,
    answer: text,
    FOREIGN KEY(question_id)  REFERENCES Questions(`id`)
    )