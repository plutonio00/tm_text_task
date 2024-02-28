$(document).ready(function () {

    $('.next-btn').on('click', function () {
        if (!validateAnswer($(this))) {
            return;
        }

        let $container = $(this).closest('.question-container');
        let $nextContainer = $container.next('.question-container');

        $container.addClass('d-none');
        $nextContainer.removeClass('d-none');
    });

    function validateAnswer ($btn) {
        let checkboxesChecked = $btn.closest('.question-container').find('input[type="checkbox"]:checked').length;

        if (checkboxesChecked === 0) {
            alert('Выберите хотя бы один вариант ответа');
            return false;
        }
    }

    $('#quiz-form').on('submit', function(e) {
        e.preventDefault();

        if (!validateAnswer($(this))) {
            return;
        }

        $.ajax({
            type: 'POST',
            url: '/quiz/process',
            data: $(this).serialize(),
            success: function(response) {
            },
            error: function(error) {
                alert('Произошла ошибка при отправке данных на сервер:' + error);
            }
        });

    });
});