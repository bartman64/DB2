/*Kunden Typ*/
create or replace TYPE KUNDET AS OBJECT 
( 
    Nummer int, 
    Name varchar2(20),
    Adresse varchar2(50),
    Status varchar2(20), 
    kontos Kontolistet
)

/*Konto type*/
create or replace TYPE KONTOT AS OBJECT 
( 
Nummer integer, 
Stand float, 
Art varchar2(1)
)

/*Zweigstellen Typ*/
create or replace TYPE ZWEIGSTELLET AS OBJECT 
( 
    name varchar2(20), 
    adresse varchar2(50),
    leiter varchar2(20), 
    kontos kontolistet
)

/*Kontoliste*/
create or replace TYPE KONTOLISTET 
AS TABLE OF ref KONTOT;

/*Konots anlegen*/
INSERT INTO KONTO VALUES(987654, 789.65, 'G');
INSERT INTO KONTO VALUES(745363, -23.67, 'S');

/*Kunden anlegen*/
INSERT INTO KUNDE VALUES (8765, 'J.Wiesner', 'Schellingstr.42', 'Geschäftskunde', 
KONTOLISTET((SELECT REF(k)FROM KONTO k WHERE k.nummer = 745363), (SELECT REF(k)FROM KONTO k WHERE k.nummer = 678453), (SELECT REF(k)FROM KONTO k WHERE k.nummer = 348973)));

INSERT INTO KUNDE VALUES (7654, 'B.Meier', 'Eschenweg 12', 'Privatkunde', 
KONTOLISTET((SELECT REF(k)FROM KONTO k WHERE k.nummer = 987654)));

/*Zweigstellen anlegen*/
INSERT INTO ZWEIGSTELLE VALUES ('Bachdorf', 'Hochstr.1', 1768, 
KONTOLISTET(
(SELECT REF(k)FROM KONTO k WHERE k.nummer = 120768),
(SELECT REF(k)FROM KONTO k WHERE k.nummer = 678453),
(SELECT REF(k)FROM KONTO k WHERE k.nummer = 987654)));

INSERT INTO ZWEIGSTELLE VALUES ('Riedering', 'Simseestr.3', 9823, 
KONTOLISTET(
(SELECT REF(k)FROM KONTO k WHERE k.nummer = 987654),
(SELECT REF(k)FROM KONTO k WHERE k.nummer = 745363)));

/*Select statement a)*/
SELECT DEREF(k.COLUMN_VALUE).Nummer AS Kontonummer,DEREF(k.COLUMN_VALUE).Stand AS Kontostand, DEREF(k.COLUMN_VALUE).Art AS Kontoart ,  zw.ADRESSE
FROM ZWEIGSTELLE zw, TABLE(zw.Kontos) k;

/*Select statement b)*/
SELECT DEREF(kundenKonto.COLUMN_VALUE).Nummer, Kunde.ADRESSE
FROM Kunde, TABLE(Kunde.Kontos) kundenKonto;



