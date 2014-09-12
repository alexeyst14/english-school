<?php
return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Гость',
        'bizRule' => null,
        'data' => null
    ),
    'student' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Студент',
        'children' => array(
            'guest', // student can do all what can do a guest
        ),
        'bizRule' => null,
        'data' => null
    ),
    'teacher' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Преподаватель',
        'children' => array(
            'student',  // teacher can do all what can do a student
        ),
        'bizRule' => null,
        'data' => null
    ),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Администратор',
        'children' => array(
            'teacher',	// admin  can do all what can do a teacher
        ),
        'bizRule' => null,
        'data' => null
    ),
);