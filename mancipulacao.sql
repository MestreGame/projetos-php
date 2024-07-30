tb_usuarios(
    usu_id,usu_login,usu_email,usu_senha ,usu_status );
    USE mafia;

INSERT INTO tb_usuarios(usu_login, usu_senha , usu_email, usu_status)
VALUES('adminstrador','123','adminstrador.com','4');
INSERT INTO tb_usuarios(usu_login, usu_senha , usu_email, usu_status)
VALUES('adminstrador','123','adminstrador.com','2');
INSERT INTO tb_usuarios(usu_login, usu_senha , usu_email, usu_status)
VALUES('adminstrador','123','adminstrador.com','3');
INSERT INTO tb_usuarios(usu_login, usu_senha , usu_email, usu_status)
VALUES('adminstrador','123','adminstrador.com','5');
INSERT INTO tb_usuarios(usu_login, usu_senha , usu_email, usu_status)
VALUES('adminstrador','123','adminstrador.com','6');
INSERT INTO tb_usuarios(usu_login, usu_senha , usu_email, usu_status)
VALUES('adminstrador','876','adminstrador.com','7');
INSERT INTO tb_usuarios(usu_login, usu_senha , usu_email, usu_status)
VALUES('adminstrador','478','adminstrador.com','8');

USE mafia;
INSERT INTO tb_clientes (cli_id, cli_cpf, cli_cel, cli_nome , cli_status)
VALUES('2','2345678905','1646745683','asta','online'),

INSERT INTO tb_clientes (cli_id, cli_cpf, cli_cel, cli_nome , cli_status)
VALUES('8','23535227895','13543575676','dia','online'),

INSERT INTO tb_clientes (cli_id, cli_cpf, cli_cel, cli_nome , cli_status)
VALUES('7','2464523465','13435667568','bem','online'),

INSERT INTO tb_clientes (cli_id, cli_cpf, cli_cel, cli_nome , cli_status)
VALUES('6','2785674563','14645656786','Ral','online'),

INSERT INTO tb_clientes (cli_id, cli_cpf, cli_cel, cli_nome , cli_status)
VALUES('5','2466322476','14524565466','dragon','online'),

INSERT INTO tb_clientes (cli_id, cli_cpf, cli_cel, cli_nome , cli_status)
VALUES('4','2253454568','13423465478','ggGold','online'),

INSERT INTO tb_clientes (cli_id, cli_cpf, cli_cel, cli_nome , cli_status)
VALUES('3','2243445656','1646978943','maria','online');