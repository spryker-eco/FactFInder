/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

var $ = require('jquery');

var factFinderTrack = {

    url: '/fact-finder/track?',

    query: function (queryData) {
        if (queryData == '') {
            return false;
        }

        $.ajax({
            type: 'GET',
            url: this.buildUrl(queryData),
            context: this,
            success: this.handleAjaxResponse
        });
    },

    handleAjaxResponse: function (response) {
        console.log(response);
    },

    buildUrl: function (queryData) {
        var queryString = '';

        $.each(queryData, function(key, value) {
            queryString += key + '=' + value + '&';
        });

        return this.url + queryString;
    }

};

module.exports = factFinderTrack;