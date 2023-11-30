CREATE SCHEMA sprint_database;

CREATE  TABLE sprint_database.client_contrat_assignment ( 
	client_contrat_assignment_id INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	client_id            INT       ,
	contrat_id           INT       ,
	CONSTRAINT unq_client_contrat_assignment_client_id UNIQUE ( client_id ) ,
	CONSTRAINT unq_client_contrat_assignment_contrat_id UNIQUE ( contrat_id ) 
 ) engine=InnoDB;

CREATE  TABLE sprint_database.compte_client_assignment ( 
	compte_client_assignment_id INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	client_id            INT       ,
	compte_id            INT       ,
	CONSTRAINT unq_compte_client_assignment_client_id UNIQUE ( client_id ) ,
	CONSTRAINT unq_compte_client_assignment_compte_id UNIQUE ( compte_id ) 
 ) engine=InnoDB;

CREATE  TABLE sprint_database.comptetype_compte_assignment ( 
	comptetype_compte_assignment_id INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	compte_id            INT       ,
	comptetype_id        INT       ,
	CONSTRAINT unq_comptetype_compte_assignment_comptetype_id UNIQUE ( comptetype_id ) ,
	CONSTRAINT unq_comptetype_compte_assignment_compte_id UNIQUE ( compte_id ) 
 ) engine=InnoDB;

CREATE  TABLE sprint_database.contrattype_contrat_assignemnt ( 
	contrattype_contrat_assignemnt_id INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	contrat_type_id      INT       ,
	contrat_id           INT       ,
	CONSTRAINT unq_contrattype_contrat_assignemnt_contrat_type_id UNIQUE ( contrat_type_id ) ,
	CONSTRAINT unq_contrattype_contrat_assignemnt_contrat_id UNIQUE ( contrat_id ) 
 ) engine=InnoDB;

CREATE  TABLE sprint_database.employee_client_assignment ( 
	employee_client_assignment_index INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	employee_id          INT       ,
	client_id            INT       ,
	CONSTRAINT unq_employee_client_assignment_client_id UNIQUE ( client_id ) ,
	CONSTRAINT unq_employee_client_assignment_employee_id UNIQUE ( employee_id ) 
 ) engine=InnoDB;

CREATE  TABLE sprint_database.employee_role_assignment ( 
	`index`              INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	employee_id          INT    NOT NULL   ,
	role_id              INT       ,
	CONSTRAINT unq_employee_role_assignment_employee_id UNIQUE ( employee_id ) ,
	CONSTRAINT unq_employee_role_assignment_role_id UNIQUE ( role_id ) 
 ) engine=InnoDB;

CREATE  TABLE sprint_database.motive_documents ( 
	motive_documents_id  INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	motive_id            INT       ,
	documents_id         INT       ,
	CONSTRAINT unq_motive_documents_motive_id UNIQUE ( motive_id ) ,
	CONSTRAINT unq_motive_documents_documents_id UNIQUE ( documents_id ) 
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

CREATE  TABLE sprint_database.comptetype ( 
	comptetype_id        INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	type_name            VARCHAR(100)       ,
	motive_id            INT       ,
	CONSTRAINT unq_comptetype_motive_id UNIQUE ( motive_id ) 
 ) engine=InnoDB;

CREATE  TABLE sprint_database.contrat ( 
	contart_id           INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	contrat_tarif        INT       ,
	open_date            DATE       
 ) engine=InnoDB;

CREATE  TABLE sprint_database.contrattype ( 
	contrattype_id       INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	contrattype_name     VARCHAR(100)       ,
	motive_id            INT       ,
	CONSTRAINT unq_contrattype_motive_id UNIQUE ( motive_id ) 
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

CREATE  TABLE sprint_database.motive ( 
	motive_id            INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	motive_name          VARCHAR(100)       
 ) engine=InnoDB;

ALTER TABLE sprint_database.client ADD CONSTRAINT fk_client_employee_client_assignment FOREIGN KEY ( client_id ) REFERENCES sprint_database.employee_client_assignment( client_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.client ADD CONSTRAINT fk_client_compte_client_assignment FOREIGN KEY ( client_id ) REFERENCES sprint_database.compte_client_assignment( client_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.client ADD CONSTRAINT fk_client_client_contrat_assignment FOREIGN KEY ( client_id ) REFERENCES sprint_database.client_contrat_assignment( client_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.client ADD CONSTRAINT fk_client_rdv FOREIGN KEY ( client_id ) REFERENCES sprint_database.rdv( client_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.compte ADD CONSTRAINT fk_compte_compte_client_assignment FOREIGN KEY ( compte_id ) REFERENCES sprint_database.compte_client_assignment( compte_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.compte ADD CONSTRAINT fk_compte_comptetype_compte_assignment FOREIGN KEY ( compte_id ) REFERENCES sprint_database.comptetype_compte_assignment( compte_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.comptetype ADD CONSTRAINT fk_comptetype_comptetype_compte_assignment FOREIGN KEY ( comptetype_id ) REFERENCES sprint_database.comptetype_compte_assignment( comptetype_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.contrat ADD CONSTRAINT fk_contrat_contrattype_contrat_assignemnt FOREIGN KEY ( contart_id ) REFERENCES sprint_database.contrattype_contrat_assignemnt( contrat_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.contrat ADD CONSTRAINT fk_contrat_client_contrat_assignment FOREIGN KEY ( contart_id ) REFERENCES sprint_database.client_contrat_assignment( contrat_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.contrattype ADD CONSTRAINT fk_contrattype_contrattype_contrat_assignemnt FOREIGN KEY ( contrattype_id ) REFERENCES sprint_database.contrattype_contrat_assignemnt( contrat_type_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.documents ADD CONSTRAINT fk_documents_motive_documents FOREIGN KEY ( documents_id ) REFERENCES sprint_database.motive_documents( documents_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.employee ADD CONSTRAINT fk_employee_employee_role_assignment FOREIGN KEY ( employee_id ) REFERENCES sprint_database.employee_role_assignment( employee_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.employee ADD CONSTRAINT fk_employee_employee_client_assignment FOREIGN KEY ( employee_id ) REFERENCES sprint_database.employee_client_assignment( employee_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.employee ADD CONSTRAINT fk_employee_rdv FOREIGN KEY ( employee_id ) REFERENCES sprint_database.rdv( employee_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.motive ADD CONSTRAINT fk_motive_comptetype FOREIGN KEY ( motive_id ) REFERENCES sprint_database.comptetype( motive_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.motive ADD CONSTRAINT fk_motive_rdv FOREIGN KEY ( motive_id ) REFERENCES sprint_database.rdv( motive_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.motive ADD CONSTRAINT fk_motive_contrattype FOREIGN KEY ( motive_id ) REFERENCES sprint_database.contrattype( motive_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.motive ADD CONSTRAINT fk_motive_motive_documents FOREIGN KEY ( motive_id ) REFERENCES sprint_database.motive_documents( motive_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.role_types ADD CONSTRAINT fk_role_types_employee_role_assignment FOREIGN KEY ( role_id ) REFERENCES sprint_database.employee_role_assignment( role_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.time_slot ADD CONSTRAINT fk_time_slot_rdv FOREIGN KEY ( time_slot_id ) REFERENCES sprint_database.rdv( time_slot_id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sprint_database.motive_documents MODIFY motive_id INT     COMMENT 'Dit-moi en personne que tu as lu ceci et je t''offrirai un cookie.';

ALTER TABLE sprint_database.time_slot MODIFY week INT     COMMENT 'i''m not sure how "week" is supposed to function';

ALTER TABLE sprint_database.client COMMENT 'you might not need total balance and total overdraft';

