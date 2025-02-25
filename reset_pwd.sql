ALTER TABLE users
    ADD user_reset_token VARCHAR(255) NULL AFTER user_pwd,
    ADD user_reset_date DATETIME NULL AFTER user_reset_token,
    ADD user_reset_exp_date DATETIME NULL AFTER user_reset_date;