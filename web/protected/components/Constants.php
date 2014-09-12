<?php

class Constants
{
	const HEADER_MAIN = 'Главная';
	const HEADER_MANAGE = 'Управление';
	const HEADER_EDIT = 'Редактирование';
	const HEADER_NEW = 'Новый';
	const HEADER_USERS = 'Пользовалели';
	const HEADER_NEW_USER = 'Новый пользовалели';
	const HEADER_GROUPS = 'Группы';
}

/*
 * Леха, я думал тебе константы для чего то другого нужны.
 * Почитай лучше эту тему http://www.yiiframework.com/doc/guide/1.1/ru/topics.i18n
 * Если вдруг нужна будет интернализация - все эти константы будут нах не нужны.
 * Лучше писать прямым текстом. А при интернализации просто добавим Yii::t('Прямой текст'),
 * и это будет автоматически переведено на нужный язык.
 */

