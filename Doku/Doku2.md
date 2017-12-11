## Datenbanken 2

Stefan Benz, Sebastian Horvath

### Übung 2
### Aufgabe 2.

#### 1.Möglichkeit

```sql
create or replace TYPE KONTOT AS OBJECT
(
  Nummer integer,
  Stand float,
  Art varchar2(1)
);```

```sql
create or replace TYPE KUNDET AS OBJECT
(
    Nummer int,
    Name varchar2(20),
    Adresse varchar2(50),
    Status varchar2(20),
    kontos Kontolistet
); ```

```sql
create or replace TYPE KONTOLISTET
AS TABLE OF ref KONTOT;```

```sql
create or replace TYPE ZWEIGSTELLET AS OBJECT
(
    name varchar2(20),
    adresse varchar2(50),
    leiter varchar2(20),
    kontos kontolistet
);```

#### 2.Möglichkeit


```sql
create or replace TYPE KUNDET2 AS OBJECT
(
    Nummer int,
    Name varchar2(20),
    Adresse varchar2(50),
    Status varchar2(20),
    kontoNr kontoNrList
);```

```sql
create or replace TYPE KONTOLISTET2
AS TABLE OF  KONTOT;
```

```sql
create or replace TYPE zweigstellet2 AS OBJECT (
    name      VARCHAR2(20),
    adresse   VARCHAR2(50),
    leiter    VARCHAR2(20),
    kontos    kontolistet2
);```


```sql
create or replace TYPE
   kontoNrList AS Table of int;```


### Aufgabe 3.

```sql
Create Table Kunde of KUNDET
  NESTED TABLE kontos
  STORE AS KONTOS_NT;
```

```sql
Create Table Zweigstelle of Zweigstellet
NESTED TABLE kontos
STORE AS KONTOS_ZW_NT;```

```sql
Create Table Konto of Kontot;```


```sql
Create Table ZWEIGSTELLE2 of ZWEIGSTELLET2
NESTED Table kontos
STORE as kontos_zweigstelle2_nt;```

```sql
Create Table KUNDE2 of KUNDET2
NESTED Table kontoNr
STORE as kontoNr_nt;
```

Kontos anlegen
```sql
INSERT INTO KONTO VALUES(987654, 789.65, 'G');
INSERT INTO KONTO VALUES(745363, -23.67, 'S');
```
Kunden anlegen
```sql
INSERT INTO KUNDE VALUES (8765, 'J.Wiesner', 'Schellingstr.42', 'Geschäftskunde',
KONTOLISTET((SELECT REF(k)FROM KONTO k WHERE k.nummer = 745363), (SELECT REF(k)FROM KONTO k WHERE k.nummer = 678453), (SELECT REF(k)FROM KONTO k WHERE k.nummer = 348973)));

INSERT INTO KUNDE VALUES (7654, 'B.Meier', 'Eschenweg 12', 'Privatkunde',
KONTOLISTET((SELECT REF(k)FROM KONTO k WHERE k.nummer = 987654)));

Insert into KUNDE2 Values (
2345,'H. Fach','Münchenerstrasse 33','Geschäftskunde',KONTONRLIST(120768,348973));

Insert into KUNDE2 Values (
7654,'B. Meier','Eschenweg 12','Privatkunde',KONTONRLIST(987654));

Insert into KUNDE2 Values (
8764,'J. Wiesner','Schellingstrasse 42','Geschäftskunde',KONTONRLIST(745363,678453,348973));
```

Zweigstellen anlegen
```sql
INSERT INTO ZWEIGSTELLE VALUES ('Bachdorf', 'Hochstr.1', 1768,
KONTOLISTET(
(SELECT REF(k)FROM KONTO k WHERE k.nummer = 120768),
(SELECT REF(k)FROM KONTO k WHERE k.nummer = 678453),
(SELECT REF(k)FROM KONTO k WHERE k.nummer = 987654)));

INSERT INTO ZWEIGSTELLE VALUES ('Riedering', 'Simseestr.3', 9823,
KONTOLISTET(
(SELECT REF(k)FROM KONTO k WHERE k.nummer = 987654),
(SELECT REF(k)FROM KONTO k WHERE k.nummer = 745363)));

Insert into ZWEIGSTELLE2 Values (
'Bachdorf','Hochstrasse 1','1768', KONTOLISTET2(KONTOT(120768,234.56,'S'),KONTOT(678453,-456.78,'G'),KONTOT(348973,12567.56,'G')));

Insert into ZWEIGSTELLE2 Values (
'Riedering','Simseestrasse 3','9823', KONTOLISTET2(KONTOT(987654,789.65,'G'),KONTOT(745363,-23.67,'S')));
```
### Aufgabe 4.

Select statement a)
```sql
SELECT DEREF(k.COLUMN_VALUE).Nummer AS Kontonummer,DEREF(k.COLUMN_VALUE).Stand AS Kontostand, DEREF(k.COLUMN_VALUE).Art AS Kontoart ,  zw.ADRESSE
FROM ZWEIGSTELLE zw, TABLE(zw.Kontos) k;
```
![alt text](4a_1_Möglichkeit.png)

```sql
SELECT z.adresse, k.nummer, k.stand, k.art FROM ZWEIGSTELLE2 z, TABLE(z.kontos) k;
```
![alt text](4_a_2.png)

Select statement b)
```sql
SELECT DEREF(kundenKonto.COLUMN_VALUE).Nummer, Kunde.ADRESSE
FROM Kunde, TABLE(Kunde.Kontos) kundenKonto;

```
![alt text](4b_1_Möglichkeit.png)

```sql
SELECT k.adresse, (n.COLUMN_VALUE) FROM KUNDE2 k, TABLE(k.kontoNr) n;
```
![alt text](4_b_2.png)

### Aufgabe 5.

#### Typen:

```sql
create or replace TYPE Casual_T UNDER EMPLOYEE_T
(
    hourly_wage int
);
```

```sql
create or replace type comp_type_t as Object (
	type_desc varchar2(50)
)not final;
```

```sql
create or replace type comp_type_1_T under comp_type_T (
	area varchar2(20)
);
```

```sql
create or replace type comp_type_2_T under comp_type_T (
	market varchar2(20)
);
```

```sql
create or replace type phone_list_T as Table of varchar2(20);
```

```sql
create or replace type Company_T as Object (
	comp_ID int,
	comp_name varchar2(40),
	comp_address varchar2(100),
	comp_phone_list phone_list_T,
	comp_fax varchar2(20),
	comp_type comp_type_t
);
```
```sql
create or replace TYPE CUSTOMER_T AS OBJECT
(
    cust_ID varchar2(255),
    cust_name varchar2(255),
    cust_address varchar2(255),
    cust_phone varchar2(255),
    cust_gender varchar2(255),
    cust_DOB date
)
```
```sql
create or replace TYPE DEPARTMENT_T AS OBJECT
(
    store_ID varchar2(255),
    dept_ID varchar2(255),
    dept_name varchar2(255),
    dept_head varchar2(255)
);
```

```sql
create type available_in_t as Object (
	item_ID varchar2(20),
	store_ID varchar2(20),
	item_stock float
);
```

```sql
create or replace TYPE EMPLOYEE_T AS OBJECT
(
    emp_ID varchar2(255),
    emp_name varchar2(255),
    emp_address varchar2(255),
    emp_phone varchar2(255),
    emp_type varchar2(255),
    emp_account_no varchar2(255),
    emp_TFN varchar2(255),
    dept_ID varchar2(255),
    Work_In varchar2(255)
)NOT FINAL
```
```sql
create or replace TYPE FULL_TIME_T UNDER EMPLOYEE_T
(
    annual_wage int,
    emp_bonus int
)
```

```sql
create or replace TYPE ITEM_T AS OBJECT
(
    item_ID varchar2(255),
    item_name varchar2(255),
    item_desc varchar2 (255),
    item_cost float,
    item_price float,
    Made_by ref MAKER_T
);
```
```sql
create or replace type Maker_T as Object (
	maker_ID varchar2(10),
	maker_name varchar2(50),
	maker_address varchar2(100),
	maker_phone varchar2(20)
);
```

```sql
create or replace type Manager_T as Object (
	manag_ID int,
	manag_type varchar2(20),
	yearly_salary float
);
```

```sql
create or replace type Director_T as Object (
	manag_ID int,
	dir_bonus varchar2(10)
);
```

```sql
create or replace type Management_T as Object (
	manag_ID int,
	manag_name varchar2(40),
	manag_address varchar2(100),
	manag_phone varchar2(20),
	comp_ID int,
	manager_ ref Manager_T,
	director_ ref Director_T
);
```

```sql
create or replace type own_shares_T as Object(
	shareholder_ID int,
	comp_ID int,
	share_amount int
);
```

```sql
create or replace TYPE Part_Time_T UNDER EMPLOYEE_T
(
    weekly_wage int
);
```
```sql
create or replace type Shareholder_T as Object (
	shareholder_ID int,
	shareholder_name varchar2(40),
	shareholder_address varchar2(100),
	shareholder_phone varchar2(20)
);
```

```sql
create or replace type Store_T as Object (
	store_ID varchar2(10),
	store_location varchar2(50),
	store_address varchar2(100),
	store_phone varchar2(20),
	is_in int,
	store_manager varchar2(50)
);
```

```sql
create or replace TYPE TRANSACTION_T AS OBJECT
(
    trans_ID int,
    trans_date date,
    quantitiy int,
    Cust_ID ref CUSTOMER_T,
    Item_ID ref ITEM_T
);
```
#### Create Table Statements
```sql
CREATE TABLE CUSTOMER OF CUSTOMER_T;

CREATE TABLE EMPLOYEE OF EMPLOYEE_T;

CREATE TABLE ITEM OF ITEM_T;

CREATE TABLE DEPRTMENT OF DEPARTMENT_T;

create table maker of Maker_T;

create table Director of Director_T;

create table Manager of Manager_T;

create table Management of Management_T;

create table own_shares of own_shares_T;

create table Company of COMPANY_T
nested table comp_phone_list
store as comp_phone_list_nt

create table Shareholder of SHAREHOLDER_T;

create table Store of STORE_T;

create table Available_in of AVAILABLE_IN_T;
```
#### Insert Statements

```sql
INSERT INTO CUSTOMER VALUES(
'C1001',
'Sally Lange',
'14 Milky Way St Melbourne 3000',
'0395486542',
'F',
DATE '1970-03-12',
);
```
```sql

INSERT INTO EMPLOYEE VALUES (FULL_TIME_T(
    'OB1-01',
    'Glenda Row',
    '10/1 Harold St. Thornbury 3125',
    '0395854523',
    'FT',
    '2568-548-586',
    '081253654',
    '1',
    'OB1',
    3000,
    2000
));

INSERT INTO EMPLOYEE VALUES (PART_TIME_T(
    'OB1-03',
    'Lily Hui',
    '6 Mornane ST Preston 3203',
    '0411528876',
    'Part Time',
    '1259-968-458',
    '089658754',
    '1',
    'OB2',
    400
));

```

```sql
INSERT INTO TRANSACTION VALUES(
    1602027891,
    DATE '2002-02-16',
    5,
    (SELECT ref(c) FROM CUSTOMER c WHERE c.cust_ID = 'C1001'),
    (SELECT ref(i) FROM ITEM i WHERE i.item_ID = 'I-1001')
);

```

```sql
INSERT INTO DEPARTMENT VALUES(
    'OB1',
    '1',
    'Deli',
    'Jared Dench'
);

INSERT INTO DEPARTMENT VALUES(
    'OB1',
    '2',
    'Bakery',
    'Charlie Williams'
);
```

```sql
insert into OWN_SHARES Values (
100, 1, 1000
);
insert into OWN_SHARES Values (
100, 2, 250
);
insert into OWN_SHARES Values (
200, 1, 2500
);
```

```sql
insert into SHAREHOLDER Values (
100, 'Judith Maxwell', '40 Pinnacles Rd Melbourne 3000', '03934502093'
);
insert into SHAREHOLDER Values (
200, 'Ian Hobbes', '2 Red Oak Ave Hobart 7000', '0362231658'
);
```

```sql
insert into MAKER Values (
'M1', 'Smiths', '15 Princess Hwy Sydney 2000', '1800157856'
);
insert into MAKER Values (
'M2', 'Homemade', '450 Light Ave Albury 2780', '0245245263'
);
```

```sql
insert into DIRECTOR Values (
1001, '5%'
);
insert into DIRECTOR Values (
1002, '10%'
);
```

```sql
insert into MANAGER Values (
1001, 'Information System', 100000
);
insert into MANAGER Values (
1003, 'Operational', 85000
);
```

```sql
insert into MANAGEMENT Values (
1001, 'Kumio Takahashi', '20 Avondale Cr. Darlinghurst 2010', '0296101024',
1, (Select ref(m) From MANAGER m Where manag_ID = 1001),
(Select ref(d) From DIRECTOR d Where manag_ID = 1001)
);
insert into MANAGEMENT Values (
1002, 'Lucia Zanetti', '5 Noel St Double Bay 2028', '0290125846',
1, (Select ref(m) From MANAGER m Where manag_ID = 1002),
(Select ref(d) From DIRECTOR d Where manag_ID = 1002)
);
insert into MANAGEMENT Values (
1003, 'Stanley Mann', '2/2 Ross St Masot 2020', '0295211110',
1, (Select ref(m) From MANAGER m Where manag_ID = 1003),
(Select ref(d) From DIRECTOR d Where manag_ID = 1003)
);
```

```sql
insert into COMPANY Values (
1, 'OZ Buyer', '20 Russel St Sydney 2000', PHONE_LIST_T('0298394000','0298394005', '1800489000'), '0298398371', COMP_TYPE_1_T('Food and Daily Goods', 'NSW ACT')
);
insert into COMPANY Values (
2, 'Goodies', '50 Collins St', PHONE_LIST_T('0394255000','0394355005', '18009000000'), '0394250005', COMP_TYPE_1_T('Food  Daily Goods', 'VIC SA TAS')
);
```

```sql
insert into STORE Values (
'OB1', 'Parmatta', '4 Victoria Rd Paramatta 2797', '0298545876', 1,
'Alice Green'
);
insert into STORE Values (
'OB2', 'Newcastle', '15 University Dv Callaghan 2308', '024589 5444', 1,
'Rob Hayes'
);
insert into STORE Values (
'H1', 'Wollongong', '5 Princess Hwy Woll. 2500', '024256 8751', 4,
'Elda Stiebel'
);
```

```sql
insert into AVAILABLE_IN Values (
'I-1001', 'OB1', 5000
);
insert into AVAILABLE_IN Values (
'I-1002', 'OB1', 5000
);
insert into AVAILABLE_IN Values (
'I-1051', 'OB1', 200
);
```
