mysql> select * from airline;
+------------+------+-------------------+--------------+
| airline_id | iata | airlinename       | base_airport |
+------------+------+-------------------+--------------+
|          1 | AE   | Air Europa        |            5 |
|          2 | AL   | Albania Airlines  |            3 |
|          3 | AM   | American Airlines |            2 |
+------------+------+-------------------+--------------+
3 rows in set (0.00 sec)

mysql> select * from airplane;
+-------------+----------+---------+------------+
| airplane_id | capacity | type_id | airline_id |
+-------------+----------+---------+------------+
|           1 |      150 |     228 |          1 |
|           2 |      200 |      38 |          1 |
|           3 |      380 |      60 |          1 |
|           4 |       50 |     232 |          2 |
|           5 |      335 |      21 |          2 |
|           6 |      115 |      48 |          2 |
|           7 |       95 |      41 |          3 |
|           8 |      115 |      48 |          3 |
|           9 |       79 |      40 |          3 |
|          10 |       95 |      41 |          3 |
+-------------+----------+---------+------------+
10 rows in set (0.00 sec)

mysql> select * from airport;
+------------+------+------+-----------+
| airport_id | iata | icao | name      |
+------------+------+------+-----------+
|          1 | CGN  | EDDK | COLONIA   |
|          2 | BER  | ADDB | BERLIN    |
|          3 | TIA  | LATI | TIRANA    |
|          4 | VIE  | LOWW | VIENA     |
|          5 | IBZ  | LEIB | IBIZA     |
|          6 | MAD  | LEMD | MADRID    |
|          7 | MRS  | LFML | MARSELLA  |
|          8 | BCN  | LEBL | BARCELONA |
|          9 | GYD  | UBBB | BAKU      |
+------------+------+------+-----------+
9 rows in set (0.00 sec)

mysql> select * from booking;
+------------+-----------+------+--------------+--------+
| booking_id | flight_id | seat | passenger_id | price  |
+------------+-----------+------+--------------+--------+
|          1 |         1 | 21A  |            3 | 131.94 |
|          2 |         2 | 19H  |            1 | 500.63 |
|          3 |         3 | 16H  |            2 | 306.92 |
|          4 |         5 | 12B  |            2 | 400.12 |
|          5 |         4 | 9C   |            1 | 329.42 |
|          6 |         9 | 7G   |            2 | 423.36 |
|          7 |         8 | 3C   |            1 | 104.90 |
+------------+-----------+------+--------------+--------+
7 rows in set (0.00 sec)

mysql> select * from flight;
+-----------+----------+--------+------+---------------------+---------------------+------------+-------------+
| flight_id | flightno | from_a | to_a | departure           | arrival             | airline_id | airplane_id |
+-----------+----------+--------+------+---------------------+---------------------+------------+-------------+
|         1 | AE1078   |      9 |    2 | 2022-06-01 10:15:00 | 2022-06-01 20:46:00 |          1 |           3 |
|         2 | AE1377   |      4 |    1 | 2022-06-01 23:41:00 | 2022-06-02 10:05:00 |          1 |           2 |
|         3 | AE1518   |      1 |    7 | 2022-06-01 03:39:00 | 2022-06-01 11:13:00 |          1 |           1 |
|         4 | AE1593   |      6 |    4 | 2022-06-02 00:02:00 | 2022-06-02 16:48:00 |          1 |           5 |
|         5 | AE1632   |      1 |    3 | 2022-06-03 19:44:00 | 2022-06-04 09:22:00 |          1 |           3 |
|         6 | AL1748   |      2 |    6 | 2022-06-01 08:31:00 | 2022-06-01 19:51:00 |          2 |           4 |
|         7 | AL1837   |      6 |    9 | 2022-06-01 07:24:00 | 2022-06-01 18:51:00 |          2 |           5 |
|         8 | AL1908   |      5 |    8 | 2022-06-01 05:47:00 | 2022-06-01 17:05:00 |          2 |           6 |
|         9 | AM2227   |      7 |    9 | 2022-06-01 05:00:00 | 2022-06-01 18:19:00 |          3 |           7 |
|        10 | AM3068   |      8 |    1 | 2022-06-01 06:00:00 | 2022-06-01 23:59:00 |          3 |           9 |
|        11 | AM3226   |      1 |    6 | 2022-06-01 16:14:00 | 2022-06-02 06:43:00 |          3 |          10 |
|        12 | AM3230   |      4 |    1 | 2022-06-01 07:38:00 | 2022-06-01 19:38:00 |          3 |           8 |
+-----------+----------+--------+------+---------------------+---------------------+------------+-------------+
12 rows in set (0.00 sec)

mysql> select * from passengerdetails;
+--------------+----------------+------------+------+------------------+--------------------------+------+----------+------------------------------+----------------+
| passenger_id | name           | birthdate  | sex  | street           | city                     | zip  | country  | emailaddress                 | telephoneno    |
+--------------+----------------+------------+------+------------------+--------------------------+------+----------+------------------------------+----------------+
|            1 | Michael Browne | 1930-01-12 | m    | Andechsstrase 45 | Bad Wimsbach-Neydharting | 4654 | Ethiopia | Michael.Browne@airtelkol.com | 03022 807190   |
|            2 | Mara Corday    | 1930-01-03 | w    | Archenweg 82     | Behamberg                | 4441 | Korea    | Mara.Corday@cvcpaging.com    | 01335 64343532 |
|            3 | Jack Greene    | 1930-01-07 | m    | Bichlweg 77      | Bad Blumau               | 8283 | Korea    | Jack.Greene@my2way.com       | 08165 15262423 |
+--------------+----------------+------------+------+------------------+--------------------------+------+----------+------------------------------+----------------+
3 rows in set (0.00 sec)

mysql> desc passengerdetails;
+--------------+--------------+------+-----+---------+-------+
| Field        | Type         | Null | Key | Default | Extra |
+--------------+--------------+------+-----+---------+-------+
| passenger_id | int(11)      | NO   | PRI | NULL    |       |
| name         | varchar(120) | NO   |     | NULL    |       |
| birthdate    | date         | NO   |     | NULL    |       |
| sex          | char(1)      | YES  |     | NULL    |       |
| street       | varchar(100) | NO   |     | NULL    |       |
| city         | varchar(100) | NO   |     | NULL    |       |
| zip          | smallint(6)  | NO   |     | NULL    |       |
| country      | varchar(100) | NO   |     | NULL    |       |
| emailaddress | varchar(120) | YES  |     | NULL    |       |
| telephoneno  | varchar(30)  | YES  |     | NULL    |       |
+--------------+--------------+------+-----+---------+-------+
10 rows in set (0.01 sec)

mysql> desc flight;
+-------------+-------------+------+-----+---------+-------+
| Field       | Type        | Null | Key | Default | Extra |
+-------------+-------------+------+-----+---------+-------+
| flight_id   | int(11)     | NO   | PRI | NULL    |       |
| flightno    | char(8)     | NO   |     | NULL    |       |
| from_a      | smallint(6) | NO   | MUL | NULL    |       |
| to_a        | smallint(6) | NO   | MUL | NULL    |       |
| departure   | datetime    | NO   |     | NULL    |       |
| arrival     | datetime    | NO   |     | NULL    |       |
| airline_id  | smallint(6) | NO   | MUL | NULL    |       |
| airplane_id | int(11)     | NO   | MUL | NULL    |       |
+-------------+-------------+------+-----+---------+-------+
8 rows in set (0.00 sec)

mysql> desc booking;
+--------------+---------------+------+-----+---------+-------+
| Field        | Type          | Null | Key | Default | Extra |
+--------------+---------------+------+-----+---------+-------+
| booking_id   | int(11)       | NO   | PRI | NULL    |       |
| flight_id    | int(11)       | NO   | MUL | NULL    |       |
| seat         | char(4)       | YES  |     | NULL    |       |
| passenger_id | int(11)       | NO   | MUL | NULL    |       |
| price        | decimal(10,2) | NO   |     | NULL    |       |
+--------------+---------------+------+-----+---------+-------+
5 rows in set (0.00 sec)

mysql> desc airport;
+------------+-------------+------+-----+---------+-------+
| Field      | Type        | Null | Key | Default | Extra |
+------------+-------------+------+-----+---------+-------+
| airport_id | smallint(6) | NO   | PRI | NULL    |       |
| iata       | char(3)     | YES  |     | NULL    |       |
| icao       | char(4)     | NO   |     | NULL    |       |
| name       | varchar(50) | NO   |     | NULL    |       |
+------------+-------------+------+-----+---------+-------+
4 rows in set (0.00 sec)

mysql> desc airplane;
+-------------+-----------------------+------+-----+---------+-------+
| Field       | Type                  | Null | Key | Default | Extra |
+-------------+-----------------------+------+-----+---------+-------+
| airplane_id | int(11)               | NO   | PRI | NULL    |       |
| capacity    | mediumint(8) unsigned | NO   |     | NULL    |       |
| type_id     | int(11)               | NO   |     | NULL    |       |
| airline_id  | smallint(6)           | NO   | MUL | NULL    |       |
+-------------+-----------------------+------+-----+---------+-------+
4 rows in set (0.00 sec)

mysql> desc airline;
+--------------+-------------+------+-----+---------+----------------+
| Field        | Type        | Null | Key | Default | Extra          |
+--------------+-------------+------+-----+---------+----------------+
| airline_id   | smallint(6) | NO   | PRI | NULL    | auto_increment |
| iata         | char(2)     | NO   |     | NULL    |                |
| airlinename  | varchar(30) | YES  |     | NULL    |                |
| base_airport | smallint(6) | NO   | MUL | NULL    |                |
+--------------+-------------+------+-----+---------+----------------+
4 rows in set (0.00 sec)

//INSERT_VALIDOS

//AIRPORT

INSERT INTO AIRPORT VALUES ('10','FRA','PARS','PARIS');
INSERT INTO AIRPORT VALUES ('10',null,'PARS','PARIS');

//AIRPLANE

INSERT INTO AIRPLANE VALUES ('11',225,49,2);

//AIRLINE

INSERT INTO AIRLINE VALUES ('4','SP','Iberia',1);
INSERT INTO AIRLINE VALUES ('4','SP',null,1);

//BOOKING
INSERT INTO BOOKING VALUES('8','5',null,'2',154.50);

//FLIGHT
INSERT INTO FLIGHT VALUES(13,'AE1078',9,2,"2022-06-01 10:15:00","2022-06-01 20:46:00",1,3);

//PASSENGERDETAILS
INSERT INTO PASSENGERDETAILS VALUES(4,"Pablo", "1995-04-30","m","Calle Juan Alonso 15","Madrid","28047","España","pgr795@gmail.com", 915255097);

INSERT INTO PASSENGERDETAILS VALUES(4,"Pablo", "1995-04-30",null,"Calle Juan Alonso 15","Madrid","28047","España",null,null);



SELECT f.flight_id,f.flightno vuelo, a1.name origen, a2.name destino
FROM flight f,airport a1, airport a2
WHERE a1.airport_id=f.from_a 
AND a2.airport_id=f.to_a 
AND flight_id 
NOT IN (SELECT f.flight_id FROM flight f,booking b WHERE f.flight_id=b.flight_id AND b.passenger_id="2") 
ORDER BY flight_id ASC;


SELECT f.flightno vuelo, a1.name origen, a2.name destino
FROM flight f,airport a1, airport a2
WHERE a1.airport_id=f.from_a 
AND a2.airport_id=f.to_a 
AND flight_id ='1';


SELECT f.flight_id,f.flightno vuelo, a1.name origen, a2.name destino
FROM flight f,airport a1, airport a2
WHERE a1.airport_id=f.from_a 
AND a2.airport_id=f.to_a 
AND flight_id 

$select = $conexion->prepare("SELECT f.flight_id,f.flightno vuelo, a1.name origen, a2.name destino,b.booking_id id
		FROM flight f,airport a1, airport a2,booking b
		WHERE a1.airport_id=f.from_a 
		AND a2.airport_id=f.to_a 
		AND b.flight_id=f.flight_id
		AND flight_id 
		IN (SELECT f.flight_id 
			FROM flight f,booking b 
			WHERE f.flight_id=b.flight_id 
			AND b.passenger_id='$id' 
			AND b.seat IS NULL) 
		ORDER BY origen ASC");