-- INSERTS


-- t_d_address_adr  
-- ADR_ID, ADR_DENOMINATION , ADR_LINE1, ADR_LINE2, ADR_LINE3, ADR_ZIPCODE, ADR_CITY, ADR_COUNTRY, ADR_STATE



-- FLORENT
INSERT INTO t_d_address_adr (ADR_DENOMINATION , ADR_LINE1, ADR_LINE2, ADR_LINE3, ADR_ZIPCODE, ADR_CITY, ADR_COUNTRY, ADR_STATE)
        values ("MARTIN", "2 rue de gilbert" , '' , '' , 54000 , "Nancy" , "France", "Lorraine"),
                ("AHMED", "2 rue des grands oiseaux" , '' , '' , 57000 , "METZ" , "France", "Lorraine"),
                ("KARIM", "2 rue de la girouette" , '' , '' , 57000 , "METZ" , "France", "Lorraine"),
                ("AMANDINE", "2 rue de blandan" , '' , '' , 57000 , "METZ" , "France", "Lorraine"),
                ("LUC", "2 place de paris" , '' , '' , 54000 , "Nancy" , "France", "Lorraine"),
                ("MOZART", "2 avenue du quatre" , '' , '' , 69000 , "Strasbourg" , "France", "Alsace"),
                ("ANNE", "2 avenue de paris" , '' , '' , 75000 , "PARIS" , "France", "Ile de France"),
                ("MARIE", "2 boulevard du garaud" , '' , '' , 75000 , "PARIS" , "France", "Ile de France"),
                ("ANISSA", "2 rue du maroc" , '' , '' , 75000 , "PARIS" , "France", "Ile de France");

-- CHARLOTTE

insert into T_D_MODE_EXPEDITION_MEN (MEN_DESC) 
    values ('Colissimo'),
            ('Chronopost'),
            ('GSL'),
            ('Expéditeur interne');

insert into T_D_MODE_PAYMENT_MPT (MPT_DESC) 
    values ('CB'),
             ('Virement'),
             ('Chèque');

-- FLORENT
insert into T_D_ORDER_STATUS_OSS (OSS_DESC) 
                          values ('Intégrée'),
                                 ('En cours de traitement'),
                                 ('Annulation Client'),
                                 ('Refus Paiement'),
                                 ('Expédiée');


-- SOFIANE
insert into T_D_ORDERHEADER_OHR (OHR_DATE,
                                 OHR_ORDERNUMBER,
                                 OHR_DELIVERYPHONE,
                                 OHR_TOTALHT, 
                                 OHR_TOTALTTC, 
                                 OHR_ID_PAYMODE,
                                 OHR_OSS_ID, 
                                 OHR_ADR_ID_PAYMENT) 
        values  (20161106, 5337149329, '9353096642', 129.33, 159.44, 4, 1, 11),
                (20201106, 7614156811, '8608890573', 129.33, 159.44, 4, 5, 12),
                (20120912, 7037242317, '2866186949', 129.33, 159.44, 4, 5, 13),
                (20121206, 0362796676, '8016902860', 129.33, 159.44, 4, 5, 14),
                (20191114, 2312782229, '9432756028', 129.33, 159.44, 5, 5, 14),
                (20141011, 8446495641, '9697283374', 129.33, 159.44, 5, 2, 13),
                (20151122, 6578412765, '9503961298', 129.33, 159.44, 5, 2, 19),
                (20130415, 9977609214, '4179843881', 129.33, 159.44, 5, 3, 18),
                (20130915, 9518226993, '6231719350', 129.33, 159.44, 6, 3, 16),
                (20131205, 2206218824, '8396747715', 129.33, 159.44, 6, 4, 15);

-- SOFIANE

INSERT INTO T_D_EXPEDITION_EXP (EXP_DATE, 
                                EXP_STATUS, 
                                EXP_QTY, 
                                EXP_ADR_ID, 
                                EXP_MEN_ID,
                                EXP_OHR_ID)
            values  (20161106, 1, 500, 11, 1, 1),
                    (20161106, 1, 500, 12, 1, 1),
                    (20161106, 1, 500, 12, 2, 2),
                    (20161106, 1, 500, 13, 2, 2),
                    (20161106, 1, 500, 13, 3, 10),
                    (20161106, 1, 600, 14, 3, 3),
                    (20161106, 1, 600, 15, 4, 4),
                    (20161106, 0, 150, 16, 4, 5),
                    (20161106, 0, 1000, 17, 2, 6),
                    (20161106, 0, 1000, 18, 1, 10);

-- SOFIANE
INSERT INTO T_D_PRODUCT_TYPE (PTY_TYPE)
                        values ('Pergola'),
                                ('Porte'),
                                ('Clôture'),
                                ('Moteur'),
                                ('grillage'),
                                ('portail');

-- -----------------------------------------------------
-- INSERT
-- -----------------------------------------------------

-- INSERT INTO "T_D_PRODUCT_TYPE" (`PTY_TYPE`)
--         values  ('Produit'), ('Lot');

-- sofiane
INSERT into T_D_PRODUCT_PRD (PRD_REFERENCE,
                               PRD_SUPPLIER, 
                               PRD_DESIGNATION, 
                               PRD_FAMILY, 
                               PRD_DESCRIPTION, 
                               PRD_GUARANTEE, 
                               PRD_OPENTOSELL, 
                               PRD_IMAGE_URL, 
                               PRD_TYPE_ID)
        values  ('DDD777', 'LeroyMerlin', 'Portail', 'Exterieur', 'Portail', 12, 1, 'Image .jpeg', 3),
                ('DDD555', 'LeroyMerlin', 'Portail', 'Exterieur', 'Portail', 24, 1, 'Image .jpeg', 3),
                ('DDD444', 'LeroyMerlin', 'Portail', 'Exterieur', 'Portail', 24, 1, 'Image .jpeg', 3),
                ('DDD333', 'LeroyMerlin', 'Portail', 'Exterieur', 'Portail', 36, 1, 'Image .jpeg', 3),
                ('DDD222', 'LeroyMerlin', 'Portail', 'Exterieur', 'Portail', 6, 1, 'Image .jpeg', 3),
                ('DDD111', 'LeroyMerlin', 'Portail', 'Exterieur', 'Portail', 12, 1, 'Image .jpeg', 4),
                ('DDD112', 'LeroyMerlin', 'Portail', 'Exterieur', 'Portail', 24, 1, 'Image .jpeg', 4),
                ('HHH777', 'Bricodepot', 'Grillage', 'Exterieur', 'Cloture', 12, 1, 'Image .jpeg', 3),
                ('HHH111', 'Bricodepot', 'Grillage', 'Exterieur', 'Cloture', 12, 0, 'Image .jpeg', 4),
                ('MMM888', 'Bricodepot', 'Grillage', 'Maison', 'Cloture electrique', 12, 1, 'Image.jpeg', 3),
                ('MMM888', 'Castorama', 'Porte', 'Batiment', 'Porte coupe feu', 12, 1, 'Image .jpeg', 3),
                ('MMM888', 'Castorama', 'Porte', 'Batiment','Portes de sortie', 12, 1, 'Image .jpeg', 4);


-- CHARLOTTE
insert into T_D_ORDERDETAIL_ODT (ODT_QTYORDERED, ODT_OHR_ID, ODT_PRD_ID) 
        values  (1, 1, 14),
                (2, 2, 15),
                (3, 3, 23),
                (4, 4, 14),
                (5, 5, 15),
                (6, 6, 16),
                (7, 7, 17),
                (8, 8, 18),
                (9, 9, 19),
                (10, 10, 20);
-- SOFIANE
INSERT into T_D_PRODUCTCOMPOSITION_PCO (PCO_QUANTITY, PCO_PRD_COMP_ID, PCO_PRD_KIT_ID)
        values  (10, 15, 16),
                (150, 15, 15),
                (50, 16, 16),
                (10, 17, 18),
                (70, 19, 19),
                (80, 20, 21),
                (80, 22, 22),
                (90, 23, 22),
                (110, 23, 23),
                (110, 24, 24);

-- FLORENT
INSERT into T_D_WAREHOUSE_WRH (WRH_NAME, WRH_CAPACITY, WRH_STOCK)
        values  ('Principal', 5000, 4000),
                ('SAV', 1000 , 500 ), 
                ('Rebus', 50 , 25);

-- FLORENT
INSERT into T_D_STOCKMOVEMENT_MVT (MVT_QUANTITY, MVT_DATE, MVT_CANCELLED, MVT_PRD_ID, MVT_OHR_ID, MVT_EXP_ID, MVT_WRH_ID)
        values  (150, 20100529, 0,13, 1, 10, 1),
                ( 50, 20110227, 1,14, 2, 3, 1),
                ( 30, 20090425, 1,15, 3, 5, 1),
                ( 100, 20111030, 1,16, 4, 2, 2),
                ( 250, 20120624, 1,17, 5, 4, 2), 
                ( 50, 20130415, 0, 18, 6, 5, 1),
                ( 20, 20140525, 0, 19, 7, 6, 2),
                ( 120, 20131130, 1,20, 8, 7, 3),
                ( 150, 20110724, 1,21, 9, 8, 3),      
                ( 90, 20110320, 0, 22, 10, 9, 3);

-- CHARLOTTE
INSERT into TYPE_DOSSIER_TDS (TDS_TYPE)
        values  ('NPAI'),
                ('NP'),
                ('EC'),
                ('EP'),
                ('SAV');

INSERT into T_D_Dossier_SAV_DSV (DSV_ETAT, DSV_PHOTO, DSV_COM_DIAG_INITIAL, DSV_COM_DIAG_TERM, DSV_PRD_ID, DSV_ORH_ID, DSV_TDS_ID)
        values  (1, 'Image du portail.jpeg', 'Casse', '', 13, 1, 1),
                (1, 'Image du moteur de porte.jpeg', 'Fissure', '', 14, 2, 2),
                (1, 'Image de la porte.jpeg', 'Fissure', '', 15, 3, 2),
                (1, 'Image de la clôture.jpeg', 'Brule', '', 16, 4, 3),
                (1, 'Image du portail.jpeg', 'Machouille', '', 17, 5, 4),
                (0, 'Image de la porte.jpeg', 'Enfonce', '', 18, 6, 4),
                (0, 'Image de la clôture.jpeg', 'Fissure', '', 19, 7, 4),
                (0, 'Image de la clôture.jpeg', 'Fissure', '', 20, 8, 5),
                (0, 'Image du moteur de porte.jpeg', 'Systeme electronique', '', 21, 9, 5),
                (0, 'Image du moteur de porte.jpeg', 'Systeme electronique', '', 22, 10, 4);
                
INSERT into TYPE_USER (Typ_type) 
            values ('Admin'),
                   ('Technicien SAV'),
                   ('Technicien HOTLINE');

Insert into users (username, password, mail, user_type_id )
            values  ('admin', 'admin', 'admin@menuiz.com', 4),
                    ('tech1', 'tech1', 'technicien1@menuiz.com', 5),
                    ('tech2', 'tech2', 'technicien2@menuiz.com', 5),
                    ('tech3', 'tech3', 'technicien3@menuiz.com', 5),
                    ('hot1', 'hot1', 'hot1@menuiz.com', 6),
                    ('hot2', 'hot2', 'hot2@menuiz.com', 6),
                    ('hot3', 'hot3', 'hot3@menuiz.com', 6);
