/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

'use strict';

var $ = require('jquery');
var factFinderSuggestions = require('./fact-finder-suggestions');
var suggestionsBox = require('./fact-finder-suggestions-box');
var track = require('./fact-finder-track');

function init(config) {
    $('.fact-finder-products-per-page, .fact-finder-sort-options').change(function(event){
        window.location = $(event.target).val();
    });

    $('.fact-finder-filter-checkbox').change(function (event) {
        $(event.target).parent()[0].click();
    });

    $('.fact-finder-range-filter').click(function(event){
        event.preventDefault();

        var form = $(this).parents('form:first');
        var minimumInput = form.find("input[name='min']");
        var maximumInput = form.find("input[name='max']");
        var minimum = minimumInput.val();
        var maximum = maximumInput.val();
        var previousMinimum = minimumInput.attr('data-old-value');
        var previousMaximum = maximumInput.attr('data-old-value');
        var formAction = $(form).attr('action');
        var filterName = form.attr('data-filter-name');

        formAction = formAction.replace(
            filterName + '=' + previousMinimum + '-' + previousMaximum,
            filterName + '=' + minimum + '-' + maximum
        );

        form.attr('action', formAction);
        minimumInput.attr('data-old-value', minimum);
        maximumInput.attr('data-old-value', maximum);
        window.location = formAction;
    });

    $('.fact-finder-range-filter-input-of').change(function(event){
        var input = $(event.target);
        var form = $(this).parents('form:first');
        var maximumInput = form.find('.fact-finder-range-filter-input-to');

        if (parseFloat(input.val()) > parseFloat(maximumInput.val())) {
            input.val(maximumInput.val());
            return;
        }

        if (parseFloat(input.val()) < parseFloat(input.attr('data-absolute-minimum'))) {
            input.val(input.attr('data-absolute-minimum'));
        }
    });

    $('.fact-finder-range-filter-input-to').change(function(event){
        var input = $(event.target);
        var form = $(this).parents('form:first');
        var minimumInput = form.find('.fact-finder-range-filter-input-of');

        if (parseFloat(input.val()) < parseFloat(minimumInput.val())) {
            input.val(minimumInput.val());
            return;
        }

        if (parseFloat(input.val()) > parseFloat(input.attr('data-absolute-maximum'))) {
            input.val(input.attr('data-absolute-maximum'));
        }
    });

    $("#ffSearchInput").keyup(function (event) {
        keyupNavigationHandler(event);
    });

    $("#ffSearchInput").keyup(_.debounce(function(event) {
        keyupSuggestionsHandler(event);
    }, 500));

    $("#ffSearchInput").click(function(){
        factFinderSuggestions.query($("#ffSearchInput").val());
    });

    $(document).click(function(){
        suggestionsBox.showSuggestionsBox(false);
    });

    $(document).on('mousedown','.fact-finder-track', function(event) {
        if (event.which === 1 || event.which === 2) {
            var data = $(event.currentTarget).data('tracking');
            track.query(data);
        }
    });

    $(document).on('click','.fact-finder-feedback-send', function(event) {
        event.preventDefault();

        var query = $('.fact-finder-feedback-query').val();
        var positive = $('.fact-finder-feedback-positive').val();
        var message = $('.fact-finder-feedback-message').val();
        var data = {
            "id": "none",
            "event": "feedback",
            "query": query !== '' ? query : '*',
            "positive": positive,
            "message": message
        };

        track.query(data);
    });


    $(document).on('mousedown','.ff-suggestion-box a', function(event) {
        if (event.which === 1 || event.which === 2) {
            event.preventDefault();

            var link = $(event.target).closest('a');
            var url = link.attr('href');
            var trackingData = link.data('tracking');

            track.query(trackingData);
            window.location.href = url;
        }
    });
}

function keyupNavigationHandler(event) {
    switch(event.which) {
        case 38: // up
            console.log('up');
            suggestionsBox.highlightRow(-1);
            break;

        case 40: // down
            console.log('down');
            suggestionsBox.highlightRow(1);
            break;

        case 13: // enter
            suggestionsBox.goTo(event);
            break;
    }
}

function keyupSuggestionsHandler(event) {
    if (event.which !== 38 && event.which !== 40 && event.which !== 13) {
        factFinderSuggestions.query(event.target.value);
    }
}

module.exports = {
    init: init
};
