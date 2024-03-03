$(document).ready(function () {

    $('.next-btn').on('click', function () {
        let $currentContainer = $(this).closest('.question-container');

        if (!isValidAnswer($currentContainer)) {
            return;
        }

        let $nextContainer = $currentContainer.next('.question-container');

        $currentContainer.addClass('d-none');
        $nextContainer.removeClass('d-none');
    });

    $('.back-btn').on('click', function () {
        let $currentContainer = $(this).closest('.question-container');
        let $previousContainer = $currentContainer.prev('.question-container');

        $currentContainer.addClass('d-none');
        $previousContainer.removeClass('d-none');
    });

    function isValidAnswer ($container) {
        let checkboxesChecked = $container.find('input[type="checkbox"]:checked').length;

        if (checkboxesChecked === 0) {
            alert('Выберите хотя бы один вариант ответа');
            return false;
        }

        return true;
    }

    $('#start-btn').on('click', function () {
        $('#greeting').addClass('d-none');
        let $firstQuestionContainer = $('#quiz-form .question-container').first();
        $firstQuestionContainer.removeClass('d-none');
    });

    $('#quiz-form').on('submit', function(e) {
        e.preventDefault();

        let $currentContainer = $('#submit-btn').closest('.question-container');

        if (!isValidAnswer($currentContainer)) {
            return;
        }

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    let $resultContainer = $('#result-container');
                    $resultContainer.html(response.view);
                    let $lastQuestionContainer = $('#quiz-form .question-container').last();
                    $lastQuestionContainer.addClass('d-none');
                    $resultContainer.removeClass('d-none');
                } else {
                    alert('Произошла ошибка при обработке ответов. Попробуйте еще раз');
                }
            },
            error: function() {
                alert('Произошла ошибка при обработке ответов. Попробуйте еще раз');
            }
        });

    });
});