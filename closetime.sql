ALTER TABLE `restaurant` ADD `r_close` TIME NOT NULL AFTER `r_menu`;

update restaurant set r_close='23:00:00' WHERE r_id=1;

update restaurant set r_close='23:30:00' WHERE r_id=2;

update restaurant set r_close='23:00:00' WHERE r_id=3;

update restaurant set r_close='23:00:00' WHERE r_id=4;

update restaurant set r_close='23:00:00' WHERE r_id=5;

update restaurant set r_close='23:30:00' WHERE r_id=6;

update restaurant set r_close='23:00:00' WHERE r_id=7;

update restaurant set r_close='23:00:00' WHERE r_id=8;

update restaurant set r_close='23:30:00' WHERE r_id=9;

update restaurant set r_close='24:00:00' WHERE r_id=10;

update restaurant set r_close='23:30:00' WHERE r_id=11;

update restaurant set r_close='23:30:00' WHERE r_id=12;