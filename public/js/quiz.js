$(document).ready(function () {

    $('.next-btn').on('click', function () {
        let checkboxesChecked = $(this).closest('.question-container').find('input[type="checkbox"]:checked').length;

        if (checkboxesChecked === 0) {
            alert('Выберите хотя бы один вариант ответа');
        } else {
            let $container = $(this).closest('.question-container');
            let $nextContainer = $container.next('.question-container');

            $container.addClass('d-none');
            $nextContainer.removeClass('d-none');
        }
    });

    $('#submit-btn').on('click', function() {
        let quizData = {};

        $('.question-container').each(function() {
            let questionId = $(this).attr('data-question-id');
            let selectedAnswers = [];

            $(this).find('input[type="checkbox"]:checked').each(function() {
                selectedAnswers.push($(this).val());
            });

            quizData[questionId] = selectedAnswers;
        });

        console.log(quizData);

        $.ajax({
            type: 'POST',
            url: '/quiz/process',
            data: JSON.stringify(quizData),
            success: function(response) {
            },
            error: function(error) {
                alert('Произошла ошибка при отправке данных на сервер:' + error);
            }
        });

    });
});