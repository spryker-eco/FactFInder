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
    $('.fact-finder-sort-action').click(function(event){
        event.preventDefault();

        var url = $('.fact-finder-sort-options').val();
        var productsPerPage = $('.fact-finder-products-per-page').val();

        window.location = url + '&productsPerPage=' + productsPerPage;
    });

    $('.fact-finder-range-filter').click(function(event){
        event.preventDefault();

        var form = $(this).parents('form:first');
        var minimum = $(form).find("input[name='min']").val();
        var maximum = $(form).find("input[name='max']").val();
        var previousMinimum = $(form).find("input[name='min']").attr('data-old-value');
        var previousMaximum = $(form).find("input[name='max']").attr('data-old-value');
        var formAction = $(form).attr('action');
        var filterName = $(form).data('filter-name');

        formAction = formAction.replace(
            filterName + '=' + previousMinimum + '-' + previousMaximum,
            filterName + '=' + minimum + '-' + maximum
        );

        $(form).attr('action', formAction);
        $(form).find("input[name='min']").attr('data-old-value', minimum);
        $(form).find("input[name='max']").attr('data-old-value', maximum);
        window.location = formAction;
    });

    $('.fact-finder-range-filter-input-of, .fact-finder-range-filter-input-to').change(function(event){
        var input = $(event.target);

        if (parseFloat(input.val()) > parseFloat(input.attr('max'))) {
            input.val(input.attr('max'));
        }

        if (parseFloat(input.val()) < parseFloat(input.attr('min'))) {
            input.val(input.attr('min'));
        }

        var ofInput = $('.fact-finder-range-filter-input-of');
        var toInput = $('.fact-finder-range-filter-input-to');

        ofInput.attr('max', toInput.val());
        toInput.attr('min', ofInput.val());
    });

    $("#ffSearchInput").keyup(function(e){
        switch(e.which) {
            case 38: // up
                suggestionsBox.highlightRow(-1);
                break;

            case 40: // down
                suggestionsBox.highlightRow(1);
                break;

            case 13: // enter
                suggestionsBox.goTo(e);
                break;

            default: factFinderSuggestions.query($("#ffSearchInput").val());
                break;
        }
    });

    $("#ffSearchInput").click(function(){
        factFinderSuggestions.query($("#ffSearchInput").val());
    });

    $(document).click(function(){
        suggestionsBox.showSuggestionsBox(false);
    });

    $(document).on('click','.fact-finder-track', function(event) {
        var data = $(event.currentTarget).data('tracking');
        track.query(data);
    });

    $(document).on('click','.fact-finder-feedback-send', function(event) {
        event.preventDefault();

        var query = $('.fact-finder-feedback-query').val();
        var positive = $('.fact-finder-feedback-positive').val();
        var message = $('.fact-finder-feedback-message').val();
        var data = {
            "id": "none",
            "event": "feedback",
            "query": query,
            "positive": positive,
            "message": message
        };

        track.query(data);
    });


    $(document).on('click','.ff-suggestion-box a', function(event) {
        event.preventDefault();

        var link = $(event.target).closest('a');
        var url = link.attr('href');
        var trackingData = link.data('tracking');

        track.query(trackingData);
        window.location.href = url;
    });
}

module.exports = {
    init: init
};
