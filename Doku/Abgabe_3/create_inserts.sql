Drop Table KEY_ZUORDNUNG_3;
/
Drop Table ARBEITER_3;
/
Drop Table ANGESTELLTER_3;
/
Drop Table PERSONAL_3;
/
Create Table KEY_ZUORDNUNG_3(
    oldkey varchar2(255),
    "source" varchar2(255),
    newkey number
);
/
Create Table ARBEITER_3(
    "NAME" varchar2(255),
    vorname varchar2(255),
    geburtsmonat varchar2(255),
    stundenlohn number
);
/
Create Table ANGESTELLTER_3(
    "NAME" varchar2(255),
    geburtsdatum date,
    berufsbezeichnung varchar2(255),
    monatsgehalt number,
    geschlecht varchar2(255),
    angestelltennr number
);
/
Create Table PERSONAL_3(
    personalnr number,
    "NAME" varchar2(255),
    vorname varchar2(255),
    "ALTER" number,
	geschlecht number,
    berufscode varchar2(255),
    jahreseinkommen number
);
/
Insert into ARBEITER_3 Values (
'Müller', 'Alex', '05.95', 12.50
);
Insert into ARBEITER_3 Values (
'Hecht', 'Daniel', '10.99', 15.00
);
Insert into ARBEITER_3 Values (
'Hartmann', 'Lukas', '02.93', 10
);
Insert into ARBEITER_3 Values (
'Brida', 'Sophie', '08.90', 17.23
);
Insert into ARBEITER_3 Values (
'Spitz', 'Anna', '01.97', 12
);

Insert into ANGESTELLTER_3 Values (
'Peter Pan', Date '1994-04-23', 'Arbeiter', 1500, 'männlich', 12345
);
Insert into ANGESTELLTER_3 Values (
'Rudi, Rabauke', Date '1996-02-28', 'Arbeiter', 1700, 'männlich', 6754934
);
Insert into ANGESTELLTER_3 Values (
'Gundula Gause', Date '1990-07-01', 'Manager', 3000, 'weiblich', 0928374
);
Insert into ANGESTELLTER_3 Values (
'Sandra, Wagner', Date '1997-12-24', 'Arbeiter', 1200, 'weiblich', 432657
);