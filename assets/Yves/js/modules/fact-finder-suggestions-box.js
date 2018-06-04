/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

var $ = require('jquery');
var tracking = require('./fact-finder-track');

var suggestionsBox = {

    cursorPosition: -1,
    hidden: true,

    prepareSuggestionsBlock: function (queryText, objectsList)     {
        this.clearProductSuggestionsBlock();
        this.clearCategoriesSuggestionsBlock();
        this.clearSearchTermsSuggestionsBlock();
        this.clearBrandsSuggestionsBlock();
        this.resetCursorPosition();

        $.each(objectsList, function (i, item) {
            if (item.type ===  'productName') {
                var productTemplateHtml = suggestionsBox.getProductTemplateHtml(item);
                $('.ff-products').append(productTemplateHtml);
                $('.ff-products').removeClass('is-hidden');
                return true;
            }
            if (item.type === 'category') {
                var categoryTemplateHtml = suggestionsBox.getCategoryTemplateHtml(item, queryText);
                $('.ff-categories').append(categoryTemplateHtml);
                $('.ff-categories').removeClass('is-hidden');
                return true;
            }
            if (item.type === 'brand') {
                var brandTemplateHtml = suggestionsBox.getBrandTemplateHtml(item, queryText);
                $('.ff-brands').append(brandTemplateHtml);
                $('.ff-brands').removeClass('is-hidden');
                return true;
            }
            if (item.type === 'searchTerm') {
                var searchTermsTemplateHtml = suggestionsBox.getSearchTermsTemplateHtml(item, queryText);
                $('.ff-search-terms').append(searchTermsTemplateHtml);
                $('.ff-search-terms').removeClass('is-hidden');
                return true;
            }
        });

        this.setSeeAllProductsLink();
        this.showSuggestionsBox(true);
    },

    getBoxRowHtml: function () {
        var template = $('#suggestions-box-row').clone();
        return $(template).prop('innerHTML');
    },

    replaceItemsInBoxRowHtml: function (item, template) {
        $.each(item, function (index, value) {
            if (typeof value === 'object') {
                value = JSON.stringify(value);
            }
            template = template.replace(':' + index, value);
        });

        return template;
    },

    getProductTemplateHtml: function (item) {
        var productTemplateHtml = this.getBoxRowHtml();
        item.url = item.attributes.deeplink;

        return this.replaceItemsInBoxRowHtml(item, productTemplateHtml);
    },

    getCategoryTemplateHtml: function (item, queryText) {
        var categoryTemplateHtml = this.getBoxRowHtml();
        item.url = this.constructUrl(item.url);

        if (item.attributes.parentCategory !== undefined && item.attributes.parentCategory !== "") {
            item.name = decodeURIComponent(item.attributes.parentCategory) + " > " + decodeURIComponent(item.name);
        }

        return this.replaceItemsInBoxRowHtml(item, categoryTemplateHtml);
    },

    getBrandTemplateHtml: function (item, queryText) {
        var brandTemplateHtml = this.getBoxRowHtml();
        item.url = this.constructUrl(item.url);

        return this.replaceItemsInBoxRowHtml(item, brandTemplateHtml);
    },

    getSearchTermsTemplateHtml: function (item, queryText) {
        var searchTermsTemplateHtml = this.getBoxRowHtml();;
        item.url = this.constructUrl(item.url);

        return this.replaceItemsInBoxRowHtml(item, searchTermsTemplateHtml);
    },

    clearProductSuggestionsBlock: function () {
        $('.ff-products > a').remove();
        $('.ff-products').addClass('is-hidden');
    },

    clearCategoriesSuggestionsBlock: function () {
        $('.ff-categories > a').remove();
        $('.ff-categories').addClass('is-hidden');
    },

    clearBrandsSuggestionsBlock: function () {
        $('.ff-brands > a').remove();
        $('.ff-brands').addClass('is-hidden');
    },

    clearSearchTermsSuggestionsBlock: function () {
        $('.ff-search-terms > a').remove();
        $('.ff-search-terms').addClass('is-hidden');
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
            var trackingData = link.data('tracking');

        if (typeof trackingData !== 'object' && trackingData !== undefined) {
                trackingData = JSON.parse(trackingData);
            }

            if (url != undefined) {
                tracking.query(trackingData);
                window.location.href = url;
            }
        }
    },

    constructUrl: function (itemUrl) {
        var uri = $('#fact-finder-search-input').data('category-uri');
        var query = this.getParamsFromUrl(itemUrl);
        var searchInput = $('#ffSearchInput').val();
        var urlQuery = '&';

        for (var index in query) {
            urlQuery += encodeURIComponent(index) + '=' + encodeURIComponent(query[index]) + '&';
        }
        urlQuery += 'userInput=' + searchInput;

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