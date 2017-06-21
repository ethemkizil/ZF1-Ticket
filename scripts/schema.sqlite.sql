CREATE TABLE ticket (
    id       INTEGER       PRIMARY KEY AUTOINCREMENT,
    title    VARCHAR (300),
    detail   TEXT,
    priority INTEGER (2),
    attachment VARCHAR (300),
    created  DATETIME
);

CREATE INDEX "id" ON "ticket" ("id");