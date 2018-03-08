/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

'use strict';

var $ = require('jquery');
var tracking = require('./fact-finder-track');

var suggestionsBox = {

    cursorPosition: -1,
    hidden: true,

    prepareSuggestionsBlock: function (queryText, objectsList)     {
        this.clearProductSuggestionsBlock();
        this.clearCategoriesSuggestionsBlock();
        this.clearSearchTermsSuggestionsBlock();
        this.resetCursorPosition();

        $.each(objectsList, function (i, item) {
            if (item.type == 'productName') {
                var productTemplateHtml = suggestionsBox.getProductTemplateHtml(item);
                $('.ff-products').append(productTemplateHtml);
                return true;
            }
            if (item.type == 'category') {
                var categoryTemplateHtml = suggestionsBox.getCategoryTemplateHtml(item, queryText);
                $('.ff-categories').append(categoryTemplateHtml);
                return true;
            }
            if (item.type == 'searchTerm') {
                var searchTermsTemplateHtml = suggestionsBox.getSearchTermsTemplateHtml(item, queryText);
                $('.ff-search-terms').append(searchTermsTemplateHtml);
                return true;
            }
        });

        this.setSeeAllProductsLink();
        this.showSuggestionsBox(true);
    },

    getProductTemplateHtml: function (item) {
        var productTemplate = $('#suggestions-box-row').clone();
        var productTemplateHtml = $(productTemplate).prop('innerHTML');
        item.url = item.attributes.deeplink;

        $.each(item, function (index, value) {
            if (typeof value == 'object') {
                value = JSON.stringify(value);
            }
            productTemplateHtml = productTemplateHtml.replace(':' + index, value);
        });

        return productTemplateHtml;
    },

    getCategoryTemplateHtml: function (item, queryText) {
        var categoryTemplate = $('#suggestions-box-row').clone();
        var categoryTemplateHtml = $(categoryTemplate).prop('innerHTML');
        item.url = this.constructUrl(item.url);

        if (item.attributes.parentCategory != undefined && item.attributes.parentCategory != "") {
            item.name = item.attributes.parentCategory + " > " + item.name;
        }

        $.each(item, function (index, value) {
            categoryTemplateHtml = categoryTemplateHtml.replace(':' + index, value);
        });

        return categoryTemplateHtml;
    },

    getSearchTermsTemplateHtml: function (item, queryText) {
        var searchTermsTemplate = $('#suggestions-box-search-term-row').clone();
        var searchTermsTemplateHtml = searchTermsTemplate.prop('innerHTML');
        item.url = this.constructUrl(item.url);

        $.each(item, function (index, value) {
            searchTermsTemplateHtml = searchTermsTemplateHtml.replace(':' + index, value);
        });

        return searchTermsTemplateHtml;
    },

    clearProductSuggestionsBlock: function () {
        $('.ff-products').html('');
    },

    clearCategoriesSuggestionsBlock: function () {
        $('.ff-categories').html('');
    },

    clearSearchTermsSuggestionsBlock: function () {
        $('.ff-search-terms').html('');
    },

    showSuggestionsBox: function (show) {
        if (show === true) {
            $('.ff-suggestion-box').removeClass('is-hidden');
            this.hidden = false;
        } else {
            $('.ff-suggestion-box').addClass('is-hidden');
            this.hidden = true;
        }
    },

    setSeeAllProductsLink: function () {
        var searchValue = $('#ffSearchInput').val();
        $('.ff-all-products').attr('href', this.getAllProductsUrl() + searchValue);
    },

    resetCursorPosition: function () {
        this.cursorPosition = -1;
    },

    unhighlightAllRows: function () {
        if ($('.suggestions').find('a.js-navigable') != undefined) {
            $('.suggestions').find('a.js-navigable').removeClass('is-active');
        }
    },

    highlightRow: function (step) {
        var rows = $('.suggestions').find('a.js-navigable');
        var rowsCount = rows.length;

        if (rowsCount == 0) {
            return false;
        }
        this.unhighlightAllRows();

        if (step > 0 && rowsCount <= this.cursorPosition + step) {
            this.resetCursorPosition();
        }

        if (step < 0 && this.cursorPosition + step == -1) {
            this.cursorPosition = rowsCount;
        }

        this.cursorPosition += step;
        $(rows[this.cursorPosition]).addClass('is-active');
    },

    goTo: function (e) {
        e.preventDefault();

        var link = $('.suggestions').find('a.js-navigable.is-active');

        if (link != undefined) {
            var url = link.attr('href');
            var trackingData = JSON.parse(link.data('tracking'));

            if (url != undefined) {
                tracking.query(trackingData);
                window.location.href = url;
            }
        }
    },

    constructUrl: function (itemUrl) {
        var uri = $('#fact-finder-search-input').data('category-uri');
        var query = this.getParamsFromUrl(itemUrl);
        var urlQuery = '?';

        for (var index in query) {
            urlQuery += encodeURIComponent(index) + '=' + encodeURIComponent(query[index]) + '&';
        }

        return uri + urlQuery;
    },

    getAllProductsUrl: function () {
        var uri = $('#fact-finder-search-input').data('search-uri');

        return uri + '?query=';
    },

    getParamsFromUrl: function(url) {
        var query = url.split("?");
        var result = [];

        if (query[1] !== undefined) {
            query[1].split("&").forEach(function(part) {
                var item = part.split("=");
                result[decodeURIComponent(item[0])] = decodeURIComponent(item[1]);
            });
        }

        return result;
    }

};

module.exports = suggestionsBox;