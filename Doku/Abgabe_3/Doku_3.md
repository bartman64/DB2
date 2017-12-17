## Übung 3

#### Stefan Benz, Sebastian Horvath

##### Aufgabe 2.

```sql
CREATE OR REPLACE FUNCTION min_max_scaling (
    v   IN NUMBER,
    old_min   IN NUMBER,
    old_max   IN NUMBER,
    new_min   IN NUMBER,
    new_max   IN NUMBER
) RETURN NUMBER
    AS
BEGIN
    RETURN ((v - old_min)/(old_max - old_min))*(new_max - new_min) + new_min;
END min_max_scaling;
```
![alt text](min_max_scaling_example.png)


##### Aufgabe 3.

```sql
CREATE TABLE ANGESTELLTER_3
(
NAME varchar2(255),
Geburtsdatum date,
Berufsbezeichnung varchar2(255),
Monatsgehalt number,
Geschlecht varchar2(255),
Angestelltennr number,
PRIMARY KEY(Angestelltennr)
);
```


```sql
CREATE TABLE ARBEITER_3
(
Name varchar2(255),
Vorname varchar2(255),
Gebutsmonat varchar2(255),
Stundenlohn number,
PRIMARY KEY (Name, Vorname)
);
```


```sql
CREATE TABLE PERSONAL_3
(
Personalnr number,
Name varchar2(255),
Vorname varchar2(255),
"ALTER" number,
Geschlecht number,
Berufscode varchar2(255),
Jahreseinkommen number,
PRIMARY KEY(Personalnr)
);
```
