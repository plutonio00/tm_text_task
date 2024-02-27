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

});