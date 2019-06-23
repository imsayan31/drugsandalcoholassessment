jQuery(document).ready(function ($) {

    $('#user_phone_updated').mask('(000) 000-0000');
    $('#user_zipcode').mask('00000');
    
    /* Add Survey Answer */
    $('.add-survey-answer').on('click', function(){
        var makeAnswerDiv = '';
        makeAnswerDiv += '<tr>';
        makeAnswerDiv += '<td>';
        makeAnswerDiv += '<input type="text" name="survey_answers[]" value="" placeholder="Enter answer" autocomplete="off"/>';
        makeAnswerDiv += '</td>';
        makeAnswerDiv += '<td>';
        makeAnswerDiv += '<a href="javascript:void(0);" class="remove-answers button button-primary">Remove answer</a>';
        makeAnswerDiv += '</td>';
        makeAnswerDiv += '</tr>';

        var countAnswer = $('.survey-answer-sec').find('tr').length;

        if(countAnswer == 0){
            $('.survey-answer-sec').parent('table').show();
            $('.survey-answer-sec').html(makeAnswerDiv);
        } else{
            $('.survey-answer-sec').find('tr').last().after(makeAnswerDiv);
        }

    });

    /* Remove Answers */
    $(document.body).on('click', '.remove-answers', function(){
        var _this = $(this);
        _this.closest('tr').remove();
    });

});
