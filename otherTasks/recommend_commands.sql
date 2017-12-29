-- Создает view с парами форм, принадлежащих одному пользователю
CREATE VIEW form_pairs AS
    SELECT U1.user_id, U1.form_id AS form_1, U2.form_id AS form_2
    FROM user_form AS U1, user_form AS U2
    WHERE U1.user_id = U2.user_id
    AND U1.form_id < U2.form_id;

-- Выстраивает таблицу пар по их популярности
SELECT P1.form_1, P2.form_2, COUNT(*) AS pairCount
    FROM form_pairs AS P1, form_pairs AS P2
    WHERE P1.user_id < P2.user_id
    AND P1.form_1 = P2.form_1
    AND P1.form_2 = P2.form_2
    GROUP BY P1.form_1, P2.form_2
    ORDER BY pairCount DESC;
