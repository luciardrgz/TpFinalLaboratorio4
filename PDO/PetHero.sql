create database PetHero;
use PetHero;

create table cupones(
id int auto_increment,
importe float not null,
fecha date,
constraint pk_id_cupon primary key (id)
)engine=InnoDB;

select * 
from cupones;

create table PetTypes(
id int auto_increment,
type_description varchar(45) unique,
constraint pk_id_pet_type primary key (id)
)engine=InnoDB;

select * 
from pettype;

create table petBreeds(
id int auto_increment,
breed varchar(50) not null unique,
id_pet_type int not null,
constraint pk_id_petbreed primary key (id),
constraint fk_id_pettype_breeds foreign key (id_pet_type) references petTypes (id)
)engine=InnoDB;

select * 
from petBreeds;

create table petSizes(
id int auto_increment,
size varchar(100) not null,
constraint pk_id_petsize primary key (id)
)engine=InnoDB;

select * 
from petSizes;

create table Owners(
id int auto_increment,
email varchar(100) unique not null,
pass varchar(20) not null,
first_name varchar(30) not null,
last_name varchar(30) not null,
phone int not null,
birth_date date not null,
nickname varchar(30) not null,
constraint pk_id_owner primary key (id)
)engine=InnoDB;

select * 
from owners;

create table Guardians(
id int auto_increment,
email varchar(100) not null,
pass varchar(100) not null,
first_name varchar(100) not null,
last_name varchar(100) not null,
phone int not null,
birth_date date not null,
nickname varchar(100) not null unique,
score int,
first_available_day date,
last_available_day date,
price float,
constraint pk_id_guardian primary key (id),
constraint check_score check (score <= 5 and score >= 0) 
)engine=InnoDB;

select * 
from Guardians;

create table Pets(
id int auto_increment,
id_pet_owner int not null,
id_pet_breed int,
id_pet_size int,
name varchar(50),
picture varchar(150)unique,
video varchar(150),
vaccination varchar(150)unique,
id_pet_type int not null,
constraint pk_id_pet primary key (id),
constraint fk_id_petowner foreign key (id_pet_owner) references Owners(id),
constraint fk_id_petbreed foreign key (id_pet_breed) references petBreeds (id),
constraint fk_id_petsize foreign key (id_pet_size) references petSizes (id),
constraint fk_id_pettype_pets foreign key (id_pet_type) references petTypes (id)
)engine=InnoDB;

select * 
from Pets;

/*
create table OwnerXPet(
id int auto_increment,
id_owner int not null,
id_pet int not null ,
constraint pk_id_owner_pet primary key (id),
constraint fk_id_owner foreign key (id_owner) references Owners(id),
constraint fk_id_pet foreign key (id_pet) references Pets(id)
)engine=InnoDB;

select * 
from OwnerXPet;*/

create table GuardianXSize(
id int auto_increment,
id_guardian int not null,
id_petsize int not null,
constraint pk_id_guardian_size primary key (id),
constraint fk_id_guardian foreign key (id_guardian) references Guardians(id),
constraint fk_id_size foreign key (id_petsize) references PetSizes(id)
)engine=InnoDB;

select * 
from GuardianXSize;

create table BookingStatus(
id int auto_increment,
booking_status varchar(50) not null,
constraint pk_id_status primary key (id)
)engine=InnoDB;

select * 
from BookingStatus;

create table Bookings(
id int auto_increment,
id_status int,
start_date date not null,
end_date date not null,
totalAmount int,
id_guardian int,
id_cupon int,
constraint pk_id_booking primary key (id),
constraint fk_id_guardian_bookings foreign key (id_guardian) references Guardians(id),
constraint fk_id_status_bookings foreign key (id_status) references BookingStatus(id),
constraint fk_id_cupon_bookings foreign key (id_cupon) references cupones(id)
)engine=InnoDB;

select * 
from Bookings;

create table OwnerXBooking(
id int auto_increment,
id_owner int not null,
id_booking int not null,
constraint pk_id_oxb primary key (id),
constraint fk_owner_oxb foreign key (id_owner) references Owners(id),
constraint fk_booking_oxb foreign key (id_booking) references Bookings(id)
)engine=InnoDB;

select * 
from OwnerXBooking;

create table BookingXPet(
id int auto_increment,
id_booking int not null,
id_pet int not null,
constraint pk_id_booking_pet primary key (id),
constraint fk_id_booking_bxp foreign key (id_booking) references Bookings(id),
constraint fk_id_pet_bxp foreign key (id_pet) references Pets(id)
)engine=InnoDB;

select * from Guardians;
select * from Owners; 

Select g.id, g.email, g.pass, g.first_name, g.last_name, g.phone, g.birth_date, g.nickname, g.score, g.first_available_day, g.last_available_day, g.price ,ps.size  
from Guardians as g
left join GuardianXSize as gxs
on g.id = gxs.id_guardian
left join petsizes as ps
on gxs.id_petsize = ps.id
where email = 'pepe@gmail.com';

insert into PetTypes (type_description) values
('Dog'), ('Cat');
select * from PetTypes;

insert into PetBreeds (breed, id_pet_type) values
('Labrador', 1), ('Golden', 1), ('Chihuahua', 1), ('Husky', 1), ('Shepard', 1),
('Sphynx', 2), ('Persian', 2), ('Ragdoll', 2), ('Scottish', 2);
select * from PetBreeds;

insert into PetSizes (size) values
('Small'), ('Medium'), ('Big');
select * from PetSizes;

/* Pruebas select*/
SELECT * FROM PetBreeds WHERE (id_pet_type = 1);
SELECT * FROM  PetBreeds WHERE (breed = 'Golden');

/* Prueba insert*/
insert into Pets (id_pet_owner, id_pet_breed, id_pet_size, name, picture, video, vaccination, id_pet_type) values
(1, 2, 3, 'Daniel', 'danielpic.com', 'danielvid.com', 'danielvacc.com', 1),
(1, 3, 1, 'Missy', 'missypic.com', '', 'missyvacc.com', 1),
(1, 4, 2, 'Michi', 'michipic.com', '', 'michivacc.com', 2);
select * from Pets;

select * from Owners;

SELECT * FROM Pets WHERE (id_pet_owner = 1);
select * from petsizes;

SELECT * FROM PetBreeds WHERE (id_pet_type = 1);

select * from guardians;

SELECT g.id as 'IdGuardian', gxs.id_petsize as 'IdPetSize', gxs.id as 'Id GxPS'
from guardians as g
left join guardianxsize as gxs
on g.id = gxs.id_guardian
left join petsizes as ps
on gxs.id_petsize = ps.id;


select * from guardians;

UPDATE Guardians 
SET first_available_day = '2022-05-12', last_available_day = '2022-05-31' WHERE id = 1;

SELECT * FROM Guardians
WHERE (first_available_day >= '2022-11-14' AND last_available_day >= '2022-11-18');

SELECT g.id, g.email, g.pass, g.first_name, g.last_name, g.phone, g.birth_date, 
g.nickname, g.score, g.first_available_day, g.last_available_day, g.price, ps.size  
FROM guardians AS g 
LEFT JOIN GuardianXSize AS gxs
ON g.id = gxs.id_guardian
LEFT JOIN petsizes AS ps
ON gxs.id_petsize = ps.id 
WHERE g.id = 1;


/*
SELECT p.id_pet_breed, p.id_pet_size, p.name, p.picture, p.video, p.vaccination, p.petType   
FROM Pets as p
LEFT JOIN PetBreeds AS pb
ON p.id_pet_breed = pb.id
LEFT JOIN PetSizes AS ps
ON p.id_pet_size = ps.id;*/



