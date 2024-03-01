<?php

use App\DataFixtures\QuestionFixture;

return [
    [
        'id' => 1,
        'question_id' => QuestionFixture::ID_1,
        'text' => '3',
        'is_correct' => false,
    ],
    [
        'id' => 2,
        'question_id' => QuestionFixture::ID_1,
        'text' => '2',
        'is_correct' => true,
    ],
    [
        'id' => 3,
        'question_id' => QuestionFixture::ID_1,
        'text' => '0',
        'is_correct' => false,
    ],
    [
        'id' => 4,
        'question_id' => QuestionFixture::ID_2,
        'text' => '4',
        'is_correct' => true,
    ],
    [
        'id' => 5,
        'question_id' => QuestionFixture::ID_2,
        'text' => '3 + 1',
        'is_correct' => true,
    ],
    [
        'id' => 6,
        'question_id' => QuestionFixture::ID_2,
        'text' => '10',
        'is_correct' => false,
    ],
    [
        'id' => 7,
        'question_id' => QuestionFixture::ID_3,
        'text' => '1 + 5',
        'is_correct' => true,
    ],
    [
        'id' => 8,
        'question_id' => QuestionFixture::ID_3,
        'text' => '1',
        'is_correct' => false,
    ],
    [
        'id' => 9,
        'question_id' => QuestionFixture::ID_3,
        'text' => '6',
        'is_correct' => true,
    ],
    [
        'id' => 10,
        'question_id' => QuestionFixture::ID_3,
        'text' => '2 + 4',
        'is_correct' => true,
    ],
    [
        'id' => 11,
        'question_id' => QuestionFixture::ID_4,
        'text' => '8',
        'is_correct' => true,
    ],
    [
        'id' => 12,
        'question_id' => QuestionFixture::ID_4,
        'text' => '4',
        'is_correct' => false,
    ],
    [
        'id' => 13,
        'question_id' => QuestionFixture::ID_4,
        'text' => '0',
        'is_correct' => false,
    ],
    [
        'id' => 14,
        'question_id' => QuestionFixture::ID_4,
        'text' => '0 + 8',
        'is_correct' => true,
    ],
    [
        'id' => 15,
        'question_id' => QuestionFixture::ID_5,
        'text' => '6',
        'is_correct' => false,
    ],
    [
        'id' => 16,
        'question_id' => QuestionFixture::ID_5,
        'text' => '18',
        'is_correct' => false,
    ],
    [
        'id' => 17,
        'question_id' => QuestionFixture::ID_5,
        'text' => '10',
        'is_correct' => true,
    ],
    [
        'id' => 18,
        'question_id' => QuestionFixture::ID_5,
        'text' => '9',
        'is_correct' => false,
    ],
    [
        'id' => 19,
        'question_id' => QuestionFixture::ID_5,
        'text' => '0',
        'is_correct' => false,
    ],
];