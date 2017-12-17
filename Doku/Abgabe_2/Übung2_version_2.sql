create or replace TYPE CUSTOMER_T AS OBJECT 
( 
    cust_ID varchar2(255),
    cust_name varchar2(255),
    cust_address varchar2(255),
    cust_phone varchar2(255),
    cust_gender varchar2(255),
    cust_DOB date
)

create or replace TYPE FULL_TIME_T UNDER EMPLOYEE_T 
(
    annual_wage int,
    emp_bonus int
)


create or replace TYPE TRANSACTION_T AS OBJECT 
( 
    trans_ID int,
    trans_date date,
    quantitiy int,
    Cust_ID ref CUSTOMER_T,
    Item_ID ref ITEM_T
)

create or replace TYPE ITEM_T AS OBJECT 
( 
    item_ID varchar2(255), 
    item_name varchar2(255),
    item_desc varchar2 (255),
    item_cost float,
    item_price float,
    Made_by ref MAKER_T
)


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
)

create or replace TYPE FULL_TIME_T AS OBJECT 
(
    annual_wage int,
    emp_bonus int
)

create or replace TYPE DEPARTMENT_T AS OBJECT 
( 
    store_ID varchar2(255),
    dept_ID varchar2(255),
    dept_name varchar2(255),
    dept_head varchar2(255)
)


CREATE TABLE CUSTOMER OF CUSTOMER_T
NESTED TABLE transactions
STORE AS TRANSACTION_NT

INSERT INTO CUSTOMER VALUES(
'C1001', 
'Sally Lange', 
'14 Milky Way St Melbourne 3000',
'0395486542',
'F',
DATE '1970-03-12',
TRANSACTIONLIST_T());


INSERT INTO ITEM VALUES (
    'I-1001',
    'Crsip Original',
    'Potato Chips 250 gr',
    2.00,
    3.10,
    (SELECT ref(m)
    FROM MAKER m 
    WHERE m.maker_ID = 'M1')
);

CREATE TABLE EMPLOYEE OF EMPLOYEE_T;

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

INSERT INTO TRANSACTION VALUES(
    1602027891,
    DATE '2002-02-16',
    5,
    (SELECT ref(c) FROM CUSTOMER c WHERE c.cust_ID = 'C1001'),
    (SELECT ref(i) FROM ITEM i WHERE i.item_ID = 'I-1001') 
);


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