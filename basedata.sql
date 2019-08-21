
insert into book values (1, '123456789', 'My book', 200, 1, 1993, 'Good Books Inc');
commit;

insert into author values (1, 'Linn', 'Ekroth', '19930421-9083', 1993, '');
commit;

insert into book_author values (1, 1);
commit;

insert into library values (1, 'Book Club Online');
commit;

insert into library_book values (1, 1, '123456789', 'Novels', '2018-12-04');
commit;
