CREATE SCHEMA sprint_database;

CREATE  TABLE sprint_database.client ( 
	client_id            INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	first_name           VARCHAR(100)       ,
	last_name            VARCHAR(100)       ,
	street_number        INT       ,
	street_name          VARCHAR(100)       ,
	postal_code          INT       ,
	tel                  INT       ,
	mail                 VARCHAR(100)       ,
	proffession          VARCHAR(100)       ,
	family_situation     VARCHAR(100)       ,
	total_balance        INT       ,
	total_overdraft      INT       
 ) engine=InnoDB;

CREATE  TABLE sprint_database.compte ( 
	compte_id            INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	balance              INT       ,
	open_date            DATE       
 ) engine=InnoDB;

CREATE  TABLE sprint_database.compte_client_assignment ( 
	compte_client_assignment_id INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	client_id            INT       ,
	compte_id            INT       ,
	CONSTRAINT unq_compte_client_assignment_client_id UNIQUE ( client_id ) ,
	CONSTRAINT unq_compte_client_assignment_compte_id UNIQUE ( compte_id ) 
 ) engine=InnoDB;

CREATE  TABLE sprint_database.comptetype ( 
	comptetype_id        INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	type_name            VARCHAR(100)       ,
	motive_id            INT       ,
	CONSTRAINT unq_comptetype_motive_id UNIQUE ( motive_id ) 
 ) engine=InnoDB;

CREATE  TABLE sprint_database.comptetype_compte_assignment ( 
	comptetype_compte_assignment_id INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	compte_id            INT       ,
	comptetype_id        INT       ,
	CONSTRAINT unq_comptetype_compte_assignment_comptetype_id UNIQUE ( comptetype_id ) ,
	CONSTRAINT unq_comptetype_compte_assignment_compte_id UNIQUE ( compte_id ) 
 ) engine=InnoDB;

CREATE  TABLE sprint_database.contrat ( 
	contart_id           INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	contrat_tarif        INT       ,
	open_date            DATE       
 ) engine=InnoDB;

CREATE  TABLE sprint_database.documents ( 
	documents_id         INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	document_name        VARCHAR(100)       
 ) engine=InnoDB;

CREATE  TABLE sprint_database.employee ( 
	employee_id          INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	first_name           VARCHAR(100)       ,
	last_name            VARCHAR(100)       ,
	username             VARCHAR(100)       ,
	password             VARCHAR(100)       
 ) engine=InnoDB;

CREATE  TABLE sprint_database.employee_client_assignment ( 
	employee_client_assignment_index INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	employee_id          INT       ,
	client_id            INT       ,
	CONSTRAINT unq_employee_client_assignment_client_id UNIQUE ( client_id ) ,
	CONSTRAINT unq_employee_client_assignment_employee_id UNIQUE ( employee_id ) 
 ) engine=InnoDB;

CREATE  TABLE sprint_database.motive ( 
	motive_id            INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	motive_name          VARCHAR(100)       
 ) engine=InnoDB;

CREATE  TABLE sprint_database.motive_documents ( 
	motive_documents_id  INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	motive_id            INT       ,
	documents_id         INT       ,
	CONSTRAINT unq_motive_documents_motive_id UNIQUE ( motive_id ) ,
	CONSTRAINT unq_motive_documents_documents_id UNIQUE ( documents_id ) 
 ) engine=InnoDB;

CREATE  TABLE sprint_database.role_types ( 
	role_id              INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	role_name            VARCHAR(100)       
 ) engine=InnoDB;

CREATE  TABLE sprint_database.time_slot ( 
	time_slot_id         INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	`date`               DATE       ,
	week                 INT       ,
	start_time           TIME       ,
	end_time             TIME       ,
	name                 VARCHAR(100)       ,
	available            BOOLEAN       
 ) engine=InnoDB;

CREATE  TABLE sprint_database.client_contrat_assignment ( 
	client_contrat_assignment_id INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	client_id            INT       ,
	contrat_id           INT       ,
	CONSTRAINT unq_client_contrat_assignment_client_id UNIQUE ( client_id ) ,
	CONSTRAINT unq_client_contrat_assignment_contrat_id UNIQUE ( contrat_id ) 
 ) engine=InnoDB;

CREATE  TABLE sprint_database.contrattype ( 
	contrattype_id       INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	contrattype_name     VARCHAR(100)       ,
	motive_id            INT       ,
	CONSTRAINT unq_contrattype_motive_id UNIQUE ( motive_id ) 
 ) engine=InnoDB;

CREATE  TABLE sprint_database.contrattype_contrat_assignemnt ( 
	contrattype_contrat_assignemnt_id INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	contrat_type_id      INT       ,
	contrat_id           INT       ,
	CONSTRAINT unq_contrattype_contrat_assignemnt_contrat_type_id UNIQUE ( contrat_type_id ) ,
	CONSTRAINT unq_contrattype_contrat_assignemnt_contrat_id UNIQUE ( contrat_id ) 
 ) engine=InnoDB;

CREATE  TABLE sprint_database.employee_role_assignment ( 
	employee_role_assignment_id INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	employee_id          INT    NOT NULL   ,
	role_id              INT       ,
	CONSTRAINT unq_employee_role_assignment_employee_id UNIQUE ( employee_id ) ,
	CONSTRAINT unq_employee_role_assignment_role_id UNIQUE ( role_id ) 
 ) engine=InnoDB;

CREATE  TABLE sprint_database.rdv ( 
	rdv_id               INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	time_slot_id         INT       ,
	client_id            INT       ,
	employee_id          INT       ,
	motive_id            INT       ,
	approved             BOOLEAN       ,
	CONSTRAINT unq_rdv_time_slot_id UNIQUE ( time_slot_id ) ,
	CONSTRAINT unq_rdv_client_id UNIQUE ( client_id ) ,
	CONSTRAINT unq_rdv_employee_id UNIQUE ( employee_id ) ,
	CONSTRAINT unq_rdv_motive_id UNIQUE ( motive_id ) 
 ) engine=InnoDB;

ALTER TABLE sprint_database.client_contrat_assignment ADD CONSTRAINT fk_client_contrat_assignment_client FOREIGN KEY ( client_id ) REFERENCES sprint_database.client( client_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.client_contrat_assignment ADD CONSTRAINT fk_client_contrat_assignment_contrat FOREIGN KEY ( contrat_id ) REFERENCES sprint_database.contrat( contart_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.compte_client_assignment ADD CONSTRAINT fk_compte_client_assignment_client FOREIGN KEY ( client_id ) REFERENCES sprint_database.client( client_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.compte_client_assignment ADD CONSTRAINT fk_compte_client_assignment_compte FOREIGN KEY ( compte_id ) REFERENCES sprint_database.compte( compte_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.comptetype_compte_assignment ADD CONSTRAINT fk_comptetype_compte_assignment_compte FOREIGN KEY ( compte_id ) REFERENCES sprint_database.compte( compte_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.comptetype_compte_assignment ADD CONSTRAINT fk_comptetype_compte_assignment_comptetype FOREIGN KEY ( comptetype_id ) REFERENCES sprint_database.comptetype( comptetype_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.contrattype ADD CONSTRAINT fk_contrattype_motive FOREIGN KEY ( motive_id ) REFERENCES sprint_database.motive( motive_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.contrattype_contrat_assignemnt ADD CONSTRAINT fk_contrattype_contrat_assignemnt_contrat FOREIGN KEY ( contrat_id ) REFERENCES sprint_database.contrat( contart_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.contrattype_contrat_assignemnt ADD CONSTRAINT fk_contrattype_contrat_assignemnt_contrattype FOREIGN KEY ( contrat_type_id ) REFERENCES sprint_database.contrattype( contrattype_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.employee_client_assignment ADD CONSTRAINT fk_employee_client_assignment_employee FOREIGN KEY ( employee_id ) REFERENCES sprint_database.employee( employee_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.employee_client_assignment ADD CONSTRAINT fk_employee_client_assignment_client FOREIGN KEY ( client_id ) REFERENCES sprint_database.client( client_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.employee_role_assignment ADD CONSTRAINT fk_employee_role_assignment_role_types FOREIGN KEY ( role_id ) REFERENCES sprint_database.role_types( role_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.employee_role_assignment ADD CONSTRAINT fk_employee_role_assignment_employee FOREIGN KEY ( employee_role_assignment_id ) REFERENCES sprint_database.employee( employee_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.motive_documents ADD CONSTRAINT fk_motive_documents_comptetype FOREIGN KEY ( motive_id ) REFERENCES sprint_database.comptetype( motive_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.motive_documents ADD CONSTRAINT fk_motive_documents_motive FOREIGN KEY ( motive_id ) REFERENCES sprint_database.motive( motive_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.motive_documents ADD CONSTRAINT fk_motive_documents_documents FOREIGN KEY ( documents_id ) REFERENCES sprint_database.documents( documents_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.rdv ADD CONSTRAINT fk_rdv_employee FOREIGN KEY ( employee_id ) REFERENCES sprint_database.employee( employee_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.rdv ADD CONSTRAINT fk_rdv_client FOREIGN KEY ( client_id ) REFERENCES sprint_database.client( client_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.rdv ADD CONSTRAINT fk_rdv_time_slot FOREIGN KEY ( time_slot_id ) REFERENCES sprint_database.time_slot( time_slot_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.rdv ADD CONSTRAINT fk_rdv_motive FOREIGN KEY ( motive_id ) REFERENCES sprint_database.motive( motive_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.client COMMENT 'you might not need total balance and total overdraft';

ALTER TABLE sprint_database.motive_documents MODIFY motive_id INT     COMMENT 'Dit-moi en personne que tu as lu ceci et je t''offrirai un cookie.';

ALTER TABLE sprint_database.time_slot MODIFY week INT     COMMENT 'i''m not sure how "week" is supposed to function';

