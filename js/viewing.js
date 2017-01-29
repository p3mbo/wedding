Viewing = function() {
    this.init();
};

$.extend(Viewing.prototype, {
    options: null,
    defaults :{
        viewingModalRequestSelector: '.js-viewing-modal-request',
        viewingModalSelector: '#viewingModal',
        viewingInfoCoupleSelector: '.js-viewing-couple',
        viewingInfoEmailSelector: '.js-viewing-email',
        viewingInfoCreatedSelector: '.js-viewing-created-at'
    },
    boards: [],
    init: function(overrideOptions) {
        console.info('Hello Viewing')
        this.options = $.extend({}, this.defaults, overrideOptions);
        this.addEvents();
    },
    showModalAction: function($el) {
        var self = this;

        var email = $el.closest('tr').data('email');
        $(self.options.viewingInfoCoupleSelector).html($el.closest('tr').data('couple'));
        $(self.options.viewingInfoEmailSelector).html('<a href="mailto:' + email + '">' + email + '</a>');
        $(self.options.viewingInfoCreatedSelector).html($el.closest('tr').data('created-at'));
        $(self.options.viewingModalSelector).modal('show');
    },
    requestViewingAction: function(el) {

    },
    showError: function(code) {
        console.error(code);
    },
    addEvents: function() {
        var self = this;

        // Calendar Navigation
        $(document).on('click', this.options.viewingModalRequestSelector, function(ev) {
            self.showModalAction($(this));
        });

    },
});

// example of using the class built above
var Viewing = new Viewing();