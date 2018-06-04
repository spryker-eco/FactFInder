/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

var $ = require('jquery');
var suggestionsBox = require('./fact-finder-suggestions-box');

var factFinderSuggestions = {

    url: '/fact-finder/suggestions?format=jsonp&query=',
    maxItemsCount: 10,
    queryText: '',

    query: function (queryText) {
        if (queryText == '') {
            return false;
        }
        this.queryText = queryText;

        $.ajax({
            type: 'GET',
            url: this.buildUrl(queryText),
            context: this,
            success: this.handleAjaxResponse
        });
    },

    handleAjaxResponse: function (response) {
        var searchResult = response;
        if (searchResult == undefined) {
            return false;
        }
        var objectsList = this.prepareObjectsList(searchResult);

        if (objectsList.length > 0) {
            suggestionsBox.prepareSuggestionsBlock(this.queryText, objectsList);
        }
    },

    buildUrl: function (queryText) {
        return this.url + encodeURIComponent(queryText);
    },

    prepareObjectsList: function (items) {
        var objectsList = [];

        $.each(items, function (i, item) {
            objectsList.push({
                'name': factFinderSuggestions.getHighlited(item.label, factFinderSuggestions.queryText),
                'url': item.url,
                'image': item.imageUrl,
                'type': item.type,
                'attributes': item.attributes,
                'label': item.label,
                'tracking': {
                    'id': item.attributes.id,
                    'masterId': item.attributes.masterId,
                    'mainId': item.attributes.masterId,
                    'event': 'recommendationClick'
                }
            });
        });

        objectsList = this.getDecreasedItemsList(objectsList);

        return objectsList;
    },

    getDecreasedItemsList: function (items) {
        if (items.length > this.maxItemsCount) {
            items.length = this.maxItemsCount;
        }

        return items;
    },

    getHighlited: function (string, substring) {
        var lowerString = string.toLowerCase();
        var lowerSubstring = substring.toLowerCase();

        if (lowerString.indexOf(lowerSubstring) >= 0) {
            var startIndex = lowerString.indexOf(lowerSubstring);
            var realSubstring = string.substr(startIndex, substring.length);

            return string.replace(realSubstring, '<strong>' + realSubstring + '</strong>');
        }

        return string;
    }

};

module.exports = factFinderSuggestions;