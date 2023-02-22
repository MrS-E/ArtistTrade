-- Accounts and Posts DB Creation Onito
-- create database
drop database if exists Onito_DB;
create database Onito_DB;
use Onito_DB;

-- create Tables
-- Accounts of Creater
create table TAccountsCreater(
CreatID int auto_increment primary key,
CreatSurname varchar(50) not null,
CreatName varchar(50) not null,
CreatUsername varchar(50) not null,
CreatPasswd varchar(998) not null,
CreatEMail varchar(998) not null,
CreatTelefon varchar(17),
CreatTyp enum('Painter','Musician','Programmer','Photographer','Moviemaker','Author'),
CreatDescryption text,
CreatCreateDate timestamp not null
);
alter table TAccountsCreater auto_increment=1000000;
-- Accounts of Users
create table TAccountsUser(
UseID int auto_increment primary key,
UseSurname varchar(50) not null,
UseName varchar(50) not null,
UseUsername varchar(50) not null,
UsePasswd varchar(998) not null,
UseEMail varchar(998) not null,
UseTelefon varchar(17),
UseBirthday date,
UseCreateDate timestamp not null
);
alter table TAccountsUser auto_increment=1000000;
-- Posts
create table TContributions(
ConID int auto_increment primary key,
CreatID int not null,
ConTyp enum('pdf','txt','docx','png','jpg','img','ico','jpeg','gif','mp3','wav','aac','mp4','mov','avi','mkv','webm') not null,
ConFile longblob not null,
ConDescryption text,
ConDate timestamp not null
);
-- Comments
create table TComments(
CommID int auto_increment primary key,
ConID int not null,
UseID int not null,
CommText text not null,
CommDate timestamp not null
);

-- create users
-- Add User
/*create user add_user@localhost identified by '12r87hasd3g1';
grant insert on Onito_DB.TAccountsCreater to add_user;
grant insert on Onito_DB.TAccountsUser to add_user;
-- Add Post
create user add_post@localhost identified by 'uahf7d98sdfho23';
grant insert on Onito_DB.TContributions to add_post;
-- Add Comment
create user add_comment@localhost identified by 'agdfh89hih76(/(op';
grant insert on Onito_DB.TComments to add_comment;
-- Show Posts and Users
create user show_posts_user@localhost identified by 'azsudfshf2019qguk';
grant select on Onito_DB.* to show_posts_user;
-- change user
create user change_user@localhost identified by '97ADGS0QWG79DVSDFG';
grant update, delete on Onito_DB.TAccountsCreater to change_user;
grant update, delete on Onito_DB.TAccountsUser to change_user;
-- delete content
create user delete_content@localhost identified by 'adjkghu9qv89rup9v';
grant select, delete on Onito_DB.TContributions to delete_content;
grant select, delete on Onito_DB.TComments to delete_content;*/
-- complette user
create user all_user identified by 'af928ioahfiuodhiuoe012390qufhuiglvtzff()/=)hzguhaodifguo';
grant select, update, delete, insert on Onito_DB.* to all_user;

-- system variables
-- safe updates --> for deleting
-- set sql_safe_updates=false;
-- add bigger packets in config
set max_allowed_packet='1000M';
set net_buffer_length='10M';


