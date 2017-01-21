-- �������ݿ�

DROP DATABASE IF EXISTS `shopPolarbear`;
CREATE DATABASE `shopPolarbear` DEFAULT CHARSET=UTF8 ;
USE `shopPolarbear`;

-- ���ݱ�

-- ����Ա��

DROP TABLE IF EXISTS `polarbear_admin`;
CREATE TABLE `polarbear_admin`(
    `id` tinyint unsigned auto_increment key,
    `username` varchar(30) not null unique,
    `password` varchar(32) not null,
    `email` varchar(60) not null
);

-- �����

DROP TABLE IF EXISTS `polarbear_cate`;
CREATE TABLE `polarbear_cate`(
    `id` int unsigned auto_increment key,
    `cName` varchar(30) not null
);

-- ��Ʒ��:polarbear_pro

DROP TABLE IF EXISTS `polarbear_pro`;
CREATE TABLE `polarbear_pro`(
    `id` smallint unsigned auto_increment key,
    `pName` varchar(255) not null unique,
    `cId` int unsigned not null,
    `pSn` varchar(50) not null,
    `pNum` int unsigned not null default 0,
    `mPrice` decimal(10, 2) not null,
    `pPrice` decimal(10, 2) not null,
    `pDesc` mediumtext,
    `pImg` varchar(255) not null,
    `pubTime` int unsigned not null,
    `isShow` tinyint(1) not null default 1,
    `isHot` tinyint(1) not null default 0
);

-- ��Ա��:polarbear_user

DROP TABLE IF EXISTS `polarbear_user`;
CREATE TABLE `polarbear_user`(
    `id` int unsigned auto_increment key,
    `username` varchar(30) not null unique,
    `password` varchar(30) not null,
    `sex` enum("��", "Ů", "����") not null default "����",
    `email` varchar(60) not null,
    `face` varchar(50) not null,
    `regTime` int unsigned not null,
    `activeFlag` tinyint(1) not null default 0
);

-- ����:polarbear_album

DROP TABLE IF EXISTS `polarbear_album`;
CREATE TABLE `polarbear_album`(
    `id` int unsigned auto_increment key,
    `pId` int unsigned not null,
    `albumPath` varchar(50) not null
);
