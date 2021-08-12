SELECT users.name, COUNT(phones.id)FROM test.users users
                                    JOIN test.phone_numbers phones ON phones.user_id = users.id
WHERE  users.gender = 2 AND TIMESTAMPDIFF(YEAR, FROM_UNIXTIME(users.birth_date), NOW()) BETWEEN 18 AND 22
GROUP BY phones.user_id;

