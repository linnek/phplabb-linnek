create table user
(
	user_id			varchar(80)			not null auto_increment,
	password		varchar(80)			not null,
	user_role		varchar(3)			not null,

	constraint 		pk_user
	primary key		(user_id)
);

create table book
(
	book_id			integer			not null auto_increment,
	isbn			varchar(13)		not null,
	title			varchar(200)	not null,
	pages			integer			not null,
	edition			integer			not null,
	published		integer			not null,
	publisher		varchar(80)		not null,

	constraint		pk_book
	primary key		(book_id)
);

create table author
(
	author_id		integer			not null auto_increment,
	first_name		varchar(40)		not null,
	last_name		varchar(40)		not null,
	social_secno	varchar(20)		,
	year_of_birth	integer			,
	info_url		varchar(200)	,

	constraint		pk_author
	primary key		(author_id)
);

create table book_author
(
	book_id			integer			not null,
	author_id		integer			not null,

	constraint		pk_book_author
	primary key		(book_id, author_id),

	constraint		fk1_book_author
	foreign key		(book_id)
	references		book (book_id),

	constraint		fk2_book_author
	foreign key		(author_id)
	references		author (author_id)
);

create table library
(
	library_id		integer			not null auto_increment,
	library_name	varchar(80)		not null,

	constraint		pk_library
	primary key		(library_id)
);

create table library_book
(
	library_id		integer			not null,
	book_id			integer			not null,
	barcode			varchar(20)		not null,
	shelf			varchar(20)		not null,
	added			date			not null,

	constraint		pk_library_book
	primary key		(barcode),

	constraint		fk1_library_book
	foreign key		(book_id)
	references		book (book_id),

	constraint		fk2_library_book
	foreign key		(library_id)
	references		library (library_id)
);