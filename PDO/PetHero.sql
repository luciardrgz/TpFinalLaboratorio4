create database PetHero;
use PetHero;

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

create table scores(
id int auto_increment,
id_guardian int not null,
id_owner int not null,
score int not null,
review varchar(300),
constraint pk_id_score primary key (id),
constraint fk_id_guardian_score foreign key (id_guardian) references Guardians(id),
constraint fk_id_owner_score foreign key (id_guardian) references owners(id),
constraint check_score_table check (score <= 5 and score >= 0)
)engine=InnoDB;

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
constraint fk_id_status_bookings foreign key (id_status) references BookingStatus(id)
)engine=InnoDB;

select * 
from Bookings;

create table cupones(
id int auto_increment,
id_booking int,
importe float not null,
fecha date,
constraint pk_id_cupon primary key (id),
constraint fk_id_booking foreign key (id_booking) references bookings(id)
)engine=InnoDB;

select * 
from cupones;

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

# Default Inserts
insert into PetTypes (type_description) values
('Dog'), ('Cat');

insert into PetBreeds (breed, id_pet_type) values
('Labrador', 1), ('Golden', 1), ('Chihuahua', 1), ('Husky', 1), ('Shepherd', 1),
('Sphynx', 2), ('Persian', 2), ('Ragdoll', 2), ('Scottish', 2), ('Tuxedo', 2);

insert into PetSizes (size) values
('Small'), ('Medium'), ('Big');

insert into BookingStatus (booking_status) values ('Waiting'), ('Accepted'), ('Rejected'), ('Finished'), ('Confirmed'), ('Timed Out'), ('Rated');

#Selects 
SELECT * FROM PetTypes;
SELECT * FROM BookingStatus;
SELECT * FROM Owners;
SELECT * FROM Bookings; 
SELECT * FROM Pets;
SELECT * FROM PetSizes;
SELECT * FROM PetBreeds;
SELECT * FROM Guardians;
SELECT * FROM OwnerXBooking;
SELECT * FROM BookingXPet;
SELECT * FROM scores;
SELECT * FROM cupones;
SELECT * FROM scores;

